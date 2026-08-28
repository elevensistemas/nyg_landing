@extends('layouts.admin')

@section('title', 'Configuración')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf @method('PUT')

    @foreach($settings as $group => $items)
        <h2 class="h5 text-capitalize">{{ $group }}</h2>
        <div class="row mb-4">
            @foreach($items as $setting)
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ $setting->label ?? $setting->key }}</label>
                    @if($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" name="settings[{{ $setting->key }}]" class="form-control" value="{{ $setting->value }}">
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach

    <button type="submit" class="btn btn-cta">Guardar configuración</button>
</form>
@endsection
