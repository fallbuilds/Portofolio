import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export function initAnimations(isMobile, prefersReducedMotion) {
    if (prefersReducedMotion) {
        // Show all elements immediately without animation
        document.querySelectorAll('[data-animate]').forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
        return;
    }
    
    // Set initial state for animated elements
    gsap.set('[data-animate="fade-up"]', {
        opacity: 0,
        y: 40,
    });
    
    // Scroll-triggered reveal animations
    ScrollTrigger.batch('[data-animate="fade-up"]', {
        onEnter: (batch) => {
            batch.forEach((el, i) => {
                const delay = parseFloat(el.dataset.delay || 0);
                gsap.to(el, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    delay: delay + i * 0.05,
                    ease: 'power3.out',
                });
            });
        },
        start: 'top 85%',
        once: true,
    });
    
    // Skill cards stagger animation
    const skillCards = document.querySelectorAll('.skill-card');
    if (skillCards.length) {
        gsap.set(skillCards, { opacity: 0, y: 30, scale: 0.95 });
        ScrollTrigger.create({
            trigger: '#skills',
            start: 'top 75%',
            once: true,
            onEnter: () => {
                gsap.to(skillCards, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.6,
                    stagger: 0.08,
                    ease: 'power2.out',
                });
            },
        });
    }
    
    // Project cards stagger
    const projectCards = document.querySelectorAll('.project-card');
    if (projectCards.length) {
        gsap.set(projectCards, { opacity: 0, y: 40 });
        ScrollTrigger.create({
            trigger: '#projects',
            start: 'top 75%',
            once: true,
            onEnter: () => {
                gsap.to(projectCards, {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    stagger: 0.15,
                    ease: 'power3.out',
                });
            },
        });
    }
    
    // Timeline items animation
    const timelineItems = document.querySelectorAll('.timeline-item');
    if (timelineItems.length) {
        gsap.set(timelineItems, { opacity: 0, x: (i) => i % 2 === 0 ? -40 : 40 });
        ScrollTrigger.create({
            trigger: '#experience',
            start: 'top 70%',
            once: true,
            onEnter: () => {
                gsap.to(timelineItems, {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    stagger: 0.2,
                    ease: 'power3.out',
                });
            },
        });
    }
    
    // Tilt effect for cards (desktop only)
    if (!isMobile) {
        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / centerY * -5;
                const rotateY = (x - centerX) / centerX * 5;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            });
        });
    }
    
    // Section heading parallax
    document.querySelectorAll('section').forEach(section => {
        const heading = section.querySelector('h2');
        if (heading) {
            gsap.to(heading, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 0.5,
                },
                y: -20,
                ease: 'none',
            });
        }
    });

    // Skill Category Filtering
    initSkillFilters();
}

export function initSkillFilters() {
    const filterButtons = document.querySelectorAll('.skill-filter-btn');
    const skillCards = document.querySelectorAll('.skill-card');

    if (!filterButtons.length || !skillCards.length) return;

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;

            // Update active state on buttons
            filterButtons.forEach(b => {
                b.classList.remove('active', 'bg-accent-cyan/20', 'border-accent-cyan', 'text-accent-cyan');
                b.classList.add('bg-dark-800/50', 'border-gray-800', 'text-gray-400');
            });
            btn.classList.add('active', 'bg-accent-cyan/20', 'border-accent-cyan', 'text-accent-cyan');
            btn.classList.remove('bg-dark-800/50', 'border-gray-800', 'text-gray-400');

            // Animate cards
            skillCards.forEach(card => {
                const category = card.dataset.category || '';
                const match = filter === 'all' || category === filter;

                if (match) {
                    card.style.display = 'block';
                    gsap.fromTo(card, 
                        { opacity: 0, scale: 0.9, y: 15 },
                        { opacity: 1, scale: 1, y: 0, duration: 0.4, ease: 'power2.out' }
                    );
                } else {
                    gsap.to(card, {
                        opacity: 0,
                        scale: 0.9,
                        duration: 0.25,
                        ease: 'power2.in',
                        onComplete: () => {
                            card.style.display = 'none';
                        }
                    });
                }
            });
        });
    });
}

