<?php

namespace App\Http\Requests;

use App\Models\Network;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNetworkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('network_edit');
    }

    public function rules()
    {
        return [
            'chainid' => [
                'required',
                'integer',
                'min:0',
                'max:2147483647',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
