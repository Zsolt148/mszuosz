<template>
    <admin-layout>
        <template #header>
            Hírek létrehozása
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:news.index')">Hírek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            Új hír
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="store">
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

                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mb-5">
                        <div class="w-full sm:w-1/2">
                            <jet-label for="name" value="Cím" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2">
                            <jet-label for="slug" value="URL" />
                            <jet-input id="slug" type="text" class="mt-1 block w-full bg-gray-200" v-model="form.slug" autocomplete="off" aria-readonly="true" disabled="disabled" />
                            <jet-input-error :message="form.errors.slug" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mb-5">
                        <div class="w-full sm:w-1/2">
                            <jet-label for="date" value="Dátum" />
                            <jet-input id="date" type="date" class="mt-1 block w-full" v-model="form.date" autocomplete="off" />
                            <jet-input-error :message="form.errors.date" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/2">
                            <jet-label for="type" value="Típus"/>
                            <select name="type" id="location_id" v-model="form.type" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option value="null" selected>Válassz</option>
                                <option v-for="(type, key) in types" :key="key" :value="key">{{type}}</option>
                            </select>
                            <jet-input-error :message="form.errors.type" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mb-5">
                        <div class="w-full">
                            <jet-label for="tags" value="Címkék"/>
                            <VueMultiselect
                                name="tags"
                                v-model="selected"
                                :options="options"
                                :multiple="true"
                                :taggable="true"
                                @tag="addTag"
                                tag-placeholder="Címke hozzáadása"
                                placeholder="Írj a kereséshez vagy a címke hozzáadásához"
                                label="name"
                                track-by="id"
                            />
                        </div>
                    </div>
                    <div class="my-5">
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
                             link_list: links,
                             toolbar:
                             'undo redo | styleselect fontsizeselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | table link | print preview'
                           }"
                        />
                        <jet-input-error :message="form.errors.body" class="mt-2" />
                    </div>
                    <div v-if="form.body" class="my-8">
                        <div class="mb-3 text-2xl">Előnézet:</div>
                        <article class="my-5 mx-auto prose-sm sm:prose lg:prose-lg xl:prose-xl" v-html="form.body"/>
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
import VueMultiselect from 'vue-multiselect'

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        Editor,
        JetCheckbox,
        VueMultiselect,
    },
    props: {
        types: Object,
        files: Object,
        tags: Object,
    },
    mounted() {
        var links = [];
        this.files.forEach(function (v) {
            links.push({
                title: v.split('/')[1],
                value: window.location.origin + '/' + v
            });
        });
        this.links = links;
    },
    data() {
        return {
            selected: [],
            options: this.tags,
            links: [],
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                slug: null,
                type: null,
                date: null,
                is_visible: false,
                body: null,
                tags: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.tags = this.selected;
            this.form.post(this.route('admin:news.store'))
        },
        slug(string) {
            if(string == null) return '';
            return string.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/&/g, `-and-`)         // & to and
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/-+$/, '');
        },
        addTag (newTag) {
            const tag = {
                id: (this.options.length + 1),
                name: newTag,
            }
            this.options.push(tag)
            this.selected.push(tag)
        }
    },
    computed: {
        name() {
          return this.form.name;
        },
        date() {
            return this.form.date;
        },
    },
    watch: {
        name() {
            this.form.slug = this.slug(this.form.date) + '-' + this.slug(this.form.name);
        },
        date() {
            this.form.slug = this.slug(this.form.date) + '-' + this.slug(this.form.name);
        },
    }
}
</script>
