@component('mail::message')
# Hello

Your verification code  {{$data['code']}}

The code will expire in 2 minutes

@component('mail::button', ['url' => config('app.url').'/verify/'.$data['id']])
Verify Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
