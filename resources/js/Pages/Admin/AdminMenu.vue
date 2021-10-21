<template>
    <div>
        <div class="flex flex-col flex-1 mt-4 justify-between space-y-4">
            <inertia-link :class="getDashboardClass('admin$')" :href="route('admin:dashboard')">
                <icon name="home" class="w-5 h-5 mr-4" />
                <div>Kezdőlap</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/news*')" :href="route('admin:news.index')">
                <icon name="news" class="w-5 h-5 mr-4" />
                <div>Hírek</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/events*')" :href="route('admin:events.index')">
                <icon name="calendar" class="w-5 h-5 mr-4" />
                <div>Versenyek</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/locations*')" :href="route('admin:locations.index')" v-if="isAdmin()">
                <icon name="location-arrow" class="w-5 h-5 mr-4" />
                <div>Helyszínek</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/teams*')" :href="route('admin:teams.index')" v-if="isAdmin()">
                <icon name="users-cog" class="w-5 h-5 mr-4" />
                <div>Egyesületek</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/documents*')" :href="route('admin:documents.index')">
                <icon name="folder" class="w-5 h-5 mr-4" />
                <div>Dokumentumok</div>
            </inertia-link>

            <inertia-link :class="getDashboardClass('admin/pages*')" :href="route('admin:pages.index')" v-if="isAdmin()">
                <icon name="file" class="w-5 h-5 mr-4" />
                <div>Tartalomkezelő</div>
            </inertia-link>

            <hr class="my-6" />

            <inertia-link :class="getDashboardClass('admin/users*')" :href="route('admin:users.index')" v-if="isAdmin()">
                <icon name="users" class="w-5 h-5 mr-4" />
                <div>Felhasználók</div>
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
        getDashboardClass(urls) {
            return this.isUrl(urls) ? 'dashboard-link-active' : 'dashboard-link';
        },
        isUrl(...urls) {
            return urls.filter(url => this.$page.url.match(url)).length
        },
        isAdmin() {
            return this.$page.props.user.role == 'admin';
        }
    },
}
</script>
