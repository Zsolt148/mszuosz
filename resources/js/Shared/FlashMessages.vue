<template>
    <div>
        <div v-if="$page.props.flash.success && show" class="bg-green-300 flex items-center text-green-700 font-bold px-4 py-3 relative mb-4 rounded-md" role="alert">
            <icon name="check" class="w-4 h-4 mr-2 text-green-700 fill-current"></icon>
            <div>{{ $page.props.flash.success }}</div>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none" @click="show = false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-4 w-4 text-green-700" viewBox="0 0 1792 1792">
                    <path d="M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z">
                    </path>
                </svg>
            </button>
        </div>

        <div v-if="($page.props.flash.error || Object.keys($page.props.errors).length > 0) && show" class="bg-red-300 flex items-center text-red-700 font-bold px-4 py-3 relative mb-4 rounded-md" role="alert">
            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-red-700 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z" /></svg>
            <div v-if="$page.props.flash.error">{{ $page.props.flash.error }}</div>
            <div v-else class="font-medium">
                <span v-if="Object.keys($page.props.errors).length === 1">Hibás mező található</span>
                <span v-else>{{ Object.keys($page.props.errors).length }} hibás mező van</span>
            </div>
            <button class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none" @click="show = false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-4 w-4 text-red-700" viewBox="0 0 1792 1792">
                    <path d="M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z">
                    </path>
                </svg>
            </button>
        </div>

    </div>
</template>

<script>
import Icon from "@/Shared/Icon";

export default {
    components: {
        Icon,
    },
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>
