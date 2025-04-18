<?php

namespace App\Models\Post;

use App\Models\Tag\Acting;
use App\Models\Tag\Country;
use App\Models\Tag\Director;
use App\Models\Tag\Distribution;
use App\Models\Tag\Genre;
use App\Models\Tag\Language;
use App\Models\Tag\PostType;
use App\Models\Tag\Production;
use App\Models\Tag\SubGenre;
use App\Models\Tag\Tag;
use App\Models\Tag\TrendingHomePage;
use App\Models\Tag\Writer;
use App\Models\Tag\Year;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTag
{
    /**
     * Get the tags for the post.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the post tags for the post.
     */
    public function postTag(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }

    /**
     * Get the actors for the post.
     */
    public function acting(): BelongsToMany
    {
        return $this->belongsToMany(Acting::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class)
            ->withPivot('custom');
    }

    /**
     * Get the acting pivot for the post.
     */
    public function actingPivot(): HasMany
    {
        return $this->postTag()->whereHas('acting');
    }

    /**
     * Get the directors for the post.
     */
    public function director(): BelongsToMany
    {
        return $this->belongsToMany(Director::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the writers for the post.
     */
    public function writer(): BelongsToMany
    {
        return $this->belongsToMany(Writer::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the production for the post.
     */
    public function production(): BelongsToMany
    {
        return $this->belongsToMany(Production::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the countries for the post.
     */
    public function country(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the languages for the post.
     */
    public function language(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the years for the post.
     */
    public function year(): BelongsToMany
    {
        return $this->belongsToMany(Year::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the sub genres for the post.
     */
    public function subGenre(): BelongsToMany
    {
        return $this->belongsToMany(SubGenre::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the genres for the post.
     */
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the post types for the post.
     */
    public function PostType(): BelongsToMany
    {
        return $this->belongsToMany(PostType::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the distributors for the post.
     */
    public function distribution(): BelongsToMany
    {
        return $this->belongsToMany(Distribution::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }

    /**
     * Get the trending home pages for the post.
     */
    public function trendingHomePage(): BelongsToMany
    {
        return $this->belongsToMany(TrendingHomePage::class, 'post_tags', 'post_id', 'tag_id')
            ->using(PostTag::class);
    }
}
