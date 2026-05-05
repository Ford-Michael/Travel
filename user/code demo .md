- about detail tour 
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container-low": "#f3f4f5",
                    "surface-container": "#edeeef",
                    "outline-variant": "#c6c5d4",
                    "on-secondary-fixed-variant": "#00429c",
                    "on-secondary": "#ffffff",
                    "on-tertiary-fixed": "#281900",
                    "tertiary": "#271800",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a",
                    "surface-bright": "#f8f9fa",
                    "on-error": "#ffffff",
                    "inverse-surface": "#2e3132",
                    "on-primary-container": "#ff645a",
                    "on-primary-fixed": "#410002",
                    "surface": "#f8f9fa",
                    "on-secondary-container": "#00337c",
                    "tertiary-fixed": "#ffdeac",
                    "secondary-fixed-dim": "#b0c6ff",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#422c00",
                    "on-primary": "#ffffff",
                    "on-error-container": "#93000a",
                    "primary": "#400002",
                    "tertiary-fixed-dim": "#ffba38",
                    "on-primary-fixed-variant": "#93000d",
                    "on-surface-variant": "#454652",
                    "on-background": "#191c1d",
                    "background": "#f8f9fa",
                    "on-secondary-fixed": "#001945",
                    "surface-container-highest": "#e1e3e4",
                    "surface-container-high": "#e7e8e9",
                    "primary-fixed": "#ffdad6",
                    "surface-variant": "#e1e3e4",
                    "error-container": "#ffdad6",
                    "on-tertiary-container": "#c98c00",
                    "surface-tint": "#bb171c",
                    "primary-fixed-dim": "#ffb4ac",
                    "primary-container": "#680006",
                    "inverse-on-surface": "#f0f1f2",
                    "secondary-fixed": "#d9e2ff",
                    "on-surface": "#191c1d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "secondary-container": "#759efd",
                    "outline": "#767683",
                    "on-tertiary-fixed-variant": "#604100"
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
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopAppBar -->
<header class="sticky top-0 w-full z-50 bg-white dark:bg-slate-900 shadow-sm dark:shadow-none">
<div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
<div class="text-xl font-bold text-[#001945] dark:text-white font-headline">Viet Sun Travel</div>
<nav class="hidden md:flex items-center gap-8">
<a class="font-headline font-medium text-sm tracking-tight text-[#2b5bb5] border-b-2 border-[#2b5bb5] pb-1 hover:text-[#ff645a] transition-colors duration-300" href="#">Tours</a>
<a class="font-headline font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Destinations</a>
<a class="font-headline font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Promotions</a>
<a class="font-headline font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">About</a>
<a class="font-headline font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-[#ff645a] transition-colors duration-300" href="#">Contact</a>
</nav>
<div class="flex items-center gap-4">
<button class="material-symbols-outlined text-on-surface-variant hover:text-on-secondary-container transition-colors">search</button>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-headline font-medium text-sm hover:opacity-90 active:scale-95 duration-200 transition-all">Book Now</button>
</div>
</div>
</header>
<main class="max-w-7xl mx-auto px-8 py-6">
<!-- Breadcrumbs -->
<nav class="flex items-center gap-2 text-xs font-medium text-outline mb-8">
<a class="hover:text-secondary transition-colors" href="#">Home</a>
<span class="material-symbols-outlined text-[10px]">chevron_right</span>
<a class="hover:text-secondary transition-colors" href="#">Tours</a>
<span class="material-symbols-outlined text-[10px]">chevron_right</span>
<a class="hover:text-secondary transition-colors" href="#">Japan</a>
<span class="material-symbols-outlined text-[10px]">chevron_right</span>
<span class="text-on-surface-variant">Gold Route</span>
</nav>
<!-- Hero Section -->
<section class="grid grid-cols-12 gap-4 mb-12">
<div class="col-span-12 lg:col-span-8 relative group overflow-hidden rounded-xl">
<img alt="Mount Fuji" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700" data-alt="Majestic Mount Fuji with snow cap reflected in Lake Kawaguchi surrounded by cherry blossoms in spring morning light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxVL_52rYKiR0uTxFM8CgUbwixbPLC_WVf04R5_-RpbWOJ3dt7r--bqCueCSOva8hgie2rYFkY5aFc1tkL96HZgwmw9y0AZV2plcHup8pFbWvZBIEys6jjHl8JZ3te47cCLaI0aCqh60uFNDELoBCs0unC1_RmupFrIiNIYpcN8AS_IBtteNLoef_oXPTmUw5M2xGZX72665XsrLXq5dT7OUeJbu6Zf8L5jFFDKei2ydl9kOihUfQ2_fQQTr8RYhobU86LEx2HuspK"/>
<div class="absolute top-6 left-6 glass-badge text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">Featured Tour</div>
</div>
<div class="col-span-12 lg:col-span-4 grid grid-cols-2 lg:grid-cols-1 gap-4">
<div class="overflow-hidden rounded-xl h-[242px]">
<img alt="Kyoto" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" data-alt="Vibrant red Fushimi Inari shrines in Kyoto with soft dappled sunlight through trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCn3IhuRfLf55XV8V-j_2fka1uOzM-tmDxvIeE_3GCfWRMtRzyCKhm61ntA7L0IVEGbn9AXLWoFM-mwNeMDc3dRcsLgX_VMo9DSeCNLhBtCxChUTk4evj7XJr7ktQiD1VyXlpqYBrTwtX6WujPMbbk9A6fvvuXbwWmIuQ0l1E0vWpjsDo-J81EW-4-6YFp1jF19daQMIEVIqsa2qNdbT085-CxXrDXQGJNlznSAmGADFM9vxZ6bdsrKRbyl0vj3Ea2NydccK73_4DO_"/>
</div>
<div class="overflow-hidden rounded-xl h-[242px] relative">
<img alt="Tokyo" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500" data-alt="Cinematic night view of Shibuya Crossing in Tokyo with neon lights and urban energy" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQBi_51e-hRWLrpmdpy31rLcA5ZedzxJoeHCZgYUHC8YefAbq77ZGEc--WQuZgu9TG4hWf7wCl0rYph4GzfkaDEkfyf1SIVu_SnJwZnsbQRMmwpfABH9odJRCqYXH-CuUtSZ3h11NWxJ2mCJPnzAXCpz2oNirWXn863pblpnC0zJBkaVGAVxOsggxatxfpkpPxctTsLdQlrO-egtX79igrLE_V-NGkY-nsnXWeVmbI_Uu7Pk3rhcUEMJXfdB4SjyueyjVaBOxgmP91"/>
<button class="absolute inset-0 bg-black/40 flex items-center justify-center text-white font-bold text-lg hover:bg-black/50 transition-all">
                        +12 Photos
                    </button>
