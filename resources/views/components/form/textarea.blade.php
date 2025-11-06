@props([
    'label' => null,
    'name',
    'value' => '',
    'required' => false,
    'rows' => 1,
    'placeholder' => '',
    'id' => $name,
    'wrapperClass' => '',
    'wrapperId' => '',
    'labelClass' => '',
    'textareaClass' => '',
])

<div {{ $attributes->merge(['class' => $wrapperClass]) }}
    @if ($wrapperId) id="{{ $wrapperId }}" @endif>
    @if ($label)
        <label for="{{ $id }}"
            class="{{ $labelClass }} @if ($required) required-label @endif">
            {{ $label }}
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" class="{{ $textareaClass }}"
        placeholder="{{ $placeholder }}" @if ($required) required @endif
        {{ $attributes->except(['class']) }}>{{ old($name, $value) }}</textarea>

    <span id="{{ $id }}_err" class="{{ $id }}_err candidateErr">
        @error($name)
            <div class="error">{{ $message }}</div>
        @enderror
    </span>
</div>
