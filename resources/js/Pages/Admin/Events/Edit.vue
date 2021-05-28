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

                    <div class="w-full flex flex-row space-x-4">
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

                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                        <div class="w-full sm:w-1/3">
                            <jet-label for="start_at" value="Kezdőnap" />
                            <jet-input id="start_at" type="date" class="mt-1 block w-full" v-model="form.start_at" autocomplete="off" />
                            <jet-input-error :message="form.errors.start_at" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="end_at" value="Végnap" />
                            <jet-input id="end_at" type="date" class="mt-1 block w-full" v-model="form.end_at" autocomplete="off"/>
                            <jet-input-error :message="form.errors.end_at" class="mt-2" />
                        </div>

                        <div class="w-full sm:w-1/3">
                            <jet-label for="location_id" value="Helyszín"/>
                            <select name="location_id" id="location_id" v-model="form.location_id" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="location in locations" :key="location.id" :value="location.id">{{location.country}} - {{location.name}}</option>
                            </select>
                            <jet-input-error :message="form.errors.location_id" class="mt-2" />
                        </div>
                    </div>

                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                        <div class="w-full sm:w-1/5">
                            <jet-label for="category" value="Kategória"/>
                            <select name="category" id="category" v-model="form.category" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="(category, key) in constants.cats" :key="key" :value="key">{{key}} - {{category}}</option>
                            </select>
                            <jet-input-error :message="form.errors.category" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/5">
                            <jet-label for="pool" value="Medence"/>
                            <select name="pool" id="pool" v-model="form.pool" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="pool in constants.pools" :key="pool" :value="pool">{{pool}}</option>
                            </select>
                            <jet-input-error :message="form.errors.pool" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/5">
                            <jet-label for="timing" value="Időmérés"/>
                            <select name="timing" id="timing" v-model="form.timing" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                <option v-for="timing in constants.timings" :key="timing" :value="timing">{{timing}}</option>
                            </select>
                            <jet-input-error :message="form.errors.timing" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/5">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="off" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                        <div class="w-full sm:w-1/5">
                            <jet-label for="site" value="Weboldal" />
                            <jet-input id="site" type="text" class="mt-1 block w-full" v-model="form.site" autocomplete="off" />
                            <jet-input-error :message="form.errors.site" class="mt-2" />
                        </div>
                    </div>

                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                        <div class="w-full sm:w-1/2">
                            <jet-label for="race_info" value="Versenykiírás"/>
                            <div v-if="race_info">
                                <a class="text-blue-600 underline mr-3" target="_blank" :href="route('home') + '/events/' + form.slug + '/' + race_info">{{race_info}}</a>
                                <jet-secondary-button @click="deleteFile('race_info', race_info)">
                                    Törlés
                                </jet-secondary-button>
                            </div>
                            <file-pond
                                v-else
                                name="race_info"
                                ref="pond"
                                :required="false"
                                :allow-multiple="false"
                                accepted-file-types="application/pdf"
                                max-files="1"
                                v-bind:server="raceInfoServer"
                                label-idle='<p>Húzd ide a fájlt vagy <span class="filepond--label-action" tabindex="0">Böngéssz</span></p>'
                            />
                        </div>
                        <div class="w-full sm:w-1/2">
                            <jet-label for="report" value="Jegyzőkönyv"/>
                            <div v-if="report">
                                <a class="text-blue-600 underline mr-3" target="_blank" :href="route('home') + '/events/' + form.slug + '/' + report">{{report}}</a>
                                <jet-secondary-button @click="deleteFile('report', report)">
                                    Törlés
                                </jet-secondary-button>
                            </div>
                            <file-pond
                                v-else
                                name="report"
                                ref="pond"
                                :required="false"
                                :allow-multiple="false"
                                accepted-file-types="application/pdf"
                                max-files="1"
                                v-bind:server="reportServer"
                                label-idle='<p>Húzd ide a fájlt vagy <span class="filepond--label-action" tabindex="0">Böngéssz</span></p>'
                            />
                        </div>
                    </div>

                    <div class="w-full mt-5">
                        <jet-label for="files" value="Fájlok"/>
                        <file-pond
                            name="files"
                            ref="pond"
                            :required="false"
                            v-bind:allow-multiple="true"
                            accepted-file-types="application/*, image/*"
                            max-files="5"
                            v-bind:server="filesServer"
                            label-idle='<p>Húzd ide a fájlokat vagy <span class="filepond--label-action" tabindex="0">Böngéssz</span></p>'
                        />
                    </div>

                    <div class="w-full flex flex-wrap sm:flex-nowrap sm:flex-row sm:space-x-4 mt-5">
                        <div v-for="(file, name) in files" :key="name">
                            <a class="text-blue-600 underline mr-3" target="_blank" :href="route('home') + '/events/' + form.slug + '/' + file">{{name}}</a>
                            <jet-secondary-button @click="deleteFile('files', file, name)">
                                Törlés
                            </jet-secondary-button>
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
                    <jet-danger-button @click="confirmModalShow = true">
                        Törlés
                    </jet-danger-button>
                </div>
            </form>
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Verseny törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a versenyt ? A verseny és az összes hozzá való fájl is törlésre fog kerülni!
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteEvent">
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
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
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
        Editor,
        JetDangerButton,
        JetConfirmationModal,
        JetSecondaryButton,
        JetCheckbox,
        FilePond
    },
    props: {
        constants: Object,
        event: Object,
        locations: Object,
    },
    data() {
        return {
            tmp: [],
            confirmModalShow: false,
            race_info: this.event.race_info,
            report: this.event.report,
            files: this.event.files,
            form: this.$inertia.form({
                _method: 'POST',
                name: this.event.name,
                slug: this.event.slug,
                start_at: this.event.start_at,
                end_at: this.event.end_at,
                email: this.event.email,
                site: this.event.site,
                category: this.event.category,
                pool: this.event.pool,
                timing: this.event.timing,
                location_id: this.event.location_id,
                body: this.event.body,
                is_visible: this.event.is_visible ? true : false,
                race_info: this.event.race_info,
                report: this.event.report,
                files: this.event.files,
                newFiles: null,
            }),
            raceInfoServer: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                process: {
                    url: '/process/race_info',
                    onload: (resp) => {
                        this.form.race_info = JSON.parse(resp)['value'];
                    },
                },
            },
            reportServer: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                process: {
                    url: '/process/report',
                    onload: (resp) => {
                        this.form.report = JSON.parse(resp)['value'];
                    },
                },
            },
            filesServer: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                process: {
                    url: '/process/files',
                    onload: (resp) => {
                        this.tmp.push(JSON.parse(resp));
                    },
                },
            },
        };
    },
    methods: {
        update() {
            this.form.newFiles = this.tmp;
            this.form.put(this.route('admin:events.update', this.event.id));
            this.race_info = this.event.race_info;
            this.report = this.event.report;
        },
        deleteEvent() {
            this.$inertia.delete(this.route('admin:events.destroy', this.event.id));
        },
        deleteFile(field, name, key = null) {
            this.$inertia.delete(this.route('admin:events.delete.file', [this.event.id, field, name]));
            if(field == 'files') {
                delete this.files[key];
            }else {
                this[field] = null;
            }
        },
        slug(string) {
            if(string == null) return '';
            return string.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/&/g, `-and-`)         // & to and
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/-+$/, '');
        }
    },
    computed: {
        name() {
            return this.form.name;
        },
        start_at() {
            return this.form.start_at;
        }
    },
    watch: {
        name() {
            this.form.slug = this.slug(this.form.start_at) + '-' + this.slug(this.form.name);
        },
        start_at() {
            this.form.slug = this.slug(this.form.start_at) + '-' + this.slug(this.form.name);
        }
    }
}
</script>
