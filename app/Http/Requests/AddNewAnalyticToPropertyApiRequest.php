<?php

namespace App\Http\Requests;

use App\Helpers\ApiFormRequest;

class AddNewAnalyticToPropertyApiRequest extends ApiFormRequest
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
            'analytic_type_id' => 'required|string|max:255',
            'value' => 'required|numeric|max:255',
        ];
    }
}
