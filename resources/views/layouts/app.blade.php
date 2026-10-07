<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Naufal Ramadhan Wicaksana | Beginner Developer</title>
    <meta name="description" content="Portofolio resmi Naufal Ramadhan Wicaksana. Beginner Developer berpengalaman membangun aplikasi web modern dengan Laravel, React, PHP, dan Tailwind CSS.">
    <meta name="keywords" content="Naufal Ramadhan Wicaksana, Beginner Developer, Web Developer Indonesia, Laravel Developer, Programmer, Jasa Pembuatan Website, Portofolio Web">
    <meta name="author" content="Naufal Ramadhan Wicaksana">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://naufalramadhan.eu.cc">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://naufalramadhan.eu.cc">
    <meta property="og:title" content="Naufal Ramadhan Wicaksana | Beginner Developer">
    <meta property="og:description" content="Portofolio resmi Naufal Ramadhan Wicaksana. Beginner Developer berpengalaman membangun aplikasi web modern dengan Laravel, React, PHP, dan Tailwind CSS.">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://naufalramadhan.eu.cc">
    <meta property="twitter:title" content="Naufal Ramadhan Wicaksana | Beginner Developer">
    <meta property="twitter:description" content="Portofolio resmi Naufal Ramadhan Wicaksana. Beginner Developer berpengalaman membangun aplikasi web modern dengan Laravel, React, PHP, dan Tailwind CSS.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-900 text-gray-100 font-body overflow-x-hidden relative">
    <!-- GLOBAL BACKGROUND (Nature Video) -->
    <div class="fixed inset-0 z-[-2] pointer-events-none overflow-hidden bg-dark-900">
        <video autoplay loop muted playsinline class="tiktok-bg opacity-25">
            <source src="{{ asset('videos/tiktok-bg.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div id="global-3d-canvas" class="fixed inset-0 z-[-1] pointer-events-none"></div>

    <div id="loading-screen" class="fixed inset-0 z-[9999] bg-dark-900 flex items-center justify-center transition-opacity duration-700">
        <div class="text-center">
            <div class="w-12 h-12 border-2 border-accent-cyan border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-accent-cyan font-heading text-sm tracking-widest uppercase">Loading</p>
        </div>
    </div>

    <div id="cursor-dot" class="hidden lg:block fixed top-0 left-0 w-2 h-2 bg-accent-cyan rounded-full pointer-events-none z-[9998] mix-blend-difference transition-transform duration-100"></div>
    <div id="cursor-outline" class="hidden lg:block fixed top-0 left-0 w-10 h-10 border border-accent-cyan/50 rounded-full pointer-events-none z-[9997] transition-all duration-300"></div>

    <div id="scroll-progress" class="fixed top-0 left-0 h-0.5 bg-accent-cyan z-[100] transition-all duration-150" style="width: 0%"></div>

    <div class="fixed inset-0 pointer-events-none z-[90] opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>

    @yield('content')

    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-dark-700/80 backdrop-blur-sm border border-accent-cyan/20 rounded-full flex items-center justify-center text-accent-cyan opacity-0 invisible translate-y-4 transition-all duration-300 hover:bg-accent-cyan/10 hover:border-accent-cyan/50 z-50" aria-label="Back to top">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <div id="toast-container" class="fixed top-6 right-6 z-[9999] space-y-3"></div>
    
    <x-music-player />
</body>
</html>
