const projects = [{
        id: 1,
        title: "E-commerce React",
        category: "web",
        color: "#ffffff",
        image: "assets/img/marketplace.webp",
        description: "Plateforme e-commerce complète avec panier, paiement Stripe et dashboard admin.",
        skills: ["Vites js", "fast api (python)", "Postgresql", "Stripe"],
        details: ["Authentification JWT", "Paiement sécurisé", "Dashboard analytics", "Responsive design"],
        link: ""
    },
    {
        id: 2,
        title: "Plateforme de reservation d'appartements",
        category: "web",
        color: "#cfe0ff",
        image: "assets/img/Jachyvhamappartements.webp",
        description: "Création complète d'une plateforme de reservation pour les appartements Jachyvamapartements..",
        skills: ["Figma", "React js ", "ChadcnUi", "Supabase"],
        details: ["Authentification JWT", "reservation sécurisé", "Dashboard analytics", "Responsive design", "Gestionnaire de stock et budget integrés"],
        link: "https://www.jachyvhamapartements.com/rooms"
    },
    {
        id: 3,
        title: "Plateforme de commande de voiture ",
        category: "web",
        color: "#ff7424",
        image: "assets/img/roadbuisness.webp",
        description: "Creation d'une plateforme de commande de voiture pour l'entreprise Road business ",
        skills: ["React js", "Django", "PostgreSQL", "Docker"],
        details: ["Architecture modulaire", "Tests automatisés", "CI/CD", "Documentation"],
        link: ""
    },
    {
        id: 4,
        title: "Chatbot medical Niketkaps ",
        category: "web, IA, recherche",
        color: "#f59e0b",
        image: "assets/img/niketkaps.webp",
        description: "Developpement d'une application de chatbot medical, avec integration LLM et du protocole RAG",
        skills: [" Systeme RAG, Temps reel, Django et React js"],
        details: ["Authentification JWT", "reservation sécurisé", "Dashboard analytics", "Responsive design", "Gestionnaire de stock et budget integrés"],
        link: "https://niketkaps.vercel.app/"
    },
    {
        id: 5,
        title: "Systeme de présence academique et scolaire ",
        category: "web",
        color: "#73ff83",
        image: "assets/img/presence.webp",
        description: "Application web de gestion de presence et rapport.",
        skills: [, "Javascript vanilla", "Tailwindcss", "Django", "C++"],
        details: ["Authentification JWT ", "Multi role Admin - Etudiants - Professeurs"],
        link: ""
    },
    {
        id: 6,
        title: "Gestionnaire de magasin de vente de produit tech",
        category: "desktop",
        color: "#ffa7a7",
        image: "assets/img/gestionmagasinjava.webp",
        description: "Conception d'une plateforme de gestion complete version ERP d'un magasin",
        skills: ["Java", "Javafx", "MySQL"],
        details: ["Authentification", "Application ERP", "Dashboard analytics"],
        link: ""
    },
    {
        id: 7,
        title: "Machine Learning et Deeplearning",
        category: "IA",
        color: "#10b981",
        image: "assets/img/recherche.webp",
        description: "Modèle de prédiction du cancert du foie et de son evolution.",
        skills: ["Python", "Pytorch", "Pandas", "Scikit-learn"],
        details: ["Data cleaning", "Feature engineering", "Model tuning"],
        link: ""
    },
    {
        id: 8,
        title: "Developpement de jeux",
        category: "jeux videos",
        color: "#f59e0b",
        image: "assets/img/godot.webp",
        description: " Developpement de jeux videos avec Unity, Godot en C#.",
        skills: ["C#", "Asset, Game Object et Component", "Integration IA"],
        details: ["20 modèles", "Éclairage de jeux", "Personnage autonome", "3D et 2D"],
        link: ""
    },
    {
        id: 9,
        title: "Competence en modelisation UML",
        category: "Recherche",
        color: "#aacbff",
        image: "assets/img/UML.webp",
        description: "conception des diagrames de classe en UML.",
        skills: ["Architecture logicielle"],
        details: ["A partir de diagramme de cas d'utilisation conception de diagramme de cas d'utilisation "],
        link: ""
    },
    {
        id: 10,
        title: "Competence en modelisation Merise",
        category: "Recherche",
        color: "#ceb9ff",
        image: "assets/img/merise.webp",
        description: "Competence en Modelisation Merise pour les bases de données",
        skills: ["JMerise", "Design system"],
        details: ["Diagramme MLD", "Diagramme MCD", " Dictionnaire de donnée", "MOD et MOT"],
        link: ""
    },
    {
        id: 11,
        title: "Mining award",
        category: "web",
        color: "#ffea00",
        image: "assets/img/miningaward.webp",
        description: "Developpement d'une plateforme pour l'asbl Mining award qui récompense les meilleurs acteurs miniers",
        skills: ["React js", "Django", "api rest"],
        details: ["Api rest", " Postgresql", "Gestion multi-role Admin-Entreprise-participant", "Tests unitaires"],
        link: ""
    },

    {
        id: 12,
        title: "Plateforme financiere de transaction paypal, mobile money et gestionnaire de paiement par api",
        category: "web",
        color: "#f59e0b",
        image: "assets/img/Plateforme_fiinanciere.png",
        description: "Plateforme financiere de transaction paypal, mobile money et gestionnaire de paiement par api pour permettre la circulation financiere en ligne plus facile pour les congolais ",
        skills: ["Vites js", "Flask ", " connexion api externe"],
        details: ["Api de paiement", "Postgresql", "Docker", "Bootstrap"],
        link: ""
    }
];

