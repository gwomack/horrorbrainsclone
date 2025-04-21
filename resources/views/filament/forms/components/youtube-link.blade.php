@php
$embed = optional($getRecord())->embed;
$url = $embed ? "https://www.youtube.com/watch?v={$embed}" : '';
@endphp

@if($url)
<a href="{{ $url }}" target="_blank" class="text-primary-600 hover:text-primary-500">
    {{ $url }}
</a>
@endif