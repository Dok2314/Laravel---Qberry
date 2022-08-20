<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseOrderRequest;
use App\Models\Location;

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

    public function getLocation()
    {
        return Location::find($this->input('location_id'));
    }
}
