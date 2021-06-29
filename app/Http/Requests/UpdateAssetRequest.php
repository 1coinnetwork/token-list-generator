<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAssetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_edit');
    }

    public function rules()
    {
        return [
            'symbol' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'network_id' => [
                'required',
                'integer',
            ],
            'contract_address' => [
                'string',
                'required',
            ],
            'logo_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
