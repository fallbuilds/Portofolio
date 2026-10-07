<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    
    <!-- Content container -->
    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 text-center mt-20">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-heading font-bold text-white mb-6 tracking-tight relative inline-block">
            <span class="sr-only">Naufal Ramadhan</span>
            <span id="tw-h1" data-text="Naufal Ramadhan"></span><span id="tw-cursor" class="animate-pulse text-accent-main">|</span>
        </h1>
        
        <p class="text-gray-200 max-w-2xl mx-auto text-lg md:text-xl leading-relaxed mb-12 font-medium min-h-[80px]">
            <span class="sr-only">Membangun aplikasi web modern, scalable, dan memiliki pengalaman dalam pengembangan sistem berbasis Laravel, PHP, JavaScript, dan teknologi modern.</span>
            <span id="tw-p" data-text="Membangun aplikasi web modern, scalable, dan memiliki pengalaman dalam pengembangan sistem berbasis Laravel, PHP, JavaScript, dan teknologi modern."></span>
        </p>
        
        <!-- Command Line / Contact Box -->
        <div class="mx-auto max-w-md bg-dark-900/60 backdrop-blur-md border border-gray-700/50 rounded-full flex items-center justify-between p-2 pl-6 shadow-2xl" data-animate="fade-up" data-delay="0.2">
            <code class="text-gray-300 font-mono text-xs">naufalramadhanwicaksana@gmail.com</code>
            <button class="w-10 h-10 shrink-0 bg-dark-800/80 hover:bg-dark-700 border border-gray-700/50 rounded-full flex items-center justify-center text-gray-400 hover:text-white transition-colors" aria-label="Copy Email" onclick="navigator.clipboard.writeText('naufalramadhanwicaksana@gmail.com'); alert('Email disalin ke clipboard!');">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </button>
        </div>
        
        <div class="mt-24 text-gray-400 text-sm font-mono tracking-wide" data-animate="fade-up" data-delay="0.3">
            <p>A BEGINNER DEVELOPER</p>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const typeWriter = (elementId, speed = 50, delay = 0) => {
        return new Promise(resolve => {
            const el = document.getElementById(elementId);
            if (!el) return resolve();
            const text = el.getAttribute('data-text');
            el.innerHTML = '';
            let i = 0;
            
            setTimeout(() => {
                const interval = setInterval(() => {
                    if (i < text.length) {
                        el.innerHTML += text.charAt(i);
                        i++;
                    } else {
                        clearInterval(interval);
                        resolve();
                    }
                }, speed);
            }, delay);
        });
    };

    // Run typewriter sequence after loading screen finishes (approx 800-1000ms)
    setTimeout(async () => {
        await typeWriter('tw-h1', 100); // 100ms per char for the heading
        
        // Hide heading cursor and move to paragraph
        const cursor = document.getElementById('tw-cursor');
        if(cursor) cursor.style.display = 'none';
        
        // P needs a faster typing speed so users don't wait too long to read
        await typeWriter('tw-p', 20); // 20ms per char
    }, 1200);
});
</script>
