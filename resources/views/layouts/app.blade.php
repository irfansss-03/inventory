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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        
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
            
            /* Smooth Animations */
            .fade-in {
                animation: fadeIn 0.6s ease-out;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
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
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            }
            
            /* Light Mode Glow Effects */
            .glow {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            }
            
            .glow-green {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
            }
            
            .glow-red {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
            }
            
            .glow-purple {
                box-shadow: 0 0 20px rgba(168, 85, 247, 0.3);
            }
            
            /* Dark Mode Glow Effects */
            .dark .glow {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }
            
            .dark .glow-green {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.5);
            }
            
            .dark .glow-red {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
            }
            
            .dark .glow-purple {
                box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <livewire:notification />
        
        <div class="space-background">
            <!-- Stars -->
            <div class="stars" id="stars-container"></div>
            
            <!-- Particle Network Canvas -->
            <canvas id="particle-canvas"></canvas>
            
            <!-- Content Layer -->
            <div class="content-layer">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="glass-card fade-in">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
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
        
        @livewireScripts
        @stack('scripts')
    </body>
</html>