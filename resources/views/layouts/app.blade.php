<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jobberman - Find Your Dream Job')</title>
    <meta name="description" content="@yield('description', 'Explore and discover the right job for you with Jobberman. The best job listing platform for seekers and employers.')">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#818cf8',
                            DEFAULT: '#6366f1',
                            dark: '#4f46e5',
                        },
                        secondary: {
                            light: '#60a5fa',
                            DEFAULT: '#3b82f6',
                            dark: '#2563eb',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'slide-up': 'slideUp 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-[#f8fafc] text-slate-900 font-sans selection:bg-primary/20">

    <!-- Navbar -->
    <header id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        Jobberman
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('jobs.index') }}" class="text-sm font-medium hover:text-primary transition-colors">Find Jobs</a>

                    @auth
                        @if(auth()->user()->isEmployer())
                            <a href="{{ route('employer.dashboard') }}" class="text-sm font-medium hover:text-primary transition-colors">Employer Dashboard</a>
                        @elseif(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium hover:text-primary transition-colors">Admin Panel</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-primary transition-colors">My Dashboard</a>
                            <a href="{{ route('applications.index') }}" class="text-sm font-medium hover:text-primary transition-colors">My Applications</a>
                        @endif
                    @endauth
                </div>

                <!-- Right Side Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-primary px-4 py-2">Log In</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 px-5 py-2.5 rounded-full transition-all">Sign Up</a>
                    @else
                        @if(auth()->user()->isEmployer())
                            <a href="{{ route('employer.jobs.create') }}" class="text-sm font-semibold text-white bg-primary hover:bg-primary-dark px-6 py-2.5 rounded-full shadow-lg shadow-primary/20 transition-all">Post A Job</a>
                        @endif
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-sm font-medium hover:text-primary transition-colors">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-primary font-bold text-xs">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </button>
                            <div class="absolute top-full right-0 w-48 mt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2">
                                <div class="bg-white rounded-xl shadow-xl border border-slate-100 py-2 overflow-hidden">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-primary">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-red-500">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-slate-100 transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 right-0 bg-white border-b border-slate-100 shadow-xl p-4 space-y-4 animate-fade-in">
            <div class="space-y-4">
                <a href="{{ route('jobs.index') }}" class="block text-base font-medium text-slate-700">Find Jobs</a>
                @auth
                    @if(auth()->user()->isEmployer())
                        <a href="{{ route('employer.dashboard') }}" class="block text-base font-medium text-slate-700">Employer Dashboard</a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block text-base font-medium text-slate-700">Admin Panel</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block text-base font-medium text-slate-700">My Dashboard</a>
                        <a href="{{ route('applications.index') }}" class="block text-base font-medium text-slate-700">My Applications</a>
                    @endif
                @endauth
            </div>
            <div class="pt-4 border-t border-slate-100 flex flex-col space-y-3">
                @guest
                    <a href="{{ route('login') }}" class="text-center py-3 text-slate-700 font-medium">Log In</a>
                    <a href="{{ route('register') }}" class="text-center py-3 bg-slate-100 rounded-xl text-slate-700 font-medium">Sign Up</a>
                @else
                    @if(auth()->user()->isEmployer())
                        <a href="{{ route('employer.jobs.create') }}" class="text-center py-3 bg-primary text-white rounded-xl font-semibold">Post A Job</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center py-3 bg-red-50 text-red-600 rounded-xl font-medium">Log Out</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-success" class="fixed top-24 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-xl animate-slide-up">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="flash-error" class="fixed top-24 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-xl animate-slide-up">
            {{ session('error') }}
        </div>
    @endif
    @if(session('info'))
        <div id="flash-info" class="fixed top-24 right-4 z-50 bg-blue-500 text-white px-6 py-3 rounded-xl shadow-xl animate-slide-up">
            {{ session('info') }}
        </div>
    @endif

    <main class="mt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-primary via-indigo-600 to-secondary pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white mb-6 block">Jobberman</a>
                    <p class="text-white/70 leading-relaxed mb-6">Nigeria's No.1 recruitment and job search platform. Helping you find the right talent or land your dream job.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-white hover:text-primary transition-all"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-white hover:text-primary transition-all"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white/70 hover:bg-white hover:text-primary transition-all"><i data-lucide="linkedin" class="w-5 h-5"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Job Seekers</h4>
                    <ul class="space-y-4 text-white/70">
                        <li><a href="{{ route('jobs.index') }}" class="hover:text-white transition-colors">Browse Jobs</a></li>
                        <li><a href="{{ route('jobs.index', ['type' => 'remote']) }}" class="hover:text-white transition-colors">Remote Jobs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Career Advice</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Resume Services</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Employers</h4>
                    <ul class="space-y-4 text-white/70">
                        <li><a href="#" class="hover:text-white transition-colors">Post a Job</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Recruitment Solutions</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Candidate Search</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pricing Plans</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-6">Support</h4>
                    <ul class="space-y-4 text-white/70">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/50">
                <p>&copy; {{ date('Y') }} Jobberman. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Site Map</a>
                    <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const menuIcon = mobileMenuBtn.querySelector('i');
                const isHidden = mobileMenu.classList.contains('hidden');
                menuIcon.setAttribute('data-lucide', isHidden ? 'menu' : 'x');
                lucide.createIcons();
            });
        }
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.add(window.scrollY > 20 ? 'scrolled' : '');
            if (window.scrollY <= 20) navbar.classList.remove('scrolled');
        });
        setTimeout(() => {
            document.querySelectorAll('[id^="flash-"]').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
