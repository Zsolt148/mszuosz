<template>
    <admin-layout>
        <template #header>
            Hírek  - <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:news.create')">Új hír</inertia-link>
        </template>

        <div>
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-full px-4 py-1 rounded-md mr-2" autocomplete="off" type="text" name="search" placeholder="Keresés…" v-model="params.search"/>
                <jet-button @click="reset">
                    Visszaállítás
                </jet-button>
            </div>

            <pagination class="my-5" :links="news.links" />

            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('name')">
                                Cím
                                <icon v-if="params.field === 'name' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'name' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('type')">
                                Típus
                                <icon v-if="params.field === 'type' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'type' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
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
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('date')">
                                Dátum
                                <icon v-if="params.field === 'date' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'date' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
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
                    <tr v-for="n in news.data" :key="n.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center focus:text-indigo-500" :href="route('admin:news.edit', n.id)">
                                {{ n.name }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:news.edit', n.id)" tabindex="-1">
                                <span v-if="n.type == 'important'" class="text-red-500">Fontos</span><span v-else-if="n.type == 'highlighted'" class="text-blue-500">Kiemelt</span><span v-else>{{ n.type_val }}</span>
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:news.edit', n.id)" tabindex="-1">
                                <span v-if="n.is_visible" class="text-green-600">Igen</span><span v-else class="text-red-600">Nem</span>
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:news.edit', n.id)" tabindex="-1">
                                {{ n.date_val }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-2 flex items-center" :href="route('admin:news.edit', n.id)" tabindex="-1">
                                {{ n.created_at }}
                            </inertia-link>
                        </td>
                        <td class="border-t w-px">
                            <inertia-link class="px-4 flex items-center" :href="route('admin:news.edit', n.id)" tabindex="-1">
                                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                            </inertia-link>
                        </td>
                    </tr>
                    <tr v-if="news.data.length === 0">
                        <td class="border-t px-6 py-2" colspan="4">No news found.</td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" :links="news.links" />
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
        news: Object,
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
                this.$inertia.get(this.route('admin:news.index'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
};
</script>