</div>
</div>
</section>
<!-- Tour Header & Key Info -->
<div class="grid grid-cols-12 gap-12 mb-16">
<div class="col-span-12 lg:col-span-8">
<div class="mb-8">
<h1 class="text-4xl font-extrabold font-headline text-on-secondary-fixed mb-4 tracking-tight">Hành trình Cung Đường Vàng Nhật Bản: Tokyo - Fuji - Kyoto</h1>
<div class="flex items-center gap-6">
<div class="flex items-center gap-1 text-[#ff645a]">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="ml-2 text-on-surface-variant text-sm font-medium">(128 Reviews)</span>
</div>
<div class="h-4 w-[1px] bg-outline-variant"></div>
<div class="text-on-surface-variant text-sm font-medium">Tour Code: <span class="text-secondary font-bold">VST-JPN-001</span></div>
</div>
</div>
<!-- Key Info Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 p-8 bg-surface-container-low rounded-2xl mb-12">
<div class="flex flex-col items-center text-center gap-2">
<span class="material-symbols-outlined text-secondary text-3xl">schedule</span>
<div>
<p class="text-[10px] uppercase font-bold text-outline tracking-wider">Duration</p>
<p class="text-sm font-bold text-on-secondary-fixed">6 Days 5 Nights</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2">
<span class="material-symbols-outlined text-secondary text-3xl">flight</span>
<div>
<p class="text-[10px] uppercase font-bold text-outline tracking-wider">Transport</p>
<p class="text-sm font-bold text-on-secondary-fixed">Airplane</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2">
<span class="material-symbols-outlined text-secondary text-3xl">location_on</span>
<div>
<p class="text-[10px] uppercase font-bold text-outline tracking-wider">Departure</p>
<p class="text-sm font-bold text-on-secondary-fixed">Ho Chi Minh City</p>
</div>
</div>
<div class="flex flex-col items-center text-center gap-2">
<span class="material-symbols-outlined text-secondary text-3xl">calendar_today</span>
<div>
<p class="text-[10px] uppercase font-bold text-outline tracking-wider">Date</p>
<p class="text-sm font-bold text-on-secondary-fixed">Weekly</p>
</div>
</div>
</div>
<!-- Content Tabs -->
<div class="border-b border-outline-variant mb-8 overflow-x-auto">
<div class="flex gap-10 min-w-max">
<button class="pb-4 text-sm font-bold text-secondary border-b-2 border-secondary">Overview</button>
<button class="pb-4 text-sm font-bold text-on-surface-variant hover:text-secondary transition-colors">Itinerary</button>
<button class="pb-4 text-sm font-bold text-on-surface-variant hover:text-secondary transition-colors">Pricing &amp; Policy</button>
<button class="pb-4 text-sm font-bold text-on-surface-variant hover:text-secondary transition-colors">Reviews</button>
</div>
</div>
<!-- Itinerary Section -->
<div class="space-y-12">
<div class="relative pl-12 border-l-2 border-secondary/20">
<div class="absolute -left-[11px] top-0 w-5 h-5 rounded-full bg-secondary ring-4 ring-white"></div>
<div class="mb-4">
<span class="inline-block px-3 py-1 bg-secondary-fixed text-on-secondary-fixed text-xs font-bold rounded mb-2">Day 01</span>
<h3 class="text-xl font-bold font-headline text-on-secondary-fixed">Ho Chi Minh City - Tokyo</h3>
</div>
<p class="text-on-surface-variant leading-relaxed mb-6">Start your journey at Tan Son Nhat Airport. Flight to Narita/Haneda International Airport. Welcome dinner at a local Japanese restaurant.</p>
<img alt="Tokyo Night" class="w-full h-64 object-cover rounded-xl shadow-sm" data-alt="Modern Tokyo city skyline at dusk with glowing city lights and traffic trails" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHQV5AO4_G4HX2Ra7kRBGXjjdOavctRQTZS9wzJ-kXy7w9NxS9XR4lmw_GgaVXPRgTyiEdTaqbYs4PlmBBX7ln7mVQxofScR8DhPfbHZRM7OZkSjkvM-IqrjmU73xfspxrboJAW6R8BYL26qMEoJJr1Cl6Wl5ufZ9wgl_B80aZBRSQhiPZzLxAgGbwwWtOLYoz8JKz0LFPlbBasjYwvP-y9O7Z8tJEmPWBBd0N4XwduIu3M31Zg7eNIhe5rI6DTqr6_c-Yt80lCF8f"/>
</div>
<div class="relative pl-12 border-l-2 border-secondary/20">
<div class="absolute -left-[11px] top-0 w-5 h-5 rounded-full bg-secondary ring-4 ring-white"></div>
<div class="mb-4">
<span class="inline-block px-3 py-1 bg-secondary-fixed text-on-secondary-fixed text-xs font-bold rounded mb-2">Day 02</span>
<h3 class="text-xl font-bold font-headline text-on-secondary-fixed">Tokyo City Tour - Shinjuku - Akihabara</h3>
</div>
<p class="text-on-surface-variant leading-relaxed mb-6">Explore the heart of Tokyo. Visit Senso-ji Temple in Asakusa, take photos at Tokyo Skytree, and enjoy shopping at the bustling Akihabara electric town.</p>
<img alt="Senso-ji" class="w-full h-64 object-cover rounded-xl shadow-sm" data-alt="Traditional red gate of Senso-ji Temple in Asakusa Tokyo with tourists walking through" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDdZhOO6rt5pR5uH9Ny1CRBYDcCNjz603jhRoChdDk6aua7fiMD_QgGOjOIMFJVXJHLgipuASUavrbSj5rLdd7vuWhSgfltzg3Ve8NDA9GYGH0hE0qfIONm2uqGi643gwIYN2-ae-Lmecz-Ip7mytijWX7_bEaFzn1M1qNrC-vi85KLM4tDNFjkg7mRxRKsdE23L1oOK0JaR_Q3STADu43ws9FGNXzpPx39Q0MFKduCcwnMlwOujEKQ86CbkhgrQsMK8aJqnk7pg0do"/>
</div>
<div class="relative pl-12 border-l-2 border-secondary/20">
<div class="absolute -left-[11px] top-0 w-5 h-5 rounded-full bg-secondary ring-4 ring-white"></div>
<div class="mb-4">
<span class="inline-block px-3 py-1 bg-secondary-fixed text-on-secondary-fixed text-xs font-bold rounded mb-2">Day 03</span>
<h3 class="text-xl font-bold font-headline text-on-secondary-fixed">Mt. Fuji - Oshino Hakkai Village</h3>
</div>
<p class="text-on-surface-variant leading-relaxed mb-6">Depart for the Fuji Five Lakes area. Visit Mt. Fuji 5th Station (weather permitting) and the ancient Oshino Hakkai village with its crystal clear springs.</p>
<img alt="Oshino Hakkai" class="w-full h-64 object-cover rounded-xl shadow-sm" data-alt="Peaceful Oshino Hakkai village with traditional thatched roof houses and Mount Fuji in distance" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbmF_qTFIHzOBTsUBCBGVThBX8j8uIhEs1WjMf6zWTtAM4QhCw8o603jL-4iIvEMo6nIeQQoihzuqO5tnvYNUjAFsk5e9UENQZaccTsZCG1u2FokKZYz9c0F-d6egJpnlomiH-rvG71DCOxv9ew1_woiFKvlZ7t5aXEdLQ_ckeqNIzfZHvCJhXA0MWzBHksJhLktwLt0qzIb1e0YOgKihzzTVLYPaJD5fUwzJahW4jCjCIb9GnrSBvqP8m0DNQquFEfgJD8ndas_46"/>
</div>
<button class="w-full py-4 border-2 border-dashed border-outline-variant rounded-xl text-outline font-bold hover:border-secondary hover:text-secondary transition-all">View Full 6-Day Itinerary</button>
</div>
</div>
<!-- Sidebar / Booking Box -->
<aside class="col-span-12 lg:col-span-4">
<div class="sticky top-28 bg-white border border-surface-container p-8 rounded-2xl shadow-sm">
<div class="mb-8">
<p class="text-xs font-bold text-outline-variant uppercase tracking-widest mb-1">Starting From</p>
<div class="flex items-baseline gap-2">
<span class="text-3xl font-black text-on-primary-container">32.900.000đ</span>
<span class="text-outline text-sm">/ pax</span>
</div>
</div>
<form class="space-y-4 mb-8">
<div>
<label class="block text-[10px] font-black text-on-secondary-fixed uppercase mb-2">Departure Date</label>
<select class="w-full bg-surface-container-low border-none rounded-md py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-secondary">
<option>Oct 15, 2024</option>
<option>Oct 22, 2024</option>
<option>Nov 05, 2024</option>
</select>
</div>
<div class="grid grid-cols-2 gap-4">
<div>
<label class="block text-[10px] font-black text-on-secondary-fixed uppercase mb-2">Adults</label>
<input class="w-full bg-surface-container-low border-none rounded-md py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-secondary" min="1" type="number" value="1"/>
</div>
<div>
<label class="block text-[10px] font-black text-on-secondary-fixed uppercase mb-2">Children</label>
<input class="w-full bg-surface-container-low border-none rounded-md py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-secondary" min="0" type="number" value="0"/>
</div>
</div>
<button class="w-full bg-on-primary-container text-white py-4 rounded-md font-headline font-bold text-lg shadow-lg shadow-on-primary-container/20 hover:opacity-90 active:scale-95 transition-all" type="submit">Book This Tour</button>
</form>
<div class="space-y-4">
<button class="w-full py-4 border-2 border-secondary text-secondary rounded-md font-headline font-bold hover:bg-secondary/5 transition-all">Send Inquiry</button>
<div class="flex items-center justify-center gap-3 py-4 bg-secondary-fixed rounded-md">
<span class="material-symbols-outlined text-secondary">call</span>
<div class="text-left">
<p class="text-[10px] font-bold text-on-secondary-fixed uppercase leading-tight">Hotline 24/7</p>
<p class="text-lg font-black text-on-secondary-fixed">1800 6789</p>
</div>
</div>
</div>
</div>
</aside>
</div>
<!-- Related Tours -->
<section class="mt-20">
<div class="flex justify-between items-end mb-10">
<div>
<h2 class="text-3xl font-black font-headline text-on-secondary-fixed mb-2">Similar Experiences</h2>
<p class="text-on-surface-variant">Handpicked Japanese adventures just for you</p>
</div>
<div class="flex gap-4">
<button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-secondary hover:text-white hover:border-secondary transition-all">
<span class="material-symbols-outlined">arrow_back</span>
</button>
<button class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-secondary hover:text-white hover:border-secondary transition-all">
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24 overflow-hidden">
<!-- Related Tour 1 -->
<div class="bg-surface-container-lowest rounded-2xl group overflow-hidden transition-all duration-300">
<div class="h-64 overflow-hidden">
<img alt="Hokkaido" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Close up of pink cherry blossom branches with Osaka Castle in the background under clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQo9_nxiz0QMgpyfw8UU-5PGqoSZXGFrqqux_37YdXg_xfVBb4zfpr2oMzB_egYWQglnRjBuZJbvE5s8YvjTJxnLB7O7Gxk43W97n7d9aB8kKduFZavcwyGcaqBhGtKyrdTFZhIA2NVPKAx3iFBKQZfYOQgkNW7bINQJkiif0vxl9Kn8i0Cgi7fGRWPDk7V9YfScTxEj2a6KJKzep9HNyABrFLjmA5ZeLtHLbHHIKG5Vyj_3CgteRyucs48fjXJ7A1LDAGAsmCIgDJ"/>
</div>
<div class="p-6">
<h4 class="text-lg font-bold font-headline text-on-secondary-fixed mb-2 line-clamp-2">Khám phá Hokkaido: Mùa Hoa Tuyết Trắng</h4>
<div class="flex justify-between items-center mt-6">
<div class="flex items-center gap-2 text-outline">
<span class="material-symbols-outlined text-sm">schedule</span>
<span class="text-xs font-bold">5 Days</span>
</div>
<span class="text-on-primary-container font-black">28.500.000đ</span>
</div>
</div>
</div>
<!-- Related Tour 2 -->
<div class="bg-surface-container-lowest rounded-2xl group overflow-hidden transition-all duration-300">
<div class="h-64 overflow-hidden">
<img alt="Kyoto Cultural" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Beautiful Kinkaku-ji Golden Pavilion temple in Kyoto reflecting in calm water pond" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0yQX3CZS9OpMOmiKEdfUJtATZBz3dw7cb7MXdZTTFz-XkegLFDmx865KDcBPnyxTTOfxbs0nwmEFHjgCN2Ju26ecBmZRP7UzSeyaUB4Jzg3zI-ZSbVOL-xcauPkL2HTWUzgkukFlelpgTepbh5h35BDNnqNAmUjt1rMw5IrRuH4FfbBX5SI3ZZzjsGpZYFDMaZYtQNIY5geGTHobxSO6FBQK2qDmC_3TWWSG0MPni5ZGrj4V1J720f6kSGQJi-m5IyOkprj49YMnZ"/>
</div>
<div class="p-6">
<h4 class="text-lg font-bold font-headline text-on-secondary-fixed mb-2 line-clamp-2">Cố Đô Kyoto &amp; Trải Nghiệm Văn Hóa Trà Đạo</h4>
<div class="flex justify-between items-center mt-6">
<div class="flex items-center gap-2 text-outline">
<span class="material-symbols-outlined text-sm">schedule</span>
<span class="text-xs font-bold">4 Days</span>
</div>
<span class="text-on-primary-container font-black">22.900.000đ</span>
</div>
</div>
</div>
<!-- Related Tour 3 -->
<div class="bg-surface-container-lowest rounded-2xl group overflow-hidden transition-all duration-300">
<div class="h-64 overflow-hidden">
<img alt="Osaka Night" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" data-alt="Vibrant night streets of Osaka Dotonbori with colorful signs and neon lights reflecting on the canal" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgwCZr7a7c_rVzuFB4gZTbhQRo6qgqVBX1zd_xps1FygTVXPI8fYGLo9jK5IFRw4dxs0c9WH1-okA9okNCXZeEAboFwGJdcoPpBZGY9Rhcw6W3k1xgFe6Snpw8XZ04EnSu0hqNJZ2QO9AymEni5RJ6fShKOa7CfEMl-9YAuxvP6h2vPQtRooco6cYapgJyIwtah9hrszWsRAsKYB8dUyw86b-cBTzdBqjuLzd4KLA2eInIjJwu-KidSSTwvd8m2oq-Tyni0Rzj0FfE"/>
</div>
<div class="p-6">
<h4 class="text-lg font-bold font-headline text-on-secondary-fixed mb-2 line-clamp-2">Osaka - Kobe: Hành Trình Ẩm Thực</h4>
<div class="flex justify-between items-center mt-6">
<div class="flex items-center gap-2 text-outline">
<span class="material-symbols-outlined text-sm">schedule</span>
<span class="text-xs font-bold">6 Days</span>
</div>
<span class="text-on-primary-container font-black">26.900.000đ</span>
</div>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full pt-20 pb-10 bg-[#2e3132] dark:bg-black font-body text-base leading-relaxed">
<div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 max-w-7xl mx-auto">
<div class="space-y-6">
<div class="text-2xl font-black text-white">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm">Tận tâm phục vụ, mang đến những hành trình tuyệt vời nhất khắp năm châu.</p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-white hover:border-[#ff645a] hover:text-[#ff645a] transition-all" href="#">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
</a>
<a class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-white hover:border-[#ff645a] hover:text-[#ff645a] transition-all" href="#">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.323-1.325z"></path></svg>
</a>
</div>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-xs tracking-widest">About Us</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">About Us</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">Terms of Service</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">Privacy Policy</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">Contact Support</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-xs tracking-widest">Tours</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">Domestic Tours</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">International Tours</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] underline-offset-4 hover:underline transition-all duration-300" href="#">Group Services</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-8 uppercase text-xs tracking-widest">Newsletter</h5>
<p class="text-[#c6c5d4] text-sm mb-6">Đăng ký để nhận thông tin khuyến mãi sớm nhất.</p>
<div class="flex gap-2">
<input class="bg-[#3e4142] border-none rounded-md px-4 py-2 text-white text-sm w-full focus:ring-1 focus:ring-[#ff645a]" placeholder="Email của bạn" type="email"/>
<button class="bg-[#ff645a] text-white p-2 rounded-md hover:bg-[#ff4d42] transition-colors">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
</div>
<div class="mt-20 px-8 max-w-7xl mx-auto border-t border-outline-variant/10 pt-10">
<p class="text-[#c6c5d4] text-xs text-center">© 2024 Viet Sun Travel. All rights reserved.</p>
</div>
</footer>
</body></html>"



--about của từng châu lục 
- châu á 
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Viet Sun Travel - Khám Phá Kỳ Quan Châu Á</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#759efd",
                    "surface-container": "#edeeef",
                    "tertiary-container": "#422c00",
                    "outline-variant": "#c6c5d4",
                    "tertiary": "#271800",
                    "on-secondary-fixed": "#001945",
                    "primary-fixed-dim": "#ffb4ac",
                    "inverse-on-surface": "#f0f1f2",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f3f4f5",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed-variant": "#604100",
                    "surface-container-highest": "#e1e3e4",
                    "outline": "#767683",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#454652",
                    "on-primary-fixed-variant": "#93000d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "inverse-surface": "#2e3132",
                    "secondary-fixed-dim": "#b0c6ff",
                    "primary-fixed": "#ffdad6",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#00337c",
                    "on-tertiary-fixed": "#281900",
                    "surface-container-high": "#e7e8e9",
                    "on-secondary-fixed-variant": "#00429c",
                    "surface-tint": "#bb171c",
                    "surface-bright": "#f8f9fa",
                    "primary-container": "#680006",
                    "tertiary-fixed": "#ffdeac",
                    "surface": "#f8f9fa",
                    "on-tertiary-container": "#c98c00",
                    "error-container": "#ffdad6",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary": "#400002",
                    "surface-variant": "#e1e3e4",
                    "secondary-fixed": "#d9e2ff",
                    "on-primary-fixed": "#410002",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a"
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
        .editorial-bleed {
            margin-right: -10vw;
        }
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface">
<!-- TopAppBar -->
<nav class="fixed top-0 w-full z-50 bg-white dark:bg-slate-900 flex justify-between items-center px-8 py-4 max-w-full">
<div class="text-2xl font-bold text-[#001945] dark:text-white font-['Plus_Jakarta_Sans'] tracking-tight">
            Viet Sun Travel
        </div>
<div class="hidden md:flex items-center space-x-8 font-['Plus_Jakarta_Sans'] tracking-tight">
<a class="text-[#2b5bb5] dark:text-[#400002] font-bold border-b-2 border-[#ff645a] pb-1 hover:text-[#ff645a] transition-colors duration-300" href="#">Asia</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Europe</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Americas</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Oceania</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Africa</a>
</div>
<div class="flex items-center space-x-6">
<div class="hidden lg:flex items-center bg-surface-container-low px-4 py-2 rounded-full">
<span class="material-symbols-outlined text-outline">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-40" placeholder="Tìm kiếm điểm đến..." type="text"/>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-bold transition-all duration-200 active:scale-95 shadow-sm hover:brightness-110">
                Book Now
            </button>
</div>
</nav>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[921px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Cinematic wide shot of a traditional Japanese pagoda at sunset surrounded by cherry blossoms with soft golden lighting and mountain backdrop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4NyKnF043DaVf3mBzAAs78g2lgFq1aMWrI0zkUh51KaWM3Rh8xi8fWK3rYMVeBHnEp_IgIt4j7_dInd8B8U-tBd-u2NKXY40W7X7Y5y5R0GxhuZxwQWNCGm3-J_lao-usKs1fFVupikYb56PN9cY8t7ldgk-803qwIG2qAQF08oGYXVQsXeJmwR5yJ7k96OnwuLL4DugDTpr30bK_V6hyGPirynw4vKHD1JNHJWPX_g5k2NQLrx0EmjAsdsvuJb5RVc4ES-tF3g68"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="container mx-auto px-8 relative z-10">
<div class="max-w-3xl">
<span class="text-on-primary-container font-bold tracking-[0.2em] uppercase text-sm mb-4 block">Trải Nghiệm Độc Bản</span>
<h1 class="text-display-lg text-white font-headline font-extrabold text-6xl md:text-8xl leading-none mb-8 tracking-tighter">
                        Asian Wonders
                    </h1>
<p class="text-body-lg text-surface-variant text-xl leading-relaxed mb-10 max-w-xl">
                        Hành trình curator đưa bạn chạm tới linh hồn của Phương Đông. Từ những góc phố rực rỡ tại Tokyo đến sự bình yên của Seoul.
                    </p>
<div class="flex space-x-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold flex items-center group">
                            Khám Phá Ngay
                            <span class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- Destinaton Bento Grid -->
<section class="py-24 bg-surface">
<div class="container mx-auto px-8">
<div class="flex justify-between items-end mb-16">
<div class="max-w-2xl">
<h2 class="text-headline-md font-headline font-extrabold text-on-secondary-fixed text-4xl mb-4">Điểm Đến Biểu Tượng</h2>
<p class="text-on-surface-variant text-lg">Những hành trình được thiết kế riêng cho người lữ hành tinh tế.</p>
</div>
<div class="hidden md:block">
<div class="h-1 w-48 bg-outline-variant/20 relative">
<div class="absolute top-0 left-0 h-full w-1/3 bg-on-primary-container"></div>
</div>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[800px]">
<!-- Japan -->
<div class="md:col-span-8 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Modern Tokyo skyline at night with neon lights and bustling street traffic, vibrant urban aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2b3YpwBQQBTcdv4mEL4WC7Bfs5oI7ui9rTojgc6IMrEbiSxRldG8TXM5Dit_95UCbQZ8OyHXK8r7AdriD477gaSqYii5ei0wh1sXFxr2aZ0k1vsVLZFCsDBv-FCBF4JR32ZI5btcax0_VxCwUC_AZm-WNsLk8D45ZzR5FoGbVTVZrvP3s5KuYH2N0HAEnLJgZn4NIKbelR1gw3vqUjK9uM2htw-VNyQuQHmbm9tyfi-uqThhkXvgp1nLBerknTdMTuBzNb4CO9-Fk"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-10">
<span class="glass-badge text-white px-3 py-1 rounded text-xs font-bold mb-4 inline-block">MỚI NHẤT</span>
<h3 class="text-white text-4xl font-headline font-bold mb-2">Nhật Bản</h3>
<p class="text-surface-variant mb-6 max-w-md">Vẻ đẹp giao thoa giữa truyền thống ngàn năm và tương lai rực rỡ.</p>
<a class="text-white font-bold flex items-center border-b border-white/30 pb-1 w-fit hover:border-on-primary-container transition-colors" href="#">
                                Chi tiết hành trình <span class="material-symbols-outlined ml-2">east</span>
</a>
</div>
</div>
<!-- Korea -->
<div class="md:col-span-4 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Gyeongbokgung Palace in Seoul during autumn with colorful maple trees and traditional architecture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMMjnb0Wj-0z8kHZIWJWI8Jpudu0zRs8ws3wT7vqVCYS5hvLX53vGrR_xgHj5EFtIsdNt7XhZbdyvuRHb8nki6tYi2m1eyWs8_WW3LQuEhs9hedZekyRTpSIAV02Vf0vzohkxvbWByLqEny_O2drpam98fy2HaDvMvccvdymcG64gBE3NpYPuT5vXRO4ZxgTsMGHhGjzXvXOWgXjjXasAPWsF8twOZEopU6_BPT5IvT_fD5sYqqmd1M8AsWSdUBHol4lFt5JCSwsqa"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-8">
<h3 class="text-white text-3xl font-headline font-bold mb-2">Hàn Quốc</h3>
<p class="text-surface-variant mb-4">Sắc màu rực rỡ của Seoul Soul.</p>
</div>
</div>
<!-- Thailand -->
<div class="md:col-span-4 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Buddhist temple in Bangkok at sunrise with intricate details and serene atmosphere" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd8YXAP-U1BnezlBLPrWVhK2MygNoOMCFHBBHg8FSW-uzv1y8Z9FEIFql0-qNrq2C7Tlv3Cqbf59w832fNRAlUUhgsvMtZ2DVHk2yiv0pLO5ZRFCilmHgT5gy-i7t0eYZPQscX_hQ3EAG-mvaLbgJEfr-qoaILNCBJZEBxQgn4tLdHWU1utjLOZNdSAEHVHfT9gqZ8VSM90VgsPJp7ZQ_lX-RqaTZIbxNaH6DXrDwzFj7ZhYyvgzZ9PrQgtKnL5Rne407EgZ4iwq0K"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-8">
<h3 class="text-white text-3xl font-headline font-bold mb-2">Thái Lan</h3>
<p class="text-surface-variant mb-4">Bangkok Gems và nụ cười rạng rỡ.</p>
</div>
</div>
<!-- Singapore -->
<div class="md:col-span-8 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Gardens by the Bay in Singapore with illuminated supertrees at twilight and futuristic park design" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsiaEzt7QWj1Bbw68nQmvp2uSIG1MrWw07a6XPT_z9vwYI_2L6ruRPp1jZLKLrIA_Yqo5oKnH_VSyKTuMoXjBiBUHW0JGoOiNGnkYg_Fk5dp6HBw8SMrbpjCxTkrHrUbEPUVPiKfMOrSRtmb3Gcj9nW00IpjjgnsEMtMYbs0a8eHSIf3DKVD2FXTHn3Y4qQf8CKyuWgopnAR4j3wAcZ81MzACBk5T8pCB-SCrLWhFwW9mf_xCMfXm023cOxQOGItxCAIg9mTYWaMTa"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-10">
<h3 class="text-white text-4xl font-headline font-bold mb-2">Singapore</h3>
<p class="text-surface-variant mb-6 max-w-md">Thành phố tương lai trong lòng di sản xanh.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Featured Tours Section -->
<section class="py-24 bg-surface-container-low">
<div class="container mx-auto px-8">
<div class="mb-16">
<span class="text-[#ff645a] font-bold text-sm tracking-widest uppercase mb-2 block">Tour Tiêu Biểu</span>
<h2 class="text-headline-md font-headline font-black text-on-secondary-fixed text-4xl italic">Hành Trình Được Đề Xuất</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-10">
<!-- Tour Card 1 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0px_12px_32px_rgba(25,28,29,0.06)] group">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Mount Fuji in Japan during spring with cherry blossoms in the foreground and a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBboegrRBQXd9pRNHV6Rr6C9goP5QOivNu0f2Mx0ewYsh11i04JYRw-GQfJYuMpW2gk36Eabzbz-FQZPNje3_LMT3OD2wX0OdB38Ch364xmsTF2B2nlT8wDTjLhunKW11GdY7tdtFbVzhzErCQug7dEG-YNAV81u_wRCSUI8Gt2cJ0pQIL6EzU9sMhx4Q-xQCVvX_klR5VuVS0JNACljxti3JYwt2gNAdZ2pgssQX_oyiq5Fs_okp3uJRUip0okSDvs9CzENQBCKM_"/>
<div class="absolute top-4 left-4 glass-badge px-3 py-1 text-white text-xs font-bold rounded">PHỔ BIẾN</div>
</div>
<div class="p-8">
<h3 class="text-xl font-headline font-bold text-on-secondary-fixed mb-4">Gold Route Japan</h3>
<div class="flex items-center text-sm text-outline mb-6">
<span class="material-symbols-outlined text-xs mr-1">schedule</span> 7 Ngày 6 Đêm
                                <span class="mx-3 text-outline-variant">|</span>
<span class="material-symbols-outlined text-xs mr-1">hotel</span> Khách sạn 5*
                            </div>
<p class="text-on-surface-variant text-sm leading-relaxed mb-8">Hành trình cung đường vàng Tokyo - Kyoto - Osaka đẳng cấp nhất.</p>
<div class="flex justify-between items-center border-t border-surface-container pt-6">
<div>
<span class="text-xs text-outline uppercase font-bold block">Giá từ</span>
<span class="text-2xl font-black text-[#ff645a]">32.900.000đ</span>
</div>
<button class="bg-secondary text-white w-10 h-10 rounded-full flex items-center justify-center transition-transform active:scale-95">
<span class="material-symbols-outlined">add</span>
</button>
</div>
</div>
</div>
<!-- Tour Card 2 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0px_12px_32px_rgba(25,28,29,0.06)] group">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Brightly lit Dongdaemun Design Plaza in Seoul at night with sleek metallic architecture and urban atmosphere" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgfS7vMqk_avrP82W1JjwJPWrquIWhDmNrY-4BPYOLDOMgcl_0cj1JXcyc_mEo--1vhKj-vPWdh5_urx5a60HE2IUQkWShE4FZkhwRnUUfVtk-7mYcokOPwsItetQzRcBtZSvKVEKJ4rMiYwtMXRgqueMLm-dnM56qXfAVI1JpJo3HFtIWI3cUgchicNReAz3gOIQvpRwnrx55pjJsg7iQt4h9S-3lwW1lKc2UYfgrDg-qptt3Oe1_zE6yuWQR4Riuum6VrvEsQu2i"/>
</div>
<div class="p-8">
<h3 class="text-xl font-headline font-bold text-on-secondary-fixed mb-4">Seoul Soul</h3>
<div class="flex items-center text-sm text-outline mb-6">
<span class="material-symbols-outlined text-xs mr-1">schedule</span> 5 Ngày 4 Đêm
                                <span class="mx-3 text-outline-variant">|</span>
