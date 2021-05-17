<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 font-bold leading-5 text-blue-600 focus:outline-none focus:border-indigo-700 transition'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-bold leading-5 text-gray-700 hover:text-gray-900 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition'
            }
        }
    }
</script>
