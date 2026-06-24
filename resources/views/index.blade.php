<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OdonCare | Tu Salud Bucal en Buenas Manos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dental: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .hero-bg {
            background-image: linear-gradient(rgba(12, 74, 110, 0.75), rgba(12, 74, 110, 0.75)), url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased bg-white">

    <!-- Navegación -->
    <nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer">
                    <div class="p-2 bg-dental-500 rounded-lg text-white shadow-lg shadow-dental-500/30">
                    
                        <img src="{{url('vendor/adminlte/dist/img/dentallogo.jpg')}}" alt="" width="50px" height="50px">
                    </div>
                    <span class="font-bold text-2xl text-dental-900 tracking-tight transition-all">Odon<span class="text-dental-500">Care</span></span>
                </div>
                
                
                <!-- Enlaces -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#inicio" class="text-gray-600 hover:text-dental-500 font-semibold transition-colors">Inicio</a>
                    <a href="#nosotros" class="text-gray-600 hover:text-dental-500 font-semibold transition-colors">Nosotros</a>
                    <a href="#servicios" class="text-gray-600 hover:text-dental-500 font-semibold transition-colors">Servicios</a>
                    <a href="#catalogo" class="text-gray-600 hover:text-dental-500 font-semibold transition-colors">Planes</a>
                </div>

                <!-- Botones -->
                <div class="hidden md:flex items-center space-x-4">
                    <!--<a href="{{url('/login')}}" class="text-dental-600 font-bold hover:text-dental-900 transition-colors">Acceso Pacientes</a>-->
                    <a href="{{url('/login')}}" class="bg-dental-500 hover:bg-dental-600 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
                        Acceso Pacientes
                    </a>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-600 p-2">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 p-4 space-y-4 shadow-xl">
            <a href="#inicio" class="block font-medium text-gray-700 py-2">Inicio</a>
            <a href="#nosotros" class="block font-medium text-gray-700 py-2">Nosotros</a>
            <a href="#servicios" class="block font-medium text-gray-700 py-2">Servicios</a>
            <a href="#catalogo" class="block font-medium text-gray-700 py-2">Planes</a>
            <hr>
            <!--<a href="{{url('/login')}}" class="block font-bold text-dental-600 py-2">Acceso Pacientes</a>-->
            <a href="{{url('/login')}}" class="block bg-dental-500 text-white text-center py-3 rounded-xl font-bold">Acceso Pacientes</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-bg relative pt-32 pb-20 lg:pt-56 lg:pb-40 flex items-center min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full text-center lg:text-left">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-dental-100 text-sm font-bold mb-8 mx-auto lg:mx-0">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    TECNOLOGÍA DENTAL AVANZADA
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-[1.1] mb-8">
                    Cuidamos tu sonrisa en <span class="text-dental-500">OdonCare</span>
                </h1>
                <p class="text-xl text-gray-200 mb-12 max-w-xl leading-relaxed mx-auto lg:mx-0">
                    Gestiona tus citas, visualiza tu historial clínico y realiza pagos desde nuestro portal exclusivo para pacientes.
                </p>
                <div class="flex flex-col sm:flex-row gap-5 justify-center lg:justify-start">
                    <a href="{{url('/register')}}" class="bg-white text-dental-900 px-10 py-5 rounded-2xl font-black text-lg transition-all shadow-2xl hover:bg-dental-50 flex items-center justify-center gap-3 group">
                        Registrarme ahora <i data-lucide="user-plus" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="#servicios" class="bg-dental-500/20 backdrop-blur-md border border-white/30 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white/10 transition-all flex items-center justify-center">
                        Nuestros Servicios
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Nosotros -->
    <section id="nosotros" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="relative order-2 lg:order-1">
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?q=80&w=800&auto=format&fit=crop" alt="" class="rounded-[2.5rem] shadow-2xl w-full h-[600px] object-cover">
                    <div class="absolute -bottom-10 -right-10 bg-dental-900 p-10 rounded-[2rem] shadow-2xl hidden md:block border-8 border-white">
                        <p class="text-5xl font-black text-dental-500">100%</p>
                        <p class="text-white font-bold opacity-80 uppercase tracking-widest text-sm mt-1">Garantizado</p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-dental-500 font-black uppercase tracking-[0.2em] text-sm mb-4 italic">Sobre OdonCare</h2>
                    <h3 class="text-4xl lg:text-5xl font-black text-gray-900 mb-8 leading-tight">Excelencia en salud bucal digitalizada.</h3>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        En **OdonCare**, combinamos la calidez humana con herramientas digitales modernas. Hemos diseñado un sistema integral para que tu experiencia, desde la primera cita hasta el seguimiento de tu historial, sea rápida y eficiente.
                    </p>
                    <div class="grid grid-cols-2 gap-8 mb-10">
                        <div class="space-y-2">
                            <div class="w-12 h-12 bg-dental-50 rounded-xl flex items-center justify-center text-dental-600">
                                <i data-lucide="calendar-check" class="w-6 h-6"></i>
                            </div>
                            <h4 class="font-bold text-gray-900">Citas Online</h4>
                            <p class="text-sm text-gray-500">Agenda en segundos desde tu móvil.</p>
                        </div>
                        <div class="space-y-2">
                            <div class="w-12 h-12 bg-dental-50 rounded-xl flex items-center justify-center text-dental-600">
                                <i data-lucide="clipboard-list" class="w-6 h-6"></i>
                            </div>
                            <h4 class="font-bold text-gray-900">Historial Digital</h4>
                            <p class="text-sm text-gray-500">Toda tu información siempre a mano.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Servicios Actualizada -->
    <section id="servicios" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-dental-500 font-black uppercase tracking-[0.2em] text-sm mb-4">Nuestras Especialidades</h2>
            <h3 class="text-4xl font-black text-gray-900 mb-16">Tratamientos Odontológicos Modernos</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Servicio 1 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-2xl transition-all border border-gray-100 text-left group">
                    <div class="w-16 h-16 bg-dental-50 rounded-2xl flex items-center justify-center text-dental-600 mb-8 group-hover:bg-dental-500 group-hover:text-white transition-colors">
                        <i data-lucide="sparkles" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 mb-4">Diseño de Sonrisa</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Utilizamos tecnología 3D para planificar y crear la sonrisa que siempre soñaste.</p>
                    <a href="#" class="text-dental-500 font-bold flex items-center gap-2 hover:gap-4 transition-all uppercase text-sm tracking-wider">
                        Saber más <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Servicio 2 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-2xl transition-all border border-gray-100 text-left group">
                    <div class="w-16 h-16 bg-dental-50 rounded-2xl flex items-center justify-center text-dental-600 mb-8 group-hover:bg-dental-500 group-hover:text-white transition-colors">
                        <i data-lucide="smile" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 mb-4">Ortodoncia</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Alineación perfecta con brackets o tecnología invisible para tu comodidad diaria.</p>
                    <a href="#" class="text-dental-500 font-bold flex items-center gap-2 hover:gap-4 transition-all uppercase text-sm tracking-wider">
                        Saber más <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Servicio 3 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-2xl transition-all border border-gray-100 text-left group">
                    <div class="w-16 h-16 bg-dental-50 rounded-2xl flex items-center justify-center text-dental-600 mb-8 group-hover:bg-dental-500 group-hover:text-white transition-colors">
                        <i data-lucide="shield-check" class="w-8 h-8"></i>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 mb-4">Cirugía Bucal</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Procedimientos indoloros realizados por especialistas certificados en OdonCare.</p>
                    <a href="#" class="text-dental-500 font-bold flex items-center gap-2 hover:gap-4 transition-all uppercase text-sm tracking-wider">
                        Saber más <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Catálogo Informativo -->
    <section id="catalogo" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-dental-500 font-black uppercase tracking-[0.2em] text-sm mb-4 italic">Nuestros Planes</h2>
                <h3 class="text-4xl font-black text-gray-900 mb-6 italic">Exclusivo para Pacientes OdonCare</h3>
                <p class="text-gray-600 text-lg">Al registrarte en nuestro sistema, podrás acceder a estos planes preferenciales y pagarlos cómodamente de forma online.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Plan 1 -->
                <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm hover:shadow-xl transition-all relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 text-dental-100 opacity-20">
                        <i data-lucide="star" class="w-20 h-20"></i>
                    </div>
                    <h4 class="text-2xl font-black text-gray-900 mb-2">Plan Kids</h4>
                    <p class="text-dental-500 font-black text-3xl mb-6">$35<span class="text-sm font-bold text-gray-400">/visita</span></p>
                    <ul class="space-y-4 mb-10 text-gray-600 font-medium">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Limpieza profiláctica</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Aplicación de flúor</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Diagnóstico digital</li>
                    </ul>
                    <a href="{{url('/register')}}" class="block w-full text-center py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-dental-600 transition-colors shadow-lg shadow-gray-200">
                        Registrarse para activar
                    </a>
                </div>

                <!-- Plan 2 (Destacado) -->
                <div class="bg-dental-900 rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden transform scale-105 border-4 border-dental-500">
                    <div class="absolute top-0 right-0 bg-dental-500 text-white px-6 py-2 rounded-bl-3xl font-black text-xs uppercase tracking-widest">Recomendado</div>
                    <h4 class="text-2xl font-black text-white mb-2">Plan Sonrisa Total</h4>
                    <p class="text-dental-500 font-black text-4xl mb-6">$150<span class="text-sm font-bold text-gray-400">/año</span></p>
                    <ul class="space-y-4 mb-10 text-gray-300 font-medium">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-dental-500 w-5 h-5"></i> 2 limpiezas completas</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-dental-500 w-5 h-5"></i> Radiografías ilimitadas</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-dental-500 w-5 h-5"></i> 20% Dto. en Ortodoncia</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-dental-500 w-5 h-5"></i> Atención prioritaria</li>
                    </ul>
                    <a href="{{url('/register')}}" class="block w-full text-center py-4 bg-dental-500 text-white rounded-2xl font-black hover:bg-white hover:text-dental-900 transition-all shadow-xl shadow-dental-500/20">
                        Activar en mi Portal
                    </a>
                </div>

                <!-- Plan 3 -->
                <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm hover:shadow-xl transition-all relative overflow-hidden">
                    <h4 class="text-2xl font-black text-gray-900 mb-2">Plan Blanqueamiento</h4>
                    <p class="text-dental-500 font-black text-3xl mb-6">$85<span class="text-sm font-bold text-gray-400">/sesión</span></p>
                    <ul class="space-y-4 mb-10 text-gray-600 font-medium">
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Sesión LED profesional</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Limpieza previa gratis</li>
                        <li class="flex items-center gap-3"><i data-lucide="check" class="text-green-500 w-5 h-5"></i> Kit de mantenimiento</li>
                    </ul>
                    <a href="{{url('/register')}}" class="block w-full text-center py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-dental-600 transition-colors shadow-lg shadow-gray-200">
                        Registrarse para activar
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dental-900 text-white pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20 mb-20">
                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-8">
                        <div class="p-2 bg-dental-500 rounded-lg text-white">
                            <img src="{{url('vendor/adminlte/dist/img/dentallogo.jpg')}}" alt="" width="50px" height="50px">
                        </div>
                        <span class="font-bold text-2xl tracking-tight">Odon<span class="text-dental-500">Care</span></span>
                    </div>
                    <p class="text-gray-400 text-lg leading-relaxed">Innovación y confianza en cada consulta. Únete a la nueva era de la odontología digital.</p>
                </div>
                
                <div>
                    <h4 class="text-xl font-black mb-8 italic">Contáctanos</h4>
                    <ul class="space-y-6 text-gray-400">
                        <li class="flex items-start gap-4">
                            <i data-lucide="map-pin" class="text-dental-500 w-6 h-6 flex-shrink-0"></i>
                            <span>Av. Salud 123, Centro Médico OdonCare, Anzoátegui.</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <i data-lucide="phone" class="text-dental-500 w-6 h-6 flex-shrink-0"></i>
                            <span>+58 212 555 0199</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-black mb-8 italic">Horarios de Atención</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-gray-400 border-b border-gray-800 pb-2">
                            <span>Lunes a Viernes</span>
                            <span class="text-white font-bold tracking-wider">08:00 - 20:00</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400 border-b border-gray-800 pb-2">
                            <span>Sábados</span>
                            <span class="text-white font-bold tracking-wider">08:00 - 14:00</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-gray-500 text-sm font-medium">© 2026 OdonCare Consultorio. Todos los derechos reservados.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-400 hover:text-dental-500 transition-all transform hover:-translate-y-1"><i data-lucide="instagram" class="w-6 h-6"></i></a>
                    <a href="#" class="text-gray-400 hover:text-dental-500 transition-all transform hover:-translate-y-1"><i data-lucide="facebook" class="w-6 h-6"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        
        // Menu toggle logic
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.onclick = () => menu.classList.toggle('hidden');
        
        // Navbar glass effect on scroll
        window.onscroll = () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-white/95', 'shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        };
    </script>
</body>
</html>