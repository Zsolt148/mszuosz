<template>
    <app-layout>
        <template #header>
            <inertia-link class="text-blue-500 hover:text-blue-600" :href="route('teams.index')">Egyesületek</inertia-link>
            <span class="text-blue-500 font-medium"> /</span>
            {{ content.name }}
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md p-5 rounded-md">
                <div class="mb-8">
                    <div class="text-2xl">{{ content.name }}</div>
                </div>
                <div class="flex flex-col space-y-2 sm:space-y-4 w-full">
                    <div v-if="content.short">Rövidítés: {{content.short}}</div>
                    <div><span class="font-bold">Egyesületi nyilvántartási szám:</span> {{content.SA}}</div>
                    <div><span class="font-bold">Címe:</span> {{content.address}}</div>
                    <div v-if="content.webpage"><span class="font-bold">Weboldal:</span> <a :href="content.webpage" class="text-blue-500 underline" target="_blank">{{content.webpage}}</a></div>
                    <div v-if="content.president"><span class="font-bold">Elnök:</span> {{content.president}}</div>
                    <div v-if="content.email"><span class="font-bold">Email cím:</span> {{content.email}}</div>
                    <div v-if="content.contact_name"><span class="font-bold">Kapcsolattartó neve:</span> {{content.contact_name}}</div>
                    <div v-if="content.contact_email"><span class="font-bold">Kapcsolattartó email címe:</span> {{content.contact_email}}</div>
                </div>
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
