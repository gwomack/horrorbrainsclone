<?php

namespace App\Console\Commands\ApiService;

use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Rupadana\ApiService\Commands\MakeApiRequest as MakeApiRequestBase;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeApiRequest extends MakeApiRequestBase
{
    protected $signature = 'make:my-filament-api-request {name?} {resource?} {--panel=}';

    protected $description = 'Create a new custom API Request';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = (string) str($this->argument('name') ?? text(
            label: 'What is the Request name?',
            placeholder: 'CreateRequest',
            required: true,
        ))
            ->studly()
            ->beforeLast('Request')
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->studly()
            ->replace('/', '\\');

        $model = (string) str($this->argument('resource') ?? text(
            label: 'What is the Resource name?',
            placeholder: 'Blog',
            required: true,
        ))
            ->studly()
            ->beforeLast('Resource')
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->studly()
            ->replace('/', '\\');

        if (blank($model)) {
            $model = 'Resource';
        }

        $modelClass = (string) str($model)->afterLast('\\');

        $modelNamespace = str($model)->contains('\\') ?
            (string) str($model)->beforeLast('\\') :
            '';
        $pluralModelClass = (string) str($modelClass)->pluralStudly();

        $panel = $this->option('panel');

        if ($panel) {
            $panel = Filament::getPanel($panel);
        }

        if (! $panel) {
            $panels = Filament::getPanels();

            /** @var Panel $panel */
            $panel = (count($panels) > 1) ? $panels[select(
                label: 'Which panel would you like to create this in?',
                options: array_map(
                    fn (Panel $panel): string => $panel->getId(),
                    $panels,
                ),
                default: Filament::getDefaultPanel()->getId()
            )] : Arr::first($panels);
        }

        $resourceDirectories = $panel->getResourceDirectories();
        $resourceNamespaces = $panel->getResourceNamespaces();

        $namespace = (count($resourceNamespaces) > 1) ?
            select(
                label: 'Which namespace would you like to create this in?',
                options: $resourceNamespaces
            ) : (Arr::first($resourceNamespaces) ?? 'App\\Filament\\Resources');
        $path = (count($resourceDirectories) > 1) ?
            $resourceDirectories[array_search($namespace, $resourceNamespaces)] : (Arr::first($resourceDirectories) ?? app_path('Filament/Resources/'));

        $nameClass = "{$name}{$model}Request";
        $resource = "{$model}Resource";
        $resourceClass = "{$modelClass}Resource";
        $resourceNamespace = $modelNamespace;
        $namespace .= $resourceNamespace !== '' ? "\\{$resourceNamespace}" : '';

        $baseResourcePath =
            (string) str($resource)
                ->prepend('/')
                ->prepend($path)
                ->replace('\\', '/')
                ->replace('//', '/');

        $requestDirectory = "{$baseResourcePath}/Api/Requests/$nameClass.php";

        $modelNamespace = app("{$namespace}\\{$resourceClass}")->getModel();

        // dd("{$namespace}\\{$resourceClass}\\Api\\Requests", $requestDirectory);

        $this->copyStubToApp('Request', $requestDirectory, [
            'namespace' => "{$namespace}\\{$resourceClass}\\Api\\Requests",
            'nameClass' => $nameClass,
            'validationRules' => $this->getValidationRules(new $modelNamespace),
        ]);

        $this->components->info("Successfully created API {$nameClass} for {$resource}!");

        return static::SUCCESS;
    }

    /**
     * Get the validation rules for the model.
     */
    public function getValidationRules(Model $model)
    {
        $tableName = $model->getTable();

        if (config('database.default') === 'pgsql') {
            $columns = DB::select("
                SELECT *
                FROM information_schema.columns
                WHERE table_name = '{$tableName}'
            ");
        } else {
            $columns = DB::select("SHOW COLUMNS FROM `{$tableName}`");
        }

        // dd($columns);

        $validationRules = collect($columns)
            ->filter(function ($column) {
                // Mengabaikan kolom 'created_at' dan 'updated_at'
                if (config('database.default') === 'pgsql') {
                    return ! in_array($column->column_name, ['id', 'created_at', 'updated_at']);
                } else {
                    return ! in_array($column->Field, ['id', 'created_at', 'updated_at']);
                }
            })
            ->map(function ($column) {
                if (config('database.default') === 'pgsql') {
                    $field = $column->column_name;
                    $type = $column->data_type;
                } else {
                    $field = $column->Field;
                    $type = $column->Type;
                }

                // Pemetaan tipe data ke validasi Laravel menggunakan match
                $rule = 'required'; // Tambahkan aturan 'required' sebagai default

                $rule .= match (true) {
                    str_contains($type, 'int') => '|integer',
                    str_contains($type, 'varchar'), str_contains($type, 'text') => '|string',
                    str_contains($type, 'date') => '|date',
                    str_contains($type, 'decimal'), str_contains($type, 'float'), str_contains($type, 'double') => '|numeric',
                    default => '',
                };

                return "\t\t\t'{$field}' => '{$rule}'";
            })
            ->implode(",\n");

        return "[\n".$validationRules."\n\t\t]";
    }
}
