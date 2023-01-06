@component('mail::message')
    # Re: {{ $title }}
    {!! nl2br($answer) !!}
@component('mail::button', ['url' => 'google.com'])
    Kliknij tutaj
@endcomponent
Pozdrawiamy,
{{config('app.name')}}
@endcomponent
