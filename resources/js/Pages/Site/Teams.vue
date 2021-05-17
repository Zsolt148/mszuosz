<template>
    <app-layout>
        <template #header>
            Egyesületek
        </template>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-full px-4 py-1 rounded-md mr-2" autocomplete="off" type="text"
                       name="search" placeholder="Keresés…" v-model="params.search"/>
                <jet-button @click="reset">
                    Visszaállítás
                </jet-button>
            </div>

            <pagination class="my-5" :links="teams.links"/>

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
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('sa')">
                                SA
                                <icon v-if="params.field === 'sa' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'sa' && params.direction === 'desc'" name="cheveron-down"
                                      class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('address')">
                                Cím
                                <icon v-if="params.field === 'address' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'address' && params.direction === 'desc'"
                                      name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('webpage')">
                                Oldal
                                <icon v-if="params.field === 'webpage' && params.direction === 'asc'" name="cheveron-up"
                                      class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'webpage' && params.direction === 'desc'"
                                      name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                    </tr>
                    <tr v-for="team in teams.data" :key="team.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <span class="px-6 py-4 flex items-center">{{team.name}}</span>
                        </td>
                        <td class="border-t">
                            <span class="px-6 py-4 flex items-center">{{team.SA}}</span>
                        </td>
                        <td class="border-t">
                            <span class="px-6 py-4 flex items-center">{{team.address}}</span>
                        </td>
                        <td class="border-t">
                            <span class="px-6 py-4 flex items-center">{{team.webpage}}</span>
                        </td>
                    </tr>
                    <tr v-if="teams.data.length === 0">
                        <td class="border-t px-6 py-4" colspan="4">
                            Nincs egyetlen egyesület sem.
                        </td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" :links="teams.links"/>
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

export default {
    components: {
        AppLayout,
        Pagination,
        JetButton,
        Icon,
    },
    props: {
        filters: Object,
        teams: Object,
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
                this.$inertia.get(this.route('teams'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
}
</script>
