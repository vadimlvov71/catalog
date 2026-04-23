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
            /*'user_id' => [
                'sometimes',
                Rule::unique('companies', 'user_id')->ignore($this->route('id'), 'id'),
                Rule::exists('users', 'id'),
            ],*/

            'name' => ['required', 'string', 'max:255', 'unique:categories'],
            'description' => ['required', 'string', 'max:5555'],
           
        ];
            //'company_email' => 'sometimes|email|unique:companies,company_email,' . $this->route('id'),

    }
}
