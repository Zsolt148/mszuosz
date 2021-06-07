<template>
    <app-layout>
        <template #header>
            <inertia-link class="text-blue-500 hover:text-blue-600" :href="route('news.index')">Hírek</inertia-link>
            <span class="text-blue-500 font-medium"> /</span>
            {{ content.name }}
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md p-5 rounded-md">
                <div class="mb-5 flex flex-col sm:flex-row justify-between">
                    <div class="text-2xl">{{ content.name }}</div>
                    <div class="flex items-center mt-3 sm:mt-0">
                        <span v-if="content.type == 'important'" class="text-red-500 mr-2">Fontos</span>
                        <span v-else-if="content.type == 'highlighted'" class="text-blue-500 mr-2">Kiemelt</span>
                        <p class="flex text-gray-600 font-semibold">
                            <icon name="calendar" class="w-4 h-4 mt-1 mr-2" />
                            <span>{{content.date_val}}</span>
                        </p>
                    </div>
                </div>
                <div class="flex flex-row flex-wrap">
                    <span v-for="tag in content.tags" :key="tag.id" class="text-gray-500 mr-2">#{{tag.name}}</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-6 text-gray-600 w-full">
                </div>
                <article class="my-5 mx-auto prose-sm sm:prose lg:prose-lg xl:prose-xl" id="body" v-html="content.body"/>
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

<style scoped>
ol, ul {
    list-style-type: inherit;
}
</style>
