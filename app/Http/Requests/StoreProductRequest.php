<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student')->id; // Obtener el ID del estudiante de la ruta

        return [
            'name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'dni' => 'required|integer|unique:students,dni,' . $studentId,
            'birthday' => 'required',
            'group' => 'required'
        ];
    }
}
