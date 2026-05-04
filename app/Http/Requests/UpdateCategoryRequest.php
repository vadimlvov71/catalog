<?php

namespace App\Http\Requests;

use App\Enums\CompanyCategory;
use App\Enums\CompanyType;
use App\Enums\FinanceType;
use App\Enums\StatusCompany;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Position;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{

  

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        return [
            /*'user_id' => [
                'sometimes',
                Rule::unique('companies', 'user_id')->ignore($this->route('id'), 'id'),
                Rule::exists('users', 'id'),
            ],*/
           'name' => ['required', 
            'string', 'max:255',  
            Rule::unique('categories', 'name')->ignore($this->route('id'), 'id'),  // ✅ Ignore current item]->ignore($itemId),  
            ],
           // 'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'url' => ['required', 
            'string', 'max:55', 
            Rule::unique('categories', 'url')->ignore($this->route('id'), 'id'),
               // ✅ Ignore current item]->ignore($itemId), 
            ],
            'status' => [
                'required',
                //Rule::exists('users', 'id'),
            ],
           
        ];
            //'company_email' => 'sometimes|email|unique:companies,company_email,' . $this->route('id'),

    }
    public function messages(): array
    {
        return [
            'name.required' => 'Item name is required.',
            'name.unique' => 'This category name already exists.',
            'name.max' => 'Item name must not exceed 255 characters.',
            'url.unique' => 'This category url already exists.',
            'category_id.required' => 'Please select a category.',
        ];
    }
}
