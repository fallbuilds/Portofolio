<section id="about" class="py-24 lg:py-32 relative">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-16">
            <p class="text-accent-cyan font-mono text-sm mb-2" data-animate="fade-up">// About Me</p>
            <h2 class="text-3xl md:text-4xl font-heading font-bold" data-animate="fade-up">Get to Know <span class="text-accent-cyan">Me</span></h2>
        </div>
        
        <div class="grid lg:grid-cols-5 gap-8">
            <!-- Profile Card (2 cols) -->
            <div class="lg:col-span-2">
                <div class="tilt-card group relative bg-dark-800/50 backdrop-blur-sm border border-gray-800/50 rounded-2xl p-8 hover:border-accent-cyan/20 transition-all duration-500 h-full" data-animate="fade-up" data-delay="0.2">
                    <div class="relative w-28 h-28 mx-auto rounded-full border-2 border-accent-cyan/30 overflow-hidden mb-6 group-hover:border-accent-cyan/60 transition-colors bg-dark-900/50">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile Photo" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Naufal+Ramadhan&background=1a1a25&color=527bff&size=200'">
                        <div class="absolute inset-0 bg-accent-cyan/5 rounded-full group-hover:bg-transparent transition-colors"></div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl font-heading font-bold">Naufal Ramadhan Wicaksana</h3>
                        <p class="text-accent-cyan text-sm font-mono mt-1">Beginner Developer</p>
                        <div class="w-12 h-px bg-accent-cyan/30 mx-auto my-4"></div>
                        <p class="text-gray-400 text-sm leading-relaxed">Seorang Beginner Developer yang sedang merintis karir di dunia pemrograman. Passionate dalam membangun solusi digital inovatif menggunakan Laravel dan teknologi modern, serta selalu bersemangat mempelajari hal baru setiap harinya.</p>
                        <p class="text-gray-500 mt-4 flex items-center justify-center gap-2 text-sm">
                            <svg class="w-4 h-4 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Indonesia
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Stats + Info (3 cols) -->
            <div class="lg:col-span-3 grid grid-cols-2 gap-4">
                <div class="tilt-card bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/20 transition-all duration-500 flex flex-col justify-center" data-animate="fade-up" data-delay="0.3">
                    <div class="text-4xl font-bold text-accent-cyan mb-1 font-heading">5+</div>
                    <div class="text-gray-400 text-sm">Tahun Pengalaman</div>
                    <div class="w-full h-px bg-gray-800 mt-3"></div>
                    <p class="text-gray-500 text-xs mt-3">Konsisten belajar dan membangun project nyata sejak 2021</p>
                </div>
                <div class="tilt-card bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/20 transition-all duration-500 flex flex-col justify-center" data-animate="fade-up" data-delay="0.4">
                    <div class="text-4xl font-bold text-accent-cyan mb-1 font-heading">5+</div>
                    <div class="text-gray-400 text-sm">Projects Completed</div>
                    <div class="w-full h-px bg-gray-800 mt-3"></div>
                    <p class="text-gray-500 text-xs mt-3">Dari web app hingga sistem manajemen</p>
                </div>
                <div class="tilt-card bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/20 transition-all duration-500 flex flex-col justify-center" data-animate="fade-up" data-delay="0.5">
                    <div class="text-4xl font-bold text-accent-cyan mb-1 font-heading">12+</div>
                    <div class="text-gray-400 text-sm">Technologies</div>
                    <div class="w-full h-px bg-gray-800 mt-3"></div>
                    <p class="text-gray-500 text-xs mt-3">Laravel, PHP, JS, Java, C#, dan lainnya</p>
                </div>
                <div class="tilt-card bg-dark-800/30 backdrop-blur-sm border border-gray-800/50 rounded-xl p-6 hover:border-accent-cyan/20 transition-all duration-500 flex flex-col justify-center" data-animate="fade-up" data-delay="0.6">
                    <div class="text-4xl font-bold text-accent-cyan mb-1 font-heading">100%</div>
                    <div class="text-gray-400 text-sm">Dedication</div>
                    <div class="w-full h-px bg-gray-800 mt-3"></div>
                    <p class="text-gray-500 text-xs mt-3">Selalu berusaha memberikan yang terbaik</p>
                </div>
            </div>
        </div>
    </div>
</section>
