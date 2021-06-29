<?php

namespace App\Http\Requests;

use App\Models\TokenList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTokenListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('token_list_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:token_lists',
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
