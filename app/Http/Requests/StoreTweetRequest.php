<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $media
 * @property mixed $resource_type
 * @property mixed $content
 * @property mixed $image
 * @property mixed $replays_on_id
 *
 */
class StoreTweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string|min:1|max:500',
            'image' => 'nullable',
            'replays_on_id' => 'nullable',
            'resource_type' => 'nullable',
            'media' => 'nullable',
        ];
    }
}