let scene, camera, renderer, controls;
let sphereGroup;
let tiles = [];
let raycaster, mouse;
let hoveredTile = null;
let currentFilter = 'all';
let bgSphere;
let touchStartX = 0;
let touchStartY = 0;
let touchMoved = false;
let touchStartTime = 0;
let pointerDownId = null;
let pointerStartX = 0;
let pointerStartY = 0;
let pointerMoved = false;
let pointerStartTime = 0;
const touchTapThreshold = 12;
const touchTapMaxTime = 350;

function applyTheme(mode) {
    const isLight = mode === 'light';
    document.body.classList.toggle('light-mode', isLight);

    const sun = document.getElementById('sunIcon');
    const moon = document.getElementById('moonIcon');
    if (sun && moon) {
        sun.style.display = isLight ? 'block' : 'none';
        moon.style.display = isLight ? 'none' : 'block';
    }

    if (scene && scene.fog) {
        scene.fog.color.set(isLight ? 0xe2e3e7 : 0x000000);
    }
    if (bgSphere && bgSphere.material) {
        bgSphere.material.color.set(isLight ? 0xbcbcbc : 0x111111);
        bgSphere.material.opacity = isLight ? 0.22 : 0.3;
        bgSphere.material.needsUpdate = true;
    }
}

function toggleTheme() {
    const isLight = !document.body.classList.contains('light-mode');
    const mode = isLight ? 'light' : 'dark';
    localStorage.setItem('theme', mode);
    applyTheme(mode);
}

function setupUIControls() {
    const themeBtn = document.getElementById('themeToggle');
    if (themeBtn) {
        themeBtn.addEventListener('click', toggleTheme);
    }

    const closeBtn = document.getElementById('closeDetailBtn');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeDetail);
    }

    document.querySelectorAll('.filter-btn[data-category]').forEach(btn => {
        btn.addEventListener('click', () => {
            filterCategory(btn.dataset.category, btn);
        });
    });
}

function init() {
    scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x000000, 0.02);

    camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 18;

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    document.getElementById('canvas-container').appendChild(renderer.domElement);
    renderer.domElement.style.touchAction = 'none';

    controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.rotateSpeed = 0.5;
    controls.zoomSpeed = 0.8;
    controls.minDistance = 12;
    controls.maxDistance = 30;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 0.5;

    const ambientLight = new THREE.AmbientLight(0xffffff, 0.4);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight.position.set(10, 10, 10);
    scene.add(directionalLight);

    const pointLight = new THREE.PointLight(0x3b82f6, 0.5);
    pointLight.position.set(-10, -10, -10);
    scene.add(pointLight);

    createSphere();

    raycaster = new THREE.Raycaster();
    mouse = new THREE.Vector2();

    window.addEventListener('resize', onWindowResize);
    window.addEventListener('mousemove', onMouseMove);
    window.addEventListener('click', onClick);
    renderer.domElement.addEventListener('touchstart', onTouchStart, { passive: true });
    renderer.domElement.addEventListener('touchmove', onTouchMove, { passive: true });
    renderer.domElement.addEventListener('touchend', onTouchEnd, { passive: true });

    renderer.domElement.addEventListener('pointerdown', onPointerDown, { passive: true });
    renderer.domElement.addEventListener('pointermove', onPointerMove, { passive: true });
    renderer.domElement.addEventListener('pointerup', onPointerUp, { passive: true });

    document.getElementById('projectCount').textContent = projects.length;

    const savedTheme = localStorage.getItem('theme') || 'dark';
    applyTheme(savedTheme);

    setupUIControls();

    animate();

    setTimeout(() => {
        document.getElementById('loader').style.opacity = '0';
        setTimeout(() => {
            document.getElementById('loader').style.display = 'none';
        }, 500);
    }, 1000);
}

