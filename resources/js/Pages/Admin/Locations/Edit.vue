<template>
    <admin-layout>
        <template #header>
            Helyszín szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:locations.index')">Helyszínek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            {{form.name}}
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8 flex flex-col">
                    <div class="w-full flex flex-row space-x-4">
                        <div class="w-1/2">
                            <jet-label for="name" value="Uszoda neve" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="city" value="Város" />
                            <jet-input id="city" type="text" class="mt-1 block w-full" v-model="form.city" autocomplete="off" />
                            <jet-input-error :message="form.errors.city" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-row space-x-4 mt-5">
                        <div class="w-1/3">
                            <jet-label for="address" value="Uszoda címe" />
                            <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" autocomplete="off" />
                            <jet-input-error :message="form.errors.address" class="mt-2" />
                        </div>

                        <div class="w-1/3">
                            <jet-label for="timing" value="Időmérés" />
                            <jet-input id="timing" type="text" class="mt-1 block w-full" v-model="form.timing" autocomplete="off"/>
                            <jet-input-error :message="form.errors.timing" class="mt-2" />
                        </div>

                        <div class="w-1/3">
                            <jet-label for="pool" value="Medence" />
                            <jet-input id="pool" type="text" class="mt-1 block w-full" v-model="form.pool" autocomplete="off"/>
                            <jet-input-error :message="form.errors.pool" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <jet-button>
                        Mentés
                    </jet-button>
                </div>
            </form>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import Editor from '@tinymce/tinymce-vue';
import JetDangerButton from '@/Jetstream/DangerButton'

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        Editor,
        JetDangerButton
    },
    props: {
        location: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: this.location.name,
                city: this.location.city,
                address: this.location.address,
                timing: this.location.timing,
                pool: this.location.pool,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:locations.update', this.location.id))
        },
        deleteLocation() {
            if (confirm('Are you sure you want to delete this location?')) {
                this.$inertia.delete(this.route('admin:locations.destroy', this.location.id))
            }
        },
    },
}
</script>
