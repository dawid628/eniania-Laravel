@component('mail::message')
    # Re: {{ $title }}
    <p class="text-break">{!! nl2br($answer) !!}</p>
@component('mail::button', ['url' => 'google.com'])
    Kliknij tutaj
@endcomponent
Pozdrawiamy,
{{config('app.name')}}
@endcomponent