function createSphere() {
    sphereGroup = new THREE.Group();
    scene.add(sphereGroup);

    const radius = 8;
    const tileCount = projects.length;
    const phi = Math.PI * (3 - Math.sqrt(5));

    projects.forEach((project, i) => {
        const y = 1 - (i / (tileCount - 1)) * 2;
        const radiusAtY = Math.sqrt(1 - y * y);
        const theta = phi * i;

        const x = Math.cos(theta) * radiusAtY;
        const z = Math.sin(theta) * radiusAtY;

        const geometry = new THREE.PlaneGeometry(2.2, 2.2, 4, 4);

        const textureLoader = new THREE.TextureLoader();
        const texture = textureLoader.load(project.image);
        texture.minFilter = THREE.LinearFilter;

        const material = new THREE.MeshBasicMaterial({
            map: texture,
            side: THREE.DoubleSide,
            transparent: true,
            opacity: 0.9
        });

        const tile = new THREE.Mesh(geometry, material);

        tile.position.set(x * radius, y * radius, z * radius);

        tile.lookAt(0, 0, 0);
        tile.rotateY(Math.PI);

        tile.userData = {
            project: project,
            originalScale: 1,
            id: i
        };

        const edgeGeometry = new THREE.EdgesGeometry(geometry);
        const edgeMaterial = new THREE.LineBasicMaterial({
            color: project.color,
            transparent: true,
            opacity: 0.3
        });
        const edges = new THREE.LineSegments(edgeGeometry, edgeMaterial);
        tile.add(edges);

        tiles.push(tile);
        sphereGroup.add(tile);
    });

    const sphereGeometry = new THREE.SphereGeometry(radius - 0.1, 32, 32);
    const sphereMaterial = new THREE.MeshBasicMaterial({
        color: 0x111111,
        transparent: true,
        opacity: 0.3,
        side: THREE.BackSide
    });
    bgSphere = new THREE.Mesh(sphereGeometry, sphereMaterial);
    sphereGroup.add(bgSphere);
}

function setPointerFromEvent(x, y) {
    mouse.x = (x / window.innerWidth) * 2 - 1;
    mouse.y = -(y / window.innerHeight) * 2 + 1;

    const label = document.getElementById('hoverLabel');
    if (label) {
        label.style.left = x + 'px';
        label.style.top = y + 'px';
    }
}

function onMouseMove(event) {
    setPointerFromEvent(event.clientX, event.clientY);
}

function onTouchMove(event) {
    if (!event.touches || event.touches.length === 0) return;
    const t = event.touches[0];
    const dx = t.clientX - touchStartX;
    const dy = t.clientY - touchStartY;
    if (Math.hypot(dx, dy) > touchTapThreshold) {
        touchMoved = true;
    }
    setPointerFromEvent(t.clientX, t.clientY);
}

function pickTileAtEvent(event) {
    let x;
    let y;
    if (event.touches && event.touches.length) {
        x = event.touches[0].clientX;
        y = event.touches[0].clientY;
    } else if (event.changedTouches && event.changedTouches.length) {
        x = event.changedTouches[0].clientX;
        y = event.changedTouches[0].clientY;
    } else {
        x = event.clientX;
        y = event.clientY;
    }
    if (typeof x !== 'number' || typeof y !== 'number') return null;
    setPointerFromEvent(x, y);
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(tiles);
    return intersects.length ? intersects[0].object : null;
}

function onClick(event) {
    const tile = pickTileAtEvent(event);
    if (tile) openDetail(tile.userData.project);
}

function onTouchStart(event) {
    if (!event.touches || event.touches.length === 0) return;
    const t = event.touches[0];
    touchStartX = t.clientX;
    touchStartY = t.clientY;
    touchMoved = false;
    touchStartTime = Date.now();
}

function onTouchEnd(event) {
    if (touchMoved) return;
    if (Date.now() - touchStartTime > touchTapMaxTime) return;
    const tile = pickTileAtEvent(event);
    if (tile) openDetail(tile.userData.project);
}

function onPointerDown(event) {
    if (event.pointerType !== 'touch') return;
    pointerDownId = event.pointerId;
    pointerStartX = event.clientX;
    pointerStartY = event.clientY;
    pointerMoved = false;
    pointerStartTime = Date.now();
}

function onPointerMove(event) {
    if (event.pointerType !== 'touch') return;
    if (pointerDownId !== event.pointerId) return;
    const dx = event.clientX - pointerStartX;
    const dy = event.clientY - pointerStartY;
    if (Math.hypot(dx, dy) > touchTapThreshold) {
        pointerMoved = true;
    }
}

function onPointerUp(event) {
    if (event.pointerType !== 'touch') return;
    if (pointerDownId !== event.pointerId) return;
    pointerDownId = null;
    if (pointerMoved) return;
    if (Date.now() - pointerStartTime > touchTapMaxTime) return;
    const tile = pickTileAtEvent(event);
    if (tile) openDetail(tile.userData.project);
}

