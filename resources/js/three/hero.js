import * as THREE from 'three';

export function initHeroScene(isMobile) {
    const container = document.getElementById('hero-canvas');
    if (!container) return;
    
    try {
        const tc = document.createElement('canvas');
        if (!(tc.getContext('webgl') || tc.getContext('experimental-webgl'))) throw 0;
    } catch {
        container.style.background = 'radial-gradient(ellipse at center, #111118 0%, #0a0a0f 100%)';
        return;
    }
    
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.z = 6;
    
    const renderer = new THREE.WebGLRenderer({ antialias: !isMobile, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);
    container.appendChild(renderer.domElement);
    
    const mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };
    const raycaster = new THREE.Raycaster();
    const mouseVec = new THREE.Vector2();
    
    // --- MATERIALS ---
    const wireMat = new THREE.MeshBasicMaterial({ color: 0x527bff, wireframe: true, transparent: true, opacity: 0.2 });
    const glowMat = new THREE.MeshBasicMaterial({ color: 0x527bff, wireframe: true, transparent: true, opacity: 0.5 });
    const solidMat = new THREE.MeshBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.06 });
    
    // --- HERO OBJECTS (interactive) ---
    const heroObjects = [];
    
    // 1. Torus Knot — main centerpiece
    const tkGeo = new THREE.TorusKnotGeometry(1.2, 0.35, isMobile ? 64 : 128, isMobile ? 8 : 16);
    const torusKnot = new THREE.Mesh(tkGeo, wireMat.clone());
    torusKnot.position.set(2.2, 0, 0);
    scene.add(torusKnot);
    heroObjects.push(torusKnot);
    
    // 2. Large Icosahedron
    const icoGeo = new THREE.IcosahedronGeometry(0.9, 1);
    const ico = new THREE.Mesh(icoGeo, wireMat.clone());
    ico.position.set(-2.8, 1.2, -2);
    scene.add(ico);
    heroObjects.push(ico);
    
    // 3. Dodecahedron
    const dodGeo = new THREE.DodecahedronGeometry(0.6, 0);
    const dod = new THREE.Mesh(dodGeo, wireMat.clone());
    dod.position.set(-1.5, -1.8, -1);
    scene.add(dod);
    heroObjects.push(dod);
    
    // 4. Torus ring
    const torusGeo = new THREE.TorusGeometry(0.7, 0.15, 16, 48);
    const torus = new THREE.Mesh(torusGeo, wireMat.clone());
    torus.position.set(3.5, 2, -3);
    scene.add(torus);
    heroObjects.push(torus);
    
    // 5. Sphere wireframe
    const sphereGeo = new THREE.SphereGeometry(0.5, 16, 16);
    const sphere = new THREE.Mesh(sphereGeo, wireMat.clone());
    sphere.position.set(-3.5, -0.5, -2);
    scene.add(sphere);
    heroObjects.push(sphere);
    
    // 6. Cone
    const coneGeo = new THREE.ConeGeometry(0.4, 1, 6);
    const cone = new THREE.Mesh(coneGeo, wireMat.clone());
    cone.position.set(0.5, 2.5, -2);
    scene.add(cone);
    heroObjects.push(cone);
    
    // 7. Cylinder
    const cylGeo = new THREE.CylinderGeometry(0.3, 0.3, 1, 8);
    const cyl = new THREE.Mesh(cylGeo, wireMat.clone());
    cyl.position.set(-0.8, -2.5, -1.5);
    scene.add(cyl);
    heroObjects.push(cyl);
    
    // 8. Second Torus Knot (smaller)
    const tk2Geo = new THREE.TorusKnotGeometry(0.5, 0.15, 64, 8, 2, 3);
    const tk2 = new THREE.Mesh(tk2Geo, wireMat.clone());
    tk2.position.set(-3, 2.5, -3);
    scene.add(tk2);
    heroObjects.push(tk2);

    // 9. Box
    const boxGeo = new THREE.BoxGeometry(0.6, 0.6, 0.6);
    const box = new THREE.Mesh(boxGeo, wireMat.clone());
    box.position.set(3.5, -1.5, -2);
    scene.add(box);
    heroObjects.push(box);

    // 10. Ring
    const ringGeo = new THREE.RingGeometry(0.4, 0.7, 32);
    const ring = new THREE.Mesh(ringGeo, wireMat.clone());
    ring.position.set(1, -2.2, -1);
    scene.add(ring);
    heroObjects.push(ring);

    // Store original positions & individual speeds
    const heroData = heroObjects.map((obj, i) => ({
        origPos: obj.position.clone(),
        rotSpeed: { x: (Math.random() - 0.5) * 0.4, y: (Math.random() - 0.5) * 0.4, z: (Math.random() - 0.5) * 0.2 },
        floatSpeed: Math.random() * 0.4 + 0.3,
        floatAmp: Math.random() * 0.4 + 0.2,
        floatOffset: Math.random() * Math.PI * 2,
        scale: 1,
        targetScale: 1,
    }));
    
    // --- INSTANCED BACKGROUND SHAPES ---
    const instanceCount = isMobile ? 200 : 600;
    const instGeo = new THREE.TetrahedronGeometry(0.15, 0);
    const instMesh = new THREE.InstancedMesh(instGeo, wireMat, instanceCount);
    const dummy = new THREE.Object3D();
    const instData = [];
    
    for (let i = 0; i < instanceCount; i++) {
        const x = (Math.random() - 0.5) * 35;
        const y = (Math.random() - 0.5) * 25;
        const z = (Math.random() - 0.5) * 25 - 5;
        dummy.position.set(x, y, z);
        dummy.rotation.set(Math.random() * Math.PI * 2, Math.random() * Math.PI * 2, Math.random() * Math.PI * 2);
        const s = Math.random() * 0.6 + 0.2;
        dummy.scale.set(s, s, s);
        dummy.updateMatrix();
        instMesh.setMatrixAt(i, dummy.matrix);
        instData.push({ x, y, z, rx: Math.random() * 0.03, ry: Math.random() * 0.03, speed: Math.random() * 0.5 + 0.1, offset: Math.random() * Math.PI * 2 });
    }
    scene.add(instMesh);
    
    // --- SECOND INSTANCED SET (octahedrons) ---
    const inst2Count = isMobile ? 80 : 250;
    const inst2Geo = new THREE.OctahedronGeometry(0.12, 0);
    const inst2Mesh = new THREE.InstancedMesh(inst2Geo, wireMat, inst2Count);
    const inst2Data = [];
    
    for (let i = 0; i < inst2Count; i++) {
        const x = (Math.random() - 0.5) * 30;
        const y = (Math.random() - 0.5) * 20;
        const z = (Math.random() - 0.5) * 20 - 3;
        dummy.position.set(x, y, z);
        dummy.rotation.set(Math.random() * Math.PI * 2, Math.random() * Math.PI * 2, 0);
        const s = Math.random() * 0.5 + 0.3;
        dummy.scale.set(s, s, s);
        dummy.updateMatrix();
        inst2Mesh.setMatrixAt(i, dummy.matrix);
        inst2Data.push({ x, y, z, rx: Math.random() * 0.02, ry: Math.random() * 0.02, speed: Math.random() * 0.3 + 0.1, offset: Math.random() * Math.PI * 2 });
    }
    scene.add(inst2Mesh);
    
    // --- PARTICLES ---
    const particleCount = isMobile ? 2000 : 6000;
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(particleCount * 3);
    for (let i = 0; i < particleCount; i++) {
        pPos[i * 3] = (Math.random() - 0.5) * 35;
        pPos[i * 3 + 1] = (Math.random() - 0.5) * 35;
        pPos[i * 3 + 2] = (Math.random() - 0.5) * 35;
    }
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    const pMat = new THREE.PointsMaterial({ color: 0x527bff, size: isMobile ? 0.02 : 0.015, transparent: true, opacity: 0.5, sizeAttenuation: true });
    const particles = new THREE.Points(pGeo, pMat);
    scene.add(particles);
    
    // --- CONNECTING LINES (dynamic constellation) ---
    const linesMat = new THREE.LineBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.06 });
    const linesGeo = new THREE.BufferGeometry();
    const maxLines = isMobile ? 50 : 150;
    const linePositions = new Float32Array(maxLines * 6);
    linesGeo.setAttribute('position', new THREE.BufferAttribute(linePositions, 3));
    const lines = new THREE.LineSegments(linesGeo, linesMat);
    scene.add(lines);
    
    // --- GRID ---
    const grid = new THREE.GridHelper(40, 40, 0x527bff, 0x527bff);
    grid.position.y = -4;
    grid.material.transparent = true;
    grid.material.opacity = 0.04;
    scene.add(grid);
    
    // --- MOUSE INTERACTION ---
    let hoveredObj = null;
    
    const onMouseMove = (e) => {
        mouse.targetX = (e.clientX / window.innerWidth) * 2 - 1;
        mouse.targetY = -(e.clientY / window.innerHeight) * 2 + 1;
        mouseVec.set(mouse.targetX, mouse.targetY);
    };
    
    const onClick = () => {
        if (hoveredObj) {
            // Spin burst on click
            const d = heroData[heroObjects.indexOf(hoveredObj)];
            if (d) {
                d.rotSpeed.x += (Math.random() - 0.5) * 3;
                d.rotSpeed.y += (Math.random() - 0.5) * 3;
                d.targetScale = 1.5;
                setTimeout(() => { d.targetScale = 1; }, 400);
            }
        }
    };
    
    if (!isMobile) {
        window.addEventListener('mousemove', onMouseMove, { passive: true });
        container.addEventListener('click', onClick);
        container.style.cursor = 'default';
    }
    
    // --- VISIBILITY ---
    let isVisible = true;
    const observer = new IntersectionObserver(([e]) => { isVisible = e.isIntersecting; }, { threshold: 0.1 });
    observer.observe(container);
    
    // --- ANIMATE ---
    const clock = new THREE.Clock();
    let animId;
    
    function animate() {
        animId = requestAnimationFrame(animate);
        if (!isVisible) return;
        
        const t = clock.getElapsedTime();
        mouse.x += (mouse.targetX - mouse.x) * 0.05;
        mouse.y += (mouse.targetY - mouse.y) * 0.05;
        
        // Raycast for hover detection
        if (!isMobile) {
            raycaster.setFromCamera(mouseVec, camera);
            const hits = raycaster.intersectObjects(heroObjects);
            if (hits.length > 0) {
                if (hoveredObj !== hits[0].object) {
                    // Un-hover previous
                    if (hoveredObj) {
                        hoveredObj.material.opacity = 0.2;
                        hoveredObj.material.color.setHex(0x527bff);
                        const pd = heroData[heroObjects.indexOf(hoveredObj)];
                        if (pd) pd.targetScale = 1;
                    }
                    hoveredObj = hits[0].object;
                    hoveredObj.material.opacity = 0.6;
                    hoveredObj.material.color.setHex(0x7da0ff);
                    const hd = heroData[heroObjects.indexOf(hoveredObj)];
                    if (hd) hd.targetScale = 1.2;
                    container.style.cursor = 'pointer';
                }
            } else if (hoveredObj) {
                hoveredObj.material.opacity = 0.2;
                hoveredObj.material.color.setHex(0x527bff);
                const pd = heroData[heroObjects.indexOf(hoveredObj)];
                if (pd) pd.targetScale = 1;
                hoveredObj = null;
                container.style.cursor = 'default';
            }
        }
        
        // Animate hero objects
        heroObjects.forEach((obj, i) => {
            const d = heroData[i];
            obj.rotation.x += d.rotSpeed.x * 0.016;
            obj.rotation.y += d.rotSpeed.y * 0.016;
            obj.rotation.z += d.rotSpeed.z * 0.016;
            obj.position.y = d.origPos.y + Math.sin(t * d.floatSpeed + d.floatOffset) * d.floatAmp;
            
            // Mouse repel effect
            if (!isMobile) {
                const dx = obj.position.x - mouse.x * 4;
                const dy = obj.position.y - mouse.y * 3;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 3) {
                    const force = (3 - dist) * 0.02;
                    obj.position.x += dx * force * 0.1;
                    obj.position.y += dy * force * 0.1;
                }
            }
            
            // Smooth scale
            d.scale += (d.targetScale - d.scale) * 0.1;
            obj.scale.setScalar(d.scale);
            
            // Dampen rotation speed
            d.rotSpeed.x *= 0.999;
            d.rotSpeed.y *= 0.999;
        });
        
        // Instanced shapes
        for (let i = 0; i < instanceCount; i++) {
            const d = instData[i];
            dummy.position.set(d.x, d.y + Math.sin(t * d.speed + d.offset) * 0.4, d.z);
            dummy.rotation.set(t * d.rx, t * d.ry, 0);
            dummy.updateMatrix();
            instMesh.setMatrixAt(i, dummy.matrix);
        }
        instMesh.instanceMatrix.needsUpdate = true;
        
        for (let i = 0; i < inst2Count; i++) {
            const d = inst2Data[i];
            dummy.position.set(d.x, d.y + Math.cos(t * d.speed + d.offset) * 0.3, d.z);
            dummy.rotation.set(t * d.rx, t * d.ry, 0);
            dummy.updateMatrix();
            inst2Mesh.setMatrixAt(i, dummy.matrix);
        }
        inst2Mesh.instanceMatrix.needsUpdate = true;
        
        // Dynamic constellation lines between hero objects
        let lineIdx = 0;
        for (let i = 0; i < heroObjects.length && lineIdx < maxLines; i++) {
            for (let j = i + 1; j < heroObjects.length && lineIdx < maxLines; j++) {
                const a = heroObjects[i].position;
                const b = heroObjects[j].position;
                const dist = a.distanceTo(b);
                if (dist < 5) {
                    linePositions[lineIdx * 6] = a.x;
                    linePositions[lineIdx * 6 + 1] = a.y;
                    linePositions[lineIdx * 6 + 2] = a.z;
                    linePositions[lineIdx * 6 + 3] = b.x;
                    linePositions[lineIdx * 6 + 4] = b.y;
                    linePositions[lineIdx * 6 + 5] = b.z;
                    lineIdx++;
                }
            }
        }
        // Clear remaining
        for (let i = lineIdx; i < maxLines; i++) {
            linePositions[i * 6] = 0; linePositions[i * 6 + 1] = 0; linePositions[i * 6 + 2] = 0;
            linePositions[i * 6 + 3] = 0; linePositions[i * 6 + 4] = 0; linePositions[i * 6 + 5] = 0;
        }
        linesGeo.attributes.position.needsUpdate = true;
        
        // Camera
        camera.position.x += (mouse.x * 0.8 - camera.position.x) * 0.02;
        camera.position.y += (mouse.y * 0.5 - camera.position.y) * 0.02;
        camera.lookAt(0, 0, 0);
        
        particles.rotation.y = t * 0.015;
        particles.rotation.x = t * 0.008;
        
        renderer.render(scene, camera);
    }
    
    animate();
    
    // Resize
    const onResize = () => {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    };
    window.addEventListener('resize', onResize);
    
    // Cleanup
    window.addEventListener('beforeunload', () => {
        cancelAnimationFrame(animId);
        observer.disconnect();
        renderer.dispose();
        window.removeEventListener('mousemove', onMouseMove);
        window.removeEventListener('resize', onResize);
    });
}
