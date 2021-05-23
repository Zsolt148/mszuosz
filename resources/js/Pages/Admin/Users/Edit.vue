<template>
    <admin-layout>
        <template #header>
            Felhasználó szerkesztése
        </template>
        <div>
            <h1 class="mb-8 font-bold text-3xl">
                <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('admin:users.index')">Felhasználók</inertia-link>
                <span class="text-indigo-400 font-medium">/</span>
                {{ form.name }}
            </h1>
            <div class="bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="update">
                    <div class="p-8">
                        <div class="space-x-4 flex flex-row">
                            <div class="w-1/3">
                                <jet-label for="name" value="Név" />
                                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="off" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="w-1/3">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" autocomplete="off" />
                                <jet-input-error :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="w-1/3">
                                <jet-label for="role" value="Típus"/>
                                <select name="role" id="role" v-model="form.role" class="block mt-1 w-full rounded-md shadow-md border-gray-300 focus:outline-none">
                                    <option v-for="(role, key) in roles" :key="key" :value="key">{{role}}</option>
                                </select>
                                <jet-input-error :message="form.errors.role" class="mt-2" />
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
                Felhasználó törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a felhasználót ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteUser">
                    Törlés
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetDangerButton from '@/Jetstream/DangerButton'
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

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
        editUser: Object,
        roles: Array,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
               _method: 'PUT',
               name: this.editUser.name,
               email: this.editUser.email,
               role: this.editUser.role,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:users.update', this.editUser.id))
        },
        deleteUser() {
            this.$inertia.delete(this.route('admin:users.destroy', this.editUser.id))
        },
    }
}
</script>
