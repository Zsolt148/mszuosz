<template>
    <app-layout>
        <template #header>
            Dokumentumok
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div v-for="(type, key) in types" :key="type.id">
                <div class="mb-6" v-if="documents[type.id]">
                    <div class="text-2xl mb-2">{{ type.name }}</div>
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="table-auto whitespace-nowrap w-full">
                            <tr class="rounded-lg font-bold border-b text-left">
                                <th class="px-4 py-4">Dátum</th>
                                <th class="px-4 py-4">Cím</th>
                                <th class="px-4 py-4">Csatolmány</th>
                            </tr>
                            <tr v-for="doc in documents[type.id]" :key="doc.id" class="hover:bg-gray-100 border-b border-gray-200">
                                <td class="px-4 py-2">{{doc.date_val}}</td>
                                <td class="px-4 py-2">{{doc.name}}</td>
                                <td class="px-4 py-2 flex">
                                    <a class="flex justify-center hover:text-blue-600" v-for="(file, key) in doc.files" :key="key" target="_blank" :href="route('home') + '/documents/' + file">
                                        <icon name="empty-file" class="w-5 h-5"></icon>
                                        <span class="mr-2" v-if="doc.files.length != 1">&nbsp;{{key+1}}.</span>
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="documents.length === 0">
                                <td class="border-t px-6 py-4" colspan="4">
                                    Nincs egyetlen dokumentum sem.
                                </td>
                            </tr>
                        </table>
                    </div>
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
        documents: Object,
        types: Array,
    }
}
</script>
