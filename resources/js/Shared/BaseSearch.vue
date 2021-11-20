<template>
    <div class="mb-6 flex w-full justify-between items-center">
        <input class="relative w-full px-4 py-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 mr-2 bg-white"
               autocomplete="off" type="text" name="search" placeholder="Keresés…"
               @input="search"
               v-model="searchTerm"
               />
        <jet-button @click="reset">
            Törlés
        </jet-button>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button';
import { ref } from 'vue';

//TODO implement in the pages

export default {
    components: {
        JetButton,
    },
    props: ['searchTerm'],
    emits: ['search'],
    setup(props, { emit }) {

        const searchTerm = ref(props.searchTerm);

        function search() {
            emit('search', searchTerm.value);
        }

        function reset() {
            searchTerm.value = '';
        }

        return {
            searchTerm,
            search,
            reset,
        }
    },
};
</script>
