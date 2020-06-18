
@component('mail::message')
# Dear, {{$job->user->name}}

You are receiving this email because we need to inform you that your submission is in moderation.

@component('mail::button', ['url' => route('home')])
Click Here to go back to website
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent