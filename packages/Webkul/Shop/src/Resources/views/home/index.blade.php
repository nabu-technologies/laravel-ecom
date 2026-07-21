@php
    $channel = core()->getCurrentChannel();
@endphp

<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="{{ $channel->home_seo['meta_title'] ?? '' }}" />

    <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}" />

    <meta name="keywords" content="{{ $channel->home_seo['meta_keywords'] ?? '' }}" />
@endPush

@push('styles')
    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes marquee-reverse {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .animate-marquee {
            animation: marquee linear infinite;
        }

        .animate-marquee-reverse {
            animation: marquee-reverse linear infinite;
        }
    </style>
@endpush

@push('scripts')
    @if (!empty($categories))
        <script>
            localStorage.setItem('categories', JSON.stringify(@json($categories)));
        </script>
    @endif

    <script
    type="text/x-template"
    id="v-distributions-landing-page-template">
    <div class="min-h-screen flex flex-col">
            <div class="flex-1">
                <div class="w-full bg-white">
                <!-- ===== HERO SECTION ===== -->
                <section :style="{ marginTop: `-${HEADER_HEIGHT}px` }"
                    class="relative min-h-screen flex items-center justify-center overflow-hidden bg-white">
                    <!-- HeroBg, inlined as a template fragment instead of a separate component -->
                    <div class="absolute inset-0 overflow-hidden pointer-events-none bg-white">
                        <div class="w-full h-full opacity-10">
                            <div v-for="(row, idx) in rows" :key="idx" :style="{ animationDuration: '150s' }" :class="[
                            'flex w-max gap-6 mb-6',
                            idx % 2 === 0 ? 'animate-marquee' : 'animate-marquee-reverse',
                            ]">
                            <component :is="Icon" v-for="(Icon, i) in multipliedIcons.slice(row)" :key="`${row}-${i}`" :size="40"
                                :stroke-width="1.5" class="text-emerald-500" />
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[500px] max-w-7xl m-auto px-4 sm:px-6 lg:px-8 w-full relative z-9 py-3">
                        <div class="text-center space-y-8 transition-all duration-700"
                            :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                            <!-- Badge -->
                            <Marquee class="shadow-[0px_0px_35px_30px_#ffffff] px-2 relative z-21" :items="marqueeItems"
                            :width-percent="70" container-width reverse />

                            <!-- Main headline -->
                            <div class="space-y-5 relative z-20 mb-5">
                            <h1
                                class="bg-white shadow-[0px_0px_35px_30px_#ffffff] px-2 w-fit m-auto text-5xl/[1.25] sm:text-6xl/[1.25] md:text-7xl/[1.25] font-bold text-neutral-900">
                                <!-- Stop<span class="text-brand-green"> Worrying</span> About
                                <span class="text-brand-green">Bills</span> -->
                                 Verifications Made <span class="text-brand-green"> Easy</span> &
                                <span class="text-brand-green"> Accessible</span>  
                            </h1>
                            <p
                                class="bg-white shadow-[0px_-4px_35px_30px_#ffffff] text-xl/[1.5] sm:text-2xl/[1.5] text-neutral-600 max-w-3xl mx-auto">
                                Verify Aadhaar, PAN, GST, Bank Accounts and more using secure APIs with lightning-fast response times.
                            </p>
                            </div>

                            <!-- CTA Buttons -->
                        <div
                            class="flex  xs:flex-row gap-4 justify-center items-center relative z-10 bg-white shadow-[0px_0px_35px_30px_#ffffff] mx-auto w-fit transition-all duration-500 delay-200"
                            :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2'">
                            @guest('customer')
                            {{-- User NOT logged in --}}
                            <AnimatedButton variant="primary" class="text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="openSignup">
                                <span class="flex items-center justify-center gap-1 whitespace-nowrap">
                                Sign Up
                                <ArrowRight class="w-5 h-5" />
                                </span>
                            </AnimatedButton>
                            <AnimatedButton variant="secondary" class="whitespace-nowrap hover:bg-[#c9f73c] text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="openLogin">
                                Explore
                            </AnimatedButton>
                             @else
                             {{-- User already logged in --}}
                             <AnimatedButton variant="primary" class="text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="redirect('{{route('shop.customers.account.profile.index')}}')">
                                <span class="flex items-center justify-center gap-1 whitespace-nowrap">
                                 Go to Profile
                                <ArrowRight class="w-5 h-5" />
                                </span>
                            </AnimatedButton>
                            <AnimatedButton variant="secondary" class="whitespace-nowrap hover:bg-[#c9f73c] text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="openLogin">
                                Explore
                            </AnimatedButton>
                             @endguest
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ===== UTILITIES SHOWCASE ===== -->
                <section ref="utilitiesSection" class="py-20 bg-neutral-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16 transition-all duration-600"
                        :class="utilitiesVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                        <h2 class="text-4xl md:text-5xl font-bold text-neutral-900 mb-4">
                        <!-- <span class="text-brand-green">Simplify</span> your monthly chores
                        </h2>
                        <p class="text-xl text-neutral-600 max-w-2xl mx-auto">
                        One platform for all your needs - less hassle, more time back in your day.
                        </p> -->
                        <span class="text-brand-green">Simplify</span> Your Verification
                        </h2>
                        <p class="text-xl text-neutral-600 max-w-2xl mx-auto">
                        One platform for all your KYC & compliance needs. Less hassle, instant results, more time back in your day.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 px-3 xs:px-0 gap-6">
                        <div v-for="(item, index) in utilities" :key="index"
                        class="relative text-center transition-all duration-700"
                        :class="utilitiesVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        :style="{ transitionDelay: `${index * 0.2}s` }">
                            <div class="relative mb-8">
                                <div
                                class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-brand-green to-emerald-500 flex items-center justify-center text-white shadow-lg">
                                <component :is="item.icon" class="h-8 w-8" />
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-neutral-900 mb-3">
                                [[ item.category ]]
                            </h3>
                            <p class="text-neutral-600 text-sm px-3 xs:px-1 leading-relaxed">
                                [[ item.description ]]
                            </p>
                        </div>
                    </div>
                    </div>
                </section>

                <!-- ===== FEATURES SECTION ===== -->
                <section ref="featuresSection" class="py-20 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16 transition-all duration-600"
                        :class="featuresVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-5'">
                        <h2 class="text-4xl md:text-5xl font-bold text-neutral-900 mb-4">Why Choose Us?</h2>
                        <p class="text-xl text-neutral-600 max-w-2xl mx-auto">
                            Experience the fastest and most secure way to complete your KYC and verifications in one place. 
                                Instant results using government APIs - no paperwork, no waiting, no hassle.
                        <!-- Experience the easiest way to manage all your chores in one place -->
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 lg:mb-12">
                        <div v-for="(feature, index) in features" :key="index"
                        class="group relative rounded-3xl border border-neutral-200 bg-neutral-50 p-8 transition-all duration-300 hover:shadow-xl hover:shadow-black/5 hover:border-brand-green/20 hover:-translate-y-2"
                        :class="featuresVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        :style="{ transitionDelay: `${feature.delay}s` }">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                            class="bg-brand-light-green flex-shrink-0 text-brand-green w-16 h-16 flex items-center justify-center rounded-2xl transition-all group-hover:bg-brand-green group-hover:text-white group-hover:scale-110">
                            <component :is="feature.icon" class="w-8 h-8" />
                            </div>
                            <h3 class="text-xl font-semibold text-neutral-900">
                                [[ feature.title ]]
                            </h3>
                        </div>
                        <p class="text-neutral-600 leading-relaxed">[[ feature.description ]]</p>
                        <div
                            class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity bg-gradient-to-r from-transparent via-brand-green/5 to-transparent">
                        </div>
                        </div>
                    </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="py-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative overflow-hidden rounded-3xl p-10 sm:p-14 md:p-20 text-center shadow-xl bg-neutral-900">
                        <!-- Background decorative rings -->
                        <div aria-hidden="true" class="pointer-events-none absolute inset-0" :style="{
                        backgroundImage:
                            'repeating-radial-gradient(circle at center, rgba(255,255,255,0.05) 0, rgba(255,255,255,0.05) 1px, rgba(0,0,0,0) 1px, rgba(0,0,0,0) 110px)',
                        }" />
                        <!-- Dashed border effect -->
                        <div aria-hidden="true"
                        class="pointer-events-none absolute inset-4 rounded-2xl border border-dashed border-white/30" />
                        <div class="max-w-4xl mx-auto">
                        <h2 class="text-4xl md:text-5xl font-bold text-white tracking-tight">Ready to Verify Instantly?</h2>
                        <p class="mt-6 text-lg md:text-xl text-neutral-300">
                            Join thousands of retailers and businesses completing KYC faster and easier.
                        </p>
                      <div
                            class="flex  xs:flex-row gap-4 justify-center items-center relative z-0 mx-auto w-fit transition-all duration-500 delay-200"
                            :class="heroVisible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2'">
                            @guest('customer')
                            {{-- User NOT logged in --}}
                            <AnimatedButton variant="primary" class="text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="openSignup">
                                <span class="flex items-center justify-center gap-1 whitespace-nowrap">
                                Sign Up
                                <ArrowRight class="w-5 h-5" />
                                </span>
                            </AnimatedButton>
                            <AnimatedButton variant="secondary" class="whitespace-nowrap text-black hover:bg-[#c9f73c] text-lg font-medium px-8 py-4 w-full xs:w-auto border-none"
                                @click="openLogin">
                                Explore
                            </AnimatedButton>
                             @else
                             {{-- User already logged in --}}
                             <AnimatedButton variant="primary" class="text-lg font-medium px-8 py-4 w-full xs:w-auto"
                                @click="redirect('{{route('shop.customers.account.profile.index')}}')">
                                <span class="flex items-center justify-center gap-1 whitespace-nowrap">
                                 Go to Profile
                                <ArrowRight class="w-5 h-5" />
                                </span>
                            </AnimatedButton>
                            <AnimatedButton variant="secondary" class="whitespace-nowrap text-black hover:bg-[#c9f73c] text-lg font-medium px-8 py-4 w-full xs:w-auto border-none"
                                @click="openLogin">
                                Explore
                            </AnimatedButton>
                             @endguest
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
                </div>
            </div>
        </div>
    </script>



    <script
    type="text/x-template"
    id="v-marquee-template">
    <div
            class="overflow-hidden"
            :style="containerWidth ? { width: `${widthPercent}%`, margin: '0 auto' } : {}"
        >
            <div
                class="flex w-max gap-8"
                :class="reverse ? 'animate-marquee-reverse' : 'animate-marquee'"
                style="animation-duration: 30s"
            >
                <div
                    v-for="(item, i) in loopItems"
                    :key="i"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-neutral-50 border border-neutral-200 text-sm font-medium text-neutral-700 whitespace-nowrap"
                >
                    <component :is="item.icon" class="w-4 h-4 text-brand-green" />
                    <span>[[ item.label ]]</span>
                </div>
            </div>
        </div>
    </script>



    <script
    type="text/x-template"
    id="v-animated-button-template">
    <button
            type="button"
            @click="handleClick"
            class="inline-flex items-center  justify-center rounded-xl transition-all duration-300 active:scale-95"
            :class="[
            variant === 'primary' &&
                'bg-brand-green text-white hover:bg-brand-green hover:shadow-sm hover:shadow-brand-green',
            variant === 'secondary' &&
                'bg-white text-[#11D359] border border-[#11D359] hover:text-black ',
            variant === 'noBorder' &&
                'bg-transparent text-white hover:text-brand-green',
            ]"
        >
            <slot />
        </button>
    </script>

    <script type="module">
        import * as LucideIcons from "https://esm.sh/lucide-vue-next@latest";


        const {
            ArrowRight,
            Zap,
            TrendingUp,
            Smartphone,
            Lock,
            Clock,
            Wifi,
            Handshake,
            Droplets,
            Flame,
            ShieldCheck,
            Tv,
            IdCard,
            PhoneCall,
            Car,
            CarFront,
            Fingerprint,
            BookUser,
            Landmark,
            ShieldAlert,
            Vote

        } = LucideIcons;

        const HEADER_HEIGHT = 64.67;

        const range = (n) => [...Array(n).keys()];

        const shuffle = (a) => {
            const array = [...a];
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        };

        const PageComponent = {
            template: '#v-distributions-landing-page-template',
            name: "Distributions",
            delimiters: ["[[", "]]"],

            components: {
                Marquee: {
                    template: "#v-marquee-template",
                    delimiters: ["[[", "]]"],
                    props: {
                        items: {
                            type: Array,
                            default: () => [], // each item: { label: string, icon: Component }
                        },
                        widthPercent: {
                            type: [Number, String],
                            default: 100,
                        },
                        containerWidth: {
                            type: Boolean,
                            default: false,
                        },
                        reverse: {
                            type: Boolean,
                            default: false,
                        },
                    },
                    computed: {
                        loopItems() {
                            return [...this.items, ...this.items];
                        }
                    }

                },
                AnimatedButton: {
                    template: "#v-animated-button-template",
                    delimiters: ["[[", "]]"],
                    props: {
                        variant: {
                            type: String,
                            default: "primary", // "primary" | "secondary" | "noBorder"
                        },
                    },
                    emits: ["click"],
                    methods: {
                        handleClick(e) {
                            this.$emit("click", e);
                        }
                    }
                },
                ArrowRight,
            },

            data() {
                return {
                    HEADER_HEIGHT,

                    signupUrl: "/customer/register",
                    loginUrl: "/products",

                    bgIcons: [ShieldCheck, IdCard, Wifi, Tv, Flame, Droplets, PhoneCall, Zap, Car, CarFront,
                        Fingerprint,
                        BookUser, Landmark, ShieldAlert, Vote
                    ],
                    rows: shuffle(range(35)),

                    utilities: [{
                            category: "Contact Data Verification",
                            icon: IdCard,
                            description: "Verify customer name, DOB, gender, and address details."
                        },
                        {
                            category: "Financial Verification",
                            icon: CarFront,
                            description: "Validate driving license details quickly and accurately."
                        },
                        {
                            category: "Identity Verification",
                            icon: Fingerprint,
                            description: "Verify vehicle registration and ownership information."
                        },
                        {
                            category: "Business Verification",
                            icon: BookUser,
                            description: "Perform secure Aadhaar-based identity verification."
                        },
                        // {
                        //     category: "Banking Verification",
                        //     icon: Landmark,
                        //     description: "Verify UAN and banking-related information securely."
                        // },
                        // {
                        //     category: "Contact Verification",
                        //     icon: Car,
                        //     description: "Verify vehicle registration and ownership information."
                        // },

                        // {
                        //     category: "Email Verification",
                        //     icon: ShieldCheck,
                        //     description: "Verify email addresses to ensure authenticity and validity."
                        // },
                        // {
                        //     category: "Mobile Verification",
                        //     icon: Vote,
                        //     description: "Validate mobile numbers and confirm active user details."
                        // }
                    ],

                    marqueeItems: [{
                            label: "Aadhar Demographic",
                            icon: IdCard
                        },
                        {
                            label: "Driving License Verification",
                            icon: CarFront
                        },
                        {
                            label: "Offline Aadhar KYC",
                            icon: Fingerprint
                        },
                        {
                            label: "Passport Verification",
                            icon: BookUser
                        },
                        {
                            label: "RC Verification",
                            icon: Car
                        },
                        {
                            label: "UAN Verification Plus",
                            icon: Landmark
                        },
                        {
                            label: "Vehicle Challan Lookup",
                            icon: ShieldAlert
                        },
                        {
                            label: "Voter ID Verification",
                            icon: Vote
                        },
                    ],

                    features: [{
                            icon: Clock,
                            title: "Verify in Seconds",
                            description: "Complete KYC instantly with real-time government API response. No more waiting.",
                            delay: 0,
                        },
                        {
                            icon: Zap,
                            title: "Instant Onboarding",
                            description: "Start verifying customers or documents in under a minute with simple integration",
                            delay: 0.1,
                        },
                        {
                            icon: Smartphone,
                            title: "Any Device, Anytime",
                            description: "Access from mobile, tablet, or desktop. Fully responsive and seamless experience.",
                            delay: 0.2,
                        },
                        {
                            icon: TrendingUp,
                            title: "Complete Audit Trail",
                            description: "Full verification history, reports, and compliance records at one place.",
                            delay: 0.3,
                        },
                        {
                            icon: Lock,
                            title: "Bank-Grade Security",
                            description: "End-to-end encryption and secure data handling as per regulatory standards.",
                            delay: 0.4,
                        },
                        {
                            icon: Handshake,
                            title: "24/7 Support",
                            description: "Dedicated support team ready to help you with any verification related queries.",
                            delay: 0.5,
                        },
                    ],

                    // whileInView replacement state
                    heroVisible: false,
                    utilitiesVisible: false,
                    featuresVisible: false,

                    // hold IntersectionObserver instances so we can disconnect them
                    _utilitiesObserver: null,
                    _featuresObserver: null,
                };
            },

            computed: {
                multipliedIcons() {
                    return range(20).flatMap(() => [...this.bgIcons]);
                },
            },

            mounted() {
                // mimics initial -> animate on mount for the hero section
                requestAnimationFrame(() => {
                    this.heroVisible = true;
                });

                // utilities section observer
                this._utilitiesObserver = new IntersectionObserver(
                    ([entry]) => {
                        if (entry.isIntersecting) {
                            this.utilitiesVisible = true;
                            this._utilitiesObserver.disconnect();
                        }
                    }, {
                        threshold: 0.2
                    }
                );
                if (this.$refs.utilitiesSection) {
                    this._utilitiesObserver.observe(this.$refs.utilitiesSection);
                }

                // features section observer
                this._featuresObserver = new IntersectionObserver(
                    ([entry]) => {
                        if (entry.isIntersecting) {
                            this.featuresVisible = true;
                            this._featuresObserver.disconnect();
                        }
                    }, {
                        threshold: 0.2
                    }
                );
                if (this.$refs.featuresSection) {
                    this._featuresObserver.observe(this.$refs.featuresSection);
                }
            },

            beforeUnmount() {
                // cleanup observers if the component is destroyed before they fire
                if (this._utilitiesObserver) this._utilitiesObserver.disconnect();
                if (this._featuresObserver) this._featuresObserver.disconnect();
            },

            methods: {
                openSignup() {
                    window.open(this.signupUrl, "_blank", "noopener,noreferrer");
                },
                openLogin() {
                    window.open(this.loginUrl, "_blank", "noopener,noreferrer");
                },
                redirect(url) {
                    window.open(url, "_blank", "noopener,noreferrer");
                }
            },
        };


        app.component('v-distributions-page', PageComponent);
    </script>
