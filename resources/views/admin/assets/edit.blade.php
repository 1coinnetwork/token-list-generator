@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="symbol">{{ trans('cruds.asset.fields.symbol') }}</label>
                <input class="form-control {{ $errors->has('symbol') ? 'is-invalid' : '' }}" type="text" name="symbol" id="symbol" value="{{ old('symbol', $asset->symbol) }}" required>
                @if($errors->has('symbol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('symbol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.symbol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="network_id">{{ trans('cruds.asset.fields.network') }}</label>
                <select class="form-control select2 {{ $errors->has('network') ? 'is-invalid' : '' }}" name="network_id" id="network_id" required>
                    @foreach($networks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('network_id') ? old('network_id') : $asset->network->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('network'))
                    <div class="invalid-feedback">
                        {{ $errors->first('network') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.network_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contract_address">{{ trans('cruds.asset.fields.contract_address') }}</label>
                <input class="form-control {{ $errors->has('contract_address') ? 'is-invalid' : '' }}" type="text" name="contract_address" id="contract_address" value="{{ old('contract_address', $asset->contract_address) }}" required>
                @if($errors->has('contract_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contract_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.contract_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.asset.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo_url">{{ trans('cruds.asset.fields.logo_url') }}</label>
                <input class="form-control {{ $errors->has('logo_url') ? 'is-invalid' : '' }}" type="text" name="logo_url" id="logo_url" value="{{ old('logo_url', $asset->logo_url) }}">
                @if($errors->has('logo_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.logo_url_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.assets.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($asset) && $asset->logo)
      var file = {!! json_encode($asset->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection