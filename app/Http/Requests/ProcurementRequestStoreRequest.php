<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementRequestStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            
            'title' => ['required', 'string', 'max:255'],
            'supplier' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'in:draft,submitted,approved,rejected'],
        ];
        

    }
}
