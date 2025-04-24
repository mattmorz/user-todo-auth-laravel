<x-mail::message>
# Hello {{ $todo->user->name }},

The following ToDo has been deleted:

**Title:** {{ $todo->title }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
