<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'dni'=>'required|regex:/^[0-9]{8}$/|unique:users,dni',
            'names'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'surnames'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'password'=>'required|min:8|min:8|same:password_confirm',
            'level'=>'required',
            'status'=>'required',
        ];
    }
    public function attributes(){
        return[
            'password_confirm'=>'confirmar contraseña',
        ];
    }
}
