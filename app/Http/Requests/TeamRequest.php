<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'team_name' => 'required|string|max:255',
            'team_flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_currently_playing' => 'required|boolean',
            'founded' => 'required|date_format:Y',
        ];
        
    }

    public function messages(): array
    {
        return [
            'league_name'           => 'You have to fill out league name',
            'team_name'             => 'You have to fill out team name',
            'is_currently_playing'  => 'You have to chose an option',
            'founded'               => 'Date format should be Y. Enter a valid Year only',
            'team_flag'             => 'Team flag should be jpeg,png,jpg,gif or svg'
        ];
    }
}
