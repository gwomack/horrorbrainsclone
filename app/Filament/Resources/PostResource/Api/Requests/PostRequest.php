<?php

namespace App\Filament\Resources\PostResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'slug' => 'required',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'rating' => 'required|numeric',
            'is_published' => 'required',
            'published_at' => 'required',
            'deleted_at' => 'required',
        ];
    }
}
