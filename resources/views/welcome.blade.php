@extends('layouts.landing')

@section('title', 'Cagayan Museum — Visitor Feedback System')

@section('content')
    <!-- ===== HERO ===== -->
    <section class="relative overflow-hidden" data-animate="up">
        {{-- Gradient background with subtle pattern --}}
        <div class="absolute inset-0 bg-gradient-to-br from-cm-teal via-cm-teal-dark to-cm-terracotta"></div>
        <div class="absolute inset-0 opacity-10" style="
            background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v2h-2v-2h-2v2H28v2h2v-2h2v2h2v-2h2v-2h2zm0-4v2h-2v-2h-2v2H28v2h2v-2h2v2h2v-2h2v-2h2v2h2v-2h2v2h2V18h-8v2zm4 10v2h-2v-2h-2v2h-2v-2h-2v2H28v2h2v-2h2v2h2v-2h2v-2h2v-2h2v2h2v-2h2v2zm-4 4v2h-2v-2h-2v2H28v2h2v-2h2v2h2v-2h2v2h2v-2h2v-2h2v2h2v-2h2v2h2v-2h2v-2v-2zm8-12v2h-2v-2h-2v2h-2v-2h-2v2H28v2h2v-2h2v2h2v-2h2v2h2v-2h2v2h2v-2h2v2h2v-2h2v2h2v-2h2v-2zm-8-18v2h-2V16h-2v2H28v2h2v-2h2v2h2v-2h2v2h2v-2h2v2h2v-2h2v2H28v2h2v-2H34v2zm-8 0v2h-2V16H14v2h2v-2h2V12h2v2zM10 6v2H8V6h2zm0 4v2H8v-2h2zm2 0h2v2H8v-2zm4 0h2v2h-2zm4 0h2v2H8v-2zm8 0h2v2h-2zm4 0h2v2h-2zm4 0h2v2h-2zm4 0h2v2h-2zm4 0h2v2h-2zm4 0h2v2h-2zm0-4V6h-2v2zm2 0h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm0 4v-2zm-40 0v-2zm4 0h2v2zm0-4h2v2zm0-4h2v2zm0-4h2v2zm0-4h2v2zm0-4h2v2zm0-4h2v2zm0-4H8v2zm0 0H6v2zm0-4h2v2zm0 4zm2 0h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4v-2zm0-40v-2zm2 0h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm0 4h2v2zm2-30v-2zm0 0h-2zm2 0h2zm0 0z' fill='%23ffffff' fill-opacity='0.07'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");
        " style="background-size: 300px;"></div>

        <div class="relative mx-auto max-w-6xl px-6 py-28 text-center text-white sm:py-36">
            <div class="stagger" data-animate="up">
                <div class="stagger-item">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-white/90">
                        <span class="h-2 w-2 rounded-full bg-gold"></span>
                        Share Your Museum Experience
                    </div>
                </div>

                <div class="stagger-item">
                    <h1 class="mt-6 text-4xl font-semibold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Cagayan Museum
                        <span class="block text-gold">Visitor Feedback System</span>
                    </h1>
                </div>

                <div class="stagger-item">
                    <p class="mx-auto mt-6 max-w-2xl text-lg text-white/85 leading-relaxed">
                        Your voice helps us preserve the rich heritage of Cagayan Valley — from the Homo luzonensis discovery
                        to our Pleistocene fossil collections. Share your experience in seconds.
                    </p>
                </div>
            </div>

            <div class="stagger mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row" data-animate="up">
                <div class="stagger-item">
                    <a href="#feedback"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cm-gold px-8 py-3.5 font-medium text-cm-teal-dark shadow-lg shadow-cm-terracotta/30 transition-all duration-200 press-scale hover:bg-gold-hover hover:shadow-xl">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.25 3v5.25a2.25 2.25 0 002.25 2.25h5.25M4.5 12h15.75M4.5 12l3-3m-3 3l3 3" />
                        </svg>
                        Start Feedback
                    </a>
                </div>

                <div class="stagger-item">
                    <a href="#about"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 px-8 py-3.5 font-medium text-white hover:bg-white/10 transition-all duration-200 press-scale">
                        Learn More
                    </a>
                </div>
            </div>

            <div class="stagger-item mt-8 text-sm text-white/60">
                No account required • Takes under 2 minutes • Multilingual support
            </div>
        </div>
    </section>

    {{-- ===== Quick Impact Stats ===== --}}
    <section class="bg-cm-cream py-12 border-t border-cm-sand/30">
        <div class="mx-auto max-w-6xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item text-center">
                    <p class="text-3xl font-bold text-cm-teal">12,847</p>
                    <p class="text-sm text-neutral-500">Visitor Feedbacks Collected</p>
                </div>

                <div class="stagger-item text-center">
                    <p class="text-3xl font-bold text-cm-teal">4.92</p>
                    <p class="text-sm text-neutral-500">Average Museum Rating</p>
                </div>

                <div class="stagger-item text-center">
                    <p class="text-3xl font-bold text-cm-teal">15+</p>
                    <p class="text-sm text-neutral-500">Museum Collections</p>
                </div>

                <div class="stagger-item text-center">
                    <p class="text-3xl font-bold text-cm-teal">2 min</p>
                    <p class="text-sm text-neutral-500">Average Feedback Time</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== How It Works ===== --}}
    <section class="py-24">
        <div class="mx-auto max-w-5xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item text-center">
                    <span class="text-sm font-medium text-cm-teal uppercase tracking-wider">Simple 3-Step Process</span>
                    <h2 class="mt-3 text-3xl font-bold text-neutral-900 sm:text-4xl">Share Your Experience in Seconds</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-neutral-500">
                        Giving feedback takes less than two minutes. Your insights directly improve the museum experience.
                    </p>
                </div>

                <div class="stagger-item">
                    <div class="mt-16 grid gap-8 sm:grid-cols-3">
                        {{-- Step 1 --}}
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.25 10.25h15.5M4.25 10.25c0-2.136.377-4.197 1.118-6.145A9.75 9.75 0 0112 2c2.357.71 4.427 2.04 6.132 3.855A22.354 22.354 0 0119.75 10.25M4.25 10.25V16a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.75 16v-5.75M12 15L7.5 10.5m4.5 4.5l4.5-4.5" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-neutral-900">1. Visit the Museum</h3>
                            <p class="mt-2 text-sm text-neutral-500 leading-relaxed">
                                Explore our galleries showcasing the natural history and cultural heritage of Cagayan Valley.
                            </p>
                        </div>

                        {{-- Step 2 --}}
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.625 15.75l11.13-4.382c.47-.185.84.495.84.99V18a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 18V12a2.25 2.25 0 012.25-2.25h1.5m3.75 6v-6m-3.75 6h3.75M12 19.5V12m0 0L8.25 10.5m3.75 1.5V12" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-neutral-900">2. Share Your Experience</h3>
                            <p class="mt-2 text-sm text-neutral-500 leading-relaxed">
                                Rate your visit and tell us what you loved, what surprised you, and what could be better.
                            </p>
                        </div>

                        {{-- Step 3 --}}
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.25 3v5.25a2.25 2.25 0 002.25 2.25h5.25M4.5 12h15.75M4.5 12l3-3m-3 3l3 3" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-neutral-900">3. Help Us Improve</h3>
                            <p class="mt-2 text-sm text-neutral-500 leading-relaxed">
                                Your feedback guides our improvements and helps us preserve Cagayan's heritage for future generations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Museum Collections ===== --}}
    <section class="bg-neutral-50 py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item">
                    <span class="text-sm font-medium text-cm-teal uppercase tracking-wider">Our Collections</span>
                    <h2 class="mt-3 text-3xl font-bold text-neutral-900 sm:text-4xl">Discover What Makes Us Unique</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-neutral-500">
                        Home to the famous Homo luzonensis discovery and Pleistocene fossils, the Cagayan Museum
                        preserves the natural and cultural heritage of Northern Philippines.
                    </p>
                </div>

                <div class="stagger-item mt-16">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        {{-- Collection 1 --}}
                        <div class="rounded-xl bg-white p-6 shadow-sm shadow-neutral-200/50 transition-all duration-300 hover-scale hover-lift">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-cm-teal/10">
                                <svg class="h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.348 14.652l4.052-4.052m-.81-5.292A8.953 8.953 0 112.95 12.95a9 9 0 0114.696-5.61l-1.2 2.97A7 7 0 105 11.75a7 7 0 0011.18-2.37l1.35-3.3A10.95 10.95 0 0121 11a10.95 10.95 0 01-3.76 7.96 11.03 11.03 0 01-17.2-8.13 11.05 11.05 0 012.5-7.12l.34.92a9 9 0 009.6 5.65 9 9 0 00.05-1.58 9 9 0 00-.33-.98L17.7 7.6a8.953 8.953 0 01-2.12 2.96A6.996 6.996 0 019.348 14.652z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 font-semibold text-neutral-900">Homo luzonensis</h3>
                            <p class="mt-2 text-sm text-neutral-500">The remarkable 50,000-year-old human species discovery from Callao Cave.</p>
                        </div>

                        {{-- Collection 2 --}}
                        <div class="rounded-xl bg-white p-6 shadow-sm shadow-neutral-200/50 transition-all duration-300 hover-scale hover-lift">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-cm-teal/10">
                                <svg class="h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 14.25a3 3 0 01.375-2.625L13.5 7.75l3.75 3.75-5.25 5.25-3.75-.5-.75 2.25zm0 0L7.5 20.25h9a.75.75 0 00.75-.75v-2.25l-1.5-.75-3.75 3.75z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 font-semibold text-neutral-900">Pleistocene Fossils</h3>
                            <p class="mt-2 text-sm text-neutral-500">Mammoths, giant tortoises, and ancient mammals from 60,000 years ago.</p>
                        </div>

                        {{-- Collection 3 --}}
                        <div class="rounded-xl bg-white p-6 shadow-sm shadow-neutral-200/50 transition-all duration-300 hover-scale hover-lift">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-cm-teal/10">
                                <svg class="h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21V5m0 0L8 9m4-4l4 4M8 13l4 4 4-4" />
                                </svg>
                            </div>
                            <h3 class="mt-4 font-semibold text-neutral-900">Archaeological Finds</h3>
                            <p class="mt-2 text-sm text-neutral-500">Stone tools, pottery shards, and artifacts spanning millennia.</p>
                        </div>

                        {{-- Collection 4 --}}
                        <div class="rounded-xl bg-white p-6 shadow-sm shadow-neutral-200/50 transition-all duration-300 hover-scale hover-lift">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-cm-teal/10">
                                <svg class="h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7.875 14.752A10.954 10.954 0 013 11a9 9 0 118.762 11.168c.024-.135.038-.272.038-.418 0-2.38-.902-4.49-2.372-6.074l.032-.006A1.125 1.125 0 109.75 11.75a7.5 7.5 0 00-1.875 3.566z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 font-semibold text-neutral-900">Cultural Heritage</h3>
                            <p class="mt-2 text-sm text-neutral-500">Traditional textiles, crafts, and ethnographic collections.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Visitor Voices ===== --}}
    <section class="py-24">
        <div class="mx-auto max-w-6xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item text-center">
                    <span class="text-sm font-medium text-cm-teal uppercase tracking-wider">Visitor Voices</span>
                    <h2 class="mt-3 text-3xl font-bold text-neutral-900 sm:text-4xl">What Visitors Are Saying</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-neutral-500">
                        See how visitor feedback is shaping the future of Cagayan Museum.
                    </p>
                </div>

                <div class="stagger-item mt-16">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        {{-- Testimonial 1 --}}
                        <div class="rounded-xl bg-white p-8 shadow-sm shadow-neutral-200/50">
                            <div class="flex gap-1 text-gold">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                            </div>
                            <p class="mt-4 text-neutral-600 italic leading-relaxed">
                                "Fascinating exhibits! The Homo luzonensis display alone is worth the trip.
                                The museum does an incredible job of making complex archaeology accessible."
                            </p>
                            <div class="mt-6 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal font-semibold">
                                    MJ
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-medium text-neutral-900">Maria Santos</p>
                                    <p class="text-xs text-neutral-400">Manila, Philippines</p>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 2 --}}
                        <div class="rounded-xl bg-white p-8 shadow-sm shadow-neutral-200/50">
                            <div class="flex gap-1 text-gold">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 text-neutral-200" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                            </div>
                            <p class="mt-4 text-neutral-600 italic leading-relaxed">
                                "As an educator, I appreciate how the museum connects visitors with our
                                cultural roots. The guided tours were exceptional and very informative."
                            </p>
                            <div class="mt-6 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal font-semibold">
                                    TJ
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-medium text-neutral-900">Teresa Lim</p>
                                    <p class="text-xs text-neutral-400">Baguio City, Philippines</p>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 3 --}}
                        <div class="rounded-xl bg-white p-8 shadow-sm shadow-neutral-200/50">
                            <div class="flex gap-1 text-gold">
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                                <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .755l3.346 6.835 7.5 1.144-5.5 5.144.88 7.454L12 17.846l-6.226 3.544.88-7.454-5.5-5.144L12 7.591l3.346-6.836z" />
                                </svg>
                            </div>
                            <p class="mt-4 text-neutral-600 italic leading-relaxed">
                                "Impressive fossil collection! Being able to see the actual Homo luzonensis
                                remains was a once-in-a-lifetime experience for my family."
                            </p>
                            <div class="mt-6 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-cm-teal/10 text-cm-teal font-semibold">
                                    RJ
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-medium text-neutral-900">Robert Johnson</p>
                                    <p class="text-xs text-neutral-400">Tokyo, Japan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Feedback Form Preview ===== --}}
    <section class="bg-white py-20">
        <div class="mx-auto max-w-5xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item text-center">
                    <span class="text-sm font-medium text-cm-teal uppercase tracking-wider">Feedback Categories</span>
                    <h2 class="mt-3 text-3xl font-bold text-neutral-900 sm:text-4xl">We Value Every Perspective</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-neutral-500">
                        Whether it's your first visit or your tenth, your feedback helps us continuously improve.
                    </p>
                </div>

                <div class="stagger-item mt-16">
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="rounded-xl border-2 border-dashed border-neutral-200 p-6 text-center transition-all duration-200 hover:border-cm-teal hover:bg-cm-teal/5">
                            <svg class="mx-auto mb-3 h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.25 3v5.25a2.25 2.25 0 002.25 2.25h5.25M4.5 12h15.75M4.5 12l3-3m-3 3l3 3" />
                            </svg>
                            <span class="text-sm font-medium text-neutral-900">General Experience</span>
                        </div>
                        <div class="rounded-xl border-2 border-dashed border-neutral-200 p-6 text-center transition-all duration-200 hover:border-cm-teal hover:bg-cm-teal/5">
                            <svg class="mx-auto mb-3 h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.348 14.652l4.052-4.052m-.81-5.292A8.953 8.953 0 012.95 12c0 4.97 4.03 9 9 9s9-4.03 9-9-4.03-9-9-9c-1.758 0-3.413.47-4.819 1.281L2.5 7.5v6A9 9 0 0011.5 18.46V16c-2.532-.33-4.5-2.303-4.5-4.88V7.5h2.348z" />
                            </svg>
                            <span class="text-sm font-medium text-neutral-900">Exhibit Quality</span>
                        </div>
                        <div class="rounded-xl border-2 border-dashed border-neutral-200 p-6 text-center transition-all duration-200 hover:border-cm-teal hover:bg-cm-teal/5">
                            <svg class="mx-auto mb-3 h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.25 8.25L20.5 12l-3.25 3.75M14.25 6.75L12 10l-2.25 4.25M9.75 4.5L7.5 8.25l2.25 3" />
                            </svg>
                            <span class="text-sm font-medium text-neutral-900">Staff & Service</span>
                        </div>
                        <div class="rounded-xl border-2 border-dashed border-neutral-200 p-6 text-center transition-all duration-200 hover:border-cm-teal hover:bg-cm-teal/5">
                            <svg class="mx-auto mb-3 h-6 w-6 text-cm-teal" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.878a8.5 8.5 0 11-4.818-1.276L3 16.875V18a.75.75 0 00.75.75h3.75a.75.75 0 00.75-.75V15a3 3 0 013-3h1.5a1.5 1.5 0 010 3h-.75v1.125a2.25 2.25 0 002.25 2.25h1.5a2.25 2.25 0 002.25-2.25v-4.5a8.5 8.5 0 00-8.482-8.482z" />
                            </svg>
                            <span class="text-sm font-medium text-neutral-900">Suggestions</span>
                        </div>
                    </div>
                </div>

                <div class="stagger-item mt-12 text-center">
                    <a href="#feedback"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cm-teal px-8 py-3.5 font-medium text-white shadow-lg shadow-cm-teal/30 transition-all duration-200 press-scale hover:bg-cm-teal-dark hover:shadow-xl">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.25 3v5.25a2.25 2.25 0 002.25 2.25h5.25M4.5 12h15.75M4.5 12l3-3m-3 3l3 3" />
                        </svg>
                        Submit Your Feedback
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== About / Trust ===== --}}
    <section class="bg-neutral-50 py-20">
        <div class="mx-auto max-w-5xl px-6">
            <div class="stagger" data-animate="up">
                <div class="stagger-item">
                    <span class="text-sm font-medium text-cm-teal uppercase tracking-wider">About the Museum</span>
                    <h2 class="mt-3 text-3xl font-bold text-neutral-900 sm:text-4xl">Cagayan Museum</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-neutral-500 leading-relaxed">
                        Located in Peñablanca, Cagayan Valley, the Cagayan Museum is part of the National Museum
                        of the Philippines. It houses the famous Homo luzonensis discovery and extensive
                        Pleistocene fossil collections. Our mission is to preserve and showcase the natural
                        and cultural heritage of Northern Philippines for education and research.
                    </p>
                </div>

                <div class="stagger-item mt-8">
                    <div class="flex flex-wrap justify-center gap-8 text-center sm:gap-12">
                        <div>
                            <p class="text-sm font-medium text-neutral-600">Established</p>
                            <p class="text-xl font-bold text-cm-teal">1973</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-neutral-600">Location</p>
                            <p class="text-xl font-bold text-cm-teal">Peñablanca, Cagayan</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-neutral-600">Collections</p>
                            <p class="text-xl font-bold text-cm-teal">15+ Exhibits</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-neutral-600">Visitors</p>
                            <p class="text-xl font-bold text-cm-teal">Annual</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== Final CTA ===== --}}
    <section class="py-20">
        <div class="mx-auto max-w-4xl px-6">
            <div class="stagger rounded-2xl bg-gradient-to-r from-cm-teal to-cm-teal-dark px-10 py-16 text-center text-white"
                data-animate="up">
                <div class="stagger-item">
                    <h2 class="text-3xl font-bold sm:text-4xl">Have a Story to Share?</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-lg text-white/85">
                        Your feedback helps us improve the museum experience and better preserve the heritage of Cagayan Valley
                        for future generations.
                    </p>
                </div>
                <div class="stagger-item mt-8">
                    <a href="#feedback"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-cm-gold px-8 py-3.5 font-medium text-cm-teal-dark shadow-lg shadow-cm-terracotta/30 transition-all duration-200 press-scale hover:bg-gold-hover hover:shadow-xl">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.25 3v5.25a2.25 2.25 0 002.25 2.25h5.25M4.5 12h15.75M4.5 12l3-3m-3 3l3 3" />
                        </svg>
                        Give Feedback Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.setAttribute('data-animate', 'visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('[data-animate]').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush
