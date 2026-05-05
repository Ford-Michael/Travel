-- about service boook car 
"<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Car Rental | Viet Sun Travel</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-bright": "#f8f9fa",
                    "on-primary": "#ffffff",
                    "on-primary-fixed-variant": "#93000d",
                    "on-error": "#ffffff",
                    "on-background": "#191c1d",
                    "surface-container-low": "#f3f4f5",
                    "inverse-surface": "#2e3132",
                    "outline": "#767683",
                    "on-tertiary-fixed-variant": "#604100",
                    "tertiary-fixed": "#ffdeac",
                    "on-secondary-fixed-variant": "#00429c",
                    "error-container": "#ffdad6",
                    "secondary-container": "#759efd",
                    "on-primary-fixed": "#410002",
                    "surface-container-highest": "#e1e3e4",
                    "primary-container": "#680006",
                    "on-tertiary-fixed": "#281900",
                    "on-secondary-container": "#00337c",
                    "tertiary-container": "#422c00",
                    "secondary": "#2b5bb5",
                    "surface-container-high": "#e7e8e9",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary-fixed-dim": "#ffb4ac",
                    "on-surface-variant": "#454652",
                    "on-tertiary-container": "#c98c00",
                    "tertiary": "#271800",
                    "inverse-on-surface": "#f0f1f2",
                    "surface-container": "#edeeef",
                    "surface-tint": "#bb171c",
                    "primary": "#400002",
                    "secondary-fixed-dim": "#b0c6ff",
                    "background": "#f8f9fa",
                    "inverse-primary": "#ffb4ac",
                    "outline-variant": "#c6c5d4",
                    "surface": "#f8f9fa",
                    "on-error-container": "#93000a",
                    "error": "#ba1a1a",
                    "on-secondary-fixed": "#001945",
                    "surface-container-lowest": "#ffffff",
                    "secondary-fixed": "#d9e2ff",
                    "on-surface": "#191c1d",
                    "surface-dim": "#d9dadb",
                    "on-tertiary": "#ffffff",
                    "primary-fixed": "#ffdad6",
                    "surface-variant": "#e1e3e4",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Be Vietnam Pro"],
                    "label": ["Be Vietnam Pro"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopNavBar -->
<nav class="bg-white dark:bg-slate-900 sticky top-0 z-50">
<div class="max-w-7xl mx-auto px-8 flex justify-between items-center h-20">
<div class="text-2xl font-bold text-[#001945] dark:text-white font-headline tracking-tight">
                Viet Sun Travel
            </div>
<div class="hidden md:flex items-center space-x-8 font-headline tracking-tight">
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Flights</a>
<a class="text-[#2b5bb5] dark:text-[#4dabf7] border-b-2 border-[#2b5bb5] pb-1" href="#">Car Rental</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Cultural Tours</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Fashion</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Deals</a>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-medium hover:opacity-90 transition-all scale-95 active:duration-150">
                Sign In
            </button>
</div>
</nav>
<main>
<!-- Hero & Search Section -->
<section class="relative h-[600px] flex items-center">
<div class="absolute inset-0 z-0 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Luxurious black sedan driving through a scenic coastal highway in Vietnam at golden hour with soft sunlight reflections" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDX3X4s-zPbOyMfV4MntT5JQNeLykljpTQU5K4X85Y-vKInMdkip-IX37dR2DKUJIMmS5dUXJlEXQgGBq5eRuU1fUiL4TDn8lhOgqWOx-A_52zTmE3gSmiWl7W51XeCxgAptX4SbL9DFLTcTcYy3jLmVVQ17HG-ByBM3YMSSEVNJjGQjFG2cfU7yb6qfJvThzThzKHLKV5tgKq_WTpxFy1gUxW2IndflhVBWDRZdhkbcOZM0GfdgFlPiGSBBC4r3VgKefTSBTYbTcFJ"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 w-full grid grid-cols-12 gap-8">
<div class="col-span-12 lg:col-span-6 text-white">
<h1 class="text-5xl md:text-6xl font-headline font-extrabold tracking-tighter leading-tight mb-6">
                        Journey with <br/><span class="text-on-primary-container">Elegance</span>
</h1>
<p class="text-lg text-surface-variant max-w-md mb-8 leading-relaxed">
                        Experience the freedom of Indochina's roads with our curated fleet of luxury vehicles and professional chauffeur services.
                    </p>
</div>
<!-- Search Box -->
<div class="col-span-12 lg:col-span-10 lg:col-start-1 mt-4">
<div class="bg-surface-container-lowest p-8 rounded-xl shadow-lg grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Location</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">location_on</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" placeholder="Hanoi, Vietnam" type="text"/>
</div>
</div>
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Date</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">calendar_today</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" type="date"/>
</div>
</div>
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Time</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">schedule</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" type="time"/>
</div>
</div>
<button class="bg-on-primary-container text-on-primary h-[52px] rounded-md font-bold text-lg hover:brightness-110 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">search</span>
                            Find Cars
                        </button>
</div>
</div>
</div>
</section>
<!-- Features Section (Horizontal Scroll/Asymmetric) -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
<div class="max-w-xl">
<h2 class="text-headline-md font-headline font-extrabold text-on-secondary-fixed mb-4">Uncompromising Standards</h2>
<p class="text-on-surface-variant">We redefine mobility by blending local hospitality with global standards of luxury and safety.</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Feature 1 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">Professional Drivers</h3>
<p class="text-on-surface-variant leading-relaxed">Our multilingual chauffeurs are experts in local routes and VIP etiquette, ensuring a seamless journey.</p>
</div>
<!-- Feature 2 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">support_agent</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">24/7 Concierge Support</h3>
<p class="text-on-surface-variant leading-relaxed">Round-the-clock assistance for route changes, dining reservations, or emergency support during your trip.</p>
</div>
<!-- Feature 3 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified_user</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">Premium Fleet Care</h3>
<p class="text-on-surface-variant leading-relaxed">Every vehicle undergoes a 50-point inspection and deep sanitation before every single booking.</p>
</div>
</div>
</div>
</section>
<!-- Car Types Grid -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<div class="flex items-center gap-4 mb-12">
<div class="h-px w-12 bg-secondary"></div>
<span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs">Curated Fleet</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-8">
<!-- Sedan - Large Card -->
<div class="md:col-span-8 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="High-end white luxury sedan parked in front of a modern architectural villa with soft morning shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2VrkSdbBRwckJHOTqAsdsrSP8oXz9AMPndAh6LvhzrXKuVdNMDmZgGQOtKZk8aAvND7DSZsd8oAI9LoUS4K3hMHraCYSNMK_AkV9ZIhOOkM7JQLhIVJUUHri2VEOVwhpWoAb7aWs4gOA39el0Zokq8OJIP9bUhytFoWd0UqxKTRzvCSEFX0MXVKqZ0QT7cA39pSbXfOfN1mwlxuIiSB1zO2VEqSfX1VF_gIjk2OoBVRo562A-ip-My_l_HwRoq24OZBAVLe85caFy"/>
<div class="absolute top-6 left-6 glass-badge px-4 py-1 rounded-full text-white text-xs font-bold uppercase tracking-wider">Most Popular</div>
</div>
<div class="p-8 flex justify-between items-center">
<div>
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Executive Sedan</h4>
<p class="text-on-surface-variant">Ideal for city transfers and business travel.</p>
</div>
<div class="text-right">
<span class="block text-xs font-bold text-outline uppercase tracking-widest mb-1">Starting from</span>
<span class="text-2xl font-headline font-bold text-primary">$85<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
</div>
</div>
</div>
<!-- SUV -->
<div class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Robust dark grey SUV on a winding mountain road through misty pine forests in Da Lat" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2Rc5jzbZiLYg8KtepYHLyY6Rb4GILVKqhYx_fH4Sy4X84XcEIgAMhZgu8n5FwYPZzri3XIAGwKk6-KRasOK-RHPZ7HRW1TEZnzsKKmvK_Yrn8WcYpjVUsDKBxp2pYeEA3BaY_g1glTA2UNpS3o6iclqg_VXqhPVPuuoFJCEQPXPDYod_DbbMNEVHNJgs_A-nQrHBx0mDuDQ03R3S2Ktei2k1F1IUDkFjCNiSA-J1bQ-iTWGXLiWHvP8UmwO9UMQ6YOvmr6DFEvsjA"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Premium SUV</h4>
<p class="text-on-surface-variant mb-6">Spacious comfort for family adventures.</p>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-6">
<span class="text-xl font-headline font-bold text-primary">$120<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
<a class="text-secondary font-bold text-sm uppercase tracking-wider flex items-center gap-1 group" href="#">Explore <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></a>
</div>
</div>
</div>
<!-- Luxury -->
<div class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Elite luxury limousine with chrome details parked at a red carpet event at night under bright spotlights" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGKgzPXZOtbCj9p39zDRoqRQZF0xNOeyKwnwYXATTIcZU7RME367mw5oAVz-y6HR-k_Fsr6lsWG5a9Fi7HylsbrLK6Di_jTqmdBLCL4Z_hzPFX4OYj5MOenCOjjpNatplAJ7TypyS7s9quQFHVzyjGyRQyiM5oWJO6nhCc-7Rp4hZRo7EvTLSWJ11q8MgwJ60DQFATLvs1z5I3MxL3U7kGv8rhV032b_pXaAJZiJm236cJqzAeYzfBodFoH0mWjXOSppvNhnNAegPc"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Ultra Luxury</h4>
<p class="text-on-surface-variant mb-6">Unrivaled prestige for special occasions.</p>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-6">
<span class="text-xl font-headline font-bold text-primary">$250<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
<a class="text-secondary font-bold text-sm uppercase tracking-wider flex items-center gap-1 group" href="#">Explore <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></a>
</div>
</div>
</div>
<!-- Minivan/Van (Asymmetric offset) -->
<div class="md:col-span-8 bg-[linear-gradient(135deg,#2b5bb5,#00337c)] rounded-xl p-12 flex flex-col justify-between text-white relative overflow-hidden">
<div class="relative z-10">
<h4 class="text-4xl font-headline font-extrabold mb-4">Group Heritage Tours</h4>
<p class="max-w-md text-secondary-fixed opacity-90 text-lg leading-relaxed mb-8">
                                Planning a cultural expedition for a larger group? Our fleet of high-end 16-seater vans offers panoramic views and climate-controlled comfort.
                            </p>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-105 transition-transform">
                                Corporate Inquiries
                            </button>
</div>
<div class="absolute right-0 bottom-0 opacity-20 transform translate-x-1/4 translate-y-1/4">
<span class="material-symbols-outlined text-[300px]">airport_shuttle</span>
</div>
</div>
</div>
</div>
</section>
<!-- Newsletter / CTA -->
<section class="py-24 max-w-7xl mx-auto px-8 mb-24">
<div class="bg-surface-container-high rounded-2xl p-12 md:p-20 flex flex-col md:flex-row items-center gap-12">
<div class="flex-1">
<h2 class="text-4xl font-headline font-extrabold text-on-secondary-fixed mb-4">Join the Inner Circle</h2>
<p class="text-on-surface-variant text-lg">Receive exclusive travel itineraries and seasonal offers for luxury car rentals across Indochina.</p>
</div>
<div class="flex-1 w-full max-w-md">
<div class="flex gap-2">
<input class="flex-1 bg-white border-outline-variant/30 rounded-md py-4 px-6 focus:ring-secondary/20 focus:border-secondary transition-all" placeholder="Your email address" type="email"/>
<button class="bg-primary text-white px-8 py-4 rounded-md font-bold hover:opacity-90">Subscribe</button>
</div>
<p class="text-xs text-outline mt-4">By subscribing, you agree to our <a class="underline" href="#">Privacy Policy</a>.</p>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black pt-20">
<div class="max-w-7xl mx-auto px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/5">
<div class="space-y-6">
<div class="text-xl font-black text-white font-headline">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm leading-relaxed">
                    Crafting premium travel experiences across Vietnam, Cambodia, and Laos since 1998. Your gateway to Indochina's soul.
                </p>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Explore</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">About Us</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cultural Heritage</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Travel Blog</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Support</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Contact Support</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Privacy Policy</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Terms of Service</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Experience</h5>
<ul class="space-y-4">
<li class="flex items-center gap-3 text-[#c6c5d4]">
<span class="material-symbols-outlined text-[#ff645a] text-sm">mail</span>
                        concierge@vietsun.com
                    </li>
<li class="flex items-center gap-3 text-[#c6c5d4]">
<span class="material-symbols-outlined text-[#ff645a] text-sm">call</span>
                        +84 24 1234 5678
                    </li>
</ul>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 py-8 flex flex-col md:flex-row justify-between items-center text-[#c6c5d4] text-xs">
<p>© 2024 Viet Sun Travel. All rights reserved.</p>
<div class="flex gap-6 mt-4 md:mt-0">
<a class="hover:text-[#ff645a]" href="#">Instagram</a>
<a class="hover:text-[#ff645a]" href="#">LinkedIn</a>
<a class="hover:text-[#ff645a]" href="#">Facebook</a>
</div>
</div>
</footer>
</body></html>"

-- about boook vissa
"<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Car Rental | Viet Sun Travel</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-bright": "#f8f9fa",
                    "on-primary": "#ffffff",
                    "on-primary-fixed-variant": "#93000d",
                    "on-error": "#ffffff",
                    "on-background": "#191c1d",
                    "surface-container-low": "#f3f4f5",
                    "inverse-surface": "#2e3132",
                    "outline": "#767683",
                    "on-tertiary-fixed-variant": "#604100",
                    "tertiary-fixed": "#ffdeac",
                    "on-secondary-fixed-variant": "#00429c",
                    "error-container": "#ffdad6",
                    "secondary-container": "#759efd",
                    "on-primary-fixed": "#410002",
                    "surface-container-highest": "#e1e3e4",
                    "primary-container": "#680006",
                    "on-tertiary-fixed": "#281900",
                    "on-secondary-container": "#00337c",
                    "tertiary-container": "#422c00",
                    "secondary": "#2b5bb5",
                    "surface-container-high": "#e7e8e9",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary-fixed-dim": "#ffb4ac",
                    "on-surface-variant": "#454652",
                    "on-tertiary-container": "#c98c00",
                    "tertiary": "#271800",
                    "inverse-on-surface": "#f0f1f2",
                    "surface-container": "#edeeef",
                    "surface-tint": "#bb171c",
                    "primary": "#400002",
                    "secondary-fixed-dim": "#b0c6ff",
                    "background": "#f8f9fa",
                    "inverse-primary": "#ffb4ac",
                    "outline-variant": "#c6c5d4",
                    "surface": "#f8f9fa",
                    "on-error-container": "#93000a",
                    "error": "#ba1a1a",
                    "on-secondary-fixed": "#001945",
                    "surface-container-lowest": "#ffffff",
                    "secondary-fixed": "#d9e2ff",
                    "on-surface": "#191c1d",
                    "surface-dim": "#d9dadb",
                    "on-tertiary": "#ffffff",
                    "primary-fixed": "#ffdad6",
                    "surface-variant": "#e1e3e4",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Be Vietnam Pro"],
                    "label": ["Be Vietnam Pro"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopNavBar -->
<nav class="bg-white dark:bg-slate-900 sticky top-0 z-50">
<div class="max-w-7xl mx-auto px-8 flex justify-between items-center h-20">
<div class="text-2xl font-bold text-[#001945] dark:text-white font-headline tracking-tight">
                Viet Sun Travel
            </div>
<div class="hidden md:flex items-center space-x-8 font-headline tracking-tight">
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Flights</a>
<a class="text-[#2b5bb5] dark:text-[#4dabf7] border-b-2 border-[#2b5bb5] pb-1" href="#">Car Rental</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Cultural Tours</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Fashion</a>
<a class="text-[#2e3132] dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Deals</a>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-medium hover:opacity-90 transition-all scale-95 active:duration-150">
                Sign In
            </button>
</div>
</nav>
<main>
<!-- Hero & Search Section -->
<section class="relative h-[600px] flex items-center">
<div class="absolute inset-0 z-0 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Luxurious black sedan driving through a scenic coastal highway in Vietnam at golden hour with soft sunlight reflections" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDX3X4s-zPbOyMfV4MntT5JQNeLykljpTQU5K4X85Y-vKInMdkip-IX37dR2DKUJIMmS5dUXJlEXQgGBq5eRuU1fUiL4TDn8lhOgqWOx-A_52zTmE3gSmiWl7W51XeCxgAptX4SbL9DFLTcTcYy3jLmVVQ17HG-ByBM3YMSSEVNJjGQjFG2cfU7yb6qfJvThzThzKHLKV5tgKq_WTpxFy1gUxW2IndflhVBWDRZdhkbcOZM0GfdgFlPiGSBBC4r3VgKefTSBTYbTcFJ"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 w-full grid grid-cols-12 gap-8">
<div class="col-span-12 lg:col-span-6 text-white">
<h1 class="text-5xl md:text-6xl font-headline font-extrabold tracking-tighter leading-tight mb-6">
                        Journey with <br/><span class="text-on-primary-container">Elegance</span>
</h1>
<p class="text-lg text-surface-variant max-w-md mb-8 leading-relaxed">
                        Experience the freedom of Indochina's roads with our curated fleet of luxury vehicles and professional chauffeur services.
                    </p>
</div>
<!-- Search Box -->
<div class="col-span-12 lg:col-span-10 lg:col-start-1 mt-4">
<div class="bg-surface-container-lowest p-8 rounded-xl shadow-lg grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Location</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">location_on</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" placeholder="Hanoi, Vietnam" type="text"/>
</div>
</div>
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Date</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">calendar_today</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" type="date"/>
</div>
</div>
<div class="space-y-2">
<label class="block text-xs font-bold uppercase tracking-widest text-outline">Pickup Time</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary">schedule</span>
<input class="w-full pl-10 py-3 bg-surface-container border-none rounded-md focus:ring-2 focus:ring-secondary/20 font-medium" type="time"/>
</div>
</div>
<button class="bg-on-primary-container text-on-primary h-[52px] rounded-md font-bold text-lg hover:brightness-110 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">search</span>
                            Find Cars
                        </button>
</div>
</div>
</div>
</section>
<!-- Features Section (Horizontal Scroll/Asymmetric) -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
<div class="max-w-xl">
<h2 class="text-headline-md font-headline font-extrabold text-on-secondary-fixed mb-4">Uncompromising Standards</h2>
<p class="text-on-surface-variant">We redefine mobility by blending local hospitality with global standards of luxury and safety.</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Feature 1 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">Professional Drivers</h3>
<p class="text-on-surface-variant leading-relaxed">Our multilingual chauffeurs are experts in local routes and VIP etiquette, ensuring a seamless journey.</p>
</div>
<!-- Feature 2 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">support_agent</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">24/7 Concierge Support</h3>
<p class="text-on-surface-variant leading-relaxed">Round-the-clock assistance for route changes, dining reservations, or emergency support during your trip.</p>
</div>
<!-- Feature 3 -->
<div class="bg-surface-container-lowest p-10 rounded-xl group transition-all duration-500 hover:-translate-y-2">
<div class="w-14 h-14 bg-secondary-fixed rounded-full flex items-center justify-center mb-8 text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified_user</span>
</div>
<h3 class="text-xl font-bold font-headline mb-4 text-on-secondary-fixed">Premium Fleet Care</h3>
<p class="text-on-surface-variant leading-relaxed">Every vehicle undergoes a 50-point inspection and deep sanitation before every single booking.</p>
</div>
</div>
</div>
</section>
<!-- Car Types Grid -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<div class="flex items-center gap-4 mb-12">
<div class="h-px w-12 bg-secondary"></div>
<span class="text-secondary font-bold tracking-[0.2em] uppercase text-xs">Curated Fleet</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-8">
<!-- Sedan - Large Card -->
<div class="md:col-span-8 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="High-end white luxury sedan parked in front of a modern architectural villa with soft morning shadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2VrkSdbBRwckJHOTqAsdsrSP8oXz9AMPndAh6LvhzrXKuVdNMDmZgGQOtKZk8aAvND7DSZsd8oAI9LoUS4K3hMHraCYSNMK_AkV9ZIhOOkM7JQLhIVJUUHri2VEOVwhpWoAb7aWs4gOA39el0Zokq8OJIP9bUhytFoWd0UqxKTRzvCSEFX0MXVKqZ0QT7cA39pSbXfOfN1mwlxuIiSB1zO2VEqSfX1VF_gIjk2OoBVRo562A-ip-My_l_HwRoq24OZBAVLe85caFy"/>
<div class="absolute top-6 left-6 glass-badge px-4 py-1 rounded-full text-white text-xs font-bold uppercase tracking-wider">Most Popular</div>
</div>
<div class="p-8 flex justify-between items-center">
<div>
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Executive Sedan</h4>
<p class="text-on-surface-variant">Ideal for city transfers and business travel.</p>
</div>
<div class="text-right">
<span class="block text-xs font-bold text-outline uppercase tracking-widest mb-1">Starting from</span>
<span class="text-2xl font-headline font-bold text-primary">$85<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
</div>
</div>
</div>
<!-- SUV -->
<div class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Robust dark grey SUV on a winding mountain road through misty pine forests in Da Lat" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2Rc5jzbZiLYg8KtepYHLyY6Rb4GILVKqhYx_fH4Sy4X84XcEIgAMhZgu8n5FwYPZzri3XIAGwKk6-KRasOK-RHPZ7HRW1TEZnzsKKmvK_Yrn8WcYpjVUsDKBxp2pYeEA3BaY_g1glTA2UNpS3o6iclqg_VXqhPVPuuoFJCEQPXPDYod_DbbMNEVHNJgs_A-nQrHBx0mDuDQ03R3S2Ktei2k1F1IUDkFjCNiSA-J1bQ-iTWGXLiWHvP8UmwO9UMQ6YOvmr6DFEvsjA"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Premium SUV</h4>
<p class="text-on-surface-variant mb-6">Spacious comfort for family adventures.</p>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-6">
<span class="text-xl font-headline font-bold text-primary">$120<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
<a class="text-secondary font-bold text-sm uppercase tracking-wider flex items-center gap-1 group" href="#">Explore <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></a>
</div>
</div>
</div>
<!-- Luxury -->
<div class="md:col-span-4 bg-surface-container-lowest rounded-xl overflow-hidden group">
<div class="relative h-[400px]">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Elite luxury limousine with chrome details parked at a red carpet event at night under bright spotlights" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGKgzPXZOtbCj9p39zDRoqRQZF0xNOeyKwnwYXATTIcZU7RME367mw5oAVz-y6HR-k_Fsr6lsWG5a9Fi7HylsbrLK6Di_jTqmdBLCL4Z_hzPFX4OYj5MOenCOjjpNatplAJ7TypyS7s9quQFHVzyjGyRQyiM5oWJO6nhCc-7Rp4hZRo7EvTLSWJ11q8MgwJ60DQFATLvs1z5I3MxL3U7kGv8rhV032b_pXaAJZiJm236cJqzAeYzfBodFoH0mWjXOSppvNhnNAegPc"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-headline font-extrabold text-on-secondary-fixed mb-1">Ultra Luxury</h4>
<p class="text-on-surface-variant mb-6">Unrivaled prestige for special occasions.</p>
<div class="flex justify-between items-center border-t border-outline-variant/20 pt-6">
<span class="text-xl font-headline font-bold text-primary">$250<span class="text-sm font-normal text-on-surface-variant">/day</span></span>
<a class="text-secondary font-bold text-sm uppercase tracking-wider flex items-center gap-1 group" href="#">Explore <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></a>
</div>
</div>
</div>
<!-- Minivan/Van (Asymmetric offset) -->
<div class="md:col-span-8 bg-[linear-gradient(135deg,#2b5bb5,#00337c)] rounded-xl p-12 flex flex-col justify-between text-white relative overflow-hidden">
<div class="relative z-10">
<h4 class="text-4xl font-headline font-extrabold mb-4">Group Heritage Tours</h4>
<p class="max-w-md text-secondary-fixed opacity-90 text-lg leading-relaxed mb-8">
                                Planning a cultural expedition for a larger group? Our fleet of high-end 16-seater vans offers panoramic views and climate-controlled comfort.
                            </p>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-105 transition-transform">
                                Corporate Inquiries
                            </button>
</div>
<div class="absolute right-0 bottom-0 opacity-20 transform translate-x-1/4 translate-y-1/4">
<span class="material-symbols-outlined text-[300px]">airport_shuttle</span>
</div>
</div>
</div>
</div>
</section>
<!-- Newsletter / CTA -->
<section class="py-24 max-w-7xl mx-auto px-8 mb-24">
<div class="bg-surface-container-high rounded-2xl p-12 md:p-20 flex flex-col md:flex-row items-center gap-12">
<div class="flex-1">
<h2 class="text-4xl font-headline font-extrabold text-on-secondary-fixed mb-4">Join the Inner Circle</h2>
<p class="text-on-surface-variant text-lg">Receive exclusive travel itineraries and seasonal offers for luxury car rentals across Indochina.</p>
</div>
<div class="flex-1 w-full max-w-md">
<div class="flex gap-2">
<input class="flex-1 bg-white border-outline-variant/30 rounded-md py-4 px-6 focus:ring-secondary/20 focus:border-secondary transition-all" placeholder="Your email address" type="email"/>
<button class="bg-primary text-white px-8 py-4 rounded-md font-bold hover:opacity-90">Subscribe</button>
</div>
<p class="text-xs text-outline mt-4">By subscribing, you agree to our <a class="underline" href="#">Privacy Policy</a>.</p>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black pt-20">
<div class="max-w-7xl mx-auto px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/5">
<div class="space-y-6">
<div class="text-xl font-black text-white font-headline">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm leading-relaxed">
                    Crafting premium travel experiences across Vietnam, Cambodia, and Laos since 1998. Your gateway to Indochina's soul.
                </p>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Explore</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">About Us</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cultural Heritage</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Travel Blog</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Support</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Contact Support</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Privacy Policy</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Terms of Service</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6 text-sm uppercase tracking-widest">Experience</h5>
<ul class="space-y-4">
<li class="flex items-center gap-3 text-[#c6c5d4]">
<span class="material-symbols-outlined text-[#ff645a] text-sm">mail</span>
                        concierge@vietsun.com
                    </li>
<li class="flex items-center gap-3 text-[#c6c5d4]">
<span class="material-symbols-outlined text-[#ff645a] text-sm">call</span>
                        +84 24 1234 5678
                    </li>
</ul>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 py-8 flex flex-col md:flex-row justify-between items-center text-[#c6c5d4] text-xs">
<p>© 2024 Viet Sun Travel. All rights reserved.</p>
<div class="flex gap-6 mt-4 md:mt-0">
<a class="hover:text-[#ff645a]" href="#">Instagram</a>
<a class="hover:text-[#ff645a]" href="#">LinkedIn</a>
<a class="hover:text-[#ff645a]" href="#">Facebook</a>
</div>
</div>
</footer>
</body></html>"

--ABOUT CODE VISA
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dịch Vụ Visa Chuyên Nghiệp - Viet Sun Travel</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-primary-fixed-variant": "#93000d",
                    "tertiary-fixed": "#ffdeac",
                    "on-secondary-fixed-variant": "#00429c",
                    "primary-fixed": "#ffdad6",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "error-container": "#ffdad6",
                    "on-tertiary-fixed": "#281900",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "on-surface-variant": "#454652",
                    "error": "#ba1a1a",
                    "on-tertiary": "#ffffff",
                    "on-primary-fixed": "#410002",
                    "outline-variant": "#c6c5d4",
                    "secondary-fixed": "#d9e2ff",
                    "surface-container": "#edeeef",
                    "surface-container-low": "#f3f4f5",
                    "surface-bright": "#f8f9fa",
                    "on-secondary-container": "#00337c",
                    "surface-container-high": "#e7e8e9",
                    "on-tertiary-fixed-variant": "#604100",
                    "background": "#f8f9fa",
                    "tertiary": "#271800",
                    "secondary-fixed-dim": "#b0c6ff",
                    "on-primary": "#ffffff",
                    "surface": "#f8f9fa",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-highest": "#e1e3e4",
                    "on-secondary": "#ffffff",
                    "surface-tint": "#bb171c",
                    "outline": "#767683",
                    "primary-fixed-dim": "#ffb4ac",
                    "on-secondary-fixed": "#001945",
                    "surface-variant": "#e1e3e4",
                    "inverse-on-surface": "#f0f1f2",
                    "inverse-surface": "#2e3132",
                    "tertiary-container": "#422c00",
                    "secondary-container": "#759efd",
                    "primary-container": "#680006",
                    "on-primary-container": "#ff645a",
                    "on-error": "#ffffff",
                    "on-tertiary-container": "#c98c00",
                    "primary": "#400002"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Be Vietnam Pro"],
                    "label": ["Be Vietnam Pro"]
            }
          },
        },
      }
    </script>
