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
            'dni'=>'required|regex:/^[0-9]{8}$/',
            'names'=>'required|string|regex:/^[\pL\s]+$/u',
            'surnames'=>'required|string|regex:/^[\pL\s]+$/u',
            'id_area'=>'required|exists:areas,id',
        ];
    }
    public function attributes(){
        return[
            'id_area'=>'área',
        ];
    }
}
