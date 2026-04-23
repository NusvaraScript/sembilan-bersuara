@props([
    'section' => '',
])

<section class="py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $section }}</h1>
    {{ $slot }}
</section>