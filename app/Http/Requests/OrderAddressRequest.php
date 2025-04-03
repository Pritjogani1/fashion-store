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
           'address_id' =>'sometimes|integer',
           'full_name' =>'required_if:address_id,new|string|max:255',
           'address_line' => 'required_if:address_id,new|string|max:255',
            'city' => 'required_if:address_id,new|string|max:255',
            'state' => 'required_if:address_id,new|string|max:255',
            'pincode' => 'required_if:address_id,new|string|max:10',
            'country' => 'required_if:address_id,new|string|max:255',
            'phone' =>'required_if:address_id,new|string|max:20',
            'set_default' => 'sometimes|boolean'
        ];
    }

    public function messages()
    {
        return [
            'address_id.required' => 'Please select or add an address',
            'street.required_if' => 'Street address is required',
            'city.required_if' => 'City is required',
            'state.required_if' => 'State is required',
            'zip.required_if' => 'ZIP code is required',
            'country.required_if' => 'Country is required',
        ];
    }
}