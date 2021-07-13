<template>
    <div>
        <div class="flex flex-col min-h-screen" :class="route().current('home') ? 'bg-white' : 'bg-gray-100'">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between md:justify-center h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('home')">
                                    <span class="font-bold text-blue-600 text-2xl">mszuosz.hu</span>
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex">
                                <jet-nav-link :href="route('home')" :active="route().current('home')">
                                    Kezdőlap
                                </jet-nav-link>
                                <jet-nav-link :href="route('news.index')" :active="route().current('news*')">
                                    Hírek
                                </jet-nav-link>
                                <jet-nav-link :href="route('events.index')" :active="route().current('events*')">
                                    Versenyek
                                </jet-nav-link>
                                <jet-nav-link :href="route('documents')" :active="route().current('documents')">
                                    Dokumentumok
                                </jet-nav-link>
                                <jet-nav-link :href="route('teams.index')" :active="route().current('teams*')">
                                    Egyesületek
                                </jet-nav-link>
                                <jet-nav-link :href="route('ranks')" :active="route().current('ranks')">
                                    Ranglisták
                                </jet-nav-link>

                            </div>
                        </div>

                        <div class="hidden md:flex md:items-center md:ml-4">
                            <jet-dropdown width="48" align="right">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-bold rounded-md bg-white text-gray-700 hover:text-blue-600 focus:outline-none transition">
                                            Szövetség

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        A szövetségről
                                    </div>

                                    <jet-dropdown-link :href="route('welcome')">
                                        Bemutatkozás
                                    </jet-dropdown-link>
                                    <jet-dropdown-link :href="route('history')">
                                        Történet
                                    </jet-dropdown-link>
                                    <jet-dropdown-link :href="route('association')">
                                        Szervezeti működés
                                    </jet-dropdown-link>
                                    <jet-dropdown-link :href="route('contact')">
                                        Elérhetőség
                                    </jet-dropdown-link>
                                </template>
                            </jet-dropdown>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center md:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="md:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('home')" :active="route().current('home')">
                            Kezdőlap
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('news.index')" :active="route().current('news*')">
                            Hírek
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('events.index')" :active="route().current('events*')">
                            Versenyek
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('documents')" :active="route().current('documents')">
                            Dokumentumok
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('teams.index')" :active="route().current('teams*')">
                            Egyesületek
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('ranks')" :active="route().current('ranks')">
                            Ranglisták
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('welcome')" :active="route().current('welcome')">
                            Bemutatkozás
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('history')" :active="route().current('history')">
                            Történet
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('association')" :active="route().current('association')">
                            Szervezeti működés
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('contact')" :active="route().current('contact')">
                            Elérhetőség
                        </jet-responsive-nav-link>
                    </div>
                </div>
            </nav>

            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-xl">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-grow">
                <slot></slot>
            </main>

            <section class="bg-gray-100 border-t border-gray-200">
                <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
                    <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                        <div class="px-5 py-2">
                            <a :href="route('impresszum')" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                Impresszum
                            </a>
                        </div>
                        <div class="px-5 py-2">
                            <a :href="route('policy')" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                Adatvédelmi Irányelvek
                            </a>
                        </div>
                        <div class="px-5 py-2">
                            <a :href="route('contact')" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                                Elérhetőség
                            </a>
                        </div>
                    </nav>
                    <p class="mt-8 text-base leading-6 text-center text-gray-400">
                        © 2021 MSZUOSZ. All rights reserved.
                    </p>
                </div>
            </section>
        </div>
        <div class="fixed bottom-5 right-0 lg:right-4 p-4 bg-white border-t-4 border-gray-300 shadow-lg rounded w-full sm:w-1/2 md:w-1/3 lg:w-1/4" v-if="!cookieAccepted">
            <h2 class="text-lg lg:text-xl mb-4 block font-bold leading-tight text-gray-600">Sütik használata</h2>
            <div class="flex flex-col">
                <p class="mb-5 font-medium text-gray-600">
                    A weboldal sütiket (cookie-kat) használ, hogy biztonságos böngészés mellett a legjobb felhasználói élményt nyújtsa.
                </p>
                <button class="w-full px-3 py-1 bg-gray-300 hover:bg-blue-500 hover:underline hover:text-white rounded text-gray-700 uppercase tracking-widest text-xs font-bold"
                        @click.prevent="acceptCookie"
                >
                    Elfogadom
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        mounted() {
            this.cookieAccepted = localStorage.getItem('cookie_accepted') == 'true' ? true : false;
        },

        data() {
            return {
                showingNavigationDropdown: false,
                cookieAccepted: false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
            acceptCookie() {
                localStorage.setItem('cookie_accepted', true);
                this.cookieAccepted = true;
            }
        }
    }
</script>
