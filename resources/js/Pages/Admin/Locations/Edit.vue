<template>
    <admin-layout>
        <template #header>
            Helyszín szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('admin:locations.index')">Helyszínek</inertia-link>
            <span class="text-blue-400 font-medium">/</span>
            {{form.name}}
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
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
                                <option v-for="(name, key) in countries" :key="key" :value="key">{{key}} - {{name}}</option>
                            </select>
                            <jet-input-error :message="form.errors.code" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-col sm:flex-row sm:space-x-4 mt-5">
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
                    <jet-danger-button @click="confirmModalShow = true">
                        Törlés
                    </jet-danger-button>
                </div>
            </form>
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Helyszín törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a helyszínt ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteLocation">
                    Törlés
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import Editor from '@tinymce/tinymce-vue';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        Editor,
        JetDangerButton,
        JetConfirmationModal,
        JetSecondaryButton,
    },
    props: {
        location: Object,
        countries: Array,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'POST',
                name: this.location.name,
                country: this.location.country,
                code: this.location.code,
                city: this.location.city,
                address: this.location.address,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:locations.update', this.location.id))
        },
        deleteLocation() {
            this.$inertia.delete(this.route('admin:locations.destroy', this.location.id))
        },
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.confirmModalShow = false;
            },
        },
    },
}
</script>
