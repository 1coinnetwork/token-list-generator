<?php

namespace App\Http\Requests;

use App\Models\TokenList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTokenListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('token_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:token_lists,id',
        ];
    }
}
