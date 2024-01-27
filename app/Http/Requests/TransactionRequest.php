<?php

namespace App\Http\Requests;

class TransactionRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
                // CREATE
            case 'POST': {
                    return [
                        'evaluation_company_id' => 'required|exists:evaluation_companies,id',
                        'type_id' => 'required|exists:categories,id',
                        'instrument_number' => 'required|string|unique:evaluation_transactions,instrument_number',
                        'transaction_number' => 'required|string',
                        'date' =>    'required',
                        'owner_name' => 'required|string',
                        'region' => 'string',
                        'files.*' => 'mimes:jpg,png,jpeg,pdf,docx,xlsx',
                        'new_city_id' => 'required|integer',
                        'plan_no' => 'required|integer',
                        'plot_no' => 'required|integer',
                        'preview_date' => 'date|nullable',
                        'preview_time' => 'string|nullable',
                        'review_date' => 'date|nullable',
                        'review_time' => 'string|nullable',
                        'income_date' => 'date|nullable',
                        'income_time' => 'string|nullable',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH': {
                    return [
                        'evaluation_company_id' => 'required|exists:evaluation_companies,id',
                        'type_id' => 'required|exists:categories,id',
                        'instrument_number' => 'required|string',
                        'transaction_number' => 'required|string',
                        'date' =>    'required',
                        'owner_name' => 'required|string',
                        'region' => 'string',
                        'files.*' => 'mimes:jpg,png,jpeg,pdf,docx,xlsx',
                        'new_city_id' => 'integer',
                        'plan_no' => 'integer',
                        'plot_no' => 'integer',
                        'preview_date' => 'date|nullable',
                        'preview_time' => 'string|nullable',
                        'review_date' => 'date|nullable',
                        'review_time' => 'string|nullable',
                        'income_date' => 'date|nullable',
                        'income_time' => 'string|nullable',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default: {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [];
    }
}
