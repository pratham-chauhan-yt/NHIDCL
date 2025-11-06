{{--
<x-form.select label="Department" name="department_id" :options="$departments" required selectClass="js-select2"/>

or

<x-form.select label="Title" name="courtesy_title" :options="['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Shri/Smt.' => 'Shri/Smt.', 'Ms.' => 'Ms.']" required selectClass="js-select2"/>
--}}

@props([
    'label' => null,
    'smallLabel' => null,
    'name',
    'options' => [],
    'value' => '',
    'required' => false,
    'multiple' => false,
    'id' => $name,
    'wrapperClass' => '',
    'wrapperId' => '',
    'labelClass' => '',
    'selectClass' => '',
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

    <select name="{{ $name }}" id="{{ $id }}"
        @if ($selectClass) class="form-select {{ $selectClass }}" @endif
        @if ($required) required @endif @if ($multiple) multiple @endif
        {{ $attributes->except(['class']) }}>
        <option value="">Select {{ strtolower($label ?? $name) }}</option>
        @foreach ($options as $key => $option)
            @php
                $optValue = is_array($option) ? $option['value'] ?? $key : $key;
                $optLabel = is_array($option) ? $option['label'] ?? $option['value'] : $option;
            @endphp
            <option value="{{ $optValue }}" {{ old($name, $value) == $optValue ? 'selected' : '' }}>
                {{ $optLabel }}
            </option>
        @endforeach
    </select>

    <span id="{{ $id }}_err" class="{{ $id }}_err candidateErr">
        @error($name)
            <div class="error">{{ $message }}</div>
        @enderror
    </span>
</div>
