<div class="w-fit">
    <label @if(!empty($required)) class="required-label" @endif>{{ $label }}</label>

    @if(($type ?? 'text') === 'select')
        <select name="{{ $name }}" id="{{ $id ?? $name }}" class="js-single {{ $class ?? '' }}" {{ $required ?? '' }}>
            {{ $slot }}
        </select>
    @else
        <input type="{{ $type ?? 'text' }}" 
               name="{{ $name }}" 
               id="{{ $id ?? $name }}" 
               placeholder="{{ $placeholder ?? '' }}" 
               minlength="{{ $minlength ?? '' }}" 
               maxlength="{{ $maxlength ?? '' }}" 
               class="{{ $class ?? '' }}" 
               {{ $required ?? '' }}>
    @endif
</div>