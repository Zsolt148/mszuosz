<template>
    <app-layout>
        <div class="text-gray-800">
            <div class="container flex flex-col items-center px-5 py-8 sm:py-16 mx-auto md:flex-row lg:px-28">
                <div class="flex flex-col items-start mb-16 text-left lg:flex-grow md:w-1/2 md:pr-16 md:mb-0">
                    <div class="items-center w-64 mb-4 font-medium title-font md:mb-0 lg:mt-16">
                        <h2 class="font-semibold tracking-tighter text-gray-500 uppercase text-bold">
                            Üdvözöljük az új oldalon!
                        </h2>
                    </div>
                    <h1 class="my-8 text-2xl font-black tracking-tighter text-black md:text-5xl title-font one">Magyar Szenior Úszók Országos Szövetsége</h1>
                    <p v-if="content" v-html="content.body" class="mb-8 text-base leading-relaxed text-left"/>
                    <div class="flex justify-center">
                        <inertia-link :href="route('news.index')">
                            <button class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-500 rounded-lg hover:bg-gray-800 hover:to-black focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">
                                Hírek
                            </button>
                        </inertia-link>
                        <p class="text-sm text-left text-gray-600 ml-6">A szövetségről <br>
                            <inertia-link :href="route('welcome')" class="inline-flex items-center font-semibold text-blue-700 md:mb-2 lg:mb-0 hover:text-blue-400 ">
                                Részletek
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                                </svg>
                            </inertia-link>
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-5/6 lg:max-w-lg md:w-1/2">
                    <img :src="route('home') + '/images/mszuosz_logo.jpg'" class="object-cover object-center rounded-lg " alt="" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: {
      content: Object,
    },
}
</script>

<style scoped>
.one:hover span:last-child {
    width: 100%;
}
</style>
