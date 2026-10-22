<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Culinary Excellence</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700,900|inter:300,400,500,600,700&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #050505;
            overflow-x: hidden;
            cursor: none;
        }

        #cursor-follower {
            position: fixed;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s, background-color 0.3s;
        }

        #cursor-dot {
            position: fixed;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
        }

        body:hover #cursor-follower {
            opacity: 1;
        }

        .cursor-hover #cursor-follower {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.1);
            border-color: transparent;
        }

        .gradient-text {
            background: linear-gradient(135deg, #a78bfa 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glow-box {
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.15);
        }

        .perspective-1000 {
            perspective: 1000px;
        }

        .transform-3d {
            transform-style: preserve-3d;
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 20s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        #three-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="antialiased font-sans text-gray-100 bg-black" x-data="restaurantApp()">

    <div id="cursor-follower"></div>
    <div id="cursor-dot"></div>

    <div
        class="fixed inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none z-50 mix-blend-overlay">
    </div>
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div
            class="absolute w-[500px] h-[500px] bg-purple-900/20 rounded-full blur-[120px] top-[-100px] left-[-100px] animate-pulse">
        </div>
        <div class="absolute w-[600px] h-[600px] bg-blue-900/20 rounded-full blur-[120px] bottom-[-200px] right-[-100px] animate-pulse"
            style="animation-delay: 2s"></div>
    </div>

    <nav class="fixed w-full z-50 transition-all duration-500"
        :class="{ 'glass-effect py-4': scrolled, 'bg-transparent py-6': !scrolled }"
        @scroll.window="scrolled = (window.pageYOffset > 50)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="#" class="magnetic-trigger">
                    <span
                        class="font-serif text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Le
                        Restaurant</span>
                </a>
                <div class="hidden md:flex items-center space-x-12">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin.dashboard') }}"
                                class="magnetic-trigger text-sm font-medium text-gray-300 hover:text-white transition-colors tracking-widest uppercase">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="magnetic-trigger px-8 py-3 rounded-full border border-white/20 hover:bg-white hover:text-black transition-all duration-300 text-sm font-medium tracking-widest uppercase">Reserve</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden perspective-1000" id="hero">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/80 to-black z-10"></div>
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop"
                class="w-full h-full object-cover opacity-40 parallax-layer" data-speed="0.5" alt="Atmosphere">
        </div>

        <div class="relative z-20 text-center px-4 max-w-5xl mx-auto">
            <h1 class="font-serif text-7xl md:text-9xl font-black tracking-tight mb-8 leading-none" id="hero-text">
                <div class="overflow-hidden"><span
                        class="block transform translate-y-full hero-line gradient-text">TASTE THE</span></div>
                <div class="overflow-hidden"><span
                        class="block transform translate-y-full hero-line text-white">IMPOSSIBLE</span></div>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 max-w-2xl mx-auto font-light tracking-wide opacity-0 hero-fade">
                A culinary journey defying expectations and gravity.
            </p>
            <div class="mt-12 opacity-0 hero-fade">
                <a href="#special"
                    class="magnetic-trigger inline-flex items-center gap-2 text-white border-b border-white/30 pb-1 hover:border-white transition-all group">
                    Discover Our Special <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>

        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-20 opacity-0 hero-fade">
            <div class="w-[1px] h-24 bg-gradient-to-b from-transparent via-white to-transparent"></div>
        </div>
    </div>

    <div class="relative h-[150vh] bg-black" id="special">
        <div class="sticky top-0 h-screen w-full overflow-hidden flex flex-col items-center justify-center">
            <canvas id="three-canvas"></canvas>

            <div class="relative z-10 text-center pointer-events-none mix-blend-difference text-white">
                <h2 class="font-serif text-6xl md:text-8xl font-bold mb-4 opacity-0 special-text translate-y-10">THE
                    ORBITAL</h2>
                <p class="text-xl md:text-2xl font-light tracking-widest opacity-0 special-text translate-y-10">BURGER
                    DECONSTRUCTED</p>
            </div>

            <div
                class="absolute bottom-10 left-10 md:left-20 max-w-xs text-left z-20 opacity-0 special-details translate-y-10">
                <h3 class="text-purple-400 font-bold tracking-widest uppercase mb-2">Composition</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Wagyu beef blend, orbit-aged cheddar, anti-gravity
                    reduction sauce, floating brioche.</p>
            </div>

            <div class="absolute bottom-10 right-10 md:right-20 z-20 opacity-0 special-details translate-y-10">
                <span class="block text-6xl font-serif font-bold text-white">$45</span>
            </div>
        </div>
    </div>

    <div class="py-24 bg-black relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center border-y border-white/10 py-12">
                <div class="stat-item group">
                    <span class="block text-4xl md:text-6xl font-bold gradient-text mb-2 counter"
                        data-target="15">0</span>
                    <span
                        class="text-gray-500 text-xs tracking-[0.2em] uppercase group-hover:text-white transition-colors">Years
                        Active</span>
                </div>
                <div class="stat-item group">
                    <span class="block text-4xl md:text-6xl font-bold gradient-text mb-2 counter"
                        data-target="128">0</span>
                    <span
                        class="text-gray-500 text-xs tracking-[0.2em] uppercase group-hover:text-white transition-colors">Signature
                        Dishes</span>
                </div>
                <div class="stat-item group">
                    <span class="block text-4xl md:text-6xl font-bold gradient-text mb-2 counter"
                        data-target="50">0</span>
                    <span
                        class="text-gray-500 text-xs tracking-[0.2em] uppercase group-hover:text-white transition-colors">Awards
                        Won</span>
                </div>
                <div class="stat-item group">
                    <span class="block text-4xl md:text-6xl font-bold gradient-text mb-2 counter"
                        data-target="3">0</span>
                    <span
                        class="text-gray-500 text-xs tracking-[0.2em] uppercase group-hover:text-white transition-colors">Michelin
                        Stars</span>
                </div>
            </div>
        </div>
    </div>

    <div class="relative py-32 bg-gradient-to-b from-black to-[#0a0a0a]" id="menu">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 scroll-reveal">
                <div>
                    <h2 class="text-5xl md:text-7xl font-serif font-bold text-white mb-6">El Menu</h2>
                    <p class="text-gray-400 max-w-md">Curated for the adventurous palate. Each dish is a distinct
                        universe of flavor.</p>
                </div>

                <div class="flex flex-wrap gap-4 mt-8 md:mt-0">
                    <button @click="setCategory('all')"
                        :class="activeCategory === 'all' ? 'text-white border-white' : 'text-gray-500 border-transparent hover:text-white'"
                        class="magnetic-trigger px-6 py-2 border rounded-full transition-all duration-300">All</button>
                    @foreach($categories as $category)
                        <button @click="setCategory('{{ $category->slug }}')"
                            :class="activeCategory === '{{ $category->slug }}' ? 'text-white border-white' : 'text-gray-500 border-transparent hover:text-white'"
                            class="magnetic-trigger px-6 py-2 border rounded-full transition-all duration-300">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>

            <div class="grid gap-x-8 gap-y-16 md:grid-cols-2 lg:grid-cols-3" x-ref="mealsGrid">
                @foreach($meals as $meal)
                    <div class="meal-card group relative transform-3d perspective-1000"
                        data-category="{{ $meal->category->slug }}">
                        <div
                            class="relative h-[400px] w-full overflow-hidden rounded-2xl bg-[#111] card-image-wrapper transition-all duration-500 group-hover:-translate-y-4 shadow-2xl shadow-black/50">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60 z-10 transition-opacity group-hover:opacity-40">
                            </div>

                            <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                            <div class="absolute top-6 right-6 z-20">
                                <span
                                    class="glass-effect px-4 py-2 rounded-full text-white font-bold backdrop-blur-md">${{ $meal->price }}</span>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-between items-start">
                            <div>
                                <h3
                                    class="text-2xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">
                                    {{ $meal->name }}
                                </h3>
                                <p
                                    class="text-gray-500 text-sm line-clamp-2 max-w-xs group-hover:text-gray-300 transition-colors">
                                    {{ $meal->description }}
                                </p>
                            </div>
                            <button
                                class="magnetic-trigger w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white group-hover:bg-white group-hover:text-black transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div x-show="filteredCount === 0" style="display: none;" class="text-center py-20">
                <p class="text-gray-500 italic text-2xl">No dishes found in this category</p>
            </div>
        </div>
    </div>

    <div class="py-32 bg-black overflow-hidden relative">
        <div
            class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-30">
        </div>

        <div class="text-center mb-20 scroll-reveal">
            <h2 class="text-lg text-purple-400 font-bold tracking-widest uppercase mb-4">Critics & Patrons</h2>
            <h3 class="text-4xl md:text-6xl font-serif font-bold text-white">Words of Praise</h3>
        </div>

        <div class="marquee-container mb-8 transform -rotate-1 opacity-80">
            <div class="marquee-content" id="marquee-1">
                <span
                    class="mx-8 text-6xl md:text-8xl font-black text-transparent stroke-text opacity-20 hover:opacity-100 transition-opacity cursor-default duration-500"
                    style="-webkit-text-stroke: 1px rgba(255,255,255,0.5);">"ABSOLUTELY DIVINE"</span>
                <span class="mx-8 text-6xl md:text-8xl font-black text-white">"MASTERPIECE"</span>
                <span
                    class="mx-8 text-6xl md:text-8xl font-black text-transparent stroke-text opacity-20 hover:opacity-100 transition-opacity cursor-default duration-500"
                    style="-webkit-text-stroke: 1px rgba(255,255,255,0.5);">"UNFORGETTABLE"</span>
                <span class="mx-8 text-6xl md:text-8xl font-black text-white">"CULINARY MAGIC"</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 mt-20">
            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="glass-effect p-8 rounded-2xl relative group hover:-translate-y-2 transition-transform duration-500 scroll-reveal">
                    <div class="text-purple-400 text-6xl font-serif absolute top-4 left-6 opacity-50">"</div>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6 relative z-10 pt-4">I've eaten all over the
                        world, but this place is different. It's not just food, it's art you can taste.</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-700 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?bg=333&auto=format&fit=crop&q=80&w=100"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-white font-bold">Jonathan Gold</h4>
                            <p class="text-gray-500 text-xs uppercase tracking-widest">Food Critic</p>
                        </div>
                    </div>
                </div>

                <div class="glass-effect p-8 rounded-2xl relative group hover:-translate-y-2 transition-transform duration-500 scroll-reveal"
                    style="transition-delay: 0.1s">
                    <div class="text-blue-400 text-6xl font-serif absolute top-4 left-6 opacity-50">"</div>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6 relative z-10 pt-4">The atmosphere, the
                        service, the deconstructed burger... it's a religious experience. Highly recommended.</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-700 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?bg=333&auto=format&fit=crop&q=80&w=100"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-white font-bold">Sarah Jenkins</h4>
                            <p class="text-gray-500 text-xs uppercase tracking-widest">Verified Guest</p>
                        </div>
                    </div>
                </div>

                <div class="glass-effect p-8 rounded-2xl relative group hover:-translate-y-2 transition-transform duration-500 scroll-reveal"
                    style="transition-delay: 0.2s">
                    <div class="text-pink-400 text-6xl font-serif absolute top-4 left-6 opacity-50">"</div>
                    <p class="text-gray-300 text-lg leading-relaxed mb-6 relative z-10 pt-4">Gravity-defying flavors.
                        The Orbital Burger is worth every penny. A must-visit destination.</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-700 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?bg=333&auto=format&fit=crop&q=80&w=100"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="text-white font-bold">Marcus Chen</h4>
                            <p class="text-gray-500 text-xs uppercase tracking-widest">Chef de Cuisine</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="relative bg-black h-[60vh] flex flex-col items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/20 to-black z-0"></div>
        <div class="relative z-10 text-center px-4">
            <h2 class="text-5xl md:text-8xl font-serif font-black text-white mb-8 tracking-tighter">RESERVE.
                TASTE.<br>EXPERIENCE.</h2>
            <p class="text-gray-400 mb-12 max-w-xl mx-auto">Limited seats available for the upcoming season. Secure your
                table at the galaxy's finest table.</p>
            <a href="#"
                class="magnetic-trigger inline-block bg-white text-black px-12 py-5 rounded-full font-bold tracking-widest hover:scale-105 transition-transform duration-300 shadow-[0_0_50px_rgba(255,255,255,0.3)]">
                BOOK A TABLE
            </a>
        </div>

        <div class="absolute bottom-10 w-full text-center">
            <p class="text-gray-600 text-xs uppercase tracking-[0.3em]">&copy; {{ date('Y') }} Le Restaurant</p>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('restaurantApp', () => ({
                activeCategory: 'all',
                scrolled: false,
                filteredCount: {{ $meals->count() }},

                init() {
                    this.initCursor();
                    this.initHeroAnimations();
                    this.init3DModel();
                    this.initScrollAnimations();
                    this.initMarquee();
                    this.initCounters();
                },

                initCursor() {
                    const cursor = document.getElementById('cursor-follower');
                    const dot = document.getElementById('cursor-dot');

                    document.addEventListener('mousemove', (e) => {
                        gsap.to(cursor, { x: e.clientX, y: e.clientY, duration: 0.5, ease: 'power2.out' });
                        gsap.to(dot, { x: e.clientX, y: e.clientY, duration: 0.1, ease: 'power2.out' });
                    });

                    const triggers = document.querySelectorAll('.magnetic-trigger');
                    triggers.forEach(trigger => {
                        trigger.addEventListener('mouseenter', () => {
                            document.body.classList.add('cursor-hover');
                            gsap.to(cursor, { scale: 1.5, duration: 0.3 });
                        });
                        trigger.addEventListener('mouseleave', () => {
                            document.body.classList.remove('cursor-hover');
                            gsap.to(cursor, { scale: 1, duration: 0.3 });
                        });
                    });
                },

                initHeroAnimations() {
                    const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

                    tl.to('.hero-line', { y: '0%', duration: 1.5, stagger: 0.2 })
                        .to('.hero-fade', { opacity: 1, duration: 1 }, '-=1');

                    gsap.to('.parallax-layer', {
                        yPercent: 50,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: '#hero',
                            start: 'top top',
                            end: 'bottom top',
                            scrub: true
                        }
                    });
                },

                init3DModel() {
                    if (typeof THREE === 'undefined') return;

                    const canvas = document.getElementById('three-canvas');
                    const scene = new THREE.Scene();

                    const camera = new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 0.1, 1000);
                    camera.position.z = 24;
                    camera.position.y = 0;

                    const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
                    renderer.setSize(window.innerWidth, window.innerHeight);
                    renderer.setPixelRatio(window.devicePixelRatio);

                    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
                    scene.add(ambientLight);

                    const spotLight = new THREE.SpotLight(0xffffff, 2);
                    spotLight.position.set(10, 20, 10);
                    spotLight.castShadow = true;
                    scene.add(spotLight);

                    const purpleLight = new THREE.PointLight(0x8b5cf6, 2, 50);
                    purpleLight.position.set(-10, 0, 10);
                    scene.add(purpleLight);

                    const blueLight = new THREE.PointLight(0x3b82f6, 2, 50);
                    blueLight.position.set(10, -5, 10);
                    scene.add(blueLight);

                    const burgerGroup = new THREE.Group();

                    const bottomBunGeo = new THREE.CylinderGeometry(3.5, 3.2, 1.2, 32);
                    const bunMat = new THREE.MeshStandardMaterial({ color: 0xdca662, roughness: 0.6 });
                    const bottomBun = new THREE.Mesh(bottomBunGeo, bunMat);
                    bottomBun.position.y = -3;
                    burgerGroup.add(bottomBun);

                    const lettuceGeo = new THREE.TorusGeometry(3.6, 0.3, 16, 100);
                    const lettuceMat = new THREE.MeshStandardMaterial({ color: 0x4ade80, roughness: 0.4 });
                    const lettuce = new THREE.Mesh(lettuceGeo, lettuceMat);
                    lettuce.rotation.x = Math.PI / 2;
                    lettuce.scale.z = 0.5;
                    lettuce.position.y = -2;
                    burgerGroup.add(lettuce);

                    const pattyGeo = new THREE.CylinderGeometry(3.4, 3.4, 1, 32);
                    const pattyMat = new THREE.MeshStandardMaterial({ color: 0x3f2212, roughness: 0.9 });
                    const patty = new THREE.Mesh(pattyGeo, pattyMat);
                    patty.position.y = -1;
                    burgerGroup.add(patty);

                    const cheeseGeo = new THREE.BoxGeometry(5, 0.1, 5);
                    const cheeseMat = new THREE.MeshStandardMaterial({ color: 0xfacc15, roughness: 0.4 });
                    const cheese = new THREE.Mesh(cheeseGeo, cheeseMat);
                    cheese.position.y = -0.4;
                    burgerGroup.add(cheese);

                    const tomatoGeo = new THREE.TorusGeometry(2.5, 0.6, 16, 32);
                    const tomatoMat = new THREE.MeshStandardMaterial({ color: 0xef4444, roughness: 0.1 });
                    const tomato = new THREE.Mesh(tomatoGeo, tomatoMat);
                    tomato.rotation.x = Math.PI / 2;
                    tomato.position.y = 0.5;
                    burgerGroup.add(tomato);

                    const topBunGeo = new THREE.SphereGeometry(3.5, 32, 32, 0, Math.PI * 2, 0, Math.PI / 2);
                    const topBun = new THREE.Mesh(topBunGeo, bunMat);
                    topBun.position.y = 1;
                    burgerGroup.add(topBun);

                    const particlesGeo = new THREE.BufferGeometry();
                    const particlesCount = 100;
                    const posArray = new Float32Array(particlesCount * 3);
                    for (let i = 0; i < particlesCount * 3; i++) {
                        posArray[i] = (Math.random() - 0.5) * 15;
                    }
                    particlesGeo.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
                    const particlesMat = new THREE.PointsMaterial({ size: 0.05, color: 0xffffff });
                    const particlesMesh = new THREE.Points(particlesGeo, particlesMat);
                    burgerGroup.add(particlesMesh);

                    burgerGroup.rotation.z = Math.PI / 12;
                    burgerGroup.rotation.x = Math.PI / 6;

                    scene.add(burgerGroup);

                    const animate = () => {
                        requestAnimationFrame(animate);
                        burgerGroup.rotation.y += 0.005;
                        particlesMesh.rotation.y -= 0.01;
                        renderer.render(scene, camera);
                    };
                    animate();

                    window.addEventListener('resize', () => {
                        camera.aspect = window.innerWidth / window.innerHeight;
                        camera.updateProjectionMatrix();
                        renderer.setSize(window.innerWidth, window.innerHeight);
                    });

                    gsap.from(burgerGroup.scale, {
                        x: 0, y: 0, z: 0,
                        duration: 1.5,
                        ease: "back.out(1.2)",
                        scrollTrigger: {
                            trigger: "#special",
                            start: "top 60%",
                            toggleActions: "play none none reverse"
                        }
                    });

                    const tl = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#special",
                            start: "top top",
                            end: "bottom bottom",
                            scrub: 1,
                        }
                    });

                    tl.to(burgerGroup.rotation, { y: Math.PI * 4, duration: 10 }, 0);

                    tl.to(burgerGroup.children[5].position, { y: 6, duration: 5 }, 1);
                    tl.to(burgerGroup.children[5].rotation, { x: 0.5, duration: 5 }, 1);

                    tl.to(burgerGroup.children[4].position, { y: 4, duration: 5 }, 1.5);

                    tl.to(burgerGroup.children[3].position, { y: 2, duration: 5 }, 1.8);

                    tl.to(burgerGroup.children[2].position, { y: 0, duration: 5 }, 2);

                    tl.to(burgerGroup.children[1].position, { y: -2, duration: 5 }, 2);

                    tl.to(burgerGroup.children[0].position, { y: -4, duration: 5 }, 2.2);

                    tl.to('.special-text', { opacity: 1, y: 0, stagger: 0.1, duration: 2 }, 0.5);
                    tl.to('.special-details', { opacity: 1, y: 0, stagger: 0.2, duration: 2 }, 3);

                },

                initScrollAnimations() {
                    ScrollTrigger.create({
                        trigger: '.stat-item',
                        start: 'top 80%',
                        onEnter: () => {
                            this.startCounters();
                        }
                    });

                    gsap.utils.toArray('.scroll-reveal').forEach(elem => {
                        gsap.from(elem, {
                            y: 50,
                            opacity: 0,
                            duration: 1,
                            ease: 'power3.out',
                            scrollTrigger: {
                                trigger: elem,
                                start: 'top 85%'
                            }
                        });
                    });
                },

                startCounters() {
                    const counters = document.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = +counter.getAttribute('data-target');
                        gsap.to(counter, {
                            innerText: target,
                            duration: 2,
                            snap: { innerText: 1 },
                            ease: 'power2.out',
                            onUpdate: function () {
                                counter.innerText = Math.ceil(this.targets()[0].innerText);
                            }
                        });
                    });
                },

                initMarquee() {
                    const marquee = document.getElementById('marquee-1');
                    if (marquee) {
                        const content = marquee.innerHTML;
                        marquee.innerHTML = content + content + content;
                    }
                },

                activeCategory: 'all',
                setCategory(category) {
                    this.activeCategory = category;
                    this.$nextTick(() => {
                        this.updateVisibility();
                        const visibleCards = Array.from(document.querySelectorAll('.meal-card')).filter(card => card.style.display !== 'none');
                        gsap.fromTo(visibleCards,
                            { opacity: 0, y: 20, scale: 0.95 },
                            { opacity: 1, y: 0, scale: 1, duration: 0.5, stagger: 0.1, ease: 'power2.out', clearProps: 'all' }
                        );
                    });
                },

                updateVisibility() {
                    const cards = document.querySelectorAll('.meal-card');
                    let count = 0;
                    cards.forEach(card => {
                        if (this.activeCategory === 'all' || card.dataset.category === this.activeCategory) {
                            card.style.display = 'block';
                            count++;
                        } else {
                            card.style.display = 'none';
                        }
                    });
                    this.filteredCount = count;
                }
            }));
        });
    </script>
</body>

</html>