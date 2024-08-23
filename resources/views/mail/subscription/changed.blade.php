<x-mail::message>
# Price Has Been Changed!

The product`s price you're subscribed was changed: old price {{ $oldPrice }} and new price is {{ $newPrice }}

<x-mail::button :url="$url">
Check new price
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
