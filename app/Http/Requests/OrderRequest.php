<?php

namespace App\Http\Requests;

class OrderRequest extends BaseOrderRequest
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

    protected function getRedirectUrl()
    {
        if (!$this->routeIs('calculate.view')) {
            return route('calculate.view', $this->route('location'));
        }

        return parent::getRedirectUrl();
    }
}
