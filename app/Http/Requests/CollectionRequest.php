<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            // Crate
            case 'POST':
            {
                return [
                    "title" => "required|unique:shares|max:64",
                    "tags" => "required|max:64",
                    "content" => "required",
                    "type" =>"required|in:audio,video,article,website"
                ];
            }
            // UPDATE
            case 'PUT':
            {
                return [
                    "title" => "required|max:64",
                    "tags" => "required|max:64",
                    "content" => "required",
                    "type" =>"required|in:audio,video,article,website"
                ];
            }
            case 'PATCH':
            {
                return [
                ];
            }
            default:break;
        }
        return [];
    }
}
