@props([
    'title' => '',
    'description' => '',
    'class' => ''
])

<section class="my-12">
    <div class="{{ $class }}">
        <h1 class="text-lg font-bold">{{ $title }}</h1>
        <p>{{ $description }}</p>
    </div>
</section>