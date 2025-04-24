
@props([
    'type'    => 'info',
    'message' => '',
])

<div {{ $attributes->merge(['class' => 'mt-2 alert alert-' . $type]) }} role="alert">
    {{ $message }}
</div>