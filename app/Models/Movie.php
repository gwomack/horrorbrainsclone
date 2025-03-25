<?php

namespace App\Models;

use App\Models\Tag\Tag;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mokhosh\FilamentRating\Components\Rating;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'release_date' => 'date',
        'rating' => 'float',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the tags for the movie.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'movie_tags')
            ->using(MovieTag::class)
            ->as('movie_tag')
            ->withPivot('id', 'movie_id', 'tag_id', 'type')
            ->withTimestamps();
    }

    /**
     * Get the directors for the movie.
     */
    public function director(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'director')
            ->withPivotValue('type', 'director');
    }

    /**
     * Get the writers for the movie.
     */
    public function writer(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'writer')
            ->withPivotValue('type', 'writer');
    }

    /**
     * Get the production for the movie.
     */
    public function production(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'production')
            ->withPivotValue('type', 'production');
    }

    /**
     * Get the actors for the movie.
     */
    public function acting(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'acting')
            ->withPivotValue('type', 'acting');
    }

    /**
     * Get the countries for the movie.
     */
    public function country(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'country')
            ->withPivotValue('type', 'country');
    }

    /**
     * Get the languages for the movie.
     */
    public function language(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'language')
            ->withPivotValue('type', 'language');
    }

    /**
     * Get the years for the movie.
     */
    public function year(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'year')
            ->withPivotValue('type', 'year');
    }

    /**
     * Get the sub genres for the movie.
     */
    public function subGenre(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'sub_genre')
            ->withPivotValue('type', 'sub_genre');
    }

    /**
     * Get the genres for the movie.
     */
    public function genre(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'genre')
            ->withPivotValue('type', 'genre');
    }

    /**
     * Get the distributors for the movie.
     */
    public function distribution(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'distribution')
            ->withPivotValue('type', 'distribution');
    }

    /**
     * Get the movie ratings for the movie.
     */
    public function movieRatings(): HasMany
    {
        return $this->hasMany(MovieRating::class);
    }

    /**
     * Get the movie types for the movie.
     */
    public function movieType(): BelongsToMany
    {
        return $this->tags()->wherePivot('type', 'movie_type')
            ->withPivotValue('type', 'movie_type');
    }

    /**
     * Get the form for the movie.
     */
    public static function getForm(): array
    {
        return [
            Section::make('Movie Information')
                ->collapsible()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->columns(1),
                    Forms\Components\TextInput::make('slug')
                        ->prefix('movie/')
                        ->required()
                        ->maxLength(255)
                        ->columns(1),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),
                    Fieldset::make('Publish Settings')
                        ->columns(2)
                        ->schema([
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->default(true),
                            Forms\Components\DateTimePicker::make('published_at')
                                ->readOnly(),
                        ]),
                    Fieldset::make('Advanced Filters')
                        ->columns(2)
                        ->schema([
                            Forms\Components\DatePicker::make('release_date')
                                ->native(false)
                                ->columns(1),
                            Rating::make('rating')
                                ->required()
                                ->stars(5)
                                ->allowZero(),
                        ]),
                ]),
            Section::make('Tags')
                ->collapsible()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('genre')
                        ->label('Genre')
                        ->multiple()
                        ->searchable()
                        ->relationship('genre', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('sub_genre')
                        ->label('Sub Genre')
                        ->multiple()
                        ->searchable()
                        ->relationship('subGenre', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('acting')
                        ->label('Acting')
                        ->columnSpan(2)
                        ->multiple()
                        ->searchable()
                        ->relationship('acting', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('director')
                        ->label('Director')
                        ->multiple()
                        ->searchable()
                        ->relationship('director', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('production')
                        ->label('Production')
                        ->multiple()
                        ->searchable()
                        ->relationship('production', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('writer')
                        ->label('Writer')
                        ->multiple()
                        ->searchable()
                        ->relationship('writer', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('distribution')
                        ->label('Distribution')
                        ->multiple()
                        ->searchable()
                        ->relationship('distribution', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('language')
                        ->label('Language')
                        ->multiple()
                        ->searchable()
                        ->relationship('language', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('country')
                        ->label('Country')
                        ->multiple()
                        ->searchable()
                        ->relationship('country', 'name')
                        ->createOptionForm(Tag::getForm()),
                    Forms\Components\Select::make('year')
                        ->label('Year')
                        ->searchable()
                        ->relationship('year', 'name')
                        ->createOptionForm(Tag::getForm())
                        // this is to make the movie type a single select
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->dehydrated(false)
                        ->multiple(false),
                    Forms\Components\Select::make('movie_type')
                        ->label('Movie Type')
                        ->searchable()
                        ->relationship('movieType', 'name')
                        ->createOptionForm(Tag::getForm())
                        // this is to make the movie type a single select
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->dehydrated(false)
                        ->multiple(false),
                ]),
        ];
    }
}