<span class="material-symbols-outlined text-xs mr-1">restaurant</span> Ẩm thực Local
                            </div>
<p class="text-on-surface-variant text-sm leading-relaxed mb-8">Chạm vào tâm hồn Seoul qua những trải nghiệm văn hóa đương đại.</p>
<div class="flex justify-between items-center border-t border-surface-container pt-6">
<div>
<span class="text-xs text-outline uppercase font-bold block">Giá từ</span>
<span class="text-2xl font-black text-[#ff645a]">18.500.000đ</span>
</div>
<button class="bg-secondary text-white w-10 h-10 rounded-full flex items-center justify-center transition-transform active:scale-95">
<span class="material-symbols-outlined">add</span>
</button>
</div>
</div>
</div>
<!-- Tour Card 3 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden transition-all duration-300 hover:shadow-[0px_12px_32px_rgba(25,28,29,0.06)] group">
<div class="relative h-72 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Floating market in Thailand with colorful boats full of fruits and vegetables, bustling with local merchants" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAd-sTcuH7J_mimB6pQR8iHdvb-n0GI3gmK97MXC-T5LvGuNm2B1uDXqhCVRYzOUdYQBpno0H3PqkNwrc7b5VTyiC69WZ9JTizoOFrlN_7tl_uLMhE2SMEddxVahAi7Dd76vypQdnId-cCeX4q5B5NOl1Vu5w7G0s3Yk2cpZkTZRFRIckF7Opn484TZp7RSUtynij7NGuN_aC3TzmtmkojHl1hZoocM1EL-i4A2fevDhJb44ufxXxtVaJehgEnucRvDw7EvSCdjSNG3"/>
</div>
<div class="p-8">
<h3 class="text-xl font-headline font-bold text-on-secondary-fixed mb-4">Bangkok Gems</h3>
<div class="flex items-center text-sm text-outline mb-6">
<span class="material-symbols-outlined text-xs mr-1">schedule</span> 4 Ngày 3 Đêm
                                <span class="mx-3 text-outline-variant">|</span>
<span class="material-symbols-outlined text-xs mr-1">shopping_bag</span> Shopping VIP
                            </div>
<p class="text-on-surface-variant text-sm leading-relaxed mb-8">Những viên ngọc quý của Bangkok từ chùa vàng đến thiên đường mua sắm.</p>
<div class="flex justify-between items-center border-t border-surface-container pt-6">
<div>
<span class="text-xs text-outline uppercase font-bold block">Giá từ</span>
<span class="text-2xl font-black text-[#ff645a]">12.900.000đ</span>
</div>
<button class="bg-secondary text-white w-10 h-10 rounded-full flex items-center justify-center transition-transform active:scale-95">
<span class="material-symbols-outlined">add</span>
</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Signature Gradient CTA -->
<section class="py-24 px-8 overflow-hidden">
<div class="container mx-auto max-w-6xl rounded-3xl bg-gradient-to-br from-secondary to-on-secondary-container p-12 md:p-24 relative overflow-hidden">
<div class="absolute top-0 right-0 w-1/2 h-full opacity-20 pointer-events-none">
<img class="w-full h-full object-cover" data-alt="Abstract artistic representation of Asian lanterns floating in a night sky with soft blur and warm light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqsKMTF90bmHqIUMcFFZYGNke1tA3Am4ctJGqdQcz9tuSMOfSGaEWz0PuciEcXzwBjgvwq-RE0e-J8udVY2UpiwnYpLpJNdRVxyq0T5_gGSibp_5FFkXs8QXXZGUOSPldoTBcLxO243eooaSHWZvqkiVa9xFZFPwiqo4h7DVnheUPzuiKuL61Y9EA3vnmaVmCBY6mfjHcwkcW1PhKKuUK2RxeO7oysTys9rFVfi0zYzruHd1N9TKbK9KAy_QVDBwRfcJlHsK6hv6qP"/>
</div>
<div class="relative z-10 max-w-xl">
<h2 class="text-4xl md:text-5xl font-headline font-black text-white mb-8 leading-tight">Bắt đầu hành trình lữ hành của riêng bạn.</h2>
<p class="text-white/80 text-lg mb-12">Viet Sun Travel cam kết mang lại trải nghiệm tinh hoa, chăm sóc từng chi tiết nhỏ nhất trong suốt chuyến đi.</p>
<div class="flex flex-col sm:flex-row gap-4">
<button class="bg-white text-secondary font-bold px-8 py-4 rounded-md transition-all hover:shadow-xl active:scale-95">Liên Hệ Tư Vấn</button>
<button class="border border-white/30 text-white font-bold px-8 py-4 rounded-md transition-all hover:bg-white/10">Xem Brochure 2024</button>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 max-w-7xl mx-auto font-['Be_Vietnam_Pro'] leading-relaxed">
<div class="col-span-1">
<div class="text-xl font-black text-white mb-6">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm mb-6">Chúng tôi kiến tạo những trải nghiệm du lịch đẳng cấp, kết nối văn hóa và con người qua từng hành trình tinh hoa.</p>
<div class="flex space-x-4">
<span class="material-symbols-outlined text-white cursor-pointer hover:text-[#ff645a] transition-all">social_leaderboard</span>
<span class="material-symbols-outlined text-white cursor-pointer hover:text-[#ff645a] transition-all">camera_alt</span>
<span class="material-symbols-outlined text-white cursor-pointer hover:text-[#ff645a] transition-all">alternate_email</span>
</div>
</div>
<div class="col-span-1">
<h4 class="text-[#e1e3e4] font-bold mb-6">Hành Trình</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Nhật Bản Mùa Hoa Anh Đào</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Seoul Soul Experience</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Bangkok Premium</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Singapore City Lights</a></li>
</ul>
</div>
<div class="col-span-1">
<h4 class="text-[#e1e3e4] font-bold mb-6">Thông Tin</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Về Chúng Tôi</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cẩm Nang Du Lịch</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Chính Sách Bảo Mật</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Điều Khoản Dịch Vụ</a></li>
</ul>
</div>
<div class="col-span-1">
<h4 class="text-[#e1e3e4] font-bold mb-6">Liên Hệ</h4>
<p class="text-[#c6c5d4] text-sm mb-4">
                    Tầng 12, Tòa nhà Travel, TP. Hồ Chí Minh<br/>
                    Hotline: 1900 123 456<br/>
                    Email: info@vietsuntravel.vn
                </p>