function checkIntersection() {
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(tiles);

    if (intersects.length > 0) {
        const tile = intersects[0].object;

        if (hoveredTile !== tile) {
            if (hoveredTile) {
                gsap.to(hoveredTile.scale, {
                    x: 1,
                    y: 1,
                    z: 1,
                    duration: 0.3
                });
            }

            hoveredTile = tile;
            gsap.to(tile.scale, {
                x: 1.2,
                y: 1.2,
                z: 1.2,
                duration: 0.3,
                ease: "back.out(1.7)"
            });

            const label = document.getElementById('hoverLabel');
            label.textContent = tile.userData.project.title;
            label.style.opacity = '1';

            controls.autoRotate = false;
            document.body.style.cursor = 'pointer';
        }
    } else {
        if (hoveredTile) {
            gsap.to(hoveredTile.scale, {
                x: 1,
                y: 1,
                z: 1,
                duration: 0.3
            });
            hoveredTile = null;

            const label = document.getElementById('hoverLabel');
            label.style.opacity = '0';

            controls.autoRotate = true;
            document.body.style.cursor = 'default';
        }
    }
}

function openDetail(project) {
    const panel = document.getElementById('detailPanel');
    const detailLink = document.getElementById('detailLink');

    document.body.classList.add('detail-open');
    if (controls) {
        controls.enabled = false;
        controls.autoRotate = false;
    }

    document.getElementById('detailCategory').textContent = project.category.toUpperCase();
    document.getElementById('detailCategory').style.color = project.color;
    document.getElementById('detailCategory').style.borderColor = project.color;
    document.getElementById('detailCategory').style.backgroundColor = project.color + '20';

    document.getElementById('detailTitle').textContent = project.title;
    document.getElementById('detailImage').style.backgroundImage = `url(${project.image})`;
    document.getElementById('detailDescription').textContent = project.description;

    const skillsContainer = document.getElementById('detailSkills');
    skillsContainer.innerHTML = '';
    project.skills.forEach(skill => {
        const span = document.createElement('span');
        span.className = 'skill-tag';
        span.textContent = skill;
        skillsContainer.appendChild(span);
    });

    const listContainer = document.getElementById('detailList');
    listContainer.innerHTML = '';
    project.details.forEach(detail => {
        const li = document.createElement('li');
        li.innerHTML = `<span class="text-white mr-2">→</span>${detail}`;
        listContainer.appendChild(li);
    });

    if (detailLink) {
        if (!detailLink.dataset.defaultHtml) {
            detailLink.dataset.defaultHtml = detailLink.innerHTML;
        }

        if (project.link) {
            detailLink.classList.remove('detail-link-disabled');
            detailLink.innerHTML = detailLink.dataset.defaultHtml;
            detailLink.href = project.link;
            detailLink.setAttribute('target', '_blank');
            detailLink.setAttribute('rel', 'noopener noreferrer');
            detailLink.style.display = "inline-flex";
        } else {
            detailLink.classList.add('detail-link-disabled');
            detailLink.innerHTML = "Bientôt disponible en ligne";
            detailLink.href = "#";
            detailLink.removeAttribute('target');
            detailLink.removeAttribute('rel');
            detailLink.style.display = "inline-flex";
        }
    }

    panel.classList.add('active');
}

function closeDetail() {
    document.body.classList.remove('detail-open');
    if (controls) {
        controls.enabled = true;
        controls.autoRotate = true;
    }
    document.getElementById('detailPanel').classList.remove('active');
}

function filterCategory(category, activeBtn) {
    currentFilter = category;

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    if (activeBtn) {
        activeBtn.classList.add('active');
    } else {
        const match = document.querySelector(`.filter-btn[data-category="${category}"]`);
        if (match) match.classList.add('active');
    }

    tiles.forEach((tile, index) => {
        const project = tile.userData.project;
        const visible = category === 'all' || project.category === category;

        if (visible) {
            gsap.to(tile.scale, {
                x: 1,
                y: 1,
                z: 1,
                duration: 0.5,
                delay: index * 0.05
            });
            gsap.to(tile.material, {
                opacity: 0.9,
                duration: 0.5
            });
        } else {
            gsap.to(tile.scale, {
                x: 0.1,
                y: 0.1,
                z: 0.1,
                duration: 0.5,
                delay: index * 0.05
            });
            gsap.to(tile.material, {
                opacity: 0.1,
                duration: 0.5
            });
        }
    });

    const count = category === 'all' ? projects.length : projects.filter(p => p.category === category).length;
    document.getElementById('projectCount').textContent = count;
}

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

function animate() {
    requestAnimationFrame(animate);

    controls.update();
    checkIntersection();

    if (sphereGroup) {
        sphereGroup.rotation.y += 0.001;
    }

    renderer.render(scene, camera);
}

init();