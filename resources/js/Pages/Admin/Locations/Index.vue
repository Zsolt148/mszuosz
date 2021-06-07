<template>
    <admin-layout>
        <template #header>
            Helyszínek  - <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:locations.create')">Új helyszín</inertia-link>
        </template>

        <div>
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-full px-4 py-1 rounded-md border-gray-300 mr-2" autocomplete="off" type="text" name="search" placeholder="Keresés…" v-model="params.search"/>
                <jet-button @click="reset">
                    Visszaállítás
                </jet-button>
            </div>

            <pagination class="my-5" :links="locations.links" />

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
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('country')">
                                Ország
                                <icon v-if="params.field === 'country' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'country' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('city')">
                                Város
                                <icon v-if="params.field === 'city' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'city' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('address')">
                                Cím
                                <icon v-if="params.field === 'address' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'address' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
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
                    <tr v-for="location in locations.data" :key="location.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center focus:text-indigo-500" :href="route('admin:locations.edit', location.id)">
                                {{ location.name }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                                <img class="mr-2" :src="'https://www.countryflags.io/' + location.code + '/flat/24.png'"> {{ location.country }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                                {{ location.city }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                                {{ location.address }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                                {{ location.created_at }}
                            </inertia-link>
                        </td>
                        <td class="border-t w-px">
                            <inertia-link class="px-4 flex items-center" :href="route('admin:locations.edit', location.id)" tabindex="-1">
                                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                            </inertia-link>
                        </td>
                    </tr>
                    <tr v-if="locations.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="6">Nincs még helyszín</td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" :links="locations.links" />
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
        locations: Object,
    },
    data() {
        return {
            params: {
                search: this.filters.search,
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
            this.params.search = '';
        }
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('admin:locations.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
};
</script>
