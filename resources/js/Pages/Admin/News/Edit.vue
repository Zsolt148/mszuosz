<template>
    <admin-layout>
        <template #header>
            Hír szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:news.index')">Hírek</inertia-link>
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
                    <div class="mb-5 w-full flex flex-row space-x-4">
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
                    <div class="mb-5 flex flex-row space-x-4">
                        <div class="w-1/2">
                            <jet-label for="date" value="Dátum" />
                            <jet-input id="date" type="date" class="mt-1 block w-full" v-model="form.date" autocomplete="off" />
                            <jet-input-error :message="form.errors.date" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="type" value="Típus"/>
                            <select name="type" id="type" v-model="form.type" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="(type, key) in types" :key="key" :value="key" >{{type}}</option>
                            </select>
                            <jet-input-error :message="form.errors.type" class="mt-2" />
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
                        <jet-input-error :message="form.errors.body" class="mt-2" />
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
                    <jet-danger-button @click="confirmModalShow = true">
                        Törlés
                    </jet-danger-button>
                </div>
            </form>
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Hír törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a hírt ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteNews">
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
import JetCheckbox from "@/Jetstream/Checkbox";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

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
        news: Object,
        types: Object,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'POST',
                name: this.news.name,
                slug: this.news.slug,
                type: this.news.type,
                date: this.news.date,
                is_visible: this.news.is_visible ? true : false,
                body: this.news.body,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:news.update', this.news.id))
        },
        deleteNews() {
            this.$inertia.delete(this.route('admin:news.destroy', this.news.id))
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
