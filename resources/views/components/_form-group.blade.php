<div class="form-group row">
    @if((isset($label) && $label !== false) || !isset($label))
    <label for="{{ $name }}" class="col-lg">@lang($label ?? Str::ucfirst($name)):</label>
    @endif
    {{ $slot }}
    <div class="offset-lg-4 invalid-feedback">
        {{ $errors->first($name) }}
    </div>
</div>