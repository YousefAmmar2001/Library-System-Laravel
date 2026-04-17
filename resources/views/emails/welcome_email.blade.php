@component('mail::message')
# Welcome with us!

Thanks for registration in Library System.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/user/login'])
Open CMS
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
