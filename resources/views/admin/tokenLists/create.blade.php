@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tokenList.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.token-lists.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.tokenList.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tokenList.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="assets">{{ trans('cruds.tokenList.fields.asset') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('assets') ? 'is-invalid' : '' }}" name="assets[]" id="assets" multiple required>
                    @foreach($assets as $id => $asset)
                        <option value="{{ $id }}" {{ in_array($id, old('assets', [])) ? 'selected' : '' }}>{{ $asset }}</option>
                    @endforeach
                </select>
                @if($errors->has('assets'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assets') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tokenList.fields.asset_helper') }}</span>
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