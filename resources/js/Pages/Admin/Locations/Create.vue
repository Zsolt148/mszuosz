<template>
    <admin-layout>
        <template #header>
            Helyszín létrehozása
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:locations.index')">Helyszínek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            Új helyszín
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="p-8">
                    <div class="w-full flex flex-col sm:flex-row sm:space-x-4">
                        <div class="w-full sm:w-1/3">
                            <jet-label for="name" value="Uszoda neve" />
                            <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="country" value="Ország" />
                            <jet-input id="country" type="text" v-model="form.country" autocomplete="off" />
                            <jet-input-error :message="form.errors.country" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="code" value="Ország kód"/>
                            <select name="code" id="code" v-model="form.code">
                                <option value="null" selected>Válassz</option>
                                <option v-for="(name, key) in countries" :key="key" :value="key">{{key}} - {{name}}</option>
                            </select>
                            <jet-input-error :message="form.errors.code" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-col sm:flex-row sm:space-x-4 mt-3">
                        <div class="w-full sm:w-1/2">
                            <jet-label for="city" value="Város" />
                            <jet-input id="city" type="text" v-model="form.city" autocomplete="off" />
                            <jet-input-error :message="form.errors.city" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2">
                            <jet-label for="address" value="Uszoda címe" />
                            <jet-input id="address" type="text" v-model="form.address" autocomplete="off" />
                            <jet-input-error :message="form.errors.address" class="mt-2" />
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

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
    },
    props: {
        countries: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                country: null,
                code: null,
                city: null,
                address: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.post(this.route('admin:locations.store'))
        },
    },
}
</script>
