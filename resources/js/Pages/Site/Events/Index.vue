<template>
    <app-layout>
        <template #header>
            Versenyek
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-4/5 px-4 py-1 border-gray-300 rounded-md mr-2" autocomplete="off" type="text"
                       name="search" placeholder="Keresés…" v-model="params.search"/>
                <select name="year" id="year" v-model="params.year" class="block rounded-md border-gray-300 py-1 w-1/5 focus:outline-none mr-2">
                    <option value="null" selected>Év</option>
                    <option v-for="year in years" :key="year" :value="year">{{year}}</option>
                </select>
                <jet-secondary-button @click="reset">
                    Törlés
                </jet-secondary-button>
            </div>

            <pagination class="my-5" v-if="events.links" :links="events.links"/>

            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('name')">
                                Név
                                <icon v-if="params.field === 'name' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'name' && params.direction === 'desc'" name="cheveron-down"
                                      class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('period')">
                                Időpont
                                <icon v-if="params.field === 'period' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'period' && params.direction === 'desc'" name="cheveron-down"
                                      class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('location')">
                                Helyszín
                                <icon v-if="params.field === 'location' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'location' && params.direction === 'desc'"
                                      name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('category')">
                                Kategória
                                <icon v-if="params.field === 'category' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'category' && params.direction === 'desc'"
                                      name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between">
                                Versenykiírás
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between">
                                Jegyzőkönyv
                            </span>
                        </th>
                    </tr>
                    <tr v-for="event in (events.data ? events.data : events)" :key="event.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :href="route('events.show', event.slug)">
                                <span v-if="event.name.length >= 50">{{ event.name.substring(0, 50)+'..' }}</span><span v-else>{{ event.name }}</span>
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :href="route('events.show', event.slug)" tabindex="-1">
                                {{ event.period }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :href="route('events.show', event.slug)" tabindex="-1">
                                <img class="mr-2" :src="getFlag(event.location.code)" width="24" height="24"> {{ event.location.city }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :href="route('events.show', event.slug)" tabindex="-1">
                                {{ event.category }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <div class="px-6 py-4 items-center hover:text-blue-600" v-if="event.race_info">
                                <a target="_blank" :href="route('home') + '/events/' + event.slug + '/' + event.race_info"><icon name="pdf" class="w-5 h-5"></icon></a>
                            </div>
                        </td>
                        <td class="border-t">
                            <div class="px-6 py-4 items-center hover:text-blue-600" v-if="event.report">
                                <a target="_blank" :href="route('home') + '/events/' + event.slug + '/' + event.report"><icon name="pdf" class="w-5 h-5"></icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="events.data && events.data.length === 0">
                        <td class="border-t px-6 py-4" colspan="7">
                            Nincs egyetlen verseny sem
                        </td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" v-if="events.links" :links="events.links"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {throttle} from "lodash";
import pickBy from "lodash/pickBy";
import Pagination from "@/Shared/Pagination";
import JetButton from "@/Jetstream/Button";
import Icon from '@/Shared/Icon';
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        AppLayout,
        Pagination,
        JetButton,
        JetSecondaryButton,
        Icon,
    },
    props: {
        filters: Object,
        events: Object,
        years: Array,
    },
    data() {
        return {
            params: {
                search: this.filters.search,
                year: this.filters.year,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        };
    },
    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },
        reset() {
            this.$inertia.get(this.route('events.index'));
        }
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('events.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
}
</script>
