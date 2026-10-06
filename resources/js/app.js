import './bootstrap';
import { initCursor } from './cursor';
import { initAnimations } from './animations';
import { initHeroScene } from './three/hero';
import { initContactForm } from './contact';
import { initSkillsScene } from './three/skills';
import { initGlobal3D } from './three/global-bg';
import { initMusicPlayer } from './music-player';


const isMobile = /Android|iPhone|iPad|iPod|webOS|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.innerWidth < 1024;
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.addEventListener('DOMContentLoaded', () => {
    
    const loadingScreen = document.getElementById('loading-screen');
    
    
    const themeToggleBtn = document.getElementById('theme-toggle-btn');
    const themeDarkIcon = document.querySelector('.theme-dark-icon');
    const themeLightIcon = document.querySelector('.theme-light-icon');
    
    const setTheme = (isDark) => {
        document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        if (isDark) {
            themeLightIcon.classList.remove('hidden');
            themeDarkIcon.classList.add('hidden');
        } else {
            themeDarkIcon.classList.remove('hidden');
            themeLightIcon.classList.add('hidden');
        }
    };
    
    
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDark = savedTheme === 'dark' || (!savedTheme && prefersDark);
    setTheme(isDark);
    
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const currentIsDark = document.documentElement.getAttribute('data-theme') === 'dark';
            setTheme(!currentIsDark);
        });
    }

    
    initAnimations(isMobile, prefersReducedMotion);
    initContactForm();
    initMusicPlayer();
    
    if (!isMobile) {
        initCursor();
    }
    
    
    if (!prefersReducedMotion) {
        requestAnimationFrame(() => {
            initHeroScene(isMobile);
            initSkillsScene(isMobile);
        });
    }
    
    
    setTimeout(() => {
        if (loadingScreen) {
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 700);
        }
    }, 800);
    
    
    const scrollProgress = document.getElementById('scroll-progress');
    window.addEventListener('scroll', () => {
        if (scrollProgress) {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            scrollProgress.style.width = scrolled + '%';
        }
    }, { passive: true });
    
    
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                backToTop.classList.add('opacity-100', 'visible', 'translate-y-0');
            } else {
                backToTop.classList.add('opacity-0', 'invisible', 'translate-y-4');
                backToTop.classList.remove('opacity-100', 'visible', 'translate-y-0');
            }
        }, { passive: true });
        
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                const offset = 80; 
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
            
            const mobileMenu = document.getElementById('mobile-menu');
            const overlay = document.getElementById('mobile-menu-overlay');
            const menuBtn = document.getElementById('menu-toggle');
            if (mobileMenu && mobileMenu.classList.contains('menu-active')) {
                mobileMenu.classList.remove('menu-active');
                if (overlay) overlay.classList.remove('menu-active');
                if (menuBtn) {
                    menuBtn.setAttribute('aria-expanded', 'false');
                    menuBtn.classList.remove('menu-open');
                }
                document.body.style.overflow = '';
            }
        });
    });
    
    
    const menuBtn = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-menu-overlay');
    
    const toggleMenu = () => {
        if (!mobileMenu) return;
        const isClosed = !mobileMenu.classList.contains('menu-active');
        if (isClosed) {
            mobileMenu.classList.add('menu-active');
            if (overlay) overlay.classList.add('menu-active');
            if (menuBtn) {
                menuBtn.setAttribute('aria-expanded', 'true');
                menuBtn.classList.add('menu-open');
            }
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.remove('menu-active');
            if (overlay) overlay.classList.remove('menu-active');
            if (menuBtn) {
                menuBtn.setAttribute('aria-expanded', 'false');
                menuBtn.classList.remove('menu-open');
            }
            document.body.style.overflow = '';
        }
    };

    if (menuBtn) {
        menuBtn.addEventListener('click', toggleMenu);
    }
    
    if (overlay) {
        overlay.addEventListener('click', toggleMenu);
    }
    
    
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    const observerOptions = { rootMargin: '-20% 0px -80% 0px' };
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navLinks.forEach(link => {
                    link.classList.toggle('active', link.getAttribute('href') === '#' + entry.target.id);
                });
            }
        });
    }, observerOptions);
    
    sections.forEach(section => sectionObserver.observe(section));
    
    
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (navbar) {
            navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
        }
    }, { passive: true });
    
    
    const typedEl = document.getElementById('typed-role');
    if (typedEl) {
        const roles = [
            'Laravel & Full Stack Developer',
            'Java & C# Programmer',
            'Creative Problem Solver',
            'UI/UX Enthusiast',
        ];
        let roleIdx = 0;
        let charIdx = 0;
        let isDeleting = false;
        let speed = 80;
        
        function typeRole() {
            const current = roles[roleIdx];
            if (isDeleting) {
                typedEl.textContent = current.substring(0, charIdx - 1);
                charIdx--;
                speed = 40;
            } else {
                typedEl.textContent = current.substring(0, charIdx + 1);
                charIdx++;
                speed = 80;
            }
            
            if (!isDeleting && charIdx === current.length) {
                speed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIdx === 0) {
                isDeleting = false;
                roleIdx = (roleIdx + 1) % roles.length;
                speed = 500;
            }
            
            setTimeout(typeRole, speed);
        }
        
        setTimeout(typeRole, 1500);
    }

    
    const filterBtns = document.querySelectorAll('.skill-filter-btn');
    const skillCards = document.querySelectorAll('.skill-card');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-accent-cyan/20', 'border-accent-cyan', 'text-accent-cyan');
                b.classList.add('bg-dark-800/50', 'border-gray-800', 'text-gray-400');
            });
            btn.classList.add('active', 'bg-accent-cyan/20', 'border-accent-cyan', 'text-accent-cyan');
            btn.classList.remove('bg-dark-800/50', 'border-gray-800', 'text-gray-400');
            
            const filter = btn.dataset.filter;
            skillCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => { card.style.display = 'none'; }, 300);
                }
            });
        });
    });
});
