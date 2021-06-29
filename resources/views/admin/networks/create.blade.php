@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.network.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.networks.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="chainid">{{ trans('cruds.network.fields.chainid') }}</label>
                <input class="form-control {{ $errors->has('chainid') ? 'is-invalid' : '' }}" type="number" name="chainid" id="chainid" value="{{ old('chainid', '85') }}" step="1" required>
                @if($errors->has('chainid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chainid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.network.fields.chainid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.network.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.network.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rpc_url">{{ trans('cruds.network.fields.rpc_url') }}</label>
                <input class="form-control {{ $errors->has('rpc_url') ? 'is-invalid' : '' }}" type="text" name="rpc_url" id="rpc_url" value="{{ old('rpc_url', 'https://data.1coin.network') }}">
                @if($errors->has('rpc_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rpc_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.network.fields.rpc_url_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection