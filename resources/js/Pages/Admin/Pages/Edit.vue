<template>
    <admin-layout>
        <template #header>
            Oldal szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:pages.index')">Oldalak</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            {{ form.name }}
        </h1>

        <div class="bg-white rounded-md shadow-md overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8 flex flex-col">
                    <div class="my-5 w-full flex flex-row space-x-4">
                        <div class="w-1/2">
                            <jet-label for="name" value="Cím" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="slug" value="URL" />
                            <jet-input id="slug" type="text" class="mt-1 block w-full bg-gray-200" v-model="form.slug" autocomplete="off" aria-readonly="true" disabled="disabled" />
                            <jet-input-error :message="form.errors.slug" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <editor
                            v-model="form.body"
                            id="body"
                            name="body"
                            api-key="skchna384fb9c6sj8ez6wr06oe6eqtedt3m8qburl2n2agbq"
                            output-format="html"
                            :init="{
                             height: 600,
                             language: 'hu_HU',
                             plugins: [
                               'link table lists print preview'
                             ],
                             toolbar:
                             'undo redo | styleselect fontsizeselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | table link | print preview'
                           }"
                        />
                    </div>
                    <div v-if="form.body" class="my-8">
                        <div class="mb-3 text-2xl">Előnézet:</div>
                        <div v-html="form.body"></div>
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between mt-2">
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
import Editor from '@tinymce/tinymce-vue';
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        AdminLayout,
        Editor,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
    },
    props: {
        page: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.page.name,
                slug: this.page.slug,
                body: this.page.body,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:pages.update', this.page.id))
        },
    },
}
</script>
