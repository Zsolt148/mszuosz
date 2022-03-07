<template>
    <admin-layout>
        <template #header>
            Egyesület szerkesztése
        </template>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('admin:teams.index')">Egyesületek</inertia-link>
                <span class="text-blue-400 font-medium">/</span>
                {{ form.name }}
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-8">
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <div class="w-full sm:w-1/2">
                                <jet-label for="name" value="Engedélyrendszer név" />
                                <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2">
                                <jet-label for="original_name" value="Eredeti név" />
                                <jet-input id="original_name" type="text" v-model="form.original_name" autocomplete="off" />
                                <jet-input-error :message="form.errors.original_name" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/3">
                                <jet-label for="sa" value="SA" />
                                <jet-input id="sa" type="text" v-model="form.sa" autocomplete="off" />
                                <jet-input-error :message="form.errors.sa" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="short" value="Rövidítés (max 20 karakter)" />
                                <jet-input id="short" type="text" v-model="form.short" autocomplete="off" :maxlength="20" />
                                <jet-input-error :message="form.errors.short" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="meet_abbr" value="Meet abbr (max 5 karakter)" />
                                <jet-input id="meet_abbr" type="text" v-model="form.meet_abbr" autocomplete="off" :maxlength="5" />
                                <jet-input-error :message="form.errors.meet_abbr" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/2">
                                <jet-label for="address" value="Cím" />
                                <jet-input id="address" type="text" v-model="form.address" autocomplete="off" />
                                <jet-input-error :message="form.errors.address" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2">
                                <jet-label for="webpage" value="Weboldal" />
                                <jet-input id="webpage" type="text" v-model="form.webpage" autocomplete="off" />
                                <jet-input-error :message="form.errors.webpage" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/3">
                                <jet-label for="president" value="Elnök" />
                                <jet-input id="president" type="text" v-model="form.president" autocomplete="off" />
                                <jet-input-error :message="form.errors.president" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="email" v-model="form.email" autocomplete="off" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="phone" value="Telefon" />
                                <jet-input id="phone" type="text" v-model="form.phone" autocomplete="off" />
                                <jet-input-error :message="form.errors.phone" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/2">
                                <jet-label for="contact_name" value="Kapcsolattartó neve" />
                                <jet-input id="contact_name" type="text" v-model="form.contact_name" autocomplete="off" />
                                <jet-input-error :message="form.errors.contact_name" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/2">
                                <jet-label for="contact_email" value="Kapcsolattartó email" />
                                <jet-input id="contact_email" type="email" v-model="form.contact_email" autocomplete="off" />
                                <jet-input-error :message="form.errors.contact_email" class="mt-2" />
                            </div>
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
        </div>
        <jet-confirmation-modal :show="confirmModalShow" @close="confirmModalShow = false">
            <template #title>
                Egyesület törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd az Egyesületet ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteTeam">
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
import JetDangerButton from '@/Jetstream/DangerButton';
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetDangerButton,
        JetConfirmationModal,
        JetSecondaryButton,
    },
    props: {
        team: Object,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.team.name,
                original_name: this.team.original_name,
                short: this.team.short,
                meet_abbr: this.team.meet_abbr,
                sa: this.team.SA,
                address: this.team.address,
                webpage: this.team.webpage,
                president: this.team.president,
                email: this.team.email,
                phone: this.team.phone,
                contact_name: this.team.contact_name,
                contact_email: this.team.contact_email,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:teams.update', this.team.id))
        },
        deleteTeam() {
            this.$inertia.delete(this.route('admin:teams.destroy', this.team.id))
        },
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.confirmModalShow = false;
            },
        },
    },
}
</script>
