<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <NavSettings />
            <NavCongregations />
            <section id="congregation-settings-smooth-scroll" class="flex flex-1 relative overflow-hidden">
                <div class="settings-container flex flex-col flex-1 h-full overflow-y-auto">
                    <create-team-form />
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
import CreateTeamForm from "./CreateTeamForm";

export default {
    props: ["team", "availableRoles", "permissions"],

    components: {
        AppLayout,
        Copyright,
        NavSettings,
        NavCongregations,
        CreateTeamForm
    },

    mounted() {
        Scrollbar.init(document.querySelector("#congregation-settings-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
