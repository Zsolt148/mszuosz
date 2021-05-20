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
                    <div class="w-full">
                        <jet-label for="name" value="Név" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="w-full mt-5">
                        <file-pond
                            name="files"
                            ref="pond"
                            v-bind:allow-multiple="false"
                            accepted-file-types="application/pdf"
                            v-on:init="handleFilePondInit"
                            v-bind:required="true"
                            max-files="1"
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

//Filepond
import vueFilePond, { setOptions } from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    mounted() {
        setOptions({
            server: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                process: {
                    url: '/process',
                    onload: (response) => this.form.file = response,
                },
                revert: '/revert',
            }
        });
    },
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        FilePond
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                file: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.post(this.route('admin:documents.store'))
        },
        // FilePond instance methods are available on `this.$refs.pond`
        handleFilePondInit: function () {
            console.log("FilePond has initialized");
        },
    },
}
</script>
