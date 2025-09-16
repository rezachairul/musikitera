<!-- Halaman home, include semua section -->

<x-public.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Hero Section --}}
    @include('public.home.hero')

    {{-- Services Section --}}
    @include('public.home.services')
    
    {{-- Count Statis Section --}}
    @include('public.home.countstatis')
    
    {{-- Gallery Section --}}
    @include('public.home.gallery')
    
    {{-- Highlight Section --}}
    @include('public.home.highlight')

    {{-- Testimonial Section --}}
    @include('public.home.testimonial')

    {{-- CTA Section --}}
    @include('public.home.cta')

    {{-- Partner Section --}}
    @include('public.home.partners')
</x-public.layouts>
