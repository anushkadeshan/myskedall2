@component('mail::message')
# Introduction

Hello  {{ $data['manager'] }}

You are receive request space to view.
Please click on the link bellow to proceed :

@component('mail::button', ['url' => 'https://sys.regcalls.com/demo/public/admin/alerts'])
Click Here
@endcomponent

Thanks,<br>
Space Control System
@endcomponent
