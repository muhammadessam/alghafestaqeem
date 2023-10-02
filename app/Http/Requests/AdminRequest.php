<?php

namespace App\Http\Requests;

class AdminRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'email' => 'required',
                    'password' => 'required|min:8',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'email' => [
                        'required',
                    ],
                    'mobile' => [
                        'required'
                    ],
                    'name' => 'required|string',
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
            // Validation messages
        ];
    }
}