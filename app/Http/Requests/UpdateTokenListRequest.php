<?php

namespace App\Http\Requests;

use App\Models\TokenList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTokenListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('token_list_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:token_lists,name,' . request()->route('token_list')->id,
            ],
            'assets.*' => [
                'integer',
            ],
            'assets' => [
                'required',
                'array',
            ],
        ];
    }
}
