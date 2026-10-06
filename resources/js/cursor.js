export function initCursor() {
    const dot = document.getElementById('cursor-dot');
    const outline = document.getElementById('cursor-outline');
    
    if (!dot || !outline) return;
    
    let cursorX = 0, cursorY = 0;
    let dotX = 0, dotY = 0;
    let outlineX = 0, outlineY = 0;
    
    // Track mouse position
    document.addEventListener('mousemove', (e) => {
        cursorX = e.clientX;
        cursorY = e.clientY;
    });
    
    // Smooth follow animation loop
    function animateCursor() {
        // Dot follows more closely
        dotX += (cursorX - dotX) * 0.2;
        dotY += (cursorY - dotY) * 0.2;
        dot.style.transform = `translate(${dotX - 4}px, ${dotY - 4}px)`;
        
        // Outline follows with more lag
        outlineX += (cursorX - outlineX) * 0.1;
        outlineY += (cursorY - outlineY) * 0.1;
        outline.style.transform = `translate(${outlineX - 20}px, ${outlineY - 20}px)`;
        
        requestAnimationFrame(animateCursor);
    }
    animateCursor();
    
    // Hover effects
    // Buttons and links
    const interactiveElements = document.querySelectorAll('a, button, .skill-card, .project-card, input, textarea');
    
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            dot.classList.add('cursor-hover');
            outline.classList.add('cursor-hover');
        });
        el.addEventListener('mouseleave', () => {
            dot.classList.remove('cursor-hover');
            outline.classList.remove('cursor-hover');
        });
    });
    
    // Magnetic button effect
    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });
    
    // Hide default cursor on body
    document.body.style.cursor = 'none';
    document.querySelectorAll('a, button').forEach(el => {
        el.style.cursor = 'none';
    });
}
