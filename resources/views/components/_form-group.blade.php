<div class="form-group row">
    <label for="{{ $name }}" class="col-lg-4">@lang($label ?? Str::ucfirst($name)):</label>
    {{ $slot }}
    <div class="offset-lg-4 invalid-feedback">
        {{ $errors->first($name) }}
    </div>
</div>