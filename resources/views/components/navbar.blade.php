<header id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <a href="#home" class="text-xl font-heading font-bold">Naufal Ramadhan<span class="text-accent-cyan"> Wicaksana</span></a>
        
        <div class="flex items-center gap-4 lg:gap-8">
            <div class="hidden lg:block">
                <nav class="flex items-center gap-8">
                    <a href="#home" class="nav-link active relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="home">Home</a>
                    <a href="#about" class="nav-link relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="about">About</a>
                    <a href="#skills" class="nav-link relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="skills">Skills</a>
                    <a href="#projects" class="nav-link relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="projects">Projects</a>
                    <a href="#experience" class="nav-link relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="experience">Experience</a>
                    <a href="#contact" class="nav-link relative text-sm font-medium text-gray-400 hover:text-accent-cyan transition-colors duration-300 py-2" data-section="contact">Contact</a>
                </nav>
            </div>

            <div class="flex items-center gap-2 lg:gap-3 z-50">
                <button id="theme-toggle-btn" class="w-9 h-9 rounded-lg border border-gray-800 bg-dark-800/60 flex items-center justify-center text-gray-400 hover:text-accent-cyan hover:border-accent-cyan/30 transition-all duration-300" aria-label="Toggle theme" title="Toggle Light/Dark Mode">
                    <svg class="theme-dark-icon w-4 h-4 hidden text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg class="theme-light-icon w-4 h-4 text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <button id="sound-toggle-btn" class="w-9 h-9 rounded-lg border border-gray-800 bg-dark-800/60 flex items-center justify-center text-gray-400 hover:text-accent-cyan hover:border-accent-cyan/30 transition-all duration-300" aria-label="Toggle background music" title="Toggle Music">
                    <svg class="sound-off w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/></svg>
                    <svg class="sound-on w-4 h-4 hidden text-accent-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                </button>
                <button id="menu-toggle" class="lg:hidden text-gray-300 hover:text-accent-cyan transition-colors relative flex flex-col justify-center items-center w-8 h-8 gap-1.5 focus:outline-none ml-1" aria-label="Toggle menu" aria-expanded="false">
                    <span class="hamburger-line w-6 h-0.5 bg-gray-300 transition-all"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-gray-300 transition-all"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-gray-300 transition-all"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay"></div>

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu">
        <a href="#home" class="mobile-nav-link">Home</a>
        <a href="#about" class="mobile-nav-link">About</a>
        <a href="#skills" class="mobile-nav-link">Skills</a>
        <a href="#projects" class="mobile-nav-link">Projects</a>
        <a href="#experience" class="mobile-nav-link">Experience</a>
        <a href="#contact" class="mobile-nav-link">Contact</a>
    </div>
</header>