<style>
      body { font-family: 'Be Vietnam Pro', sans-serif; }
      h1, h2, h3, h4 { font-family: 'Plus Jakarta Sans', sans-serif; }
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
      .glass-badge { background: rgba(43, 91, 181, 0.4); backdrop-filter: blur(20px); }
    </style>
</head>
<body class="bg-surface text-on-surface">
<!-- Top Navigation Bar -->
<header class="w-full top-0 sticky z-50 bg-white dark:bg-slate-950 font-['Plus_Jakarta_Sans'] tracking-tight">
<div class="flex justify-between items-center max-w-7xl mx-auto px-6 h-20">
<div class="text-2xl font-bold text-slate-900 dark:text-white">Viet Sun Travel</div>
<nav class="hidden md:flex gap-8 items-center">
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300 hover:text-rose-500" href="#">Tours</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300 hover:text-rose-500" href="#">Destinations</a>
<a class="text-rose-600 dark:text-rose-400 font-semibold border-b-2 border-rose-600 transition-colors duration-300 hover:text-rose-500" href="#">Visa Services</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300 hover:text-rose-500" href="#">About Us</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors duration-300 hover:text-rose-500" href="#">Blog</a>
</nav>
<button class="bg-on-primary-container text-on-primary px-6 py-2.5 rounded-md font-semibold transition-all duration-150 ease-in-out active:scale-95">Book Now</button>
</div>
</header>
<main>
<!-- Hero Section -->
<section class="relative h-[614px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img alt="Global Travel" class="w-full h-full object-cover" data-alt="Close up of a person's hands holding multiple global passports with a blurred world map in a bright minimalist luxury travel office setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDArhroodQPCWbWf_s8zj6jT52Nx_CkkpGOgs6jx5ZRZ2gAOFuTJ5YvTCvuTXzto71PlbBXQpTcwIp-6NF-qC8GIvJ4ZS0EkMsXZ5OzKfNS0uzy9XbFceKa9lazclF8HlsoRHYRWfbwuzYzgCbLBBD4hqTHT7D-012l6WIVeP0rtqa0CqoCBMWAX46_fuoMk1qhAvQbiGRqH16gRi06F99y0y-6fOfQ-eQIYEli4-xa2VU2sVZ56J1Hkk2ZkLECCHMsVZ-sHMxiapdb"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
<div class="max-w-2xl">
<span class="text-on-primary-container font-semibold tracking-widest uppercase text-sm mb-4 block">International Gateway</span>
<h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight -tracking-[0.02em] mb-6">
                        DỊCH VỤ VISA <br/><span class="text-on-primary-container">CHUYÊN NGHIỆP</span>
