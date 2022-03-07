<template>
    <admin-layout>
        <template #header>
            Egyesület szerkesztése
        </template>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('admin:teams.index')">Egyesületek</inertia-link>
                <span class="text-blue-400 font-medium">/</span>
                Új egyesület
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="store">
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
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        AdminLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'POST',
                name: null,
                short: null,
                meet_abbr: null,
                sa: null,
                address: null,
                webpage: null,
                president: null,
                email: null,
                phone: null,
                contact_name: null,
                contact_email: null,
            }),
        };
    },
    methods: {
        store() {
            this.form.post(this.route('admin:teams.store'))
        },
    }
}
</script>
