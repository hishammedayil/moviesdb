<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SplFileInfo;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        if ($this->getMethod() == self::METHOD_PUT) {
            $coverImageRules = 'mimes:jpg,bmp,png,jpeg|file|max:500000';
        } else {
            $coverImageRules = 'required|mimes:jpg,bmp,png,jpeg|file|max:500000';
        }
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'released_on' => 'required|date|date_format:Y-m-d',
            'rating' => 'required|between:1,5',
            'ticket_price' => 'required|numeric',
            'country' => 'required',
            'genres' => 'required',
            'cover_image' => $coverImageRules
        ];
    }

    public function getFillables(): array
    {
        return $this->only([
            'name',
            'description',
            'released_on',
            'rating',
            'ticket_price',
            'country',
            'genres'
        ]);
    }

    public function getCoverImage(): ?SplFileInfo
    {
        return $this->file('cover_image');
    }
}
