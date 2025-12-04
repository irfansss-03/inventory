<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Inventory Management System</title>

        <!-- Script to prevent dark mode flash -->
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }
            
            /* Light Mode Background */
            .space-background {
                background: linear-gradient(to bottom, #f0f4f8 0%, #e2e8f0 50%, #cbd5e1 100%);
                position: relative;
                min-height: 100vh;
                transition: background 0.5s ease;
            }
            
            /* Dark Mode Background */
            .dark .space-background {
                background: linear-gradient(to bottom, #050a14 0%, #0d1520 50%, #060913 100%);
            }
            
            /* Stars Background */
            .stars {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 1;
            }
            
            .star {
                position: absolute;
                width: 2px;
                height: 2px;
                border-radius: 50%;
                animation: twinkle 3s infinite;
            }
            
            /* Light mode stars - darker */
            .star {
                background: #1e293b;
                opacity: 0.4;
            }
            
            .dark .star {
                background: white;
                opacity: 1;
            }
            
            @keyframes twinkle {
                0%, 100% { opacity: 0.3; }
                50% { opacity: 1; }
            }
            
            /* Particle Canvas */
            #particle-canvas {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 2;
            }
            
            /* Light Mode Glass Card */
            .glass-card {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(148, 163, 184, 0.3);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }
            
            /* Dark Mode Glass Card */
            .dark .glass-card {
                background: rgba(15, 23, 42, 0.8);
                border: 1px solid rgba(148, 163, 184, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            }
            
            /* Content Layer */
            .content-layer {
                position: relative;
                z-index: 10;
            }
            
            /* Hero Section Animation */
            .hero-content {
                animation: fadeInUp 1s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Hover Effects */
            .hover-lift {
                transition: all 0.3s ease;
            }
            
            .hover-lift:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            }

            .dark .hover-lift:hover {
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            }

            /* Feature Card Hover */
            .feature-card {
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-10px) scale(1.02);
            }

            /* Light Mode Glow Effects */
            .glow {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            }
            
            .glow-green {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
            }
            
            .glow-purple {
                box-shadow: 0 0 20px rgba(168, 85, 247, 0.3);
            }

            .glow-orange {
                box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);
            }
            
            /* Dark Mode Glow Effects */
            .dark .glow {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }
            
            .dark .glow-green {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.5);
            }
            
            .dark .glow-purple {
                box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);
            }

            .dark .glow-orange {
                box-shadow: 0 0 20px rgba(249, 115, 22, 0.5);
            }

            /* Button Styles */
            .btn-primary {
                background: linear-gradient(135deg, #3b82f6, #2563eb);
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #2563eb, #1e40af);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
            }

            .btn-secondary {
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                transition: all 0.3s ease;
            }

            .dark .btn-secondary {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.3);
                border-color: rgba(59, 130, 246, 0.5);
                transform: translateY(-2px);
            }

            .dark .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.15);
            }

            /* Shine Effect */
            .shine {
                position: relative;
                overflow: hidden;
            }

            .shine::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                animation: shine 3s infinite;
            }

            @keyframes shine {
                0% { left: -100%; }
                100% { left: 200%; }
            }

            /* Theme Toggle Button */
            .theme-toggle {
                position: fixed;
                top: 1.5rem;
                right: 1.5rem;
                z-index: 50;
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(148, 163, 184, 0.3);
                padding: 0.75rem;
                border-radius: 0.75rem;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .dark .theme-toggle {
                background: rgba(15, 23, 42, 0.7);
                border: 1px solid rgba(148, 163, 184, 0.2);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            .theme-toggle:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
            }

            .theme-toggle svg {
                width: 1.5rem;
                height: 1.5rem;
                color: #1e293b;
            }

            .dark .theme-toggle svg {
                color: #f1f5f9;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="space-background">
            <!-- Stars -->
            <div class="stars" id="stars-container"></div>
            
            <!-- Particle Network Canvas -->
            <canvas id="particle-canvas"></canvas>

            <!-- Content Layer -->
            <div class="content-layer">
                <!-- Theme Toggle Button -->
                <div
                    x-data="{
                        theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
                        toggle() {
                            this.theme = this.theme === 'light' ? 'dark' : 'light';
                            localStorage.setItem('theme', this.theme);
                            document.documentElement.classList.toggle('dark', this.theme === 'dark');
                        }
                    }"
                    x-init="document.documentElement.classList.toggle('dark', theme === 'dark')"
                >
                    <button @click="toggle()" class="theme-toggle group">
                        <svg x-show="theme !== 'dark'" class="transition-transform duration-500 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="theme === 'dark'" class="transition-transform duration-500 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <header class="py-6 px-4 sm:px-6 lg:px-8">
                    @if (Route::has('login'))
                        <nav class="max-w-7xl mx-auto flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 flex items-center justify-center">
                                    <x-application-logo class="h-10 w-auto text-blue-600 dark:text-white fill-current" />
                                </div>
                                <span class="text-xl font-bold hidden sm:block text-gray-900 dark:text-white">
                                    Inventory System
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn-primary px-6 py-2.5 rounded-xl font-medium text-white">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-secondary px-6 py-2.5 rounded-xl font-medium text-gray-900 dark:text-white">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-primary px-6 py-2.5 rounded-xl font-medium text-white hidden sm:block">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </nav>
                    @endif
                </header>

                <!-- Hero Section -->
                <main class="flex items-center justify-center min-h-[calc(100vh-180px)] px-4 sm:px-6 lg:px-8">
                    <div class="max-w-6xl mx-auto text-center hero-content">
                        <!-- Main Title -->
                        <div class="mb-8">
                            <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold mb-6 text-gray-900 dark:text-white">
                                Inventory Management
                                <span class="block mt-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 dark:from-blue-400 dark:via-purple-400 dark:to-blue-400">
                                    Made Simple
                                </span>
                            </h1>
                            <p class="text-xl sm:text-2xl text-gray-700 dark:text-blue-100 max-w-3xl mx-auto">
                                Manage your inventory with style and precision. Track items, monitor stock levels, and streamline your workflow.
                            </p>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap items-center justify-center gap-4 mb-16">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary px-8 py-4 rounded-2xl font-semibold text-lg text-white shine hover-lift">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-primary px-8 py-4 rounded-2xl font-semibold text-lg text-white shine hover-lift">
                                    Get Started Free
                                </a>
                                <a href="{{ route('login') }}" class="btn-secondary px-8 py-4 rounded-2xl font-semibold text-lg text-gray-900 dark:text-white hover-lift">
                                    Sign In
                                </a>
                            @endauth
                        </div>

                        <!-- Features Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                            <!-- Feature 1 -->
                            <div class="glass-card p-6 rounded-2xl feature-card glow">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-4 mx-auto">
                                    <i class="fas fa-box text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Real-time Tracking</h3>
                                <p class="text-gray-700 dark:text-blue-100 text-sm">Monitor inventory levels in real-time with instant updates</p>
                            </div>

                            <!-- Feature 2 -->
                            <div class="glass-card p-6 rounded-2xl feature-card glow-green">
                                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mb-4 mx-auto">
                                    <i class="fas fa-chart-bar text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Smart Analytics</h3>
                                <p class="text-gray-700 dark:text-blue-100 text-sm">Get insights with powerful analytics and reporting</p>
                            </div>

                            <!-- Feature 3 -->
                            <div class="glass-card p-6 rounded-2xl feature-card glow-purple">
                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mb-4 mx-auto">
                                    <i class="fas fa-cog text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Easy Management</h3>
                                <p class="text-gray-700 dark:text-blue-100 text-sm">Simple and intuitive interface for quick operations</p>
                            </div>

                            <!-- Feature 4 -->
                            <div class="glass-card p-6 rounded-2xl feature-card glow-orange">
                                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mb-4 mx-auto">
                                    <i class="fas fa-bell text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Smart Alerts</h3>
                                <p class="text-gray-700 dark:text-blue-100 text-sm">Get notified about low stock and important updates</p>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Footer -->
                <footer class="py-8 text-center text-gray-600 dark:text-blue-100">
                    <p>&copy; {{ date('Y') }} Inventory Management System. Built by Sir. Pann using Laravel.</p>
                </footer>
            </div>
        </div>
        
        <script>
            // Generate Stars
            document.addEventListener('DOMContentLoaded', function() {
                const starsContainer = document.getElementById('stars-container');
                const starCount = 200;
                
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.style.left = Math.random() * 100 + '%';
                    star.style.top = Math.random() * 100 + '%';
                    star.style.animationDelay = Math.random() * 3 + 's';
                    star.style.opacity = Math.random() * 0.7 + 0.3;
                    starsContainer.appendChild(star);
                }
                
                // Particle Network
                const canvas = document.getElementById('particle-canvas');
                if (!canvas) return;
                
                const ctx = canvas.getContext('2d');
                let particles = [];
                const particleCount = 80;
                let mouseX = -1000;
                let mouseY = -1000;
                
                function setCanvasSize() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                }
                setCanvasSize();
                window.addEventListener('resize', setCanvasSize);
                
                function isDarkMode() {
                    return document.documentElement.classList.contains('dark');
                }
                
                class Particle {
                    constructor() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.vx = (Math.random() - 0.5) * 0.8;
                        this.vy = (Math.random() - 0.5) * 0.8;
                        this.radius = Math.random() * 2.5 + 1.5;
                    }
                    
                    getColor() {
                        const darkColors = [
                            'rgba(59, 130, 246, 0.8)',    // blue
                            'rgba(34, 197, 94, 0.8)',     // green
                            'rgba(168, 85, 247, 0.8)',    // purple
                            'rgba(236, 72, 153, 0.8)',    // pink
                            'rgba(251, 146, 60, 0.8)',    // orange
                        ];
                        const lightColors = [
                            'rgba(30, 41, 59, 0.6)',      // dark blue
                            'rgba(71, 85, 105, 0.6)',     // slate
                            'rgba(100, 116, 139, 0.6)',   // gray
                            'rgba(51, 65, 85, 0.6)',      // darker slate
                            'rgba(15, 23, 42, 0.6)',      // very dark
                        ];
                        const colors = isDarkMode() ? darkColors : lightColors;
                        return colors[Math.floor(Math.random() * colors.length)];
                    }
                    
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        
                        if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                        if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
                        
                        // Mouse interaction
                        const dx = mouseX - this.x;
                        const dy = mouseY - this.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        
                        if (distance < 120) {
                            const force = (120 - distance) / 120;
                            this.vx -= (dx / distance) * force * 0.2;
                            this.vy -= (dy / distance) * force * 0.2;
                        }
                        
                        // Speed limit
                        const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                        if (speed > 2) {
                            this.vx = (this.vx / speed) * 2;
                            this.vy = (this.vy / speed) * 2;
                        }
                    }
                    
                    draw() {
                        const color = this.getColor();
                        // Glow effect
                        ctx.shadowBlur = 10;
                        ctx.shadowColor = color;
                        
                        ctx.fillStyle = color;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                        ctx.fill();
                        
                        ctx.shadowBlur = 0;
                    }
                }
                
                // Initialize particles
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
                
                function drawConnections() {
                    for (let i = 0; i < particles.length; i++) {
                        for (let j = i + 1; j < particles.length; j++) {
                            const dx = particles[i].x - particles[j].x;
                            const dy = particles[i].y - particles[j].y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            
                            if (distance < 180) {
                                const opacity = (1 - distance / 180) * 0.5;
                                const color = isDarkMode() 
                                    ? `rgba(148, 163, 184, ${opacity})` 
                                    : `rgba(71, 85, 105, ${opacity})`;
                                ctx.strokeStyle = color;
                                ctx.lineWidth = 1;
                                ctx.beginPath();
                                ctx.moveTo(particles[i].x, particles[i].y);
                                ctx.lineTo(particles[j].x, particles[j].y);
                                ctx.stroke();
                            }
                        }
                    }
                }
                
                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    drawConnections();
                    
                    particles.forEach(particle => {
                        particle.update();
                        particle.draw();
                    });
                    
                    requestAnimationFrame(animate);
                }
                
                animate();
                
                // Mouse tracking
                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });
                
                document.addEventListener('mouseleave', () => {
                    mouseX = -1000;
                    mouseY = -1000;
                });
            });
        </script>
    </body>
</html>