@endpush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{ $channel->home_seo['meta_title'] ?? '' }}
    </x-slot>

    {{-- Starting main page --}}

    {{-- End main page --}}

    <!-- Loop over the theme customization -->
    {{-- @foreach ($customizations as $customization)
        @php ($data = $customization->options) @endphp

        <!-- Static content -->
        @switch ($customization->type)
            @case ($customization::IMAGE_CAROUSEL)
                <!-- Image Carousel -->
                <x-shop::carousel
                    :options="$data"
                    aria-label="{{ trans('shop::app.home.index.image-carousel') }}"
        />

        @break
        @case ($customization::STATIC_CONTENT)
        <!-- push style -->
        @if (!empty($data['css']))
        @push('styles')
        <style>
        {{ $data['css'] }}
        </style>
        @endpush
        @endif

        <!-- render html -->
        @if (!empty($data['html']))
        {!! $data['html'] !!}
        @endif

        @break
        @case ($customization::CATEGORY_CAROUSEL)
        <!-- Categories carousel -->
        <x-shop::categories.carousel
            :title="$data['title'] ?? ''"
            :src="route('shop.api.categories.index', $data['filters'] ?? [])"
            :navigation-link="route('shop.home.index')"
            aria-label="{{ trans('shop::app.home.index.categories-carousel') }}" />

        @break
        @case ($customization::PRODUCT_CAROUSEL)
        <!-- Product Carousel -->
        <x-shop::products.carousel
            :title="$data['title'] ?? ''"
            :src="route('shop.api.products.index', $data['filters'] ?? [])"
            :navigation-link="route('shop.search.index', $data['filters'] ?? [])"
            aria-label="{{ trans('shop::app.home.index.product-carousel') }}" />

        @break
        @endswitch
        @endforeach --}}

    <v-distributions-page />
</x-shop::layouts>
