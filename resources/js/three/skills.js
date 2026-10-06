import * as THREE from 'three';

export function initSkillsScene(isMobile) {
    const container = document.getElementById('skills-canvas');
    if (!container) return;
    
    try {
        const c = document.createElement('canvas');
        if (!(c.getContext('webgl') || c.getContext('experimental-webgl'))) throw 0;
    } catch { return; }
    
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(60, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(0, 0, 12);
    
    const renderer = new THREE.WebGLRenderer({ antialias: !isMobile, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);
    container.appendChild(renderer.domElement);
    
    const wireMat = new THREE.MeshBasicMaterial({ color: 0x527bff, wireframe: true, transparent: true, opacity: 0.06 });
    
    // DNA-like double helix
    const helixPoints1 = [];
    const helixPoints2 = [];
    const segments = 200;
    for (let i = 0; i < segments; i++) {
        const t = (i / segments) * Math.PI * 6;
        const y = (i / segments) * 30 - 15;
        helixPoints1.push(new THREE.Vector3(Math.cos(t) * 3, y, Math.sin(t) * 3));
        helixPoints2.push(new THREE.Vector3(Math.cos(t + Math.PI) * 3, y, Math.sin(t + Math.PI) * 3));
    }
    
    const helixGeo1 = new THREE.BufferGeometry().setFromPoints(helixPoints1);
    const helixGeo2 = new THREE.BufferGeometry().setFromPoints(helixPoints2);
    const lineMat = new THREE.LineBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.08 });
    scene.add(new THREE.Line(helixGeo1, lineMat));
    scene.add(new THREE.Line(helixGeo2, lineMat));
    
    // Cross-links between helices
    const crossGeo = new THREE.BufferGeometry();
    const crossPos = [];
    for (let i = 0; i < segments; i += 8) {
        crossPos.push(helixPoints1[i].x, helixPoints1[i].y, helixPoints1[i].z);
        crossPos.push(helixPoints2[i].x, helixPoints2[i].y, helixPoints2[i].z);
    }
    crossGeo.setAttribute('position', new THREE.Float32BufferAttribute(crossPos, 3));
    scene.add(new THREE.LineSegments(crossGeo, new THREE.LineBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.04 })));
    
    // Floating code symbols (instanced small shapes)
    const symbolCount = isMobile ? 60 : 200;
    const symGeo = new THREE.OctahedronGeometry(0.08, 0);
    const symMesh = new THREE.InstancedMesh(symGeo, wireMat, symbolCount);
    const dummy = new THREE.Object3D();
    const symData = [];
    
    for (let i = 0; i < symbolCount; i++) {
        const x = (Math.random() - 0.5) * 25;
        const y = (Math.random() - 0.5) * 25;
        const z = (Math.random() - 0.5) * 15 - 3;
        dummy.position.set(x, y, z);
        const s = Math.random() * 0.8 + 0.3;
        dummy.scale.set(s, s, s);
        dummy.updateMatrix();
        symMesh.setMatrixAt(i, dummy.matrix);
        symData.push({ x, y, z, speed: Math.random() * 0.3 + 0.1, offset: Math.random() * Math.PI * 2, ry: Math.random() * 0.02 });
    }
    scene.add(symMesh);
    
    // Particles
    const pCount = isMobile ? 500 : 2000;
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(pCount * 3);
    for (let i = 0; i < pCount * 3; i++) pPos[i] = (Math.random() - 0.5) * 30;
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    const pMat = new THREE.PointsMaterial({ color: 0x527bff, size: 0.015, transparent: true, opacity: 0.3, sizeAttenuation: true });
    const pts = new THREE.Points(pGeo, pMat);
    scene.add(pts);
    
    let isVisible = false;
    const observer = new IntersectionObserver(([e]) => { isVisible = e.isIntersecting; }, { threshold: 0.1 });
    observer.observe(container);
    
    const clock = new THREE.Clock();
    let animId;
    
    function animate() {
        animId = requestAnimationFrame(animate);
        if (!isVisible) return;
        const t = clock.getElapsedTime();
        
        // Rotate helix
        scene.rotation.y = t * 0.03;
        
        for (let i = 0; i < symbolCount; i++) {
            const d = symData[i];
            dummy.position.set(d.x, d.y + Math.sin(t * d.speed + d.offset) * 0.4, d.z);
            dummy.rotation.set(t * d.ry, t * d.ry * 1.5, 0);
            dummy.updateMatrix();
            symMesh.setMatrixAt(i, dummy.matrix);
        }
        symMesh.instanceMatrix.needsUpdate = true;
        
        pts.rotation.y = t * 0.008;
        
        renderer.render(scene, camera);
    }
    animate();
    
    const onResize = () => {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    };
    window.addEventListener('resize', onResize);
    
    window.addEventListener('beforeunload', () => {
        cancelAnimationFrame(animId);
        observer.disconnect();
        renderer.dispose();
    });
}
