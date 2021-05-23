<template>
    <app-layout>

        <section class="flex flex-wrap items-center h-screen md">
          <div class="container w-full h-screen bg-white md:w-1/2">
              <div class="mx-5 lg:mx-32 ">
                  <div class="items-center w-64 mt-32 mb-4 font-medium title-font md:mb-0 lg:mt-16">
                      <h2 class="font-semibold tracking-tighter text-gray-500 uppercase transition duration-1000 ease-in-out transform text-bold lg:mr-8">
                          Üdvözöljük az oldalon!
                      </h2>
                  </div>
                  <div class="flex mt-16 font-light text-gray-500">
                      <div class="pr-4">
                          <h1 class="mb-6 text-2xl font-semibold tracking-tighter text-black sm:text-6xl title-font">
                              Magyar Szenior Úszók Országos Szövetsége
                          </h1>
                      </div>
                  </div>
                  <div v-html="content.body" class="w-full mt-10 text-base font-medium text-gray-700 sm:md:w-3/3 mb-8leading-relaxed" />
                  <div class="flex flex-row space-x-2 mt-12">
                      <inertia-link :href="route('news.index')">
                          <button class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-blue-500 rounded-lg hover:bg-gray-800 hover:to-black focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">
                              Hírek
                          </button>
                      </inertia-link>
                      <inertia-link :href="route('ranks')">
                          <button class="flex items-center px-6 py-2 mt-auto font-semibold text-white transition duration-500 ease-in-out transform bg-black rounded-lg hover:bg-blue-500 hover:to-black focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">
                              Ranglisták
                          </button>
                      </inertia-link>
                  </div>
              </div>
          </div>
          <div class="hidden w-full h-screen bg-center bg-cover md:w-1/2 lg:block">
              <img src="https://dummyimage.com/1000x1000/F3F4F7/8693ac" class="object-fill w-full h-screen" alt="" />
          </div>
        </section>

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
