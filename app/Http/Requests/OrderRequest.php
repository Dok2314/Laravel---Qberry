<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
        $today      = \Carbon\Carbon::now();
        $expiry_day = $today->addDays(24);

        return [
            'volume'            => ['required','integer'],
            'temperature'       => ['required','integer'],
            'start_shelf_life'  => ['required','date', 'after_or_equal:today'],
            'end_shelf_life'    => ['required','date','before_or_equal:'.$expiry_day]
        ];
    }

    public function messages()
    {
        $today      = \Carbon\Carbon::now();
        $expiry_day = $today->addDays(24);

        return [
            'volume.required'                  => 'Заполните пожалуйста поле',
            'temperature.required'             => 'Заполните пожалуйста поле',
            'start_shelf_life.required'        => 'Заполните пожалуйста поле',
            'end_shelf_life.required'          => 'Заполните пожалуйста поле',
            'start_shelf_life.after_or_equal'  => 'Начальный срок годности должен быть датой после сегодняшнего дня или равным ему.',
            'end_shelf_life.before_or_equal'   => 'Конечный срок годности должен быть датой, предшествующей или равной ' . $expiry_day
        ];
    }
}
