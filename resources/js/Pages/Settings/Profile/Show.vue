<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <NavSettings />
            <NavCongregations />
            <section id="profile-smooth-scroll" class="flex flex-1 relative overflow-hidden">
                <div class="settings-container flex flex-col flex-1 h-full overflow-y-auto">
                    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                        <update-profile-information-form :user="$page.props.user" />
                    </div>

                    <div v-if="$page.props.jetstream.canUpdatePassword">
                        <update-password-form class="mt-10 sm:mt-0" />
                    </div>

                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                        <two-factor-authentication-form class="mt-10 sm:mt-0" />
                    </div>

                    <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

                    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <delete-user-form class="mt-10 pb-8 sm:mt-0" />
                    </template>
                </div>
            </section>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Scrollbar from "smooth-scrollbar";
import Copyright from "@/Components/Copyright";
import NavSettings from "@/Pages/Settings/Components/NavSettings";
import NavCongregations from "@/Pages/Settings/Components/NavCongregations";
import DeleteUserForm from "./DeleteUserForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import LogoutOtherBrowserSessionsForm from "./LogoutOtherBrowserSessionsForm";
import TwoFactorAuthenticationForm from "./TwoFactorAuthenticationForm";
import UpdatePasswordForm from "./UpdatePasswordForm";
import UpdateProfileInformationForm from "./UpdateProfileInformationForm";

export default {
    props: ["sessions"],

    components: {
        AppLayout,
        Copyright,
        NavSettings,
        NavCongregations,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm
    },

    mounted() {
        Scrollbar.init(document.querySelector("#profile-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
