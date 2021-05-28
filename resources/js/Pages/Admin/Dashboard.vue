<template>
    <admin-layout>
        <template #header>
            Kezdőlap
        </template>

        <div class="container max-w-7xl px-5 mx-auto my-28">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="text-base">Feltöltöt fájlok száma</div>
                    <div class="flex items-center pt-1">
                        <div class="text-2xl font-bold text-gray-900 ">{{data.files}} db</div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="text-base">Hírek</div>
                    <div class="text-gray-600 text-sm">Látható / Nem látható</div>
                    <div class="flex items-center pt-1">
                        <div class="text-2xl font-bold text-gray-900 ">
                            <span class="text-green-500">{{data.visible_news}} db</span> / <span class="text-red-500">{{data.not_visible_news}} db</span>
                        </div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="text-base">Versenyek</div>
                    <div class="text-gray-600 text-sm">Látható / Nem látható</div>
                    <div class="flex items-center pt-1">
                        <div class="text-2xl font-bold text-gray-900 ">
                            <span class="text-green-500">{{data.visible_events}} db</span> / <span class="text-red-500">{{data.not_visible_events}} db</span>
                        </div>
                    </div>
                </div>
                <div class="p-5 bg-white rounded shadow-sm">
                    <div class="text-base">Dokumentumok</div>
                    <div class="text-gray-600 text-sm">Látható / Nem látható</div>
                    <div class="flex items-center pt-1">
                        <div class="text-2xl font-bold text-gray-900 ">
                            <span class="text-green-500">{{data.visible_documents}} db</span> / <span class="text-red-500">{{data.not_visible_documents}} db</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </admin-layout>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        components: {
            AdminLayout,
        },
        props: {
            data: Array,
        },
        data() {
            return {
            };
        },
    }
</script>
