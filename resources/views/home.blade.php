@extends('layouts.app')

@section('content')
    <x-navbar />
    
    <main>
        <x-hero />
        <x-about />
        <x-skills :skills="$skills" />
        <x-projects :projects="$projects" />
        <x-experience :experiences="$experiences" />
        <x-contact />
    </main>
    
    <x-footer />
@endsection
