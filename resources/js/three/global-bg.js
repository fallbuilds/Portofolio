import * as THREE from 'three';

export function initGlobal3D(isMobile) {
    const container = document.getElementById('global-3d-canvas');
    if (!container) return;
    
    try {
        const c = document.createElement('canvas');
        if (!(c.getContext('webgl') || c.getContext('experimental-webgl'))) throw 0;
    } catch { return; }
    
    const scene = new THREE.Scene();
    // Add a very subtle dark red fog to blend with the dark background
    scene.fog = new THREE.FogExp2(0x0a0505, 0.04);
    
    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set(0, 0, 15);
    
    const renderer = new THREE.WebGLRenderer({ antialias: false, alpha: true, powerPreference: "high-performance" });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(1); // Force 1x pixel ratio for massive performance gain on full-screen
    container.appendChild(renderer.domElement);
    
    // Group for the entire "Robot Core"
    const robotCore = new THREE.Group();
    scene.add(robotCore);
    
    // 1. The "Eye" (Central glowing sphere)
    const eyeGeo = new THREE.SphereGeometry(1.5, 16, 16);
    const eyeMat = new THREE.MeshBasicMaterial({ 
        color: 0xff1111, 
        wireframe: false,
        transparent: true,
        opacity: 0.8
    });
    const eye = new THREE.Mesh(eyeGeo, eyeMat);
    robotCore.add(eye);
    
    // 2. The "Iris" (Inner darker sphere)
    const irisGeo = new THREE.SphereGeometry(1.55, 8, 8);
    const irisMat = new THREE.MeshBasicMaterial({
        color: 0x000000,
        wireframe: true,
        transparent: true,
        opacity: 0.5
    });
    const iris = new THREE.Mesh(irisGeo, irisMat);
    eye.add(iris);
    
    // 3. The "Helmet / Armor" (Wireframe outer shell)
    const armorGeo = new THREE.IcosahedronGeometry(3, 0);
    const armorMat = new THREE.MeshBasicMaterial({
        color: 0x330000,
        wireframe: true,
        transparent: true,
        opacity: 0.2
    });
    const armor = new THREE.Mesh(armorGeo, armorMat);
    robotCore.add(armor);
    
    // 4. Data Rings
    const ringGeo1 = new THREE.TorusGeometry(5, 0.05, 8, 48);
    const ringMat = new THREE.MeshBasicMaterial({ color: 0xff3333, transparent: true, opacity: 0.2 });
    const ring1 = new THREE.Mesh(ringGeo1, ringMat);
    ring1.rotation.x = Math.PI / 2;
    robotCore.add(ring1);
    
    const ringGeo2 = new THREE.TorusGeometry(6, 0.02, 8, 48);
    const ringMat2 = new THREE.MeshBasicMaterial({ color: 0x00f5ff, transparent: true, opacity: 0.1 });
    const ring2 = new THREE.Mesh(ringGeo2, ringMat2);
    ring2.rotation.y = Math.PI / 3;
    robotCore.add(ring2);
    
    // 5. Floating atmospheric particles (Digital Rain / Embers)
    const pCount = isMobile ? 150 : 400;
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(pCount * 3);
    for (let i = 0; i < pCount * 3; i++) {
        pPos[i] = (Math.random() - 0.5) * 40;
    }
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    const pMat = new THREE.PointsMaterial({ 
        color: 0xff4444, 
        size: 0.05, 
        transparent: true, 
        opacity: 0.4,
        blending: THREE.AdditiveBlending 
    });
    const particles = new THREE.Points(pGeo, pMat);
    scene.add(particles);
    
    // Mouse tracking for parallax and "looking"
    const mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };
    if (!isMobile) {
        window.addEventListener('mousemove', (e) => {
            mouse.targetX = (e.clientX / window.innerWidth) * 2 - 1;
            mouse.targetY = -(e.clientY / window.innerHeight) * 2 + 1;
        }, { passive: true });
    }
    
    // Scroll tracking to move the core up and down
    let scrollY = 0;
    window.addEventListener('scroll', () => {
        scrollY = window.scrollY;
    }, { passive: true });
    
    const clock = new THREE.Clock();
    let animId;
    
    function animate() {
        animId = requestAnimationFrame(animate);
        const t = clock.getElapsedTime();
        
        // Smooth mouse follow
        mouse.x += (mouse.targetX - mouse.x) * 0.05;
        mouse.y += (mouse.targetY - mouse.y) * 0.05;
        
        // Robot Core looks at mouse
        robotCore.rotation.y = mouse.x * 0.5 + Math.sin(t * 0.2) * 0.1;
        robotCore.rotation.x = -mouse.y * 0.5 + Math.cos(t * 0.3) * 0.1;
        
        // Internal animations
        iris.rotation.y = t * 0.5;
        iris.rotation.x = t * 0.3;
        armor.rotation.y = -t * 0.1;
        ring1.rotation.z = t * 0.2;
        ring2.rotation.x = t * 0.1;
        
        // Parallax effect on particles
        particles.rotation.y = t * 0.02 + mouse.x * 0.1;
        particles.rotation.x = mouse.y * 0.1;
        
        // Move the entire scene based on scroll so it feels like we are traveling past it
        const scrollOffset = scrollY * 0.01;
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
