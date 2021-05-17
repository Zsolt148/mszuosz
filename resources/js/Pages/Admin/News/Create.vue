<template>
    <admin-layout>
        <template #header>
            Hírek szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:news.index')">Hírek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            Új hír
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
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
        Editor,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                slug: null,
                body: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.post(this.route('admin:news.store'))
        },
    },
    computed: {
      name() {
          return this.form.name;
      }
    },
    watch: {
        name() {
            this.form.slug = this.form.name.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/^-+/, '')            // Trim - from start of text
                .replace(/&/g, `-and-`)         // & to and
                .replace(/\-\-+/g, '-')                                 // Replace multiple - with single -
                .replace(/-+$/, '');
        }
    }
}
</script>

<style scoped>

</style>
