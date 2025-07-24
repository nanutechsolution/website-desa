@props(['slider', 'index', 'imageUrl'])

<div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-700" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat flex items-center justify-center"
    style="background-image: url('{{ asset($imageUrl) }}');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent dark:from-black/90"></div>

    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-3xl mx-auto animate-fade-in">
        <h1 class="text-white text-4xl md:text-5xl font-bold drop-shadow-md mb-4 tracking-wide leading-tight">
            {{ $slider->title }}
        </h1>
        <div class="text-white/90 text-base md:text-lg leading-relaxed space-y-2 prose prose-invert max-w-none">
            {!! $slider->description !!}
        </div>
    </div>
</div>
