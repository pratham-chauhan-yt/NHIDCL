@props(['label', 'name', 'rows' => '1', 'value' => '', 'maxlength' => '', 'required' => false])

<div class="col-12 col-sm-12 col-md-4 col-lg-4">
    <div class="mb-3">
        <label for="{{ $name }}"
            class="form-label @if ($required) aster @endif">{{ $label }}</label>
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" autocomplete="off"
            class="form-control @error($name) is-invalid @enderror"
            @if ($maxlength) maxlength="{{ $maxlength }}" @endif
            @if ($required) required @endif>{{ old($name, $value) }}</textarea>

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
