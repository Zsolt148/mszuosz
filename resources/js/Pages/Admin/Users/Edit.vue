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
                    <div class="p-8 -mr-6 -mb-8 flex flex-col">
                        <div class="mb-4">
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.name" autocomplete="off" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="text" class="mt-1 block w-full lg:w-1/2" v-model="form.email" autocomplete="off" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                    </div>
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <jet-button>
                            Mentés
                        </jet-button>
                        <jet-danger-button @click="deleteUser">
                            Törlés
                        </jet-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetDangerButton from '@/Jetstream/DangerButton'
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
        JetDangerButton
    },
    props: {
      editUser: Object,
    },
    data() {
        return {
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
            if (confirm('Are you sure you want to delete this user?')) {
                this.$inertia.delete(this.route('admin:users.destroy', this.editUser.id))
            }
        },
    }
}
</script>
