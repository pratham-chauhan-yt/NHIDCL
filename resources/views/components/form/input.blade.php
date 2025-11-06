{{--
<x-form.input label="Full Name" placeholder="Enter Your Full Name" name="name" required />
--}}

@props([
    'label' => null,
    'smallLabel' => null,
    'name',
    'type' => 'text',
    'value' => '',
    'min' => null,
    'max' => null,
    'maxlength' => 2000,
    'required' => false,
    'placeholder' => '',
    'id' => $name,
    'wrapperClass' => '',
    'wrapperId' => '',
    'labelClass' => '',
    'inputClass' => '',
])

<div {{ $attributes->merge(['class' => $wrapperClass]) }}
    @if ($wrapperId) id="{{ $wrapperId }}" @endif>
    @if ($label)
        <label for="{{ $id }}"
            class="{{ $labelClass }} @if ($required) required-label @endif">
            {{ $label }} @if ($smallLabel)
                <small>({{ $smallLabel }})</small>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="{{ $inputClass }}"
        placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" maxlength="{{ $maxlength }}"
        @if ($min) min="{{ $min }}" @endif
        @if ($max) max="{{ $max }}" @endif
        @if ($required) required @endif {{ $attributes->except(['class']) }}>

    <span id="{{ $id }}_err" class="{{ $id }}_err candidateErr">
        @error($name)
            <div class="error">{{ $message }}</div>
        @enderror
    </span>
</div>
