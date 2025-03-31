@props(['title' => '', 'bodyClass' => null, 'footerLinks'=>''])

<x-base-layoute :$title :$bodyClass>

    <x-layouts.header/>

    {{ $slot }}

</x-base-layoute>
