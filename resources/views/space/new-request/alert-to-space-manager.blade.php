@component('mail::message')
# Piority Space Request

Dear Manager

Piority space request was recieved. Please Contact

@component('mail::button', ['url' => 'https://sys.regcalls.com/demo/public/admin/alerts'])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
