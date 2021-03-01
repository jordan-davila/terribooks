<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <NavSettings />
            <NavProfile />
            <section id="profile-smooth-scroll" class="flex flex-1 relative overflow-hidden">
                <div class="settings-container flex flex-col flex-1 h-full overflow-y-auto">
                    <PhotoModule />
                    <DetailsModule />
                    <ResetPasswordModule />
                    <!-- <two-factor-authentication-form class="mt-10 sm:mt-0" /> -->
                    <!-- <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" /> -->
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
import NavProfile from "@/Pages/Settings/Components/NavProfile";
// import LogoutOtherBrowserSessionsForm from "./LogoutOtherBrowserSessionsForm";
// import TwoFactorAuthenticationForm from "./TwoFactorAuthenticationForm";
import PhotoModule from "@/Pages/Settings/Profile/PhotoModule";
import DetailsModule from "@/Pages/Settings/Profile/DetailsModule";
import ResetPasswordModule from "@/Pages/Settings/Profile/ResetPasswordModule";

export default {
    components: {
        AppLayout,
        Copyright,
        NavSettings,
        NavProfile,
        // LogoutOtherBrowserSessionsForm,
        // TwoFactorAuthenticationForm,
        PhotoModule,
        DetailsModule,
        ResetPasswordModule
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
