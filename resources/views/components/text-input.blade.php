@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm ' .
            'placeholder:text-gray-400 focus:border-primary focus:ring-4 focus:ring-primary/20 ' .
            'disabled:opacity-60 disabled:cursor-not-allowed transition'
    ]) !!}
/>
