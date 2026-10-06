@props(['skills'])

@php
$iconMap = [
    'laravel' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg',
    'php' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg',
    'javascript' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg',
    'html' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg',
    'css' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg',
    'tailwind' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg',
    'bootstrap' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/bootstrap/bootstrap-original.svg',
    'mysql' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg',
    'git' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/git/git-original.svg',
    'flutter' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/flutter/flutter-original.svg',
    'java' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/java/java-original.svg',
    'csharp' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/csharp/csharp-original.svg',
    'api' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/networkx/networkx-original.svg' // Fallback for REST API
];
@endphp

<section id="skills" class="py-24 lg:py-32 relative overflow-hidden">
    <div id="skills-canvas" class="absolute inset-0 z-0"></div>
    <div class="relative z-10 max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <p class="text-accent-cyan font-mono text-sm mb-2" data-animate="fade-up">// Skills & Technologies</p>
                <h2 class="text-3xl md:text-4xl font-heading font-bold" data-animate="fade-up">My Tech <span class="text-accent-purple">Stack</span></h2>
            </div>
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap gap-2" data-animate="fade-up" data-delay="0.2">
                <button type="button" class="skill-filter-btn active px-4 py-2 text-xs font-mono rounded-lg border transition-all duration-300 bg-accent-cyan/20 border-accent-cyan text-accent-cyan" data-filter="all">ALL</button>
                <button type="button" class="skill-filter-btn px-4 py-2 text-xs font-mono rounded-lg border transition-all duration-300 bg-dark-800/50 border-gray-800 text-gray-400 hover:text-gray-200 hover:border-gray-700" data-filter="frontend">FRONTEND</button>
                <button type="button" class="skill-filter-btn px-4 py-2 text-xs font-mono rounded-lg border transition-all duration-300 bg-dark-800/50 border-gray-800 text-gray-400 hover:text-gray-200 hover:border-gray-700" data-filter="backend">BACKEND</button>
                <button type="button" class="skill-filter-btn px-4 py-2 text-xs font-mono rounded-lg border transition-all duration-300 bg-dark-800/50 border-gray-800 text-gray-400 hover:text-gray-200 hover:border-gray-700" data-filter="mobile">MOBILE</button>
                <button type="button" class="skill-filter-btn px-4 py-2 text-xs font-mono rounded-lg border transition-all duration-300 bg-dark-800/50 border-gray-800 text-gray-400 hover:text-gray-200 hover:border-gray-700" data-filter="tools">TOOLS</button>
            </div>
        </div>
        
        <div id="skills-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($skills ?? [] as $skill)
            <div class="skill-card tilt-card group relative bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/30 transition-all duration-500 cursor-default" data-category="{{ strtolower($skill->category ?? 'backend') }}" data-animate="fade-up" data-delay="{{ $loop->iteration * 0.05 }}">
                <div class="flex flex-col items-center text-center relative z-10">
                    <div class="w-12 h-12 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ $iconMap[strtolower($skill->icon ?? $skill->name)] ?? 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/devicon/devicon-original.svg' }}" alt="{{ $skill->name }} logo" class="w-10 h-10 object-contain drop-shadow-md grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                    </div>
                    <h3 class="font-heading font-semibold text-sm mb-2">{{ $skill->name }}</h3>
                    <div class="w-full bg-dark-900/50 rounded-full h-1.5 mt-2 overflow-hidden">
                        <div class="h-1.5 rounded-full bg-accent-cyan transition-all duration-1000" style="width: {{ $skill->level }}%"></div>
                    </div>
                    <span class="text-xs text-gray-500 mt-2">{{ $skill->level }}%</span>
                </div>
                <div class="absolute inset-0 rounded-xl bg-accent-cyan/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>
