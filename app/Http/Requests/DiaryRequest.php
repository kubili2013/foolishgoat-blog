<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
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
                    "tags" => "required|max:64",
                    "content" => "required",
                ];
            }
            // UPDATE
            case 'PUT':
            {
                return [
                    "tags" => "required|max:64",
                    "content" => "required",
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
