@props(['experiences'])

<section id="experience" class="py-24 lg:py-32 relative">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-16">
            <p class="text-accent-cyan font-mono text-sm mb-2" data-animate="fade-up" data-i18n="experience.subtitle">// Journey</p>
            <h2 class="text-3xl md:text-4xl font-heading font-bold" data-animate="fade-up"><span data-i18n="experience.title_prefix">My </span><span class="text-accent-cyan" data-i18n="experience.title_suffix">Experience</span></h2>
        </div>
        
        <div class="relative">
            <!-- Timeline line -->
            <div class="absolute left-8 md:left-1/2 md:-translate-x-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-accent-cyan/60 via-accent-cyan/20 to-transparent"></div>
            
            @foreach($experiences ?? [] as $index => $exp)
            @php
                $expTitleKey = 'experience.exp' . ($index + 1) . '_title';
                $expDescKey = 'experience.exp' . ($index + 1) . '_desc';
            @endphp
            <div class="timeline-item relative flex flex-col md:flex-row md:items-center mb-16 last:mb-0" data-animate="fade-up" data-delay="{{ $index * 0.2 }}">
                <!-- Dot -->
                <div class="absolute left-8 md:left-1/2 -translate-x-1/2 w-4 h-4 bg-dark-900 border-2 border-accent-cyan rounded-full z-10 top-8 md:top-auto">
                    <div class="absolute inset-1 bg-accent-cyan rounded-full animate-pulse"></div>
                </div>
                
                <!-- Content -->
                <div class="w-full md:w-5/12 pl-20 md:pl-0 {{ $index % 2 === 0 ? 'md:pr-16 md:text-right' : 'md:pl-16 md:ml-auto' }}">
                    <div class="tilt-card bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/20 transition-all duration-500 relative group">
                        <!-- Year badge -->
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-medium border bg-accent-cyan/10 text-accent-cyan border-accent-cyan/30 mb-3">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $exp->year }}
                        </span>
                        <h3 class="text-lg font-heading font-bold mb-2 group-hover:text-accent-cyan transition-colors" data-i18n="{{ $expTitleKey }}">{{ $exp->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="{{ $expDescKey }}">{{ $exp->description }}</p>
                        
                        <!-- Type badge -->
                        <div class="mt-4 pt-3 border-t border-gray-800/50">
                            <span class="text-xs font-mono text-gray-600 uppercase tracking-wider">{{ $exp->type }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
