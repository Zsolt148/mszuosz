<template>
    <app-layout>
        <template #header>
            <inertia-link class="text-blue-500 hover:text-blue-600" :href="route('news.index')">Hírek</inertia-link>
            <span class="text-blue-500 font-medium"> /</span>
            {{ content.name }}
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md p-5 rounded-md">
                <div class="mb-5 flex justify-between">
                    <div class="text-2xl">{{ content.name }}</div>
                    <div class="flex mt-2 text-gray-600">
                        <icon name="calendar" class="w-4 h-4 mt-1 mr-2" />
                        <span>{{content.date_val}}</span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-6 text-gray-600 w-full">
                </div>
                <div class="my-5" v-html="content.body"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";

export default {
    components: {
        AppLayout,
        Icon,
    },
    props: {
        content: Object,
    }
}
</script>
