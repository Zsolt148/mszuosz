<template>
    <app-layout>
        <template #header>
            Dokumentumok
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-5" v-for="(document, name) in documents" :key="document.id">
                <div class="text-xl">{{types[name]}}</div>
                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="table-auto whitespace-nowrap w-full">
                        <tr class="rounded-lg font-bold border-b text-center">
                            <th class="px-6 pt-6 pb-4">Dátum</th>
                            <th class="px-6 pt-6 pb-4">Cím</th>
                            <th class="px-6 pt-6 pb-4">Csatolmány</th>
                        </tr>
                        <tr v-for="doc in document" :key="doc.id" class="hover:bg-gray-100 border-b border-gray-200 py-10 text-center">
                            <td class="px-6 py-4">{{doc.date_val}}</td>
                            <td class="px-6 py-4">{{doc.name}}</td>
                            <td class="px-6 py-4 flex justify-center items-center hover:text-blue-600 underline">
                                <icon name="pdf" class="w-5 h-5 mr-2"></icon>
                                <a class="mr-3" v-for="(file, key) in doc.files" :key="key" target="_blank" :href="route('home') + '/' + file">
                                    {{doc.name}}<span v-if="doc.files.length != 1">&nbsp;{{key+1}}</span>.pdf
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
