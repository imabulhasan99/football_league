<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AddLeague extends FormRequest
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
         
                'league_name' => 'required|string|max:255',
                'league_country' => 'required|string|max:255',
                'league_flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ];
    }
}
