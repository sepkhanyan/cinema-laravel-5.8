<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HallUpdateRequest extends FormRequest
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
        return [

            'rows' => 'required|integer',
            'chairs' => 'required|integer',
            'title' => [
                'required',
                'max:255',
                Rule::unique('halls')->ignore($this->hall->id, 'id')
                    ->where(function ($query) {
                    return $query->where('cinema_id', $this->hall->cinem_id);
                })
            ]
        ];
    }
}
