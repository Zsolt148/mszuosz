<template>
    <admin-layout>
        <template #header>
            Dokumentum létrehozása
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:documents.index')">Dokumentumok</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            Új dokumentum
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store" enctype="multipart/form-data">
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
                        <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mb-5 space-x-4 flex flex-row">
                        <div class="w-1/2">
                            <jet-label for="date" value="Dátum" />
                            <jet-input id="date" type="date" v-model="form.date" autocomplete="off" />
                            <jet-input-error :message="form.errors.date" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="type" value="Típus"/>
                            <select name="type" id="location_id" v-model="form.type">
                                <option value="null" selected>Válassz</option>
                                <option v-for="(type, key) in types" :key="key" :value="key">{{type}}</option>
                            </select>
                            <jet-input-error :message="form.errors.type" class="mt-2" />
                        </div>
                    </div>

                    <div class="w-full mt-5">
                        <jet-label for="files" value="Fájlok"/>
                        <file-pond
                            name="documents"
                            ref="pond"
                            v-bind:allow-multiple="true"
                            accepted-file-types="application/*, image/*, .xls, .xlsx, .doc, .docx"
                            v-bind:required="true"
                            v-bind:server="filesServer"
                            max-files="5"
                            label-idle='<p>Húzd ide a fájlokat vagy <span class="filepond--label-action" tabindex="0">Böngéssz</span></p>'
                        />
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
import JetCheckbox from "@/Jetstream/Checkbox";

//Filepond
import vueFilePond, { setOptions } from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetCheckbox,
        FilePond,
    },
    props: {
        types: Object,
    },
    data() {
        return {
            tmp: [],
            filesServer: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                process: {
                    url: '/process/documents',
                    onload: (resp) => {
                        this.tmp.push(JSON.parse(resp)['value']);
                    },
                },
            },
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                date: null,
                type: null,
                is_visible: false,
                files: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.files = this.tmp;
            this.form.post(this.route('admin:documents.store'))
        },
    },
}
</script>
