<?php

namespace App\Http\Requests;

use App\Enums\CompanyCategory;
use App\Enums\CompanyType;
use App\Enums\FinanceType;
use App\Enums\StatusCompany;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Position;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{

  

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get the item ID from the route
        $itemId = $this->route('item') ?? $this->route('id');
        return [
            'category_id' => [
                'required',
                //Rule::exists('users', 'id'),
            ],
            'status' => [
                'required',
                //Rule::exists('users', 'id'),
            ],
            'price' => [
                'required',
                //Rule::exists('users', 'id'),
            ],
            'name' => ['required', 
            'string', 'max:255',  
            Rule::unique('items', 'name')->ignore($this->route('id'), 'id'),  // ✅ Ignore current item]->ignore($itemId),  
            ],
           // 'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'url' => ['required', 
            'string', 'max:55', 
            Rule::unique('items', 'url')->ignore($itemId)
               // ✅ Ignore current item]->ignore($itemId), 
            ]
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Item name is required.',
            'name.unique' => 'This item name already exists.',
            'name.max' => 'Item name must not exceed 255 characters.',
            'price.required' => 'Price is required.',
            'category_id.required' => 'Please select a category.',
        ];
    }
}
