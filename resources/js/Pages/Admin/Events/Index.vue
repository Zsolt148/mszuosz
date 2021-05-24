<template>
    <admin-layout>
        <template #header>
            Versenyek  - <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:events.create')">Új verseny</inertia-link>
        </template>

        <div>
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-4/5 px-4 py-1 rounded-md border-gray-300 mr-2" autocomplete="off" type="text" name="search" placeholder="Keresés…" v-model="params.search"/>
                <select name="year" id="year" v-model="params.year" class="block rounded-md border-gray-300 py-1 w-1/5 focus:outline-none mr-2">
                    <option value="null" selected>Év</option>
                    <option v-for="year in years" :key="year" :value="year">{{year}}</option>
                </select>
                <jet-button @click="reset">
                    Visszaállítás
                </jet-button>
            </div>

            <pagination class="my-5" :links="events.links" />

            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('name')">
                                Név
                                <icon v-if="params.field === 'name' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'name' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('date')">
                                Dátum
                                <icon v-if="params.field === 'date' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'date' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between">
                                Helyszín
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('category')">
                                Kategória
                                <icon v-if="params.field === 'category' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'category' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('is_visible')">
                                Látható
                                <icon v-if="params.field === 'is_visible' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'is_visible' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('created_at')">
                                Létrehozva
                                <icon v-if="params.field === 'created_at' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'created_at' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                    </tr>
                    <tr v-for="event in events.data" :key="event.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center focus:text-indigo-500" :href="route('admin:events.edit', event.id)">
                                {{ event.name }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:events.edit', event.id)" tabindex="-1">
                                {{ event.period }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:events.edit', event.id)" tabindex="-1">
                                <img class="mr-2" :src="'https://www.countryflags.io/' + event.location.code + '/flat/24.png'"> {{ event.location.city }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:events.edit', event.id)" tabindex="-1">
                                {{ event.category }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:documents.edit', event.id)" tabindex="-1">
                                <span v-if="event.is_visible" class="text-green-600">Igen</span><span v-else class="text-red-600">Nem</span>
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:events.edit', event.id)" tabindex="-1">
                                {{ event.created_at }}
                            </inertia-link>
                        </td>
                        <td class="border-t w-px">
                            <inertia-link class="px-4 flex items-center" :href="route('admin:events.edit', event.id)" tabindex="-1">
                                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                            </inertia-link>
                        </td>
                    </tr>
                    <tr v-if="events.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="4">Nem található verseny.</td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" :links="events.links" />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import pickBy from 'lodash/pickBy'
import JetButton from "@/Jetstream/Button";
import Icon from '@/Shared/Icon'
import {throttle} from "lodash";
import Pagination from '@/Shared/Pagination'

export default {
    components: {
        Icon,
        JetButton,
        AdminLayout,
        Pagination,
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
            this.$inertia.get(this.route('admin:events.index'));
        }
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('admin:events.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
};
</script>
