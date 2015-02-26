<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest {
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => ["required", "unique:users"],
            "email" => ["required", "email", "unique:users"],
            "password" => ["required", "min:8"],
            "password_confirmation" => ["required", "same:password"],
        ];
    }
}
