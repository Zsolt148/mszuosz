<template>
    <admin-layout>
        <template #header>
            Dokumentum szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:documents.index')">Dokumentumok</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            {{form.name}}
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8 flex flex-col">
                    <div class="mb-5">
                        <jet-label for="is_visible">
                            <div class="flex items-center text-xl">
                                <jet-checkbox name="is_visible" id="is_visible" v-model:checked="form.is_visible" />

                                <div class="ml-2">
                                    Látható
                                </div>
                            </div>
                        </jet-label>
                    </div>

                    <div class="mb-5 w-full">
                        <jet-label for="name" value="Név" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mb-5 space-x-4 flex flex-row">
                        <div class="w-1/2">
                            <jet-label for="date" value="Dátum" />
                            <jet-input id="date" type="date" class="mt-1 block w-full" v-model="form.date" autocomplete="off" />
                            <jet-input-error :message="form.errors.date" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="type" value="Típus"/>
                            <select name="type" id="location_id" v-model="form.type" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="(type, key) in types" :key="key" :value="key">{{type}}</option>
                            </select>
                            <jet-input-error :message="form.errors.type" class="mt-2" />
                        </div>
                    </div>

                    <div class="w-full mt-5">
                        <jet-label for="file" value="Fájlok" />
                        <input type="hidden" v-model="form.files">
                        <a class="text-blue-600 underline mr-3" v-for="(file, key) in form.files" :key="key" target="_blank" :href="route('home') + '/' + file">{{form.name}} {{key+1}}.pdf</a>
                        <jet-input-error :message="form.errors.file" class="mt-2" />
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
                Dokumentum törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a dokumentumot ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteDocument">
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
import JetDangerButton from '@/Jetstream/DangerButton'
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetCheckbox from "@/Jetstream/Checkbox";

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        Editor,
        JetDangerButton,
        JetCheckbox,
        JetConfirmationModal,
        JetSecondaryButton,
    },
    props: {
        document: Object,
        types: Object,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'POST',
                name: this.document.name,
                date: this.document.date,
                type: this.document.type,
                is_visible: this.document.is_visible ? true : false,
                files: this.document.files,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:documents.update', this.document.id))
        },
        deleteDocument() {
            this.$inertia.delete(this.route('admin:documents.destroy', this.document.id))
        },
    },
}
</script>
