<template>
    <admin-layout>
        <template #header>
            Egyesület szerkesztése
        </template>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:teams.index')">Egyesületek</inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                {{ form.name }}
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-8 -mr-6 -mb-8 flex flex-col">
                        <div class="mb-4">
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <jet-label for="sa" value="SA" />
                            <jet-input id="sa" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.sa" autocomplete="off" />
                            <jet-input-error :message="form.errors.sa" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <jet-label for="address" value="Address" />
                            <jet-input id="address" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.address" autocomplete="off" />
                            <jet-input-error :message="form.errors.address" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <jet-label for="webpage" value="Webpage" />
                            <jet-input id="webpage" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.webpage" autocomplete="off" />
                            <jet-input-error :message="form.errors.webpage" class="mt-2" />
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <jet-button>
                            Mentés
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
    },
    props: {
        team: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.team.name,
                sa: this.team.SA,
                address: this.team.address,
                webpage: this.team.webpage,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:teams.update', this.team.id))
        },
    }
}
</script>
