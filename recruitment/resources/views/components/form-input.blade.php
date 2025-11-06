@props([
    'label',
    'name',
    'value' => '',
    'type' => 'text',
    'min' => '',
    'max' => '',
    'maxlength' => '',
    'required' => false,
    'disabled' => false,
])

<div class="col-12 col-sm-12 col-md-4 col-lg-4">
    <div class="mb-3">
        <label for="{{ $name }}"
            class="form-label @if ($required) aster @endif">{!! $label !!}</label>
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" autocomplete="off"
            value="{{ old($name, $value) }}" class="form-control @error($name) is-invalid @enderror"
            @if ($maxlength) maxlength="{{ $maxlength }}" @endif
            @if ($min) min="{{ $min }}" @endif
            @if ($max) max="{{ $max }}" @endif
            @if ($required) required @endif @if ($disabled) disabled @endif />

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
