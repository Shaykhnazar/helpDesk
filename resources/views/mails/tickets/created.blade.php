@component('mail::message')
# Hello **{{$name}}**,

@component('mail::panel')
#  **{{ $subject }}**

Client created ticket and sent to managers
@endcomponent
<h4 style="color:orange">Here the ticket address. Press the button and answer to ticket:</h4>
@component('mail::button', ['url' => $url])
Go to ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
