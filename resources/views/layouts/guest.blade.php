<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                margin: 0;
                padding: 0;
                overflow: hidden;
            }
            
            /* Light Mode Background */
            .space-background {
                background: linear-gradient(to bottom, #f0f4f8 0%, #e2e8f0 50%, #cbd5e1 100%);
                position: fixed;
                width: 100%;
                height: 100%;
                transition: background 0.5s ease;
            }
            
            /* Dark Mode Background */
            .dark .space-background {
                background: linear-gradient(to bottom, #0a1628 0%, #1a2332 50%, #0f1419 100%);
            }
            
            .stars {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }
            
            .star {
                position: absolute;
                width: 2px;
                height: 2px;
                background: white;
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
            
            #particle-canvas {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
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
                background: rgba(15, 23, 42, 0.7);
                border: 1px solid rgba(148, 163, 184, 0.2);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            }
            
            .floating-logo {
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            /* Light Mode Glow */
            .glow-effect {
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.4),
                            0 0 60px rgba(168, 85, 247, 0.3);
            }
            
            /* Dark Mode Glow */
            .dark .glow-effect {
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.6),
                            0 0 60px rgba(168, 85, 247, 0.4);
            }
            
            .content-container {
                position: relative;
                z-index: 10;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 1.5rem;
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
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="space-background">
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

            <!-- Stars -->
            <div class="stars" id="stars-container"></div>
            
            <!-- Particle Network -->
            <canvas id="particle-canvas"></canvas>
            
            <!-- Content -->
            <div class="content-container">
                <!-- Logo Container -->
                <div class="floating-logo mb-8">
                    <a href="/" class="block">
                        <div class="glass-card glow-effect rounded-full p-6 hover:scale-110 transition-transform duration-300">
                            <x-application-logo class="w-20 h-20 fill-current text-blue-600 dark:text-white" />
                        </div>
                    </a>
                </div>

                <!-- Content Card -->
                <div class="w-full sm:max-w-md glass-card rounded-2xl p-8 hover:scale-105 transition-all duration-300">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Inventory System</h2>
                        <p class="text-gray-600 dark:text-gray-300">Manage your inventory with style and precision</p>
                    </div>
                    {{ $slot }}
                </div>
                
                <!-- Footer Text -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Powered by Sir. Pann</p>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Generate Stars
                const starsContainer = document.getElementById('stars-container');
                const starCount = 200;
                
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'star';
                    star.style.left = Math.random() * 100 + '%';
                    star.style.top = Math.random() * 100 + '%';
                    star.style.animationDelay = Math.random() * 3 + 's';
                    starsContainer.appendChild(star);
                }
                
                // Particle Network
                const canvas = document.getElementById('particle-canvas');
                const ctx = canvas.getContext('2d');
                let particles = [];
                const particleCount = 60;
                let mouseX = -1000;
                let mouseY = -1000;
                
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
                
                window.addEventListener('resize', () => {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                });
                
                function isDarkMode() {
                    return document.documentElement.classList.contains('dark');
                }
                
                class Particle {
                    constructor() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.vx = (Math.random() - 0.5) * 0.6;
                        this.vy = (Math.random() - 0.5) * 0.6;
                        this.radius = Math.random() * 2 + 1;
                    }
                    
                    getColor() {
                        const darkColors = [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(168, 85, 247, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                        ];
                        const lightColors = [
                            'rgba(30, 41, 59, 0.6)',
                            'rgba(71, 85, 105, 0.6)',
                            'rgba(100, 116, 139, 0.6)',
                        ];
                        const colors = isDarkMode() ? darkColors : lightColors;
                        return colors[Math.floor(Math.random() * colors.length)];
                    }
                    
                    update() {
                        this.x += this.vx;
                        this.y += this.vy;
                        
                        if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                        if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
                        
                        const dx = mouseX - this.x;
                        const dy = mouseY - this.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        
                        if (distance < 100) {
                            this.vx -= dx * 0.0002;
                            this.vy -= dy * 0.0002;
                        }
                    }
                    
                    draw() {
                        const color = this.getColor();
                        ctx.shadowBlur = 15;
                        ctx.shadowColor = color;
                        ctx.fillStyle = color;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                        ctx.fill();
                        ctx.shadowBlur = 0;
                    }
                }
                
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
                
                function drawConnections() {
                    for (let i = 0; i < particles.length; i++) {
                        for (let j = i + 1; j < particles.length; j++) {
                            const dx = particles[i].x - particles[j].x;
                            const dy = particles[i].y - particles[j].y;
                            const distance = Math.sqrt(dx * dx + dy * dy);
                            
                            if (distance < 150) {
                                const opacity = 0.3 * (1 - distance / 150);
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
                
                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                });
            });
        </script>
        
        @livewireScripts
    </body>
</html>