@component('mail::message')

# Your Download Link

Download your purchase from the link below


@component('mail::button', ['url' => $link])
Download
@endcomponent

@endcomponent