<?php

namespace App\Filament\Resources\TagResource\Api\Requests;

use App\Models\Tag\Tag;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
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
			'description' => 'text',
			'name' => [
                'string', 'required',
                function ($attribute, $value, $fail) {
                    if (Tag::where('slug', Str::slug($value))->exists()) {
                        $fail('Tag already exists.');
                    }
                },
            ],
			'slug' => 'string|unique:tags,slug'
		];
    }
}
