<template>
    <admin-layout>
        <template #header>
            Profil beállítások
        </template>

        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <update-profile-information-form :user="$page.props.user" />

                <jet-section-border />
            </div>

            <div v-if="$page.props.jetstream.canUpdatePassword">
                <update-password-form class="mt-10 sm:mt-0" />

                <jet-section-border />
            </div>

            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <two-factor-authentication-form class="mt-10 sm:mt-0" />

                <jet-section-border />
            </div>

            <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <jet-section-border />

                <delete-user-form class="mt-10 sm:mt-0" />
            </template>
        </div>
    </admin-layout>
</template>

<script>
    import DeleteUserForm from './DeleteUserForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'
    import AdminLayout from "@/Layouts/AdminLayout";

    export default {
        props: ['sessions'],

        components: {
            AdminLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
