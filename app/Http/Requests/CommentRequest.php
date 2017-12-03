<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                    "body" => "required|max:1024",
                    "commentable_id" => "required",
                    "commentable_type" => "required"
                ];
            }
            // UPDATE
            case 'PUT':
            {
                return [];
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
