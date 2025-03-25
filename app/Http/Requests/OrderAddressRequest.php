<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'address_line' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'country' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Please enter your full name',
            'address_line.required' => 'Please enter your address',
            'city.required' => 'Please enter your city',
            'state.required' => 'Please enter your state',
            'pincode.required' => 'Please enter your pincode',
            'phone.required' => 'Please enter your phone number',
            'country.required' => 'Please enter your country',
        ];
    }
}