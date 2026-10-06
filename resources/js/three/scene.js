import * as THREE from 'three';

export function initInteractiveScene(isMobile) {
    const container = document.getElementById('interactive-canvas');
    if (!container) return;
    
    try {
        const c = document.createElement('canvas');
        if (!(c.getContext('webgl') || c.getContext('experimental-webgl'))) throw 0;
    } catch {
        container.style.background = 'radial-gradient(ellipse at center, #111118 0%, #0a0a0f 100%)';
        return;
    }
    
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(60, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(0, 2, 10);
    
    const renderer = new THREE.WebGLRenderer({ antialias: !isMobile, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);
    container.appendChild(renderer.domElement);
    
    const mouse = { x: 0, y: 0, targetX: 0, targetY: 0 };
    const raycaster = new THREE.Raycaster();
    const mouseVec = new THREE.Vector2();
    
    const wireMat = new THREE.MeshBasicMaterial({ color: 0x527bff, wireframe: true, transparent: true, opacity: 0.15 });
    
    // --- ORBITING OBJECTS (interactive solar-system style) ---
    const orbitObjects = [];
    const orbitData = [];
    
    const orbitGeos = [
        new THREE.IcosahedronGeometry(0.5, 1),
        new THREE.OctahedronGeometry(0.4, 0),
        new THREE.DodecahedronGeometry(0.35, 0),
        new THREE.TetrahedronGeometry(0.4, 0),
        new THREE.TorusGeometry(0.35, 0.1, 8, 24),
        new THREE.TorusKnotGeometry(0.3, 0.1, 64, 8),
        new THREE.BoxGeometry(0.5, 0.5, 0.5),
        new THREE.ConeGeometry(0.3, 0.6, 6),
        new THREE.SphereGeometry(0.3, 12, 12),
        new THREE.CylinderGeometry(0.2, 0.3, 0.5, 6),
        new THREE.TorusKnotGeometry(0.25, 0.08, 64, 8, 3, 2),
        new THREE.IcosahedronGeometry(0.35, 0),
    ];
    
    orbitGeos.forEach((geo, i) => {
        const mat = wireMat.clone();
        const mesh = new THREE.Mesh(geo, mat);
        const radius = 3 + (i % 4) * 1.5;
        const angle = (i / orbitGeos.length) * Math.PI * 2;
        const yOff = (Math.random() - 0.5) * 3;
        mesh.position.set(Math.cos(angle) * radius, yOff, Math.sin(angle) * radius);
        scene.add(mesh);
        orbitObjects.push(mesh);
        orbitData.push({
            radius,
            angle,
            yOff,
            orbitSpeed: (Math.random() * 0.15 + 0.05) * (i % 2 === 0 ? 1 : -1),
            selfRotX: (Math.random() - 0.5) * 0.6,
            selfRotY: (Math.random() - 0.5) * 0.6,
            floatSpeed: Math.random() * 0.5 + 0.3,
            floatOffset: Math.random() * Math.PI * 2,
            scale: 1,
            targetScale: 1,
            exploded: false,
        });
    });
    
    // --- CENTER PIECE: Large wireframe sphere ---
    const centerGeo = new THREE.IcosahedronGeometry(1.5, 2);
    const centerMat = new THREE.MeshBasicMaterial({ color: 0x527bff, wireframe: true, transparent: true, opacity: 0.08 });
    const centerSphere = new THREE.Mesh(centerGeo, centerMat);
    scene.add(centerSphere);
    
    // --- ORBIT RINGS (visual) ---
    for (let r = 0; r < 4; r++) {
        const ringGeo = new THREE.RingGeometry(3 + r * 1.5 - 0.02, 3 + r * 1.5 + 0.02, 64);
        const ringMat = new THREE.MeshBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.04, side: THREE.DoubleSide });
        const ring = new THREE.Mesh(ringGeo, ringMat);
        ring.rotation.x = -Math.PI / 2;
        ring.position.y = 0;
        scene.add(ring);
    }
    
    // --- INSTANCED BACKGROUND (3 types) ---
    const dummy = new THREE.Object3D();
    const bgSets = [];
    const bgGeos = [
        new THREE.TetrahedronGeometry(0.1, 0),
        new THREE.OctahedronGeometry(0.08, 0),
        new THREE.BoxGeometry(0.1, 0.1, 0.1),
    ];
    
    bgGeos.forEach(geo => {
        const count = isMobile ? 100 : 350;
        const mesh = new THREE.InstancedMesh(geo, wireMat, count);
        const data = [];
        for (let i = 0; i < count; i++) {
            const x = (Math.random() - 0.5) * 50;
            const y = (Math.random() - 0.5) * 30;
            const z = (Math.random() - 0.5) * 30 - 5;
            dummy.position.set(x, y, z);
            dummy.rotation.set(Math.random() * Math.PI * 2, Math.random() * Math.PI * 2, 0);
            const s = Math.random() * 0.5 + 0.3;
            dummy.scale.set(s, s, s);
            dummy.updateMatrix();
            mesh.setMatrixAt(i, dummy.matrix);
            data.push({ x, y, z, rx: Math.random() * 0.02, ry: Math.random() * 0.02, speed: Math.random() * 0.3 + 0.1, offset: Math.random() * Math.PI * 2 });
        }
        scene.add(mesh);
        bgSets.push({ mesh, data, count });
    });
    
    // --- PARTICLES ---
    const pCount = isMobile ? 2000 : 8000;
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(pCount * 3);
    for (let i = 0; i < pCount * 3; i++) pPos[i] = (Math.random() - 0.5) * 50;
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    const pMat = new THREE.PointsMaterial({ color: 0x527bff, size: 0.018, transparent: true, opacity: 0.35, sizeAttenuation: true });
    const pointCloud = new THREE.Points(pGeo, pMat);
    scene.add(pointCloud);
    
    // --- CONSTELLATION LINES between orbiting objects ---
    const linesMat = new THREE.LineBasicMaterial({ color: 0x527bff, transparent: true, opacity: 0.05 });
    const linesGeo = new THREE.BufferGeometry();
    const maxLines = 40;
    const linePos = new Float32Array(maxLines * 6);
    linesGeo.setAttribute('position', new THREE.BufferAttribute(linePos, 3));
    const lines = new THREE.LineSegments(linesGeo, linesMat);
    scene.add(lines);
    
    // --- GRID ---
    const grid = new THREE.GridHelper(50, 50, 0x527bff, 0x527bff);
    grid.position.y = -5;
    grid.material.transparent = true;
    grid.material.opacity = 0.03;
    scene.add(grid);
    
    // --- MOUSE ---
    let hoveredOrbit = null;
    
    const onMouseMove = (e) => {
        const rect = container.getBoundingClientRect();
        mouse.targetX = ((e.clientX - rect.left) / rect.width) * 2 - 1;
        mouse.targetY = -((e.clientY - rect.top) / rect.height) * 2 + 1;
        mouseVec.set(mouse.targetX, mouse.targetY);
    };
    
    const onClick = () => {
        if (hoveredOrbit) {
            const idx = orbitObjects.indexOf(hoveredOrbit);
            const d = orbitData[idx];
            // Explode outwards briefly
            d.radius += 2;
            d.selfRotX += (Math.random() - 0.5) * 5;
            d.selfRotY += (Math.random() - 0.5) * 5;
            d.targetScale = 1.8;
            d.exploded = true;
            setTimeout(() => {
                d.radius -= 2;
                d.targetScale = 1;
                d.exploded = false;
            }, 600);
        }
    };
    
    if (!isMobile) {
        container.addEventListener('mousemove', onMouseMove, { passive: true });
        container.addEventListener('click', onClick);
    }
    
    // --- CAMERA DRAG ---
    let isDragging = false;
    let dragStart = { x: 0, y: 0 };
    let cameraAngle = { x: 0, y: 0 };
    
    if (!isMobile) {
        container.addEventListener('mousedown', (e) => {
            if (e.button === 2 || e.button === 1) { // right or middle click
                isDragging = true;
                dragStart = { x: e.clientX, y: e.clientY };
            }
        });
        container.addEventListener('mouseup', () => { isDragging = false; });
        container.addEventListener('mouseleave', () => { isDragging = false; });
        container.addEventListener('mousemove', (e) => {
            if (isDragging) {
                cameraAngle.x += (e.clientX - dragStart.x) * 0.003;
                cameraAngle.y += (e.clientY - dragStart.y) * 0.003;
                cameraAngle.y = Math.max(-1, Math.min(1, cameraAngle.y));
                dragStart = { x: e.clientX, y: e.clientY };
            }
        });
        container.addEventListener('contextmenu', (e) => e.preventDefault());
    }
    
    // --- VISIBILITY ---
    let isVisible = false;
    const observer = new IntersectionObserver(([e]) => { isVisible = e.isIntersecting; }, { threshold: 0.1 });
    observer.observe(container);
    
    // --- ANIMATE ---
    const clock = new THREE.Clock();
    let animId;
    
    function animate() {
        animId = requestAnimationFrame(animate);
        if (!isVisible) return;
        
        const t = clock.getElapsedTime();
        mouse.x += (mouse.targetX - mouse.x) * 0.03;
        mouse.y += (mouse.targetY - mouse.y) * 0.03;
        
        // Center sphere rotation
        centerSphere.rotation.x = t * 0.05;
        centerSphere.rotation.y = t * 0.08;
        
        // Raycast
        if (!isMobile) {
            raycaster.setFromCamera(mouseVec, camera);
            const hits = raycaster.intersectObjects(orbitObjects);
            if (hits.length > 0) {
                if (hoveredOrbit !== hits[0].object) {
                    if (hoveredOrbit) {
                        hoveredOrbit.material.opacity = 0.15;
                        hoveredOrbit.material.color.setHex(0x527bff);
                        const pd = orbitData[orbitObjects.indexOf(hoveredOrbit)];
                        if (pd && !pd.exploded) pd.targetScale = 1;
                    }
                    hoveredOrbit = hits[0].object;
                    hoveredOrbit.material.opacity = 0.6;
                    hoveredOrbit.material.color.setHex(0x7da0ff);
                    const hd = orbitData[orbitObjects.indexOf(hoveredOrbit)];
                    if (hd && !hd.exploded) hd.targetScale = 1.3;
                    container.style.cursor = 'pointer';
                }
            } else if (hoveredOrbit) {
                hoveredOrbit.material.opacity = 0.15;
                hoveredOrbit.material.color.setHex(0x527bff);
                const pd = orbitData[orbitObjects.indexOf(hoveredOrbit)];
                if (pd && !pd.exploded) pd.targetScale = 1;
                hoveredOrbit = null;
                container.style.cursor = 'default';
            }
        }
        
        // Orbit objects
        orbitObjects.forEach((obj, i) => {
            const d = orbitData[i];
            d.angle += d.orbitSpeed * 0.016;
            obj.position.x = Math.cos(d.angle) * d.radius;
            obj.position.z = Math.sin(d.angle) * d.radius;
            obj.position.y = d.yOff + Math.sin(t * d.floatSpeed + d.floatOffset) * 0.5;
            
            obj.rotation.x += d.selfRotX * 0.016;
            obj.rotation.y += d.selfRotY * 0.016;
            
            d.scale += (d.targetScale - d.scale) * 0.1;
            obj.scale.setScalar(d.scale);
            
            d.selfRotX *= 0.998;
            d.selfRotY *= 0.998;
        });
        
        // Background instances
        bgSets.forEach(({ mesh, data, count }) => {
            for (let i = 0; i < count; i++) {
                const d = data[i];
                dummy.position.set(d.x, d.y + Math.sin(t * d.speed + d.offset) * 0.3, d.z);
                dummy.rotation.set(t * d.rx, t * d.ry, 0);
                dummy.updateMatrix();
                mesh.setMatrixAt(i, dummy.matrix);
            }
            mesh.instanceMatrix.needsUpdate = true;
        });
        
        // Constellation lines
        let li = 0;
        for (let i = 0; i < orbitObjects.length && li < maxLines; i++) {
            for (let j = i + 1; j < orbitObjects.length && li < maxLines; j++) {
                const a = orbitObjects[i].position, b = orbitObjects[j].position;
                if (a.distanceTo(b) < 6) {
                    linePos[li * 6] = a.x; linePos[li * 6 + 1] = a.y; linePos[li * 6 + 2] = a.z;
                    linePos[li * 6 + 3] = b.x; linePos[li * 6 + 4] = b.y; linePos[li * 6 + 5] = b.z;
                    li++;
                }
            }
        }
        for (let i = li; i < maxLines; i++) {
            linePos[i * 6] = 0; linePos[i * 6 + 1] = 0; linePos[i * 6 + 2] = 0;
            linePos[i * 6 + 3] = 0; linePos[i * 6 + 4] = 0; linePos[i * 6 + 5] = 0;
        }
        linesGeo.attributes.position.needsUpdate = true;
        
        pointCloud.rotation.y = t * 0.01;
        
        // Camera
        const camDist = 10;
        camera.position.x = Math.sin(cameraAngle.x) * camDist + mouse.x * 1.5;
        camera.position.y = 2 + cameraAngle.y * 3 + mouse.y * 0.8;
        camera.position.z = Math.cos(cameraAngle.x) * camDist;
        camera.lookAt(0, 0, 0);
        
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
