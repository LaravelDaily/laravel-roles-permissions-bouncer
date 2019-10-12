@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.role.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('abilities') ? 'has-error' : '' }}">
                <label for="abilities">{{ trans('cruds.role.fields.abilities') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="abilities[]" id="abilities" class="form-control select2" multiple="multiple" required>
                    @foreach($abilities as $id => $abilities)
                        <option value="{{ $id }}" {{ in_array($id, old('abilities', [])) || $role->getAbilities()->pluck('name', 'name')->contains($abilities) ? 'selected' : '' }}>{{ $abilities }}</option>
                    @endforeach
                </select>
                @if($errors->has('abilities'))
                    <em class="invalid-feedback">
                        {{ $errors->first('abilities') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.role.fields.abilities_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
