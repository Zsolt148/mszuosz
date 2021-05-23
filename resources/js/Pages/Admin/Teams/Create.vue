<template>
    <admin-layout>
        <template #header>
            Egyesület szerkesztése
        </template>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:teams.index')">Egyesületek</inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                Új egyesület
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="store">
                    <div class="p-8">
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <div class="w-full sm:w-2/3">
                                <jet-label for="name" value="Név" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/3">
                                <jet-label for="short" value="Rövidítés" />
                                <jet-input id="short" type="text" class="mt-1 block w-full" v-model="form.short" autocomplete="off" />
                                <jet-input-error :message="form.errors.short" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/5">
                                <jet-label for="sa" value="SA" />
                                <jet-input id="sa" type="text" class="mt-1 block w-full" v-model="form.sa" autocomplete="off" />
                                <jet-input-error :message="form.errors.sa" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-5">
                            <div class="w-full sm:w-1/4">
                                <jet-label for="address" value="Cím" />
                                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" autocomplete="off" />
                                <jet-input-error :message="form.errors.address" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/4">
                                <jet-label for="webpage" value="Weboldal" />
                                <jet-input id="webpage" type="text" class="mt-1 block w-full" v-model="form.webpage" autocomplete="off" />
                                <jet-input-error :message="form.errors.webpage" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/4">
                                <jet-label for="contact_name" value="Kapcsolattartó neve" />
                                <jet-input id="contact_name" type="text" class="mt-1 block w-full" v-model="form.contact_name" autocomplete="off" />
                                <jet-input-error :message="form.errors.contact_name" class="mt-2" />
                            </div>

                            <div class="w-full sm:w-1/4">
                                <jet-label for="contact_email" value="Kapcsolattartó email" />
                                <jet-input id="contact_email" type="email" class="mt-1 block w-full" v-model="form.contact_email" autocomplete="off" />
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
                sa: null,
                address: null,
                webpage: null,
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
