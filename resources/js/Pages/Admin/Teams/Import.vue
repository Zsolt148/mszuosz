<template>
    <admin-layout>
        <template #header>
            Egyesületek
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:teams.index')">Egyesületek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            Importálás
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="submit">
                <div class="p-8">
                    <jet-label for="name" value="Excel" />
                    <jet-input id="file" name="file" type="file" @input="form.file = $event.target.files[0]" autocomplete="off" />
                    <jet-input-error :message="form.errors.file" class="mt-2" />
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <jet-button>
                        Feltöltés
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
        Editor,
    },
    data() {
        return {
            form: this.$inertia.form({
                file: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route('admin:teams.upload'))
        },
    },
}
</script>
