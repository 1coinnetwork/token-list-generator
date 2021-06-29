<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTokenListRequest;
use App\Http\Requests\StoreTokenListRequest;
use App\Http\Requests\UpdateTokenListRequest;
use App\Models\Asset;
use App\Models\TokenList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenListController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('token_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tokenLists = TokenList::with(['assets'])->get();

        return view('admin.tokenLists.index', compact('tokenLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('token_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::all()->pluck('symbol', 'id');

        return view('admin.tokenLists.create', compact('assets'));
    }

    public function store(StoreTokenListRequest $request)
    {
        $tokenList = TokenList::create($request->all());
        $tokenList->assets()->sync($request->input('assets', []));

        return redirect()->route('admin.token-lists.index');
    }

    public function edit(TokenList $tokenList)
    {
        abort_if(Gate::denies('token_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::all()->pluck('symbol', 'id');

        $tokenList->load('assets');

        return view('admin.tokenLists.edit', compact('assets', 'tokenList'));
    }

    public function update(UpdateTokenListRequest $request, TokenList $tokenList)
    {
        $tokenList->update($request->all());
        $tokenList->assets()->sync($request->input('assets', []));

        return redirect()->route('admin.token-lists.index');
    }

    public function show(TokenList $tokenList)
    {
        abort_if(Gate::denies('token_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tokenList->load('assets');

        return view('admin.tokenLists.show', compact('tokenList'));
    }

    public function destroy(TokenList $tokenList)
    {
        abort_if(Gate::denies('token_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tokenList->delete();

        return back();
    }

    public function massDestroy(MassDestroyTokenListRequest $request)
    {
        TokenList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
