<x-mail::message>
# Subscribed

You subscribed to check price on the OLX

<x-mail::button :url="$url">
View page
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