<div class="mt-8 flex">
<input class="bg-white/10 border-none rounded-l-md px-4 py-2 text-white text-sm w-full focus:ring-1 focus:ring-[#ff645a]" placeholder="Email nhận ưu đãi" type="email"/>
<button class="bg-[#ff645a] text-white px-4 py-2 rounded-r-md">
<span class="material-symbols-outlined text-sm">send</span>
</button>
</div>
</div>
</div>
<div class="mt-20 pt-8 border-t border-white/5 text-center">
<p class="text-[#c6c5d4] text-xs">© 2024 Viet Sun Travel. Curated Editorial Experiences.</p>
</div>
</footer>
</body></html>"

=châu âu 
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Viet Sun Travel - European Elegance</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#759efd",
                    "surface-container": "#edeeef",
                    "tertiary-container": "#422c00",
                    "outline-variant": "#c6c5d4",
                    "tertiary": "#271800",
                    "on-secondary-fixed": "#001945",
                    "primary-fixed-dim": "#ffb4ac",
                    "inverse-on-surface": "#f0f1f2",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f3f4f5",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed-variant": "#604100",
                    "surface-container-highest": "#e1e3e4",
                    "outline": "#767683",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#454652",
                    "on-primary-fixed-variant": "#93000d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "inverse-surface": "#2e3132",
                    "secondary-fixed-dim": "#b0c6ff",
                    "primary-fixed": "#ffdad6",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#00337c",
                    "on-tertiary-fixed": "#281900",
                    "surface-container-high": "#e7e8e9",
                    "on-secondary-fixed-variant": "#00429c",
                    "surface-tint": "#bb171c",
                    "surface-bright": "#f8f9fa",
                    "primary-container": "#680006",
                    "tertiary-fixed": "#ffdeac",
                    "surface": "#f8f9fa",
                    "on-tertiary-container": "#c98c00",
                    "error-container": "#ffdad6",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary": "#400002",
                    "surface-variant": "#e1e3e4",
                    "secondary-fixed": "#d9e2ff",
                    "on-primary-fixed": "#410002",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a"
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
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .editorial-shadow:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
        }
        .signature-gradient {
            background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
        }
    </style>
</head>
<body class="bg-background text-on-background">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white dark:bg-slate-900 flex justify-between items-center px-8 py-4 max-w-full font-['Plus_Jakarta_Sans'] tracking-tight">
<div class="text-2xl font-bold text-[#001945] dark:text-white">Viet Sun Travel</div>
<div class="hidden md:flex gap-8">
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Asia</a>
<a class="text-[#2b5bb5] dark:text-[#400002] font-bold border-b-2 border-[#ff645a] pb-1" href="#">Europe</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Americas</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Oceania</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Africa</a>
</div>
<button class="bg-on-primary-container text-white px-6 py-2.5 rounded-md font-bold hover:scale-95 duration-200 transition-transform shadow-[inset_0_1px_0_rgba(255,255,255,0.1)]">
            Book Now
        </button>
</nav>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Dreamy sunset over the Eiffel Tower and Parisian rooftops with soft golden lighting and editorial fashion aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4P2JX3rKPzI5v_OYU-GfdkUshBRZ8fGVGOhg9hRHet_yMUTQZ7tNKKO07N4_c-_HStto5YwJ4Q7frwGWgXXQ4-jaMF65pvg6gK8okA6vXLPo21-KoDDYuw39i1jReH5kC8WUrOsdtxkbnmg97kd_imEC6sTqSOlqb0cw3jE27CElapdaLpRPMYgyP4GaiWyBtuTtKhBBgFD90WlLPKmdEAo4-znI2dCvGIQkkiOltA31-Cex0u1y_3J6ORQscJc4opUtVY9Vqjzvq"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 px-12 md:px-24 max-w-4xl text-white">
<span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest uppercase bg-on-primary-container rounded-sm">Premium Selection</span>
<h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter mb-6 leading-[0.9]">European Elegance</h1>
<p class="text-xl md:text-2xl font-light leading-relaxed max-w-2xl opacity-90 mb-10 font-body">
                    Hành trình tinh hoa đưa bạn đến với trái tim của Châu Âu cổ kính. Khám phá vẻ đẹp lãng mạn của Pháp, sự hùng vĩ của Thụy Sĩ và kho tàng văn hóa vĩ đại của Ý.
                </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold text-lg hover:opacity-90 transition-opacity">Khám Phá Ngay</button>
<button class="border border-white/40 backdrop-blur-md px-8 py-4 rounded-md font-bold text-lg hover:bg-white hover:text-on-secondary-fixed transition-all">Tư Vấn Miễn Phí</button>
</div>
</div>
</section>
<!-- Asymmetric Intro -->
<section class="py-24 bg-surface-container-low px-12">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-16 items-center">
<div class="md:col-span-5 md:col-start-2">
<h2 class="text-4xl font-extrabold text-on-secondary-fixed mb-8 leading-tight">Tuyệt Tác Nghệ Thuật Của Những Chuyến Đi</h2>
<p class="text-on-surface-variant text-lg leading-relaxed mb-6">
                        Viet Sun Travel không chỉ bán những chuyến đi, chúng tôi kiến tạo những trải nghiệm biên niên sử. Mỗi hành trình được thiết kế như một tác phẩm nghệ thuật, nơi dịch vụ đẳng cấp gặp gỡ những giá trị văn hóa bản địa sâu sắc.
                    </p>
<a class="text-secondary font-bold flex items-center gap-2 group" href="#">
                        Tìm hiểu về phong cách Viet Sun 
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
<div class="md:col-span-6 relative">
<img class="rounded-lg shadow-2xl w-full h-[500px] object-cover" data-alt="Stunning aerial view of Positano village on the Amalfi Coast Italy with colorful houses clinging to cliffs and turquoise sea" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBn5vvcY9tvhLRY2iMx20BrRk2eRNEqXYKUGuvI_W5uzJseUGafgNEthOwyJKyR87DsDQED2GVsfRc2UcmIe-sUEDFONlWN11QNb8jI2GVv1j6vHyDXpw2ZGMnJYf3KmfU90tpPqdtk6kGxNKWRV975xXqUJ67Ka6dzw6KZ9buP5DtKWa2HwDALOtjQkBfE5D3P4jbYTrn37sECCtvYQcU2RwvgMUabanH3xGLTP6ss5-1D6_fo2o0-ywY3ZgR8tpHTdlMc-L5Wa0L7"/>
<div class="absolute -bottom-8 -left-8 bg-white p-8 rounded-lg shadow-xl hidden md:block max-w-[240px]">
<p class="text-4xl font-black text-on-primary-container mb-2">15+</p>
<p class="text-sm font-bold text-on-secondary-fixed">Năm kinh nghiệm kiến tạo tour Châu Âu cao cấp</p>
</div>
</div>
</div>
</section>
<!-- Bento Grid Tours -->
<section class="py-24 px-12 bg-surface-container-lowest">
<div class="max-w-7xl mx-auto">
<div class="mb-16">
<h2 class="text-sm font-bold text-on-primary-container tracking-[0.3em] uppercase mb-4">Hành trình tiêu biểu</h2>
<div class="flex justify-between items-end">
<h3 class="text-5xl font-extrabold text-on-secondary-fixed tracking-tight">Cảm Hứng Châu Âu</h3>
<div class="flex gap-2">
<span class="w-12 h-1 bg-on-primary-container"></span>
<span class="w-12 h-1 bg-outline-variant"></span>
</div>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Featured Large Card: Parisian Romance -->
<div class="md:col-span-2 group relative overflow-hidden rounded-lg bg-surface-container-low transition-all editorial-shadow">
<div class="aspect-[16/10] overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Elegant street cafe in Paris with red awnings and wicker chairs at sunrise with warm soft light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFgR-ETyGU4oVbQpjEtB_KU-BY-0iCQ2CvVdQCPb0mHiTQmZoruxvXZtQ0_H-03qaGLdKyTQOCBQxTBtuqtfLSNuXSERMLR3gaQLLn_fjXVqiA2iSx2Wh4FzKdRfOYivrE5Va3-s6awtXGCP2nX0lBkgCe3jpsmBOTElztE1Iy8lPTITJbrn-pLZnY8EMo0y1y0lyd5pnE_N7J79cQwyZdsDeC3H4EVbb0uLcWiBqfCqeGZlV9Cw8DL8m7p00-ahbRLkAeUap2gIGZ"/>
</div>
<div class="absolute top-6 left-6 glass-badge px-4 py-2 rounded-full text-white text-xs font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            FEATURED TOUR
                        </div>
<div class="p-8">
<div class="flex justify-between items-start mb-4">
<div>
<h4 class="text-3xl font-bold text-on-secondary-fixed mb-2">Parisian Romance</h4>
<p class="text-on-surface-variant">Pháp - Bỉ - Hà Lan | 9 Ngày 8 Đêm</p>
</div>
<div class="text-right">
<p class="text-sm font-bold text-outline uppercase tracking-wider">Từ</p>
<p class="text-3xl font-black text-on-primary-container">68.900.000đ</p>
</div>
</div>
<button class="text-secondary font-bold flex items-center gap-2 group/btn mt-4">
                                Chi tiết hành trình
                                <span class="material-symbols-outlined transition-transform group-hover/btn:translate-x-1">arrow_forward</span>
