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
                    <div class="relative w-36 h-36 mx-auto rounded-full border-2 border-accent-cyan/30 overflow-hidden mb-6 group-hover:border-accent-cyan/60 transition-all duration-300 bg-dark-900/50 cursor-pointer shadow-[0_0_15px_rgba(0,245,255,0.1)] group-hover:shadow-[0_0_25px_rgba(0,245,255,0.2)]" onclick="toggleProfileImage(this)" title="Click to swap identity!">
                        <img id="profile-img-1" src="{{ asset('images/profile-1.png') }}" alt="Profile Photo Formal" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 opacity-100">
                        <img id="profile-img-2" src="{{ asset('images/profile-2.png') }}" alt="Profile Photo Cyber" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 opacity-0">
                        
                        <!-- Scanline overlay for cyber effect -->
                        <div class="absolute inset-0 pointer-events-none bg-[linear-gradient(transparent_50%,rgba(0,0,0,0.1)_50%)] bg-[length:100%_4px]"></div>
                        
                        <!-- Hover hint -->
                        <div class="absolute inset-0 bg-dark-900/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <span class="text-[10px] font-mono text-accent-cyan px-2 py-1 bg-dark-900/80 rounded border border-accent-cyan/30 tracking-widest">SWAP_ID</span>
                        </div>
                    </div>
                    
                    <script>
                        function toggleProfileImage(container) {
                            const img1 = container.querySelector('#profile-img-1');
                            const img2 = container.querySelector('#profile-img-2');
                            
                            if (img1.classList.contains('opacity-100')) {
                                img1.classList.replace('opacity-100', 'opacity-0');
                                img2.classList.replace('opacity-0', 'opacity-100');
                                container.style.filter = 'contrast(150%) hue-rotate(90deg) brightness(1.2)';
                                setTimeout(() => container.style.filter = 'none', 150);
                            } else {
                                img2.classList.replace('opacity-100', 'opacity-0');
                                img1.classList.replace('opacity-0', 'opacity-100');
                                container.style.filter = 'contrast(150%) hue-rotate(90deg) brightness(1.2)';
                                setTimeout(() => container.style.filter = 'none', 150);
                            }
                        }
                    </script>
                    <div class="text-center">
                        <h3 class="text-xl font-heading font-bold">Naufal Ramadhan Wicaksana</h3>
                        <p class="text-accent-cyan text-sm font-mono mt-1">Full Stack Developer</p>
                        <div class="w-12 h-px bg-accent-cyan/30 mx-auto my-4"></div>
                        <p class="text-gray-400 text-sm leading-relaxed">Seorang Full Stack Developer dengan pengalaman lebih dari 5 tahun di dunia pemrograman. Passionate dalam membangun solusi digital inovatif menggunakan Laravel dan teknologi modern, serta selalu bersemangat mempelajari hal baru setiap harinya.</p>
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
