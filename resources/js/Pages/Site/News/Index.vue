<template>
    <app-layout>
        <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 my-6 px-4 md:px-6 lg:px-8">
                <div v-for="data in news.data" :key="data.id" class="mx-auto px-4 py-4 bg-white shadow-md rounded-lg w-full">
                    <div class="py-2 flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center">
                            <inertia-link class="text-2xl flex text-blue-500 focus:text-blue-800" :href="route('news.show', data.slug)">
                                {{ data.name }}
                            </inertia-link>
                        </div>
                        <div class="flex flex-row items-center">
                            <p class="font-semibold text-gray-700">{{ data.created_at }}</p>
                        </div>
                    </div>
                    <div class="py-2">
                        <p class="leading-snug">
                            <div v-html="data.body.substring(0, 500)+'...'" />
                        </p>
                    </div>
                    <div>
                        <div class="py-2 flex flex-row items-center">
                            <inertia-link class="flex text-blue-400" :href="route('news.show', data.slug)">
                                Tovább
                                <icon name="cheveron-right" class="w-5 h-5"></icon>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            <pagination :links="news.links"></pagination>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";
import Pagination from "@/Shared/Pagination";
export default {
    components: {
        AppLayout,
        Icon,
        Pagination,
    },
    props: {
        news: Object,
    }
}
</script>
