<?php

namespace App\Filament\Resources\PostResource\Api\Requests;

use App\Models\Post\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'slug' => function ($attribute, $value, $fail) {
                if (! Str::contains(request('title'), '('.request('year').')')) {
                    $slug = Str::slug(request('title').'('.request('year').')');
                } else {
                    $slug = Str::slug(request('title'));
                }

                if (Post::where('slug', $slug)->exists()) {
                    $fail('Movie already exists.');
                }
            },
            'synopsis' => 'required|string',
            'release_date' => 'date',
            'rating' => 'numeric|min:1|max:5',
            'is_published' => 'boolean',
            'published_at' => 'date',
            'deleted_at' => 'date',
            'tmdb_id' => 'integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'slug.unique' => 'The slug has already been taken.',
            'rating.min' => 'The rating must be at least 1.',
            'rating.max' => 'The rating must be at most 5.',
            'synopsis.required' => 'The synopsis is required.',
            'release_date.date' => 'The release date must be a valid date.',
            'tmdb_id.integer' => 'The TMDB ID must be an integer.',
        ];
    }
}
