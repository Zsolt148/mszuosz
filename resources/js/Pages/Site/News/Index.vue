<template>
    <app-layout>
        <template #header>
            Hírek
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-full px-4 py-1 border-gray-300 rounded-md mr-2" autocomplete="off" type="text"
                       name="search" placeholder="Keresés…" v-model="params.search"/>
                <jet-secondary-button @click="reset">
                    Törlés
                </jet-secondary-button>
            </div>

            <pagination class="my-5" :links="news.links"/>

            <div v-for="data in news.data" :key="data.id" class="mx-auto mb-6 px-4 py-2 bg-white shadow hover:shadow-md transition-shadow duration-300 ease-in-out rounded-lg w-full border-r-8" :class="data.type == 'important' ? 'border-red-500' : data.type == 'highlighted' ? 'border-blue-500' : ''">
                <div class="py-2 flex flex-col sm:flex-row justify-between">
                    <div class="flex flex-row items-center">
                        <inertia-link class="text-2xl flex text-blue-600 focus:text-blue-800 w-full relative one" :href="route('news.show', data.slug)">
                            <span>{{ data.name }}</span>
                            <span class="absolute -bottom-1 left-0 w-0 transition-all h-0.5 bg-blue-600"></span>
                        </inertia-link>
                    </div>
                    <div class="flex items-center mt-3 sm:mt-0">
                        <span v-if="data.type == 'important'" class="text-red-500 mr-2">Fontos</span>
                        <span v-else-if="data.type == 'highlighted'" class="text-blue-500 mr-2">Kiemelt</span>
                        <p class="font-semibold text-gray-600 flex">
                            <icon name="calendar" class="w-4 h-4 mt-1 mr-2" />
                            <span>{{data.date_val}}</span>
                        </p>
                    </div>
                </div>
                <div class="flex flex-row flex-wrap">
                    <span v-for="tag in data.tags" :key="tag.id" class="text-gray-500 mr-2">#{{tag.name}}</span>
                </div>
                <div class="py-2">
                    <article class="prose max-w-none" v-html="data.body.substring(0, 500)+'...'" />
                </div>
                <div>
                    <div class="py-2 flex flex-row items-center">
                        <inertia-link class="flex text-blue-400 hover:underline" :href="route('news.show', data.slug)">
                            Tovább <icon name="arrow-right" class="w-4 h-4 mt-1 ml-1"></icon>
                        </inertia-link>
                    </div>
                </div>
            </div>

            <div v-if="news.data.length === 0" class="">
                Nincs a keresésnek '{{params.search}}' megfelelő találat
            </div>

            <pagination :links="news.links"></pagination>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";
import Pagination from "@/Shared/Pagination";
import {throttle} from "lodash";
import pickBy from "lodash/pickBy";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        AppLayout,
        Icon,
        Pagination,
        JetButton,
        JetSecondaryButton,
    },
    props: {
        news: Object,
        filters: Object
    },
    data() {
        return {
            params: {
                search: this.filters.search,
            },
        };
    },
    methods: {
        reset() {
            this.$inertia.get(this.route('news.index'));
        }
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('news.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
}
</script>

<style scoped>
.one:hover span:last-child {
    width: 100%;
}
</style>
