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
                    <div class="w-full">
                        <jet-label for="name" value="Név" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="w-full mt-5">
                        <jet-label for="file" value="Fájl" />
                        <input type="hidden" v-model="form.file">
                        <a class="text-blue-600 underline" target="_blank" :href="route('home') + '/' + form.file">{{form.name}}.pdf</a>
                        <jet-input-error :message="form.errors.file" class="mt-2" />
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <jet-button>
                        Mentés
                    </jet-button>
                    <jet-danger-button @click="deleteDocument">
                        Törlés
                    </jet-danger-button>
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
        document: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: this.document.name,
                file: this.document.file,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:documents.update', this.document.id))
        },
        deleteDocument() {
            if (confirm('Are you sure you want to delete this document?')) {
                this.$inertia.delete(this.route('admin:documents.destroy', this.document.id))
            }
        },
    },
}
</script>
