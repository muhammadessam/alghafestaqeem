<?php

namespace App\Http\Requests;

class RequestRate extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [

                        // 'mobile' => 'required',
                        // 'name' => 'required',
                        // 'address' => 'required',
                        // 'real_estate_area' => 'required',
                        // 'real_estate_age' => 'required',
                        // 'goal_id' => 'required|exists:categories,id',
                        // 'usage_id' => 'required|exists:categories,id',
                        // 'type_id' => 'required|exists:categories,id',
                        //   'goal_id' => 'exists:categories,id',
                        // 'usage_id' => 'exists:categories,id',
                        // 'type_id' => 'exists:categories,id',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        // UPDATE ROLES

                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            'name' => 'الاسم مطلوب',
            'address' => 'عنوان طالب التقييم مطلوب',
            'real_estate_area' => 'المساحة (م2) مطلوب',
            'type_id' => 'نوع العقار محل التقييم مطلوب',
            'usage_id' => 'استعمال العقار مطلوب',
            'real_estate_age' => 'العمر (سنوات) مطلوب',
        ];
    }
}