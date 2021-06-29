<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTokenListRequest;
use App\Http\Requests\UpdateTokenListRequest;
use App\Http\Resources\Admin\TokenListResource;
use App\Models\TokenList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('token_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TokenListResource(TokenList::with(['assets'])->get());
    }

    public function store(StoreTokenListRequest $request)
    {
        $tokenList = TokenList::create($request->all());
        $tokenList->assets()->sync($request->input('assets', []));

        return (new TokenListResource($tokenList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TokenList $tokenList)
    {
        abort_if(Gate::denies('token_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TokenListResource($tokenList->load(['assets']));
    }

    public function update(UpdateTokenListRequest $request, TokenList $tokenList)
    {
        $tokenList->update($request->all());
        $tokenList->assets()->sync($request->input('assets', []));

        return (new TokenListResource($tokenList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TokenList $tokenList)
    {
        abort_if(Gate::denies('token_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tokenList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
