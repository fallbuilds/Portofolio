@props(['projects'])

<section id="projects" class="py-24 lg:py-32 relative">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-16">
            <p class="text-accent-cyan font-mono text-sm mb-2" data-animate="fade-up" data-i18n="projects.subtitle">// Portfolio</p>
            <h2 class="text-3xl md:text-4xl font-heading font-bold" data-animate="fade-up"><span data-i18n="projects.title_prefix">Featured </span><span class="text-accent-purple" data-i18n="projects.title_suffix">Projects</span></h2>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($projects ?? [] as $project)
            @php
                $i18nKey = match(true) {
                    str_contains(strtolower($project->title), 'cargo') => 'projects.jmb_desc',
                    str_contains(strtolower($project->title), 'jagoan') => 'projects.jagoan_desc',
                    str_contains(strtolower($project->title), 'ling') => 'projects.ling_desc',
                    str_contains(strtolower($project->title), 'sakurakyat') => 'projects.sakurakyat_desc',
                    default => null,
                };
            @endphp
            <div class="project-card tilt-card group relative bg-dark-800/40 backdrop-blur-md border border-gray-800/60 rounded-2xl overflow-hidden hover:border-accent-cyan/40 transition-all duration-500 flex flex-col justify-between" data-animate="fade-up" data-delay="{{ $loop->iteration * 0.15 }}">
                
                <!-- Visual Header Banner -->
                <div class="relative h-52 bg-dark-800 overflow-hidden border-b border-gray-800/50">
                    <!-- Decorative Graphic Badge (Always visible) -->
                    <div class="absolute top-4 left-4 z-20 flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-medium border bg-dark-900/80 backdrop-blur-sm {{ $project->featured ? 'text-accent-cyan border-accent-cyan/40 shadow-[0_0_10px_rgba(0,245,255,0.2)]' : 'text-gray-400 border-gray-700' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $project->featured ? 'bg-accent-cyan animate-pulse' : 'bg-gray-500' }}"></span>
                            {{ $project->featured ? 'FEATURED' : 'PROJECT' }}
                        </span>
                    </div>

                    @if($project->image ?? false)
                        <!-- Image Banner -->
                        <div class="absolute inset-0 w-full h-full">
                            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark-800 via-transparent to-transparent opacity-80"></div>
                        </div>
                    @else
                        <!-- Abstract Fallback Banner -->
                        <div class="absolute inset-0 opacity-20 group-hover:opacity-30 transition-opacity duration-500 bg-[radial-gradient(#00f5ff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        
                        <!-- Project Logo / Abstract Icon -->
                        <div class="absolute inset-0 flex items-center justify-center group-hover:scale-105 transition-transform duration-700 z-10">
                            <div class="w-20 h-20 rounded-2xl bg-accent-cyan/10 border border-white/10 flex items-center justify-center backdrop-blur-sm group-hover:border-accent-cyan/40 shadow-xl transition-all">
                                @if(str_contains(strtolower($project->title), 'cargo'))
                                    <svg class="w-10 h-10 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                @elseif(str_contains(strtolower($project->title), 'tugas'))
                                    <svg class="w-10 h-10 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                @elseif(str_contains(strtolower($project->title), 'ai'))
                                    <svg class="w-10 h-10 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                @else
                                    <svg class="w-10 h-10 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                @endif
                            </div>
                        </div>

                        <!-- Ambient Glow -->
                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-48 h-20 bg-accent-cyan/15 blur-2xl rounded-full pointer-events-none group-hover:bg-accent-cyan/25 transition-all z-10"></div>
                    @endif
                </div>

                <!-- Content Area -->
                <div class="p-8 flex-1 flex flex-col justify-between relative z-10">
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-3">
                            <h3 class="text-xl font-heading font-bold text-white group-hover:text-accent-cyan transition-colors">{{ $project->title }}</h3>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6" @if($i18nKey) data-i18n="{{ $i18nKey }}" @endif>{{ $project->description }}</p>
                    </div>

                    <div>
                        <!-- Tech Tags -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($project->technologies ?? [] as $tech)
                            <span class="text-xs px-3 py-1 bg-dark-900/80 border border-gray-800 rounded-md text-gray-300 font-mono group-hover:border-gray-700 transition-colors">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-3 pt-4 border-t border-gray-800/60">
                            @if($project->github_url ?? false)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="magnetic-btn inline-flex items-center gap-2 px-4 py-2 text-xs font-mono rounded-lg border border-gray-700 text-gray-300 hover:text-white hover:border-gray-500 transition-colors" aria-label="View Source Code">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                <span data-i18n="projects.btn_source">Source Code</span>
                            </a>
                            @endif
                            @if($project->demo_url ?? false)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="magnetic-btn inline-flex items-center gap-2 px-4 py-2 text-xs font-mono rounded-lg border border-accent-cyan/30 bg-accent-cyan/10 text-accent-cyan hover:bg-accent-cyan/20 hover:border-accent-cyan/50 transition-colors" aria-label="View Live Demo">
                                <span data-i18n="projects.btn_demo">Live Demo</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            @endif
                            @if(!($project->github_url ?? false) && !($project->demo_url ?? false))
                            <span class="inline-flex items-center gap-2 px-4 py-2 text-xs font-mono rounded-lg border border-gray-600 bg-gray-800/50 text-gray-400 cursor-not-allowed" aria-label="Under Maintenance">
                                <svg class="w-4 h-4 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span data-i18n="projects.btn_maintenance">Under Maintenance</span>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Glow Edge -->
                <div class="absolute inset-0 rounded-2xl bg-accent-cyan/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>
