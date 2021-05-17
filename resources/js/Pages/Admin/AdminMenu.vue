<template>
    <div>
        <div class="flex flex-col flex-1 mt-4 justify-between space-y-4">
            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin$') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:dashboard')">
                <icon name="home" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin$') ? 'font-bold' : 'group-hover:text-blue-900'">Kezdőlap</div>
            </inertia-link>

            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin/news*') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:news.index')">
                <icon name="news" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin/news*') ? 'font-bold' : 'group-hover:text-blue-900'">Hírek</div>
            </inertia-link>

            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin/events*') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:events.index')">
                <icon name="calendar" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin/events*') ? 'font-bold' : 'group-hover:text-blue-900'">Versenyek</div>
            </inertia-link>

            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin/teams*') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:teams.index')">
                <icon name="users-cog" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin/teams*') ? 'font-bold' : 'group-hover:text-blue-900'">Egyesületek</div>
            </inertia-link>

            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin/pages*') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:pages.index')">
                <icon name="file" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin/pages*') ? 'font-bold' : 'group-hover:text-blue-900'">Tartalomkezelő</div>
            </inertia-link>

            <hr class="my-6" />

            <inertia-link class="flex items-center px-6 py-2 text-gray-700 hover:text-blue-500" :class="isUrl('admin/users*') ? 'bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500 text-blue-500' : ''" :href="route('admin:users.index')">
                <icon name="users" class="w-5 h-5 mr-4" />
                <div :class="isUrl('admin/users*') ? 'font-bold' : 'group-hover:text-blue-900'">Felhasználók</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon';

export default {
    components: {
        Icon,
    },
    methods: {
        isUrl(...urls) {
            return urls.filter(url => this.$page.url.match(url)).length
        },
    },
}
</script>
