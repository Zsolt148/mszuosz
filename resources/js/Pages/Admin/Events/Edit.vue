<template>
    <admin-layout>
        <template #header>
            Verseny szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:events.index')">Versenyek</inertia-link>
            <span class="text-indigo-400 font-medium">/</span>
            {{form.name}}
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8 flex flex-col">
                    <div class="my-5 w-full flex flex-row space-x-4">
                        <div class="w-1/2">
                            <jet-label for="name" value="Név" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="slug" value="URL" />
                            <jet-input id="slug" type="text" class="mt-1 block w-full bg-gray-200" v-model="form.slug" autocomplete="off" aria-readonly="true" disabled="disabled" />
                            <jet-input-error :message="form.errors.slug" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-row space-x-4 mt-5">
                        <div class="w-1/2">
                            <jet-label for="start_at" value="Kezdőnap" />
                            <jet-input id="start_at" type="date" class="mt-1 block w-full" v-model="form.start_at" autocomplete="off" />
                            <jet-input-error :message="form.errors.start_at" class="mt-2" />
                        </div>

                        <div class="w-1/2">
                            <jet-label for="end_at" value="Végnap" />
                            <jet-input id="end_at" type="date" class="mt-1 block w-full" v-model="form.end_at" autocomplete="off"/>
                            <jet-input-error :message="form.errors.end_at" class="mt-2" />
                        </div>
                    </div>
                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                        <div class="w-full sm:w-1/4">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="off" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/4">
                            <jet-label for="site" value="Weboldal" />
                            <jet-input id="site" type="text" class="mt-1 block w-full" v-model="form.site" autocomplete="off" />
                            <jet-input-error :message="form.errors.site" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/4">
                            <jet-label for="category" value="Kategória"/>
                            <select name="category" id="category" v-model="form.category" class="block mt-1 w-full rounded-md shadow-md focus:outline-none">
                                <option value="">Válassz</option>
                                <option v-for="(category, key) in categories" :key="key" :value="key">{{key}} - {{category}}</option>
                            </select>
                            <jet-input-error :message="form.errors.category" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/4">
                            <jet-label for="location_id" value="Helyszín"/>
                            <select name="location_id" id="location_id" v-model="form.location_id" class="block mt-1 w-full rounded-md shadow-md focus:outline-none">
                                <option value="" selected>Válassz</option>
                                <option v-for="location in locations" :key="location.id" :value="location.id">{{location.name}}</option>
                            </select>
                            <jet-input-error :message="form.errors.location_id" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <jet-label for="body" value="Leírás" />
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
                    <jet-danger-button @click="deleteEvent">
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
        event: Object,
        locations: Object,
        categories: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: this.event.name,
                slug: this.event.slug,
                start_at: this.event.start_at,
                end_at: this.event.end_at,
                email: this.event.email,
                site: this.event.site,
                category: this.event.category,
                location_id: this.event.location_id,
                body: this.event.body,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:events.update', this.event.id))
        },
        deleteEvent() {
            if (confirm('Are you sure you want to delete this event?')) {
                this.$inertia.delete(this.route('admin:events.destroy', this.event.id))
            }
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
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/&/g, `-and-`)         // & to and
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/-+$/, '');
        }
    }
}
</script>