</button>
</div>
</div>
<!-- Swiss Alps Adventure -->
<div class="group relative overflow-hidden rounded-lg bg-surface-container-low transition-all editorial-shadow">
<div class="aspect-square overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Majestic snow-capped Swiss Alps peaks with a classic red mountain train winding through green meadows" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_MW9vDTt5jAkkRW62O41JZuXJDMxzDq06BXqhCWMXwlNdF2kJ-oB56QAfWZO6svep_H2Vf5r5EJPWxcVegdR7BYl766p76MWgX-pHvivpPNo7F8i7fhpucioc838nLsmgqLZqn3NEFghHQtAv_KuVjHvKGwNDaWBMG2hjkKgx-jbDzkyBZpCFOH0O8tye4xYj551cHTglfGWBbXTdF-fXzXtpsCmdzTb1lS1EfRjEUCvU2IMDEeOZ5tCScmnQ5f_A7XgMoKd6zFlf"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-bold text-on-secondary-fixed mb-2">Swiss Alps Adventure</h4>
<p class="text-on-surface-variant mb-4">Thụy Sĩ Tinh Khôi | 7 Ngày</p>
<div class="pt-4 border-t border-outline-variant/30 flex justify-between items-center">
<p class="text-2xl font-black text-on-primary-container">82.500.000đ</p>
<span class="material-symbols-outlined text-secondary">explore</span>
</div>
</div>
</div>
<!-- Grand Tour of Europe -->
<div class="group relative overflow-hidden rounded-lg bg-surface-container-low transition-all editorial-shadow">
<div class="aspect-square overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Classic Roman architecture of the Colosseum in Rome Italy at dusk with glowing warm street lights" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDevFWr2it2r9uy29OqBQVRmKltYR7iyJX2dCjsiizZKRW0d0gHhJXqrIg0f7ZZHrDJjviBf5YhK6Zz00Cu6U5U8c-45KyNF5WI1BjntB4S2WFQS3xHSGQHLKjot_y4hPs0WHVJt2YCei1J26_nAEFY3dBLSCoHXpFHC_G_Ey3X77OR26HdXbYW-kIDKo8shspMhjG6U1b7wYWFKjUmKt-TrLrTlk4z8qvZ-avfX-vtaremC6hen3Wl_FuAatRAZlcZNPeia6LufGir"/>
</div>
<div class="p-8">
<h4 class="text-2xl font-bold text-on-secondary-fixed mb-2">Grand Tour of Europe</h4>
<p class="text-on-surface-variant mb-4">Pháp - Ý - Anh Quốc | 15 Ngày</p>
<div class="pt-4 border-t border-outline-variant/30 flex justify-between items-center">
<p class="text-2xl font-black text-on-primary-container">125.000.000đ</p>
<span class="material-symbols-outlined text-secondary">flight_takeoff</span>
</div>
</div>
</div>
<!-- UK Royal Journey -->
<div class="md:col-span-2 group relative overflow-hidden rounded-lg bg-surface-container-low transition-all editorial-shadow flex flex-col md:flex-row">
<div class="md:w-1/2 overflow-hidden h-full">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Big Ben and Westminster Bridge in London UK with classic red double-decker buses in the foreground" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGjGYwOUrkxGIHZ3UqubD0OnH9RP2N7ySUmjC__HvJLlUe0od-3nCjVqExex2FdxM2NMh0swLvWav8-qUKcIb2iw6SV8KZIi2K-e_4lYkuuQWOe_n-TRnSkwnVtpuqz7REbHz9ONpARRTY_SjD_SEqSES53j8EU3DAMMs5r7cSs0IL4tXBOhXuxb0HHeADo53V2avjlCWmL4WK52azX3Je3wrk8-xoUOr-Vgk0K-bRkEmRUPRH2WBgiEZ8aGeSvDrSpxTCoG-xfwHE"/>
</div>
<div class="md:w-1/2 p-10 flex flex-col justify-center">
<span class="text-on-primary-container font-black text-xs tracking-widest mb-2">LIMITED EDITION</span>
<h4 class="text-3xl font-bold text-on-secondary-fixed mb-4">UK Royal Journey</h4>
<p class="text-on-surface-variant mb-6 leading-relaxed">Khám phá vẻ đẹp hoàng gia từ London sầm uất đến những ngôi làng cổ kính vùng Cotswolds.</p>
<div class="flex justify-between items-end">
<div>
<p class="text-sm text-outline font-bold">GIÁ TRỌN GÓI</p>
<p class="text-3xl font-black text-on-primary-container">94.900.000đ</p>
</div>
<button class="bg-on-secondary-container text-white p-3 rounded-full hover:scale-110 transition-transform">
<span class="material-symbols-outlined">add</span>
</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Newsletter / Signature Section -->
<section class="py-24">
<div class="max-w-7xl mx-auto px-12">
<div class="signature-gradient rounded-3xl p-16 relative overflow-hidden flex flex-col md:flex-row items-center gap-12">
<div class="relative z-10 md:w-1/2">
<h3 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">Nhận Cẩm Nang Du Lịch Châu Âu Biên Soạn Riêng</h3>
<p class="text-secondary-fixed-dim text-lg mb-8 opacity-90">Đăng ký để nhận những gợi ý điểm đến ẩn mình và các ưu đãi đặc quyền dành riêng cho khách hàng thân thiết.</p>
<form class="flex flex-col sm:flex-row gap-4">
<input class="flex-1 px-6 py-4 rounded-md border-none focus:ring-2 focus:ring-on-primary-container text-on-surface" placeholder="Email của bạn..." type="email"/>
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:bg-white hover:text-on-primary-container transition-all">Đăng Ký Ngay</button>
</form>
</div>
<div class="md:w-1/2 relative z-10 flex justify-center">
<div class="relative">
<div class="w-64 h-80 rounded-lg overflow-hidden border-8 border-white/10 rotate-3">
<img class="w-full h-full object-cover" data-alt="Close up of a travel journal and vintage camera on a wooden table with a map of Europe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3f0yFyLiZqVQUlCtEZ1Chtj26MVljW6ObRh5niRdhzCL8kX9in4qhh4zc6ebAj6FW-QkS72jjPmcmQmrXT4rstTZg5Uxpf0bXKYOpSFcZzEc9qZYAsDeEz9ibmHBGsQGpvB0iaU0b7zn778TeNaFX96Xv5K3ldBXy9_ICbNdbn5FR0OBWywF1YqWBxZSM_aXCDpPFdoIzEFo1yMVlkwKrObo-FqYhNMKAOeiz1w7TZMpHf1BZe_rTTiyS44riV6vqgt5OTyx_ykRK"/>
</div>
<div class="absolute -top-6 -right-6 w-48 h-64 rounded-lg overflow-hidden border-8 border-white/20 -rotate-6 shadow-2xl">
<img class="w-full h-full object-cover" data-alt="Scenic view of a medieval German town with half-timbered houses and cobblestone streets" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2mq7oGneuxTTSKpjwqY7DkGQz87sEekpjw-Ue6mXBiOybG4oz-3l5s4I3Qsse2vDChDb3t9j_xaqskud89bPW6ZdHzc8fwBKsPiEJNe49bysIu7YchwUYuM5BHBctaAonpHvE4Qr54RT1ZKYKU-sxJggZvgNrKn-IDmMtk663NzeJrIVOtq32YmtHtNtu82MHLaz0qUz8A704TNgLAlYn3ubiJpKIcGnageBPxmfMi0NaF1EenGAdMY5dAGJ1d-DtARN2SgkvNvZ_"/>
</div>
</div>
</div>
<!-- Decorative element -->
<div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10 font-['Be_Vietnam_Pro'] leading-relaxed">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 max-w-7xl mx-auto">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-black text-white mb-6">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm mb-6 max-w-xs">Chuyên gia tổ chức các hành trình trải nghiệm đẳng cấp thế giới, mang đến giá trị tinh hoa trong từng chuyến đi.</p>
<div class="flex gap-4">
<span class="material-symbols-outlined text-[#ff645a] cursor-pointer hover:opacity-80 transition-all">public</span>
<span class="material-symbols-outlined text-[#ff645a] cursor-pointer hover:opacity-80 transition-all">mail</span>
<span class="material-symbols-outlined text-[#ff645a] cursor-pointer hover:opacity-80 transition-all">phone_in_talk</span>
</div>
</div>
<div>
<h5 class="text-white font-bold mb-6">Khám Phá</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">About Us</a></li>
<li><a class="text-[#ff645a]" href="#">Destinations</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Travel Guides</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6">Hỗ Trợ</h5>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Contact</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Privacy Policy</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Terms of Service</a></li>
</ul>
</div>
<div>
<h5 class="text-white font-bold mb-6">Văn Phòng</h5>
<p class="text-[#c6c5d4] text-sm mb-2">240 Lý Chính Thắng, Phường 9, Quận 3, TP. Hồ Chí Minh</p>
<p class="text-[#c6c5d4] text-sm mb-2">Hotline: 1800 5555</p>
<p class="text-[#c6c5d4] text-sm">Email: info@vietsuntravel.com</p>
</div>
</div>
<div class="max-w-7xl mx-auto px-12 mt-20 pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="text-[#c6c5d4] text-xs">© 2024 Viet Sun Travel. Curated Editorial Experiences.</p>
<div class="flex gap-6">
<span class="text-[#c6c5d4] text-xs cursor-pointer hover:text-[#ff645a]">Facebook</span>
<span class="text-[#c6c5d4] text-xs cursor-pointer hover:text-[#ff645a]">Instagram</span>
<span class="text-[#c6c5d4] text-xs cursor-pointer hover:text-[#ff645a]">LinkedIn</span>
</div>
</div>
</footer>
</body></html>"

- châu mỹ 
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#759efd",
                    "surface-container": "#edeeef",
                    "tertiary-container": "#422c00",
                    "outline-variant": "#c6c5d4",
                    "tertiary": "#271800",
                    "on-secondary-fixed": "#001945",
                    "primary-fixed-dim": "#ffb4ac",
                    "inverse-on-surface": "#f0f1f2",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f3f4f5",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed-variant": "#604100",
                    "surface-container-highest": "#e1e3e4",
                    "outline": "#767683",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#454652",
                    "on-primary-fixed-variant": "#93000d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "inverse-surface": "#2e3132",
                    "secondary-fixed-dim": "#b0c6ff",
                    "primary-fixed": "#ffdad6",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#00337c",
                    "on-tertiary-fixed": "#281900",
                    "surface-container-high": "#e7e8e9",
                    "on-secondary-fixed-variant": "#00429c",
                    "surface-tint": "#bb171c",
                    "surface-bright": "#f8f9fa",
                    "primary-container": "#680006",
                    "tertiary-fixed": "#ffdeac",
                    "surface": "#f8f9fa",
                    "on-tertiary-container": "#c98c00",
                    "error-container": "#ffdad6",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary": "#400002",
                    "surface-variant": "#e1e3e4",
                    "secondary-fixed": "#d9e2ff",
                    "on-primary-fixed": "#410002",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a"
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
        .tonal-shift-bg-to-surface-low {
            background-color: #f3f4f5;
        }
        .signature-gradient {
            background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
        }
        .glass-badge {
            background: rgba(225, 227, 228, 0.4);
            backdrop-filter: blur(20px);
        }
        .editorial-shadow:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- Top Navigation Bar -->
<nav class="fixed top-0 w-full z-50 bg-white dark:bg-slate-900 flex justify-between items-center px-8 py-4 max-w-full font-['Plus_Jakarta_Sans'] tracking-tight">
<div class="text-2xl font-bold text-[#001945] dark:text-white">Viet Sun Travel</div>
<div class="hidden md:flex space-x-8">
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Asia</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Europe</a>
<a class="text-[#2b5bb5] dark:text-[#400002] font-bold border-b-2 border-[#ff645a] pb-1 hover:text-[#ff645a] transition-colors duration-300" href="#">Americas</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Oceania</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Africa</a>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:flex items-center bg-surface-container px-4 py-2 rounded-full">
<span class="material-symbols-outlined text-outline mr-2">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Tìm kiếm hành trình..." type="text"/>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-bold hover:scale-95 transition-transform duration-200 shadow-inner">Book Now</button>
</div>
</nav>
<main class="pt-20">
<!-- Hero Section: Editorial Style -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Modern New York City skyline at sunset with golden light reflecting off skyscrapers and the Hudson River" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAd4mIlQpoGHQfgSu1Aq7287uYpCGOAgO-0tXG8fzkJF0MDH1jiuNEpqnqBqsOhrYok3rWq857vLRxOEfOdf3txFlaPpqQ_iHnkn8bjNEXYbg5_WIXnzQfwGdc5M5kP862MMbPLWCWwMH203swLTKBu4pBoxcP_fUNgg-gFLpYyt8VDaKhxICjIn3NZeKrQCCPaqUnOFoz39UCHrPro_3hcBVfnR_H6jmCqOa94oMh2_GWi7XQN9J07ERoqzJHm6RQpj3o90cNbCvF6"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
<div class="max-w-2xl">
<span class="text-on-primary-container font-bold tracking-widest uppercase text-sm mb-4 block">Hành trình Khám phá Châu Mỹ</span>
<h1 class="font-headline text-white text-6xl md:text-8xl font-extrabold tracking-tighter leading-[0.9] mb-6">
                        The New World <br/>Discovery
                    </h1>
<p class="text-white/90 text-xl leading-relaxed mb-8 max-w-lg">
                        Trải nghiệm sự hùng vĩ từ những dãy núi Rocky tuyết phủ đến nhịp sống sôi động của Manhattan. Một hành trình được biên tập riêng cho những tâm hồn khao khát tự do.
                    </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:scale-95 transition-all">Khám phá ngay</button>
<button class="border border-white/40 text-white px-8 py-4 rounded-md font-bold hover:bg-white/10 transition-all">Tư vấn miễn phí</button>
</div>
</div>
</div>
</section>
<!-- Destination Highlights: Asymmetric Bento Grid -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16">
<div>
<h2 class="font-headline text-4xl font-extrabold text-on-secondary-fixed mb-4">Điểm đến tâm điểm</h2>
<p class="text-on-surface-variant max-w-md">Những vùng đất hứa với vẻ đẹp kỳ quan thiên nhiên và tinh hoa kiến trúc hiện đại.</p>
</div>
<div class="mt-6 md:mt-0">
<span class="text-secondary font-bold cursor-pointer flex items-center gap-2 group">
                            Xem tất cả điểm đến 
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-[800px]">
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Gate Bridge in San Francisco shrouded in morning fog with soft blue and orange hues" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAt7Jjz7OY9D22MCMrywPV0iirfcorjf_5lQFN7L09syXWkwNxolLKU6hYPK9bLJF-UiRR_02JPWbWhRJyUhEZEanvXjeQRnjQcgj4kVP-P7dsxEtb1Fs3rPRKkTNyWGowDl17XKwXCfXNPqVdXoyK0pQPF_TbTERPretIInnUvkchI0y3P16QwLQtAJoyHPl4lWli7wnbIFUXrl3BG-NqBGYv9MhN_54dwVLghOEzhuSpdoknpsPCE40xeWm7OQ7jNAtf6HGrKkicM"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">MỸ</span>
<h3 class="text-3xl font-bold">USA: Miền Đất Hứa</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Aerial view of Christ the Redeemer statue in Rio de Janeiro overlooking the lush green mountains and bay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwW4m3eyNi9OTYrxjyLy-cPY5ZrdKLZ2daF5mxucrwIDKA7mf5VStd1mcSJ65DHJ10AVcAg04zxpMizqh7VLmBftEWcyDyANQ9iy-PK1NGgL_H7HjGY_3pAzn01fs4cL-mq0HXVe_Xm7UibCOz3ZSpPdNcUzL_iEmnA6f2BIUXXr6M8qSp_s5Yb8NZ2fHRHdvLSGw736wxqxlYnXPhgCr03EQmYjj87jLf_-nE6X0OvB8YOzS9hIU_nBsW3UVAfg9MZoOTqqSQfjW5"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">BRAZIL</span>
<h3 class="text-2xl font-bold">Sắc màu Latin</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Ancient ruins of Machu Picchu in Peru with green terraced mountains under a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnGih2cV12VWelE02rNU5DTrkOOqbAxUbr_36TI1xlJlyCEhUTvZDtwatSdc92d5hsCP7MfMD4uSFLMaOKG6-I5vKF6pqY7aWSgXJS0QH8PhVuTcMySGT51AxSDyJFaTwv0SGLpJvZ_Cj_-0_dyEv2DMy0xQFZvdp8KW3Ilhbk10FYS_mhaHRsbXiNhaeY9VrAZWFGgjMqaKw4cGnOfcPgfyTzdgOPMWhseuQlY90PLphOAEK3VRVLEU5_QIWskbQqEBGyVcWEM8pI"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">PERU</span>
<h3 class="text-2xl font-bold">Huyền thoại Inca</h3>
</div>
</div>
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Snow-capped Canadian Rockies reflected in a crystal clear turquoise glacial lake surrounded by pine trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7aog5oAAsYR3sMnOaPKb99HdOk0P6CO0_LmYlWChCyhIqWkS6JkpaFFh7Y52k5FgkRoTaqRLhmscEN6vCtzxYILreAwfktEFJrGJ3Yml4HGdhi2M565Qr0aZn10Bi08gZlP5vZt0pQ1pHC97_cRiwiQNssFYfcIRaoTXDPYPOcCrHF_PIee_LLoPJqTo9T6aFN7T8W14Xft5XxqKSWcBCf2Iqofl0EfCRmPd5YrWsdObPgrPaTapUsuhu3LmFAHuO86Zh8tcmsjKn"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">CANADA</span>
<h3 class="text-3xl font-bold">Kỳ quan Rockies</h3>
</div>
</div>
</div>
</div>
</section>
<!-- Featured Tours: Editorial List -->
<section class="py-24 bg-white">
<div class="max-w-7xl mx-auto px-8">
<div class="text-center mb-20">
<h2 class="font-headline text-5xl font-black text-on-secondary-fixed mb-4">Hành trình Tuyển chọn</h2>
<div class="w-24 h-1 bg-on-primary-container mx-auto"></div>
</div>
<div class="space-y-12">
<!-- Tour Card 1 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Vibrant night scene of Times Square in New York City with bright neon billboards and yellow taxis" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXQWJCk59wDaGDmualKtcY8s8cAKVS_2heY0W1eJEr5UGqpsNT0S7TCE0W1ctv75Q8fieaiGdgF3fw9U98iaLubrT_9KyFvFP7BN8qKOPn_lAjEuHHo7skIUxF-4crr2unkKfTMn3iLpbKEdbRHrQw_BuQ1mD04gqtbKdTooX-4m1kr4i73XA7yUPG3unZ5yfN0QjqlHEB5g9fBfL9Mu3rE_WaOOvFOZ8O6ei55im-vUnYFkFR_NGFuBNnoBzuxUAPgrzHPZcM7kob"/>
<div class="absolute top-4 left-4 glass-badge px-4 py-2 rounded-full flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">stars</span>
<span class="text-xs font-bold text-on-secondary-fixed">Bán chạy nhất</span>
</div>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">9 Ngày 8 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">US East Coast Explorer</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Từ thủ đô Washington D.C cổ kính đến sự nhộn nhịp của New York và vẻ đẹp lãng mạn của Philadelphia. Một chuyến đi gói gọn linh hồn của nước Mỹ.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">85.900.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 2 -->
<div class="flex flex-col lg:flex-row-reverse gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Panoramic view of Moraine Lake in the Canadian Rockies with stunning blue water and majestic mountains" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOTY7d2-3tGzcTW4re5L5jSfJsiRqw8FBJ-h7p305fj02q3DpfzoqKgItIl5wedVVbOr8VFGVQvCxMP7Nsqckx_-jmNomP_goeYuon4kZxcgqje5HS5E-O45O-RakHGhoOLBCym-mpuP7Pxf532v-PXUzsgmestpcal62hqObyn1NR96Zqw8MNphu6TVb2l3gDaMAQ_eVTgz9Ir1ICbmGmbLjkLueWjx-okxMURvGlbR4hbi1JCGcKxXZCL8dLQCDBSWK29eoX3d05"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">12 Ngày 11 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Canadian Rockies</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Đắm mình vào thiên nhiên hùng vĩ của vườn quốc gia Banff và Jasper. Khám phá những hồ nước xanh ngọc bích và các rặng núi tuyết vĩnh cửu.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">112.500.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 3 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Lush green valley of Machu Picchu at sunrise with soft mist clinging to the ancient stone structures" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClXM3q9A5252wRJsTAbsxT7K6SX54YRUPtL54O_2zqe86O_-o2Ena7iI2tZm0wukiLtZ59O7f29fMmqZsit8qyF9VGOsZLpbBIhj1UMIa6y7DzXKgXX8kGlgJfPnr-oRzZ8WPYG-eeqv18RgGZY2MpIx14kGjA_89iPdKsNDvKp3NiGPE9uuThKbEB_5h45eL9Ug-89QXc4s6mcclB8FeUyYOJG2K-dlv45VFzXtIwhqtE_SvB9Pk2u_AqiNy7z1fEAzPr0tUewm2B"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">14 Ngày 13 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Machu Picchu Trail</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Hành trình đi tìm thành phố đã mất của người Inca. Một chuyến đi đầy thử thách nhưng vô cùng xứng đáng cho những ai yêu thích lịch sử và khám phá.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">98.000.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Signature Experience Banner -->
<section class="signature-gradient py-24 relative overflow-hidden">
<div class="absolute right-0 top-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[400px]" style="font-variation-settings: 'FILL' 1;">public</span>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 text-center lg:text-left">
<div class="flex flex-col lg:flex-row items-center gap-16">
<div class="lg:w-3/5">
<h2 class="font-headline text-white text-5xl font-extrabold mb-6 leading-tight">Dịch vụ Curated cho <br/>Trải nghiệm Thượng lưu</h2>
<p class="text-white/80 text-xl mb-10 max-w-2xl">
                            Chúng tôi không chỉ bán tour. Chúng tôi thiết kế những trải nghiệm mang đậm dấu ấn cá nhân, từ việc chọn khách sạn Boutique đến các bữa tối Michelin độc bản.
                        </p>
<div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">verified_user</span>
<span class="text-white font-medium">Bảo hiểm Cao cấp</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">support_agent</span>
<span class="text-white font-medium">Hỗ trợ 24/7</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">hotel</span>
<span class="text-white font-medium">Khách sạn 5 sao</span>
</div>
</div>
<button class="bg-white text-secondary px-10 py-4 rounded-md font-black hover:bg-on-primary-container hover:text-white transition-all shadow-xl">Liên hệ thiết kế Tour riêng</button>
</div>
<div class="lg:w-2/5">
<div class="relative p-4 bg-white/10 rounded-2xl backdrop-blur-md">
<img class="rounded-xl shadow-2xl" data-alt="Happy couple toast with champagne on a luxury private yacht during a sunset cruise" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw-CN1cKxV4K9u8G00NPxTiP7sBpJXsZAbRwpGlRBJskz3s_0ft-wDQIihWmDEFIkOCuVKYBj4SxUvKHgItXIxlkX0n6KH-UeEs3BjITy4E5gRZjt0BbQF8RnzT5hIj5p6lkpwXQJAfjYM7VRJauGJm0WTwHOLw2qHKmiuhRa1Pv25_joImKUBGmHkedcKqvDy03PEPDwgTdVo8bsyFY0F5QLL1duPULmQ-lrhKYbvW57bLgas-2o4SgIIOtA50EvvFEjXGNGWPUll"/>
</div>
</div>
</div>
</div>
</section>
<!-- Social Proof / Press -->
<section class="py-16 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<p class="text-center text-outline-variant font-bold tracking-[0.2em] uppercase text-xs mb-8">Đối tác &amp; Tạp chí Du lịch</p>
<div class="flex flex-wrap justify-center gap-12 lg:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
<span class="font-headline text-2xl font-black text-on-surface">VOGUE</span>
<span class="font-headline text-2xl font-black text-on-surface">Travel+Leisure</span>
<span class="font-headline text-2xl font-black text-on-surface">MONOCLE</span>
<span class="font-headline text-2xl font-black text-on-surface">Condé Nast</span>
<span class="font-headline text-2xl font-black text-on-surface">Forbes Travel</span>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10 font-['Be_Vietnam_Pro'] leading-relaxed">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 max-w-7xl mx-auto">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-black text-white mb-6">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm mb-6">
                    Đơn vị lữ hành cao cấp hàng đầu Việt Nam, chuyên cung cấp những trải nghiệm du lịch mang tính biên tập và sang trọng trên toàn thế giới.
                </p>
<div class="flex gap-4">
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">social_leaderboard</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">camera_alt</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">youtube_activity</span>
</div>
</div>
<div>
<h4 class="text-white font-bold mb-6">About Us</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Về chúng tôi</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đội ngũ chuyên gia</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Tuyển dụng</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đối tác du lịch</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Travel Guides</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cẩm nang Visa Mỹ</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Thời điểm đi Canada</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Văn hóa Latinh</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Blog hành trình</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Contact</h4>
<ul class="space-y-4">
<li class="flex items-start gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm mt-1">location_on</span>
<span class="text-[#c6c5d4] text-sm">230 Nam Kỳ Khởi Nghĩa, Quận 3, TP.HCM</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">phone</span>
<span class="text-[#c6c5d4] text-sm">1800 5555 99</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">mail</span>
<span class="text-[#c6c5d4] text-sm">info@vietsuntravel.com</span>
</li>
</ul>
</div>
</div>
<div class="mt-20 pt-8 border-t border-white/5 text-center">
<p class="text-[#c6c5d4] text-xs">© 2024 Viet Sun Travel. Curated Editorial Experiences.</p>
</div>
</footer>
</body></html>"

-- châu úc 
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#759efd",
                    "surface-container": "#edeeef",
                    "tertiary-container": "#422c00",
                    "outline-variant": "#c6c5d4",
                    "tertiary": "#271800",
                    "on-secondary-fixed": "#001945",
                    "primary-fixed-dim": "#ffb4ac",
                    "inverse-on-surface": "#f0f1f2",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f3f4f5",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed-variant": "#604100",
                    "surface-container-highest": "#e1e3e4",
                    "outline": "#767683",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#454652",
                    "on-primary-fixed-variant": "#93000d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "inverse-surface": "#2e3132",
                    "secondary-fixed-dim": "#b0c6ff",
                    "primary-fixed": "#ffdad6",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#00337c",
                    "on-tertiary-fixed": "#281900",
                    "surface-container-high": "#e7e8e9",
                    "on-secondary-fixed-variant": "#00429c",
                    "surface-tint": "#bb171c",
                    "surface-bright": "#f8f9fa",
                    "primary-container": "#680006",
                    "tertiary-fixed": "#ffdeac",
                    "surface": "#f8f9fa",
                    "on-tertiary-container": "#c98c00",
                    "error-container": "#ffdad6",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary": "#400002",
                    "surface-variant": "#e1e3e4",
                    "secondary-fixed": "#d9e2ff",
                    "on-primary-fixed": "#410002",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a"
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
        .tonal-shift-bg-to-surface-low {
            background-color: #f3f4f5;
        }
        .signature-gradient {
            background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
        }
        .glass-badge {
            background: rgba(225, 227, 228, 0.4);
            backdrop-filter: blur(20px);
        }
        .editorial-shadow:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- Top Navigation Bar -->
<nav class="fixed top-0 w-full z-50 bg-white dark:bg-slate-900 flex justify-between items-center px-8 py-4 max-w-full font-['Plus_Jakarta_Sans'] tracking-tight">
<div class="text-2xl font-bold text-[#001945] dark:text-white">Viet Sun Travel</div>
<div class="hidden md:flex space-x-8">
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Asia</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Europe</a>
<a class="text-[#2b5bb5] dark:text-[#400002] font-bold border-b-2 border-[#ff645a] pb-1 hover:text-[#ff645a] transition-colors duration-300" href="#">Americas</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Oceania</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Africa</a>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:flex items-center bg-surface-container px-4 py-2 rounded-full">
<span class="material-symbols-outlined text-outline mr-2">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Tìm kiếm hành trình..." type="text"/>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-bold hover:scale-95 transition-transform duration-200 shadow-inner">Book Now</button>
</div>
</nav>
<main class="pt-20">
<!-- Hero Section: Editorial Style -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Modern New York City skyline at sunset with golden light reflecting off skyscrapers and the Hudson River" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAd4mIlQpoGHQfgSu1Aq7287uYpCGOAgO-0tXG8fzkJF0MDH1jiuNEpqnqBqsOhrYok3rWq857vLRxOEfOdf3txFlaPpqQ_iHnkn8bjNEXYbg5_WIXnzQfwGdc5M5kP862MMbPLWCWwMH203swLTKBu4pBoxcP_fUNgg-gFLpYyt8VDaKhxICjIn3NZeKrQCCPaqUnOFoz39UCHrPro_3hcBVfnR_H6jmCqOa94oMh2_GWi7XQN9J07ERoqzJHm6RQpj3o90cNbCvF6"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
<div class="max-w-2xl">
<span class="text-on-primary-container font-bold tracking-widest uppercase text-sm mb-4 block">Hành trình Khám phá Châu Mỹ</span>
<h1 class="font-headline text-white text-6xl md:text-8xl font-extrabold tracking-tighter leading-[0.9] mb-6">
                        The New World <br/>Discovery
                    </h1>
<p class="text-white/90 text-xl leading-relaxed mb-8 max-w-lg">
                        Trải nghiệm sự hùng vĩ từ những dãy núi Rocky tuyết phủ đến nhịp sống sôi động của Manhattan. Một hành trình được biên tập riêng cho những tâm hồn khao khát tự do.
                    </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:scale-95 transition-all">Khám phá ngay</button>
<button class="border border-white/40 text-white px-8 py-4 rounded-md font-bold hover:bg-white/10 transition-all">Tư vấn miễn phí</button>
</div>
</div>
</div>
</section>
<!-- Destination Highlights: Asymmetric Bento Grid -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16">
<div>
<h2 class="font-headline text-4xl font-extrabold text-on-secondary-fixed mb-4">Điểm đến tâm điểm</h2>
<p class="text-on-surface-variant max-w-md">Những vùng đất hứa với vẻ đẹp kỳ quan thiên nhiên và tinh hoa kiến trúc hiện đại.</p>
</div>
<div class="mt-6 md:mt-0">
<span class="text-secondary font-bold cursor-pointer flex items-center gap-2 group">
                            Xem tất cả điểm đến 
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-[800px]">
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Gate Bridge in San Francisco shrouded in morning fog with soft blue and orange hues" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAt7Jjz7OY9D22MCMrywPV0iirfcorjf_5lQFN7L09syXWkwNxolLKU6hYPK9bLJF-UiRR_02JPWbWhRJyUhEZEanvXjeQRnjQcgj4kVP-P7dsxEtb1Fs3rPRKkTNyWGowDl17XKwXCfXNPqVdXoyK0pQPF_TbTERPretIInnUvkchI0y3P16QwLQtAJoyHPl4lWli7wnbIFUXrl3BG-NqBGYv9MhN_54dwVLghOEzhuSpdoknpsPCE40xeWm7OQ7jNAtf6HGrKkicM"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">MỸ</span>
<h3 class="text-3xl font-bold">USA: Miền Đất Hứa</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Aerial view of Christ the Redeemer statue in Rio de Janeiro overlooking the lush green mountains and bay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwW4m3eyNi9OTYrxjyLy-cPY5ZrdKLZ2daF5mxucrwIDKA7mf5VStd1mcSJ65DHJ10AVcAg04zxpMizqh7VLmBftEWcyDyANQ9iy-PK1NGgL_H7HjGY_3pAzn01fs4cL-mq0HXVe_Xm7UibCOz3ZSpPdNcUzL_iEmnA6f2BIUXXr6M8qSp_s5Yb8NZ2fHRHdvLSGw736wxqxlYnXPhgCr03EQmYjj87jLf_-nE6X0OvB8YOzS9hIU_nBsW3UVAfg9MZoOTqqSQfjW5"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">BRAZIL</span>
<h3 class="text-2xl font-bold">Sắc màu Latin</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Ancient ruins of Machu Picchu in Peru with green terraced mountains under a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnGih2cV12VWelE02rNU5DTrkOOqbAxUbr_36TI1xlJlyCEhUTvZDtwatSdc92d5hsCP7MfMD4uSFLMaOKG6-I5vKF6pqY7aWSgXJS0QH8PhVuTcMySGT51AxSDyJFaTwv0SGLpJvZ_Cj_-0_dyEv2DMy0xQFZvdp8KW3Ilhbk10FYS_mhaHRsbXiNhaeY9VrAZWFGgjMqaKw4cGnOfcPgfyTzdgOPMWhseuQlY90PLphOAEK3VRVLEU5_QIWskbQqEBGyVcWEM8pI"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">PERU</span>
<h3 class="text-2xl font-bold">Huyền thoại Inca</h3>
</div>
</div>
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Snow-capped Canadian Rockies reflected in a crystal clear turquoise glacial lake surrounded by pine trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7aog5oAAsYR3sMnOaPKb99HdOk0P6CO0_LmYlWChCyhIqWkS6JkpaFFh7Y52k5FgkRoTaqRLhmscEN6vCtzxYILreAwfktEFJrGJ3Yml4HGdhi2M565Qr0aZn10Bi08gZlP5vZt0pQ1pHC97_cRiwiQNssFYfcIRaoTXDPYPOcCrHF_PIee_LLoPJqTo9T6aFN7T8W14Xft5XxqKSWcBCf2Iqofl0EfCRmPd5YrWsdObPgrPaTapUsuhu3LmFAHuO86Zh8tcmsjKn"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">CANADA</span>
<h3 class="text-3xl font-bold">Kỳ quan Rockies</h3>
</div>
</div>
</div>
</div>
</section>
<!-- Featured Tours: Editorial List -->
<section class="py-24 bg-white">
<div class="max-w-7xl mx-auto px-8">
<div class="text-center mb-20">
<h2 class="font-headline text-5xl font-black text-on-secondary-fixed mb-4">Hành trình Tuyển chọn</h2>
<div class="w-24 h-1 bg-on-primary-container mx-auto"></div>
</div>
<div class="space-y-12">
<!-- Tour Card 1 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Vibrant night scene of Times Square in New York City with bright neon billboards and yellow taxis" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXQWJCk59wDaGDmualKtcY8s8cAKVS_2heY0W1eJEr5UGqpsNT0S7TCE0W1ctv75Q8fieaiGdgF3fw9U98iaLubrT_9KyFvFP7BN8qKOPn_lAjEuHHo7skIUxF-4crr2unkKfTMn3iLpbKEdbRHrQw_BuQ1mD04gqtbKdTooX-4m1kr4i73XA7yUPG3unZ5yfN0QjqlHEB5g9fBfL9Mu3rE_WaOOvFOZ8O6ei55im-vUnYFkFR_NGFuBNnoBzuxUAPgrzHPZcM7kob"/>
<div class="absolute top-4 left-4 glass-badge px-4 py-2 rounded-full flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">stars</span>
<span class="text-xs font-bold text-on-secondary-fixed">Bán chạy nhất</span>
</div>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">9 Ngày 8 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">US East Coast Explorer</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Từ thủ đô Washington D.C cổ kính đến sự nhộn nhịp của New York và vẻ đẹp lãng mạn của Philadelphia. Một chuyến đi gói gọn linh hồn của nước Mỹ.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">85.900.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 2 -->
<div class="flex flex-col lg:flex-row-reverse gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Panoramic view of Moraine Lake in the Canadian Rockies with stunning blue water and majestic mountains" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOTY7d2-3tGzcTW4re5L5jSfJsiRqw8FBJ-h7p305fj02q3DpfzoqKgItIl5wedVVbOr8VFGVQvCxMP7Nsqckx_-jmNomP_goeYuon4kZxcgqje5HS5E-O45O-RakHGhoOLBCym-mpuP7Pxf532v-PXUzsgmestpcal62hqObyn1NR96Zqw8MNphu6TVb2l3gDaMAQ_eVTgz9Ir1ICbmGmbLjkLueWjx-okxMURvGlbR4hbi1JCGcKxXZCL8dLQCDBSWK29eoX3d05"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">12 Ngày 11 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Canadian Rockies</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Đắm mình vào thiên nhiên hùng vĩ của vườn quốc gia Banff và Jasper. Khám phá những hồ nước xanh ngọc bích và các rặng núi tuyết vĩnh cửu.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">112.500.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 3 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Lush green valley of Machu Picchu at sunrise with soft mist clinging to the ancient stone structures" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClXM3q9A5252wRJsTAbsxT7K6SX54YRUPtL54O_2zqe86O_-o2Ena7iI2tZm0wukiLtZ59O7f29fMmqZsit8qyF9VGOsZLpbBIhj1UMIa6y7DzXKgXX8kGlgJfPnr-oRzZ8WPYG-eeqv18RgGZY2MpIx14kGjA_89iPdKsNDvKp3NiGPE9uuThKbEB_5h45eL9Ug-89QXc4s6mcclB8FeUyYOJG2K-dlv45VFzXtIwhqtE_SvB9Pk2u_AqiNy7z1fEAzPr0tUewm2B"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">14 Ngày 13 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Machu Picchu Trail</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Hành trình đi tìm thành phố đã mất của người Inca. Một chuyến đi đầy thử thách nhưng vô cùng xứng đáng cho những ai yêu thích lịch sử và khám phá.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">98.000.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Signature Experience Banner -->
<section class="signature-gradient py-24 relative overflow-hidden">
<div class="absolute right-0 top-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[400px]" style="font-variation-settings: 'FILL' 1;">public</span>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 text-center lg:text-left">
<div class="flex flex-col lg:flex-row items-center gap-16">
<div class="lg:w-3/5">
<h2 class="font-headline text-white text-5xl font-extrabold mb-6 leading-tight">Dịch vụ Curated cho <br/>Trải nghiệm Thượng lưu</h2>
<p class="text-white/80 text-xl mb-10 max-w-2xl">
                            Chúng tôi không chỉ bán tour. Chúng tôi thiết kế những trải nghiệm mang đậm dấu ấn cá nhân, từ việc chọn khách sạn Boutique đến các bữa tối Michelin độc bản.
                        </p>
<div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">verified_user</span>
<span class="text-white font-medium">Bảo hiểm Cao cấp</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">support_agent</span>
<span class="text-white font-medium">Hỗ trợ 24/7</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">hotel</span>
<span class="text-white font-medium">Khách sạn 5 sao</span>
</div>
</div>
<button class="bg-white text-secondary px-10 py-4 rounded-md font-black hover:bg-on-primary-container hover:text-white transition-all shadow-xl">Liên hệ thiết kế Tour riêng</button>
</div>
<div class="lg:w-2/5">
<div class="relative p-4 bg-white/10 rounded-2xl backdrop-blur-md">
<img class="rounded-xl shadow-2xl" data-alt="Happy couple toast with champagne on a luxury private yacht during a sunset cruise" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw-CN1cKxV4K9u8G00NPxTiP7sBpJXsZAbRwpGlRBJskz3s_0ft-wDQIihWmDEFIkOCuVKYBj4SxUvKHgItXIxlkX0n6KH-UeEs3BjITy4E5gRZjt0BbQF8RnzT5hIj5p6lkpwXQJAfjYM7VRJauGJm0WTwHOLw2qHKmiuhRa1Pv25_joImKUBGmHkedcKqvDy03PEPDwgTdVo8bsyFY0F5QLL1duPULmQ-lrhKYbvW57bLgas-2o4SgIIOtA50EvvFEjXGNGWPUll"/>
</div>
</div>
</div>
</div>
</section>
<!-- Social Proof / Press -->
<section class="py-16 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<p class="text-center text-outline-variant font-bold tracking-[0.2em] uppercase text-xs mb-8">Đối tác &amp; Tạp chí Du lịch</p>
<div class="flex flex-wrap justify-center gap-12 lg:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
<span class="font-headline text-2xl font-black text-on-surface">VOGUE</span>
<span class="font-headline text-2xl font-black text-on-surface">Travel+Leisure</span>
<span class="font-headline text-2xl font-black text-on-surface">MONOCLE</span>
<span class="font-headline text-2xl font-black text-on-surface">Condé Nast</span>
<span class="font-headline text-2xl font-black text-on-surface">Forbes Travel</span>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10 font-['Be_Vietnam_Pro'] leading-relaxed">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 max-w-7xl mx-auto">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-black text-white mb-6">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm mb-6">
                    Đơn vị lữ hành cao cấp hàng đầu Việt Nam, chuyên cung cấp những trải nghiệm du lịch mang tính biên tập và sang trọng trên toàn thế giới.
                </p>
<div class="flex gap-4">
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">social_leaderboard</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">camera_alt</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">youtube_activity</span>
</div>
</div>
<div>
<h4 class="text-white font-bold mb-6">About Us</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Về chúng tôi</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đội ngũ chuyên gia</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Tuyển dụng</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đối tác du lịch</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Travel Guides</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cẩm nang Visa Mỹ</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Thời điểm đi Canada</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Văn hóa Latinh</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Blog hành trình</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Contact</h4>
<ul class="space-y-4">
<li class="flex items-start gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm mt-1">location_on</span>
<span class="text-[#c6c5d4] text-sm">230 Nam Kỳ Khởi Nghĩa, Quận 3, TP.HCM</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">phone</span>
<span class="text-[#c6c5d4] text-sm">1800 5555 99</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">mail</span>
<span class="text-[#c6c5d4] text-sm">info@vietsuntravel.com</span>
</li>
</ul>
</div>
</div>
<div class="mt-20 pt-8 border-t border-white/5 text-center">
<p class="text-[#c6c5d4] text-xs">© 2024 Viet Sun Travel. Curated Editorial Experiences.</p>
</div>
</footer>
</body></html>"

- châu phi
"<!DOCTYPE html>

<html lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#759efd",
                    "surface-container": "#edeeef",
                    "tertiary-container": "#422c00",
                    "outline-variant": "#c6c5d4",
                    "tertiary": "#271800",
                    "on-secondary-fixed": "#001945",
                    "primary-fixed-dim": "#ffb4ac",
                    "inverse-on-surface": "#f0f1f2",
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f3f4f5",
                    "on-secondary": "#ffffff",
                    "on-primary-container": "#ff645a",
                    "background": "#f8f9fa",
                    "on-tertiary-fixed-variant": "#604100",
                    "surface-container-highest": "#e1e3e4",
                    "outline": "#767683",
                    "on-tertiary": "#ffffff",
                    "on-surface-variant": "#454652",
                    "on-primary-fixed-variant": "#93000d",
                    "surface-container-lowest": "#ffffff",
                    "surface-dim": "#d9dadb",
                    "secondary": "#2b5bb5",
                    "inverse-surface": "#2e3132",
                    "secondary-fixed-dim": "#b0c6ff",
                    "primary-fixed": "#ffdad6",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#00337c",
                    "on-tertiary-fixed": "#281900",
                    "surface-container-high": "#e7e8e9",
                    "on-secondary-fixed-variant": "#00429c",
                    "surface-tint": "#bb171c",
                    "surface-bright": "#f8f9fa",
                    "primary-container": "#680006",
                    "tertiary-fixed": "#ffdeac",
                    "surface": "#f8f9fa",
                    "on-tertiary-container": "#c98c00",
                    "error-container": "#ffdad6",
                    "on-surface": "#191c1d",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#ffba38",
                    "primary": "#400002",
                    "surface-variant": "#e1e3e4",
                    "secondary-fixed": "#d9e2ff",
                    "on-primary-fixed": "#410002",
                    "on-background": "#191c1d",
                    "inverse-primary": "#ffb4ac",
                    "error": "#ba1a1a"
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
        .tonal-shift-bg-to-surface-low {
            background-color: #f3f4f5;
        }
        .signature-gradient {
            background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
        }
        .glass-badge {
            background: rgba(225, 227, 228, 0.4);
            backdrop-filter: blur(20px);
        }
        .editorial-shadow:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- Top Navigation Bar -->
<nav class="fixed top-0 w-full z-50 bg-white dark:bg-slate-900 flex justify-between items-center px-8 py-4 max-w-full font-['Plus_Jakarta_Sans'] tracking-tight">
<div class="text-2xl font-bold text-[#001945] dark:text-white">Viet Sun Travel</div>
<div class="hidden md:flex space-x-8">
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Asia</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Europe</a>
<a class="text-[#2b5bb5] dark:text-[#400002] font-bold border-b-2 border-[#ff645a] pb-1 hover:text-[#ff645a] transition-colors duration-300" href="#">Americas</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Oceania</a>
<a class="text-[#2e3132] dark:text-slate-400 font-medium hover:text-[#ff645a] transition-colors duration-300" href="#">Africa</a>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:flex items-center bg-surface-container px-4 py-2 rounded-full">
<span class="material-symbols-outlined text-outline mr-2">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Tìm kiếm hành trình..." type="text"/>
</div>
<button class="bg-[#ff645a] text-white px-6 py-2 rounded-md font-bold hover:scale-95 transition-transform duration-200 shadow-inner">Book Now</button>
</div>
</nav>
<main class="pt-20">
<!-- Hero Section: Editorial Style -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Modern New York City skyline at sunset with golden light reflecting off skyscrapers and the Hudson River" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAd4mIlQpoGHQfgSu1Aq7287uYpCGOAgO-0tXG8fzkJF0MDH1jiuNEpqnqBqsOhrYok3rWq857vLRxOEfOdf3txFlaPpqQ_iHnkn8bjNEXYbg5_WIXnzQfwGdc5M5kP862MMbPLWCWwMH203swLTKBu4pBoxcP_fUNgg-gFLpYyt8VDaKhxICjIn3NZeKrQCCPaqUnOFoz39UCHrPro_3hcBVfnR_H6jmCqOa94oMh2_GWi7XQN9J07ERoqzJHm6RQpj3o90cNbCvF6"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
<div class="max-w-2xl">
<span class="text-on-primary-container font-bold tracking-widest uppercase text-sm mb-4 block">Hành trình Khám phá Châu Mỹ</span>
<h1 class="font-headline text-white text-6xl md:text-8xl font-extrabold tracking-tighter leading-[0.9] mb-6">
                        The New World <br/>Discovery
                    </h1>
<p class="text-white/90 text-xl leading-relaxed mb-8 max-w-lg">
                        Trải nghiệm sự hùng vĩ từ những dãy núi Rocky tuyết phủ đến nhịp sống sôi động của Manhattan. Một hành trình được biên tập riêng cho những tâm hồn khao khát tự do.
                    </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:scale-95 transition-all">Khám phá ngay</button>
<button class="border border-white/40 text-white px-8 py-4 rounded-md font-bold hover:bg-white/10 transition-all">Tư vấn miễn phí</button>
</div>
</div>
</div>
</section>
<!-- Destination Highlights: Asymmetric Bento Grid -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16">
<div>
<h2 class="font-headline text-4xl font-extrabold text-on-secondary-fixed mb-4">Điểm đến tâm điểm</h2>
<p class="text-on-surface-variant max-w-md">Những vùng đất hứa với vẻ đẹp kỳ quan thiên nhiên và tinh hoa kiến trúc hiện đại.</p>
</div>
<div class="mt-6 md:mt-0">
<span class="text-secondary font-bold cursor-pointer flex items-center gap-2 group">
                            Xem tất cả điểm đến 
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-[800px]">
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Gate Bridge in San Francisco shrouded in morning fog with soft blue and orange hues" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAt7Jjz7OY9D22MCMrywPV0iirfcorjf_5lQFN7L09syXWkwNxolLKU6hYPK9bLJF-UiRR_02JPWbWhRJyUhEZEanvXjeQRnjQcgj4kVP-P7dsxEtb1Fs3rPRKkTNyWGowDl17XKwXCfXNPqVdXoyK0pQPF_TbTERPretIInnUvkchI0y3P16QwLQtAJoyHPl4lWli7wnbIFUXrl3BG-NqBGYv9MhN_54dwVLghOEzhuSpdoknpsPCE40xeWm7OQ7jNAtf6HGrKkicM"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">MỸ</span>
<h3 class="text-3xl font-bold">USA: Miền Đất Hứa</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Aerial view of Christ the Redeemer statue in Rio de Janeiro overlooking the lush green mountains and bay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwW4m3eyNi9OTYrxjyLy-cPY5ZrdKLZ2daF5mxucrwIDKA7mf5VStd1mcSJ65DHJ10AVcAg04zxpMizqh7VLmBftEWcyDyANQ9iy-PK1NGgL_H7HjGY_3pAzn01fs4cL-mq0HXVe_Xm7UibCOz3ZSpPdNcUzL_iEmnA6f2BIUXXr6M8qSp_s5Yb8NZ2fHRHdvLSGw736wxqxlYnXPhgCr03EQmYjj87jLf_-nE6X0OvB8YOzS9hIU_nBsW3UVAfg9MZoOTqqSQfjW5"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">BRAZIL</span>
<h3 class="text-2xl font-bold">Sắc màu Latin</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Ancient ruins of Machu Picchu in Peru with green terraced mountains under a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnGih2cV12VWelE02rNU5DTrkOOqbAxUbr_36TI1xlJlyCEhUTvZDtwatSdc92d5hsCP7MfMD4uSFLMaOKG6-I5vKF6pqY7aWSgXJS0QH8PhVuTcMySGT51AxSDyJFaTwv0SGLpJvZ_Cj_-0_dyEv2DMy0xQFZvdp8KW3Ilhbk10FYS_mhaHRsbXiNhaeY9VrAZWFGgjMqaKw4cGnOfcPgfyTzdgOPMWhseuQlY90PLphOAEK3VRVLEU5_QIWskbQqEBGyVcWEM8pI"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">PERU</span>
<h3 class="text-2xl font-bold">Huyền thoại Inca</h3>
</div>
</div>
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Snow-capped Canadian Rockies reflected in a crystal clear turquoise glacial lake surrounded by pine trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7aog5oAAsYR3sMnOaPKb99HdOk0P6CO0_LmYlWChCyhIqWkS6JkpaFFh7Y52k5FgkRoTaqRLhmscEN6vCtzxYILreAwfktEFJrGJ3Yml4HGdhi2M565Qr0aZn10Bi08gZlP5vZt0pQ1pHC97_cRiwiQNssFYfcIRaoTXDPYPOcCrHF_PIee_LLoPJqTo9T6aFN7T8W14Xft5XxqKSWcBCf2Iqofl0EfCRmPd5YrWsdObPgrPaTapUsuhu3LmFAHuO86Zh8tcmsjKn"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">CANADA</span>
<h3 class="text-3xl font-bold">Kỳ quan Rockies</h3>
</div>
</div>
</div>
</div>
</section>
<!-- Featured Tours: Editorial List -->
<section class="py-24 bg-white">
<div class="max-w-7xl mx-auto px-8">
<div class="text-center mb-20">
<h2 class="font-headline text-5xl font-black text-on-secondary-fixed mb-4">Hành trình Tuyển chọn</h2>
<div class="w-24 h-1 bg-on-primary-container mx-auto"></div>
</div>
<div class="space-y-12">
<!-- Tour Card 1 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Vibrant night scene of Times Square in New York City with bright neon billboards and yellow taxis" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXQWJCk59wDaGDmualKtcY8s8cAKVS_2heY0W1eJEr5UGqpsNT0S7TCE0W1ctv75Q8fieaiGdgF3fw9U98iaLubrT_9KyFvFP7BN8qKOPn_lAjEuHHo7skIUxF-4crr2unkKfTMn3iLpbKEdbRHrQw_BuQ1mD04gqtbKdTooX-4m1kr4i73XA7yUPG3unZ5yfN0QjqlHEB5g9fBfL9Mu3rE_WaOOvFOZ8O6ei55im-vUnYFkFR_NGFuBNnoBzuxUAPgrzHPZcM7kob"/>
<div class="absolute top-4 left-4 glass-badge px-4 py-2 rounded-full flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-sm">stars</span>
<span class="text-xs font-bold text-on-secondary-fixed">Bán chạy nhất</span>
</div>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">9 Ngày 8 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">US East Coast Explorer</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Từ thủ đô Washington D.C cổ kính đến sự nhộn nhịp của New York và vẻ đẹp lãng mạn của Philadelphia. Một chuyến đi gói gọn linh hồn của nước Mỹ.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">85.900.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 2 -->
<div class="flex flex-col lg:flex-row-reverse gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Panoramic view of Moraine Lake in the Canadian Rockies with stunning blue water and majestic mountains" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOTY7d2-3tGzcTW4re5L5jSfJsiRqw8FBJ-h7p305fj02q3DpfzoqKgItIl5wedVVbOr8VFGVQvCxMP7Nsqckx_-jmNomP_goeYuon4kZxcgqje5HS5E-O45O-RakHGhoOLBCym-mpuP7Pxf532v-PXUzsgmestpcal62hqObyn1NR96Zqw8MNphu6TVb2l3gDaMAQ_eVTgz9Ir1ICbmGmbLjkLueWjx-okxMURvGlbR4hbi1JCGcKxXZCL8dLQCDBSWK29eoX3d05"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">12 Ngày 11 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Canadian Rockies</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Đắm mình vào thiên nhiên hùng vĩ của vườn quốc gia Banff và Jasper. Khám phá những hồ nước xanh ngọc bích và các rặng núi tuyết vĩnh cửu.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">112.500.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
<!-- Tour Card 3 -->
<div class="flex flex-col lg:flex-row gap-12 items-center p-8 rounded-2xl bg-surface-container-lowest editorial-shadow transition-all group">
<div class="w-full lg:w-1/2 aspect-video overflow-hidden rounded-lg relative">
<img class="w-full h-full object-cover transition-transform group-hover:scale-105" data-alt="Lush green valley of Machu Picchu at sunrise with soft mist clinging to the ancient stone structures" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClXM3q9A5252wRJsTAbsxT7K6SX54YRUPtL54O_2zqe86O_-o2Ena7iI2tZm0wukiLtZ59O7f29fMmqZsit8qyF9VGOsZLpbBIhj1UMIa6y7DzXKgXX8kGlgJfPnr-oRzZ8WPYG-eeqv18RgGZY2MpIx14kGjA_89iPdKsNDvKp3NiGPE9uuThKbEB_5h45eL9Ug-89QXc4s6mcclB8FeUyYOJG2K-dlv45VFzXtIwhqtE_SvB9Pk2u_AqiNy7z1fEAzPr0tUewm2B"/>
</div>
<div class="w-full lg:w-1/2">
<span class="text-secondary font-bold text-sm tracking-widest uppercase">14 Ngày 13 Đêm</span>
<h3 class="font-headline text-4xl font-bold text-on-secondary-fixed mt-2 mb-6">Machu Picchu Trail</h3>
<p class="text-on-surface-variant text-lg leading-relaxed mb-8">
                                Hành trình đi tìm thành phố đã mất của người Inca. Một chuyến đi đầy thử thách nhưng vô cùng xứng đáng cho những ai yêu thích lịch sử và khám phá.
                            </p>
<div class="flex items-center justify-between">
<div>
<span class="text-outline text-sm block">Giá từ</span>
<span class="text-3xl font-black text-[#400002]">98.000.000đ</span>
</div>
<button class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:scale-95 transition-all">Chi tiết tour</button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Signature Experience Banner -->
<section class="signature-gradient py-24 relative overflow-hidden">
<div class="absolute right-0 top-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[400px]" style="font-variation-settings: 'FILL' 1;">public</span>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 text-center lg:text-left">
<div class="flex flex-col lg:flex-row items-center gap-16">
<div class="lg:w-3/5">
<h2 class="font-headline text-white text-5xl font-extrabold mb-6 leading-tight">Dịch vụ Curated cho <br/>Trải nghiệm Thượng lưu</h2>
<p class="text-white/80 text-xl mb-10 max-w-2xl">
                            Chúng tôi không chỉ bán tour. Chúng tôi thiết kế những trải nghiệm mang đậm dấu ấn cá nhân, từ việc chọn khách sạn Boutique đến các bữa tối Michelin độc bản.
                        </p>
<div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">verified_user</span>
<span class="text-white font-medium">Bảo hiểm Cao cấp</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">support_agent</span>
<span class="text-white font-medium">Hỗ trợ 24/7</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">hotel</span>
<span class="text-white font-medium">Khách sạn 5 sao</span>
</div>
</div>
<button class="bg-white text-secondary px-10 py-4 rounded-md font-black hover:bg-on-primary-container hover:text-white transition-all shadow-xl">Liên hệ thiết kế Tour riêng</button>
</div>
<div class="lg:w-2/5">
<div class="relative p-4 bg-white/10 rounded-2xl backdrop-blur-md">
<img class="rounded-xl shadow-2xl" data-alt="Happy couple toast with champagne on a luxury private yacht during a sunset cruise" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw-CN1cKxV4K9u8G00NPxTiP7sBpJXsZAbRwpGlRBJskz3s_0ft-wDQIihWmDEFIkOCuVKYBj4SxUvKHgItXIxlkX0n6KH-UeEs3BjITy4E5gRZjt0BbQF8RnzT5hIj5p6lkpwXQJAfjYM7VRJauGJm0WTwHOLw2qHKmiuhRa1Pv25_joImKUBGmHkedcKqvDy03PEPDwgTdVo8bsyFY0F5QLL1duPULmQ-lrhKYbvW57bLgas-2o4SgIIOtA50EvvFEjXGNGWPUll"/>
</div>
</div>
</div>
</div>
</section>
<!-- Social Proof / Press -->
<section class="py-16 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<p class="text-center text-outline-variant font-bold tracking-[0.2em] uppercase text-xs mb-8">Đối tác &amp; Tạp chí Du lịch</p>
<div class="flex flex-wrap justify-center gap-12 lg:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
<span class="font-headline text-2xl font-black text-on-surface">VOGUE</span>
<span class="font-headline text-2xl font-black text-on-surface">Travel+Leisure</span>
<span class="font-headline text-2xl font-black text-on-surface">MONOCLE</span>
<span class="font-headline text-2xl font-black text-on-surface">Condé Nast</span>
<span class="font-headline text-2xl font-black text-on-surface">Forbes Travel</span>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10 font-['Be_Vietnam_Pro'] leading-relaxed">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 max-w-7xl mx-auto">
<div class="col-span-1 md:col-span-1">
<div class="text-xl font-black text-white mb-6">Viet Sun Travel</div>
<p class="text-[#c6c5d4] text-sm mb-6">
                    Đơn vị lữ hành cao cấp hàng đầu Việt Nam, chuyên cung cấp những trải nghiệm du lịch mang tính biên tập và sang trọng trên toàn thế giới.
                </p>
<div class="flex gap-4">
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">social_leaderboard</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">camera_alt</span>
<span class="material-symbols-outlined text-white/50 cursor-pointer hover:text-[#ff645a]">youtube_activity</span>
</div>
</div>
<div>
<h4 class="text-white font-bold mb-6">About Us</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Về chúng tôi</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đội ngũ chuyên gia</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Tuyển dụng</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Đối tác du lịch</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Travel Guides</h4>
<ul class="space-y-4">
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Cẩm nang Visa Mỹ</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Thời điểm đi Canada</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Văn hóa Latinh</a></li>
<li><a class="text-[#c6c5d4] hover:text-[#ff645a] transition-all duration-300" href="#">Blog hành trình</a></li>
</ul>
</div>
<div>
<h4 class="text-white font-bold mb-6">Contact</h4>
<ul class="space-y-4">
<li class="flex items-start gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm mt-1">location_on</span>
<span class="text-[#c6c5d4] text-sm">230 Nam Kỳ Khởi Nghĩa, Quận 3, TP.HCM</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">phone</span>
<span class="text-[#c6c5d4] text-sm">1800 5555 99</span>
</li>
<li class="flex items-center gap-2">
<span class="material-symbols-outlined text-[#ff645a] text-sm">mail</span>
<span class="text-[#c6c5d4] text-sm">info@vietsuntravel.com</span>
</li>
</ul>
</div>
</div>
<div class="mt-20 pt-8 border-t border-white/5 text-center">
<p class="text-[#c6c5d4] text-xs">© 2024 Viet Sun Travel. Curated Editorial Experiences.</p>
</div>
</footer>
</body></html>"