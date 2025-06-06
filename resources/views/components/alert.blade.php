
@props([
    'type'    => 'info',
    'message' => '',
])

<div {{ $attributes->merge(['class' => 'alert-dismissible fade show mt-2 alert alert-' . $type]) }} role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>