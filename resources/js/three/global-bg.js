import * as THREE from 'three';

export function initGlobal3D(isMobile) {
    const container = document.getElementById('global-3d-canvas');
    if (!container) return;
    
    try {
        const c = document.createElement('canvas');
        if (!(c.getContext('webgl') || c.getContext('experimental-webgl'))) throw 0;
    } catch { return; }
    
    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x0a0a0f, 0.03);
    
    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 0, 15);
    
    const renderer = new THREE.WebGLRenderer({ antialias: !isMobile, alpha: true, powerPreference: "high-performance" });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, isMobile ? 1.0 : 1.5));
    container.appendChild(renderer.domElement);
    
    // Group for the entire interactive 3D universe
    const universe = new THREE.Group();
    scene.add(universe);
    
    // 1. Central Cyber Polyhedron (Cyan & Purple Wireframe)
    const coreGeo = new THREE.IcosahedronGeometry(2.4, 1);
    const coreMat = new THREE.MeshBasicMaterial({ 
        color: 0x00f5ff, 
        wireframe: true, 
        transparent: true, 
        opacity: 0.35 
    });
    const coreMesh = new THREE.Mesh(coreGeo, coreMat);
    universe.add(coreMesh);
    
    // Inner pulsing crystal
    const innerGeo = new THREE.OctahedronGeometry(1.2, 0);
    const innerMat = new THREE.MeshBasicMaterial({
        color: 0xa855f7,
        wireframe: true,
        transparent: true,
        opacity: 0.55
    });
    const innerMesh = new THREE.Mesh(innerGeo, innerMat);
    coreMesh.add(innerMesh);
    
    // 2. Orbital Rings
    const ringGeo1 = new THREE.TorusGeometry(4.4, 0.03, 8, 64);
    const ringMat1 = new THREE.MeshBasicMaterial({ color: 0x00f5ff, transparent: true, opacity: 0.3 });
    const ring1 = new THREE.Mesh(ringGeo1, ringMat1);
    ring1.rotation.x = Math.PI / 2.5;
    universe.add(ring1);
    
    const ringGeo2 = new THREE.TorusGeometry(5.6, 0.02, 8, 64);
    const ringMat2 = new THREE.MeshBasicMaterial({ color: 0xa855f7, transparent: true, opacity: 0.25 });
    const ring2 = new THREE.Mesh(ringGeo2, ringMat2);
    ring2.rotation.y = Math.PI / 3;
    universe.add(ring2);
    
    // 3. Floating Interactive Constellation Particles
    const pCount = isMobile ? 180 : 450;
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(pCount * 3);
    for (let i = 0; i < pCount * 3; i++) {
        pPos[i] = (Math.random() - 0.5) * 45;
    }
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    const pMat = new THREE.PointsMaterial({ 
        color: 0x00f5ff, 
        size: isMobile ? 0.07 : 0.09, 
        transparent: true, 
        opacity: 0.65,
        blending: THREE.AdditiveBlending 
    });
    const particles = new THREE.Points(pGeo, pMat);
    scene.add(particles);
    
    // Mouse tracking for parallax and interactive rotation
    const mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };
    window.addEventListener('mousemove', (e) => {
        mouse.targetX = (e.clientX / window.innerWidth) * 2 - 1;
        mouse.targetY = -(e.clientY / window.innerHeight) * 2 + 1;
    }, { passive: true });
    
    // Scroll tracking to move the universe through space
    let scrollY = 0;
    window.addEventListener('scroll', () => {
        scrollY = window.scrollY;
    }, { passive: true });
    
    let isVisible = true;
    document.addEventListener('visibilitychange', () => {
        isVisible = !document.hidden;
    }, { passive: true });
    
    const clock = new THREE.Clock();
    
    function animate() {
        requestAnimationFrame(animate);
        if (!isVisible) return;
        const t = clock.getElapsedTime();
        
        // Smooth mouse follow
        mouse.x += (mouse.targetX - mouse.x) * 0.05;
        mouse.y += (mouse.targetY - mouse.y) * 0.05;
        
        // Universe dynamically tilts toward mouse
        universe.rotation.y = mouse.x * 0.6 + Math.sin(t * 0.25) * 0.15;
        universe.rotation.x = -mouse.y * 0.6 + Math.cos(t * 0.3) * 0.15;
        
        // Core & Rings internal spin
        coreMesh.rotation.y = t * 0.2;
        coreMesh.rotation.z = Math.sin(t * 0.15) * 0.2;
        innerMesh.rotation.x = -t * 0.4;
        innerMesh.rotation.y = t * 0.3;
        ring1.rotation.z = t * 0.15;
        ring2.rotation.x = -t * 0.1;
        
        // Parallax drift on galaxy particles
        particles.rotation.y = t * 0.03 + mouse.x * 0.15;
        particles.rotation.x = -mouse.y * 0.1;
        
        // Travel through depth on scroll
        const scrollOffset = scrollY * 0.008;
        camera.position.y = -scrollOffset;
        
        renderer.render(scene, camera);
    }
    animate();
    
    const onResize = () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    };
    window.addEventListener('resize', onResize);
}
