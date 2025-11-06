@props(['label', 'name', 'options' => [], 'required' => false])

<div class="col-12 col-sm-12 col-md-4 col-lg-4">
    <div class="mb-3">
        <label for="{{ $name }}" class="form-label @if ($required) aster @endif">{{ $label }}</label>
        <select name="{{ $name }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
            @if ($required) required @endif>
            <option value="">Select</option>

            @foreach ($options as $value => $text)
                <!-- Handle simple value array (no key-value pair) -->
                @if (is_int($value))
                    <option value="{{ $text }}" @selected(old($name) == $text)>{{ $text }}</option>
                    <!-- Handle key-value pair array -->
                @else
                    <option value="{{ $value }}" @selected(old($name) == $value)>{{ $text }}</option>
                @endif
            @endforeach
        </select>

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
