<?php

namespace App\Http\Requests;

use App\Models\Network;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNetworkRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('network_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'chainids'   => 'required|array',
            'chainids.*' => 'exists:networks,chainid',
        ];
    }
}
