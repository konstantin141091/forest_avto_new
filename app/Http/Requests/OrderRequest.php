<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|max:100',
            'phone' => 'required|max:12',
            'delivery_method' => 'required',
            'address' => 'max:150',
            'comment' => 'max:200',
            'payment_method' => 'required',
        ];
    }
    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'delivery_method' => 'Способ доставки',
            'address' => 'Адрес',
            'comment' => 'Коментарий',
            'payment_method' => 'Способ оплаты',
        ];
    }
}
