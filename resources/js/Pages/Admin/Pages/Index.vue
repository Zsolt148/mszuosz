<template>
    <admin-layout>
        <template #header>
            Tartalomkezelő
        </template>

        <div>
            <div class="mb-6 flex w-full justify-between items-center">
                <input class="relative w-full px-4 py-1 rounded-md mr-2" autocomplete="off" type="text" name="search" placeholder="Search…" v-model="params.search"/>
                <jet-button @click="$emit('reset')">
                    Reset
                </jet-button>
            </div>

            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('name')">
                                Name
                                <icon v-if="params.field === 'name' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'name' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('slug')">
                                Slug
                                <icon v-if="params.field === 'slug' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'slug' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                        <th class="px-6 pt-6 pb-4">
                            <span class="inline-flex w-full justify-between cursor-pointer" @click="sort('body')">
                                Body
                                <icon v-if="params.field === 'body' && params.direction === 'asc'" name="cheveron-up" class="w-4 h-4"></icon>
                                <icon v-if="params.field === 'body' && params.direction === 'desc'" name="cheveron-down" class="w-4 h-4"></icon>
                            </span>
                        </th>
                    </tr>
                    <tr v-for="page in pages.data" :key="page.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('admin:pages.edit', page.id)">
                                {{ page.name }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center" :href="route('admin:pages.edit', page.id)" tabindex="-1">
                                {{ page.slug }}
                            </inertia-link>
                        </td>
                        <td class="border-t">
                            <inertia-link class="px-6 py-4 flex items-center" :href="route('admin:pages.edit', page.id)" tabindex="-1">
                                 <span v-if="page.body" v-text="page.body.substring(0,40) + '..'"></span>
                                <span v-else>-</span>
                            </inertia-link>
                        </td>
                        <td class="border-t w-px">
                            <inertia-link class="px-4 flex items-center" :href="route('admin:pages.edit', page.id)" tabindex="-1">
                                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                            </inertia-link>
                        </td>
                    </tr>
                    <tr v-if="pages.data.length === 0">
                        <td class="border-t px-6 py-4" colspan="4">No pages found.</td>
                    </tr>
                </table>
            </div>
            <pagination class="my-5" :links="pages.links" />
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
        Pagination
    },
    props: {
        filters: Object,
        pages: Object,
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
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('admin:pages'), params, { replace: true, preserveState: true });
            }, 150),
            deep: true,
        },
    },
}
</script>
