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

    {{-- CTA Section --}}
    @include('public.home.cta')
</x-public.layouts>
