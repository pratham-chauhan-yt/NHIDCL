@props(['label', 'name', 'options' => [], 'required' => false, 'keyValuePair' => false])

<div class="col-12 col-sm-12 col-md-4 col-lg-4">
    <div class="mb-3">
        <label class="form-label @if ($required) aster @endif">{{ $label }}</label>
        <div class="radio-btns-inp d-flex align-items-center h-100">
            @foreach ($options as $value => $text)
                <div class="form-check form-check-inline">
                    <!-- If the options are in simple array format, handle it as a value with no explicit key -->
                    @if ($keyValuePair)
                        <input class="form-check-input @error($name) is-invalid @enderror" type="radio"
                            name="{{ $name }}" id="{{ $text }}" value="{{ $value }}"
                            @checked(old($name)) @if ($required) required @endif>
                        <label class="form-check-label" for="{{ $text }}">{{ $text }}</label>
                        <!-- If the options are in key-value pair format, handle it as key and text -->
                    @else
                        <input class="form-check-input @error($name) is-invalid @enderror" type="radio"
                            name="{{ $name }}" id="{{ $text }}" value="{{ $text }}"
                            @checked(old($name) == $text) @if ($required) required @endif>
                        <label for="{{ $text }}" class="form-check-label">{{ $text }}</label>
                    @endif
                </div>
            @endforeach
        </div>

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
