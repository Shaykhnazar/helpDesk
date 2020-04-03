@component('mail::message')
# Hello **{{$name}}**,  {{-- use double space for line break --}}

@component('mail::panel')

@if($statusChanged != '')
<p> Manager was changed your ticket's status.</p>
@endif

@if($comment != '')
Manager was answered your ticket :
<p>
    <i style="color:orange">{{ $comment }}</i>
</p>
@endif
@endcomponent

<h4 style="color:orange"> Here your ticket address: Press the button and see your ticket</h4>
@component('mail::button', ['url' => $url, 'color'=>'green'])
Go to your ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
