<?php

namespace App\Http\Requests;

use App\Enums\CompanyCategory;
use App\Enums\CompanyType;
use App\Enums\FinanceType;
use App\Enums\StatusCompany;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Position;
use Illuminate\Validation\Rule;

class UpdateCategoryLocalizationRequest extends FormRequest
{

  

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'locale' => [
                'required',
                Rule::unique('categories_localizations')
                    ->ignore($this->input('locale_id'))
                    ->where(fn ($query) => 
                    $query->where('category_id', $this->input('category_id'))
                    
                ),
            ],
            'category_id' => ['required', 'string', 'max:255'],
            'name' => ['required', 
            'string', 'max:255',  
            Rule::unique('categories_localizations', 'name')->ignore($this->input('locale_id'), 'id'),  // ✅ Ignore current item]->ignore($itemId),  
            ],
            'description' => ['required', 'string', 'max:5555'],
           
        ];
            //'company_email' => 'sometimes|email|unique:companies,company_email,' . $this->route('id'),

    }
    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required.',
            'name.unique' => 'This category name already exists.',
            'name.max' => 'Item name must not exceed 255 characters.',
            'locale.unique' => 'This locale already exists.',
            'description.required' => 'description is required.',
        ];
    }
}
