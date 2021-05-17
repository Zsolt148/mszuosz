<template>
    <app-layout>
        <template #header>
            <inertia-link class="text-blue-500 hover:text-blue-600" :href="route('news.index')">Hírek</inertia-link>
            <span class="text-blue-500 font-medium"> /</span>
            {{ content.name }}
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md p-5 rounded-md">
                <div class="my-5" v-html="content.body"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    components: {
        AppLayout
    },
    props: {
        content: Object,
    }
}
</script>

<style scoped>
ol {
    list-style: decimal;
    margin-left: 2em;
}

ul {
    list-style: disc;
    margin-left: 2em;
}
</style>
