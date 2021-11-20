<template>
    <admin-layout>
        <template #header>
            Dokumentum típus szerkesztése
        </template>

        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('admin:documentTypes.index')">Dokumentum típusok</inertia-link>
            <span class="text-blue-400 font-medium">/</span>
            {{ form.name }}
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden">
            <form @submit.prevent="update">
                <div class="p-8 w-full flex flex-col">
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

                    <div class="w-1/2">
                        <jet-label for="name" value="Típus neve" />
                        <jet-input id="name" type="text" v-model="form.name" autocomplete="off" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
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
                Dokumentum típus törlése
            </template>

            <template #content>
                Biztosan törölni szeretnéd a dokumentum típust ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="confirmModalShow = false">
                    Mégse
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="deleteDocument">
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
import JetCheckbox from "@/Jetstream/Checkbox";
import JetDangerButton from "@/Jetstream/DangerButton";
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
        JetCheckbox,
        JetConfirmationModal,
        JetSecondaryButton,
    },
    props: {
        documentType: Object,
    },
    data() {
        return {
            confirmModalShow: false,
            form: this.$inertia.form({
                _method: 'POST',
                name: this.documentType.name,
                is_visible: this.documentType.is_visible ? true : false,
            }),
        };
    },
    methods: {
        update() {
            this.form.put(this.route('admin:documentTypes.update', this.documentType.id))
        },
        deleteDocument() {
            this.$inertia.delete(this.route('admin:documentTypes.destroy', this.documentType.id))
        },
    },
}
</script>
