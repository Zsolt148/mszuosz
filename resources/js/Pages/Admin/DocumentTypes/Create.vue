<template>
    <admin-layout>
        <template #header>
            Dokumentum típus létrehozása
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('admin:documentTypes.index')">Dokumentum típusok</inertia-link>
            <span class="text-blue-400 font-medium">/</span>
            Új dokumentum típus
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="p-8 w-full flex flex-col">
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

                    <div class="w-1/2">
                        <jet-label for="name" value="Típus neve" />
                        <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
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
import JetCheckbox from "@/Jetstream/Checkbox";

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetCheckbox,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                is_visible: false,
            }),
        };
    },
    methods: {
        store() {
            this.form.post(this.route('admin:documentTypes.store'))
        },
    },
}
</script>
