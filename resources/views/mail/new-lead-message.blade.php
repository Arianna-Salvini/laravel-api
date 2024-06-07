<x-mail::message>
    # Introduction

    Sender: {{ $lead->name }}

    Email: {{ $lead->email }}

    ## Message
    {{ $lead->message }}

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