</h1>
<p class="text-lg text-slate-200 font-body leading-relaxed max-w-lg mb-8">
                        Vượt qua mọi rào cản hành chính. Chúng tôi kiến tạo lộ trình thị thực hoàn hảo cho hành trình khám phá thế giới của bạn.
                    </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-on-primary px-8 py-4 rounded-md font-bold shadow-lg hover:brightness-110 transition-all">Bắt Đầu Ngay</button>
<button class="border border-white/30 text-white backdrop-blur-md px-8 py-4 rounded-md font-bold hover:bg-white hover:text-on-secondary-fixed transition-all">Xem Bảng Giá</button>
</div>
</div>
</div>
</section>
<!-- Introduction Section -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-6">
<div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
<div>
<h2 class="text-3xl font-bold text-on-secondary-fixed mb-6 leading-tight">Tại sao chọn Viet Sun Travel?</h2>
<p class="text-body-lg text-on-surface-variant mb-8 leading-relaxed">
                            Với hơn 15 năm kinh nghiệm trong lĩnh vực lữ hành quốc tế, Viet Sun Travel không chỉ cung cấp dịch vụ, chúng tôi cung cấp sự an tâm tuyệt đối. Quy trình của chúng tôi được tinh chỉnh để tối ưu hóa tỷ lệ đậu visa lên đến 99%.
                        </p>
