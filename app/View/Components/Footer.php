<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Random\Randomizer;

class Footer extends Component
{
    /**
     * The random tags.
     */
    public $randomTags;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->randomTags = Cache::remember('random_tags', 360, function () {
            $result = [];
            $models = [
                '\App\Models\Tag\SubGenre',
                '\App\Models\Tag\Year',
                '\App\Models\Tag\Director',
                '\App\Models\Tag\Acting',
                '\App\Models\Tag\Language',
                '\App\Models\Tag\Production',
                '\App\Models\Tag\Country',
                '\App\Models\Tag\Distribution',
            ];

            $randomizer = new Randomizer;
            $randomModels = $randomizer->shuffleArray($models);

            while (count($result) < 4) {
                $index = $randomizer->getInt(0, count($randomModels) - 1);
                $model = $randomModels[$index];

                // Get the total count first
                $count = $model::has('posts')->count();

                if ($count > 0) {
                    // Get a random offset
                    $offset = $randomizer->getInt(0, $count - 1);

                    // Use offset to get a random record
                    $tag = $model::whereHas('posts', function ($query) {
                        $query->published();
                    })->offset($offset)
                        ->limit(1)
                        ->first();

                    if ($tag) {
                        $result[] = $tag;
                    }
                }
            }

            return $result;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
