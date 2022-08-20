<?php

namespace App\Http\Requests;

use App\DTO\Order\CalculateOrderDTO;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $expiry_day = now()->addDays(24)->toDateString();

        return [
            'volume'            => ['required','integer','min:1'],
            'temperature'       => ['required','integer'],
            'start_shelf_life'  => ['required','date', 'after_or_equal:today'],
            'end_shelf_life'    => ['required','date','before_or_equal:'.$expiry_day]
        ];
    }

    public function messages()
    {
        return [
            'start_shelf_life.after_or_equal' => 'В поле :attribute должна быть дата после или равняться '.now()->toDateString().'.',
        ];
    }

    public function attributes()
    {
        return [
            'volume'            => 'Объем',
            'temperature'       => 'Температура',
            'start_shelf_life'  => 'Начало срока хранения',
            'end_shelf_life'    => 'Конец срока хранения'
        ];
    }

    public function getCalculationDTO()
    {
        return new CalculateOrderDTO([
            'volume'            => (int) $this->input('volume'),
            'temperature'       => (int) $this->input('temperature'),
            'start_shelf_life'  => Carbon::make($this->input('start_shelf_life')),
            'end_shelf_life'    => Carbon::make($this->input('end_shelf_life'))
        ]);
    }
}