<ul class="space-y-4">
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary">verified</span>
<div>
<span class="font-bold block">Chuyên gia tư vấn tận tâm</span>
<span class="text-sm text-on-surface-variant">Đội ngũ am hiểu sâu sắc luật di trú của từng quốc gia.</span>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary">speed</span>
<div>
<span class="font-bold block">Xử lý hồ sơ thần tốc</span>
<span class="text-sm text-on-surface-variant">Tối ưu hóa thời gian chờ đợi cho những chuyến đi khẩn cấp.</span>
</div>
</li>
<li class="flex items-start gap-3">
<span class="material-symbols-outlined text-secondary">visibility</span>
<div>
<span class="font-bold block">Minh bạch &amp; Rõ ràng</span>
<span class="text-sm text-on-surface-variant">Cam kết không chi phí ẩn, quy trình cập nhật liên tục qua App/SMS.</span>
</div>
</li>
</ul>
</div>
<div class="relative">
<div class="aspect-square rounded-full border-2 border-dashed border-outline-variant absolute -inset-4 rotate-45"></div>
<img alt="Service" class="rounded-xl w-full h-[500px] object-cover relative z-10" data-alt="Professional consultant in a modern sleek office assisting a client with travel documents, natural lighting, high-end editorial style" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYMtrUDLaFoDeDcTojAgqbnpNx77ijjikE952Vp1QRlmWRe1nsmm5lRx1OdiTFEJjFovLPkSWGh5GgW31SO6f7jTucfvE_vCA1hJGpO2nggunYp2yTuxW9m9MieZ3dcgD_NeEm_u8hunhPH6yFDP9kZujyHDsYq3yqf2dBKTSF5yszoRokJwzT6tue4qNl3WKXZCpvaRe11i6j12qPko3eePeQiOKm1JxyGBluvtvauGHISw7BT3SMUS4UqZ1w1rMy4QiVMQTubHJ5"/>
</div>
</div>
</div>
</section>
<!-- Service Categories -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-6">
<div class="text-center mb-16">
<h2 class="text-4xl font-bold text-on-secondary-fixed mb-4">Danh Mục Dịch Vụ</h2>
<p class="text-on-surface-variant max-w-xl mx-auto">Giải pháp thị thực đa dạng cho mọi mục đích chuyến đi</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
<!-- Tourist Visa -->
<div class="bg-surface-container-lowest p-8 rounded-xl group hover:bg-secondary transition-all duration-300">
<div class="w-14 h-14 rounded-full bg-secondary-fixed flex items-center justify-center mb-6 group-hover:bg-on-secondary transition-colors">
<span class="material-symbols-outlined text-secondary group-hover:text-secondary">travel_explore</span>
</div>
<h3 class="text-xl font-bold mb-3 group-hover:text-white">Visa Du Lịch</h3>
<p class="text-sm text-on-surface-variant group-hover:text-white/80 mb-6">Trải nghiệm những vùng đất mới với thủ tục du lịch nhanh chóng.</p>
<a class="text-secondary font-bold group-hover:text-on-primary-container flex items-center gap-2" href="#">Tìm hiểu thêm <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<!-- Business Visa -->
<div class="bg-surface-container-lowest p-8 rounded-xl group hover:bg-secondary transition-all duration-300">
<div class="w-14 h-14 rounded-full bg-secondary-fixed flex items-center justify-center mb-6 group-hover:bg-on-secondary transition-colors">
<span class="material-symbols-outlined text-secondary group-hover:text-secondary">business_center</span>
</div>
<h3 class="text-xl font-bold mb-3 group-hover:text-white">Visa Công Tác</h3>
<p class="text-sm text-on-surface-variant group-hover:text-white/80 mb-6">Mở rộng cơ hội kinh doanh toàn cầu với visa thương mại dài hạn.</p>
<a class="text-secondary font-bold group-hover:text-on-primary-container flex items-center gap-2" href="#">Tìm hiểu thêm <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<!-- Student Visa -->
<div class="bg-surface-container-lowest p-8 rounded-xl group hover:bg-secondary transition-all duration-300">
<div class="w-14 h-14 rounded-full bg-secondary-fixed flex items-center justify-center mb-6 group-hover:bg-on-secondary transition-colors">
<span class="material-symbols-outlined text-secondary group-hover:text-secondary">school</span>
</div>
<h3 class="text-xl font-bold mb-3 group-hover:text-white">Visa Du Học</h3>
<p class="text-sm text-on-surface-variant group-hover:text-white/80 mb-6">Đồng hành cùng ước mơ học thuật tại các quốc gia hàng đầu.</p>
<a class="text-secondary font-bold group-hover:text-on-primary-container flex items-center gap-2" href="#">Tìm hiểu thêm <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
<!-- Family Visa -->
<div class="bg-surface-container-lowest p-8 rounded-xl group hover:bg-secondary transition-all duration-300">
<div class="w-14 h-14 rounded-full bg-secondary-fixed flex items-center justify-center mb-6 group-hover:bg-on-secondary transition-colors">
<span class="material-symbols-outlined text-secondary group-hover:text-secondary">family_restroom</span>
</div>
<h3 class="text-xl font-bold mb-3 group-hover:text-white">Visa Thăm Thân</h3>
<p class="text-sm text-on-surface-variant group-hover:text-white/80 mb-6">Kết nối yêu thương, rút ngắn khoảng cách với người thân phương xa.</p>
<a class="text-secondary font-bold group-hover:text-on-primary-container flex items-center gap-2" href="#">Tìm hiểu thêm <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
</div>
</div>
</div>
</section>
<!-- Popular Destinations Grid -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-6">
<div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
<div>
<h2 class="text-4xl font-bold text-on-secondary-fixed mb-2">Điểm Đến Phổ Biến</h2>
<p class="text-on-surface-variant">Yêu cầu visa cho các thị trường hàng đầu</p>
</div>
<button class="text-secondary font-bold border-b-2 border-secondary/20 hover:border-secondary transition-all">Xem tất cả 50+ quốc gia</button>
</div>
<div class="grid grid-cols-2 md:grid-cols-6 gap-8">
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="Europe" class="w-full h-full object-cover rounded-full" data-alt="The Eiffel Tower in Paris under a soft blue morning sky, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAen48fVqq3zgm5uTnKYwzpm-f7Fg-_HMmGHh9bLRoVp5SI93ViSum31YlnzXcW80l0U8IRDYL4TMJXQkn_4uK2QYHyhD_Fzfx-EpKi51xuPG9bulqVN3oBxs3udl-TZ1-G0mVWPCTrm1ILm6iw_9ubBqcPx191_nvAHXzSLGvxV0q18lH3LC8gPONsV8IQrbBbOPoPU8_f7_UZboT8qOMKc926Zb7ERrOonYA6CkQNcxs1Ic1-nKcUCOokdj6g083-eTAfW1FneXd7"/>
</div>
<h4 class="font-bold">Châu Âu</h4>
<span class="text-xs text-on-surface-variant">Schengen Visa</span>
</div>
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="USA" class="w-full h-full object-cover rounded-full" data-alt="Statue of Liberty silhouette against a warm sunset sky, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXLbT5JqjwncLxvMP2NOdPGS2HIiBAuv88gu9Wded4BG1ynFy0N0KyZXdWLIX91FDn1M3K3gnTz8Jbw2IIRcUgs4N9vQozQ_xo5ZzKIhhX0LjxwTMIhb35kxqjGc0-5IQlJNfnCscetIWwj6KE0GQck73yQLyDi77y-3KktytjpkZPa8Ot-URCPT6L5zENQWoAGI7JPA6JLpt02ycSGuZUuAEas7bAmZxe6JCwYDT5gFIMo7pcuS5oKVJIn4-fDFlDfshat7jvAtAL"/>
</div>
<h4 class="font-bold">Hoa Kỳ</h4>
<span class="text-xs text-on-surface-variant">Visa B1/B2</span>
</div>
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="Japan" class="w-full h-full object-cover rounded-full" data-alt="Traditional Japanese pagoda with cherry blossoms in spring, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsEbn3CS2Z1qS9G4JmQRdi82hO0F6VZNBOvE2vN4FczN-RKSSgJORMHCx7NazY8IE3S9zhduD7nWRJx5ORYvNoa-8qQpp8EaHkpnqvZZsgVPgwRGjwyJeLq7JMFDIanFiUeuP1B_zJRPy6F0jekO1HJY203nSBVAkEZYUSohdtyw7mbaLjCt0NMg5mwmXTyIj0mvxQDdSFyzGd3TMVIVH3pQh4qy9dk8JvgqO58Bnq4E1WJd0gfmrTTafsiifH6LZ4NAk0UUPMCDBZ"/>
</div>
<h4 class="font-bold">Nhật Bản</h4>
<span class="text-xs text-on-surface-variant">Visa Lưu Trú</span>
</div>
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="Korea" class="w-full h-full object-cover rounded-full" data-alt="Night view of Seoul skyline with modern architecture and bright lights, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOR4OV45oxK7z1uxawZEGzNbiup5TB3D6gQztfb7aa1dzpdksp9NhovGnLESTJ3SNLM7Kf2fNl9-4bo32JEiaP09xhmqoT8wrgfEcy-JnRgEE0ZCJm5dHqdLq7tB616gFAC_ZOIpnuFigOvjGQcvUkgX28xzB2ZmzyWmc4TVx8zSMvlSJ31A9H-dRUnihMG7NNcMMStWyjbL4VK-7EOTXMsqdyfSK3g7sVlxfH6tD_MQdJf4P1vrehM43wtTn3_ru0Zrrs-6GVmDRw"/>
</div>
<h4 class="font-bold">Hàn Quốc</h4>
<span class="text-xs text-on-surface-variant">Visa Du Lịch</span>
</div>
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="China" class="w-full h-full object-cover rounded-full" data-alt="The Great Wall of China winding through green mountains, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDs6tp_TGM9hqda0F8nM3TFDp9KjneW0Tk2JtDt1XNcRE69tEkzMnRueFhHrKvPYBjVinb-Z6ByD4XG4omy_sc60_1xedbBIhMLa40GCRWENBEmyIEf_iMttgReAVtbPXs_eVCkndVoIBFw5Mq2EQ8HYUBhoLkI6CD7UBPUi5nQi7AV9B3BtTFNzUcNv-1gNWRpLMaTWbeQVlrc4Z4L2g5bL3MifONTnzv2zSNa_HI4bpoK4cvuSUgKqbDBN9JjFCT_nuqj7Smv9BZy"/>
</div>
<h4 class="font-bold">Trung Quốc</h4>
<span class="text-xs text-on-surface-variant">L Visa</span>
</div>
<div class="text-center group cursor-pointer">
<div class="aspect-square rounded-full overflow-hidden mb-4 border-2 border-transparent group-hover:border-on-primary-container transition-all p-1">
<img alt="Australia" class="w-full h-full object-cover rounded-full" data-alt="Sydney Opera House at dusk with deep blue water, circular crop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-BZB9D0a4DrnorUOkA79p3ml1TcvtZrZj-cKOkUESSDu0yahu7eFCJ_cmV1gFX_HFvEDL3bGjvQkS3TjrLL8KVHqtfr7T2ZdqPIxFNoPyhxga58HojUzhYicLVFdE92ZbrAuMIxCNy1C3I2OiKUWU7CgRSS7yjkrJPoQ7-e66spZxx37igjVDN4o-eGA5CfmqckflrKNjdM7-ZZJC3Nbtf6apJKdIgmRWRwAOF_2ug6mKgJIi47tU9ZOt3B47bXrN4F3utsVhXSKF"/>
</div>
<h4 class="font-bold">Australia</h4>
<span class="text-xs text-on-surface-variant">Subclass 600</span>
</div>
</div>
</div>
</section>
<!-- Process Timeline -->
<section class="py-24 bg-slate-900 text-white overflow-hidden relative">
<div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
<img alt="Decor" class="w-full h-full object-cover" data-alt="Blueprint and architectural lines texture over dark background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAtUwjYF3-xc1DAQ_4A3RluwYlRfOx_mi8Vqm6jyc3WWDJhDZaKGGaMGNrG671ZQJs3GUPCvCd6Gdg4-kZkXSP1TFA5PQeRLU73RI-D2q904tIe9q93nrDC75K6ERQBOBlRyYReqUSYagEAfsBpUogZKphN35laupHXHnW_9psDJfnQxUKla3OJfl7veP4MuwQSdwFThTYXCJZg_jPdFS7rhcXlsPjbBGrbSt-J1rdAjClIoNy7vPXFeH6VsAoD5wPnaPHvuAxCeO3A"/>
</div>
<div class="max-w-7xl mx-auto px-6 relative z-10">
<div class="text-center mb-16">
<h2 class="text-4xl font-bold mb-4">Quy Trình 4 Bước Đơn Giản</h2>
<p class="text-slate-400">Chúng tôi đơn giản hóa sự phức tạp để bạn tập trung vào chuyến đi</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
<div class="hidden md:block absolute top-12 left-0 w-full h-px bg-white/20 z-0"></div>
<div class="relative z-10 text-center">
<div class="w-24 h-24 rounded-full bg-secondary border-4 border-slate-900 flex items-center justify-center mx-auto mb-6 shadow-2xl">
<span class="material-symbols-outlined text-3xl">chat</span>
</div>
<h3 class="text-xl font-bold mb-2">1. Tư Vấn</h3>
<p class="text-slate-400 text-sm">Chuyên gia phân tích hồ sơ và đưa ra chiến lược tối ưu nhất.</p>
</div>
<div class="relative z-10 text-center">
<div class="w-24 h-24 rounded-full bg-secondary border-4 border-slate-900 flex items-center justify-center mx-auto mb-6 shadow-2xl">
<span class="material-symbols-outlined text-3xl">folder_zip</span>
</div>
<h3 class="text-xl font-bold mb-2">2. Thu Thập</h3>
<p class="text-slate-400 text-sm">Chúng tôi hỗ trợ bạn chuẩn bị và dịch thuật hồ sơ đúng chuẩn.</p>
</div>
<div class="relative z-10 text-center">
<div class="w-24 h-24 rounded-full bg-secondary border-4 border-slate-900 flex items-center justify-center mx-auto mb-6 shadow-2xl">
<span class="material-symbols-outlined text-3xl">send</span>
</div>
<h3 class="text-xl font-bold mb-2">3. Nộp Hồ Sơ</h3>
<p class="text-slate-400 text-sm">Nộp hồ sơ trực tiếp tại Đại sứ quán/Lãnh sự quán/Trung tâm tiếp nhận.</p>
</div>
<div class="relative z-10 text-center">
<div class="w-24 h-24 rounded-full bg-on-primary-container border-4 border-slate-900 flex items-center justify-center mx-auto mb-6 shadow-2xl">
<span class="material-symbols-outlined text-3xl">flight_takeoff</span>
</div>
<h3 class="text-xl font-bold mb-2 text-on-primary-container">4. Nhận Visa</h3>
<p class="text-slate-400 text-sm">Chào mừng bạn đã sở hữu visa. Sẵn sàng cho hành trình!</p>
</div>
</div>
</div>
</section>
<!-- FAQ Section -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-3xl mx-auto px-6">
<h2 class="text-3xl font-bold text-center mb-12">Câu Hỏi Thường Gặp</h2>
<div class="space-y-4">
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex justify-between items-center cursor-pointer">
<h4 class="font-bold">Thời gian xử lý visa mất bao lâu?</h4>
<span class="material-symbols-outlined text-secondary">add</span>
</div>
<p class="mt-4 text-on-surface-variant text-sm">Tùy vào quốc gia và loại visa, trung bình từ 5 đến 15 ngày làm việc. Một số diện khẩn có thể lấy trong 48h.</p>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex justify-between items-center cursor-pointer">
<h4 class="font-bold">Phí dịch vụ bao gồm những gì?</h4>
<span class="material-symbols-outlined text-secondary">add</span>
</div>
</div>
<div class="bg-white p-6 rounded-lg shadow-sm">
<div class="flex justify-between items-center cursor-pointer">
<h4 class="font-bold">Tỉ lệ đậu visa có được cam kết không?</h4>
<span class="material-symbols-outlined text-secondary">add</span>
</div>
</div>
</div>
</div>
</section>
<!-- CTA Section -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-6">
<div class="bg-gradient-to-br from-secondary to-on-secondary-container rounded-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row">
<div class="p-12 md:w-1/2 flex flex-col justify-center text-white">
<h2 class="text-4xl font-extrabold mb-6">Bạn đã sẵn sàng để bay?</h2>
<p class="text-white/80 mb-8">Hãy để các chuyên gia của chúng tôi lo liệu các thủ tục phức tạp. Tư vấn miễn phí và đánh giá hồ sơ trong 15 phút.</p>
<div class="flex items-center gap-4 text-2xl font-bold">
<div class="w-12 h-12 rounded-full bg-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined">call</span>
</div>
<span>1900 6789</span>
</div>
</div>
<div class="bg-white/10 backdrop-blur-xl p-12 md:w-1/2 border-l border-white/10">
<form class="space-y-4">
<div class="grid grid-cols-2 gap-4">
<input class="w-full bg-white/5 border-white/20 rounded-md p-3 text-white placeholder-white/50 focus:ring-on-primary-container focus:border-on-primary-container" placeholder="Họ và tên" type="text"/>
<input class="w-full bg-white/5 border-white/20 rounded-md p-3 text-white placeholder-white/50 focus:ring-on-primary-container focus:border-on-primary-container" placeholder="Số điện thoại" type="tel"/>
</div>
<select class="w-full bg-white/5 border-white/20 rounded-md p-3 text-white placeholder-white/50 focus:ring-on-primary-container">
<option class="text-on-surface">Chọn quốc gia đến</option>
<option class="text-on-surface">Châu Âu</option>
<option class="text-on-surface">Hoa Kỳ</option>
<option class="text-on-surface">Nhật Bản</option>
</select>
<textarea class="w-full bg-white/5 border-white/20 rounded-md p-3 text-white placeholder-white/50 focus:ring-on-primary-container" placeholder="Ghi chú thêm về nhu cầu của bạn" rows="3"></textarea>
<button class="w-full bg-on-primary-container text-on-primary font-bold py-4 rounded-md hover:shadow-xl hover:brightness-110 transition-all">Gửi Yêu Cầu Tư Vấn</button>
</form>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full pt-20 pb-10 bg-slate-900 dark:bg-black font-['Be_Vietnam_Pro'] leading-relaxed border-t border-slate-800">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-7xl mx-auto px-8">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-bold text-white mb-6">Viet Sun Travel</div>
<p class="text-slate-400 text-sm mb-6">Tận hưởng hành trình diệu kỳ với các dịch vụ du lịch và thị thực chuyên nghiệp hàng đầu Việt Nam.</p>
</div>
<div>
<h5 class="text-rose-500 dark:text-rose-400 font-bold mb-6">Quick Links</h5>
<ul class="space-y-4">
<li><a class="text-slate-400 hover:text-rose-500 transition-all duration-300 hover:translate-x-1 inline-block" href="#">Visa Requirements</a></li>
<li><a class="text-slate-400 hover:text-rose-500 transition-all duration-300 hover:translate-x-1 inline-block" href="#">Terms of Service</a></li>
<li><a class="text-slate-400 hover:text-rose-500 transition-all duration-300 hover:translate-x-1 inline-block" href="#">Privacy Policy</a></li>
</ul>
</div>
<div>
<h5 class="text-rose-500 dark:text-rose-400 font-bold mb-6">Support</h5>
<ul class="space-y-4">
<li><a class="text-slate-400 hover:text-rose-500 transition-all duration-300 hover:translate-x-1 inline-block" href="#">Contact Support</a></li>
<li><a class="text-slate-400 hover:text-rose-500 transition-all duration-300 hover:translate-x-1 inline-block" href="#">Office Locations</a></li>
</ul>
</div>
<div>
<h5 class="text-rose-500 dark:text-rose-400 font-bold mb-6">Newsletter</h5>
<div class="flex flex-col gap-4">
<p class="text-slate-400 text-xs">Nhận ưu đãi du lịch mới nhất qua email.</p>
<div class="flex gap-2">
<input class="bg-slate-800 border-none text-white text-sm p-2 rounded-md grow" placeholder="Email" type="email"/>
<button class="bg-rose-600 text-white p-2 rounded-md"><span class="material-symbols-outlined">send</span></button>
</div>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto px-8 mt-20 pt-10 border-t border-slate-800 text-center">
<p class="text-slate-400 text-sm opacity-80">© 2024 Viet Sun Travel. All rights reserved. Curated luxury experiences.</p>
</div>
</footer>
</body></html>"
