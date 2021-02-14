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
                    <!-- <OwnerModule /> -->
                    <!-- <DetailsModule /> -->
                    <MemberInviteModule />
                    <MemberListModule />
                    <!-- <MemberManagerModule /> -->
                    <!-- <MemberManagerModule
                        :team="$page.props.team"
                        :availableRoles="$page.props.availableRoles"
                        :userPermissions="$page.props.permissions"
                    /> -->

                    <template v-if="permissions.canDeleteTeam && !team.personal_team">
                        <DeleteTeamForm class="mt-10 mb-8 sm:mt-0" :team="team" />
                    </template>
                </div>
            </section>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import DeleteTeamForm from "./DeleteTeamForm";
import Scrollbar from "smooth-scrollbar";
import Copyright from "@/Components/Copyright";
import NavSettings from "@/Pages/Settings/Components/NavSettings";
import NavCongregations from "@/Pages/Settings/Components/NavCongregations";
import OwnerModule from "@/Pages/Settings/Congregations/OwnerModule";
import DetailsModule from "@/Pages/Settings/Congregations/DetailsModule";
import MemberInviteModule from "@/Pages/Settings/Congregations/MemberInviteModule";
import MemberListModule from "@/Pages/Settings/Congregations/MemberListModule";
import MemberManagerModule from "@/Pages/Settings/Congregations/MemberManagerModuleBak";

export default {
    props: ["team", "availableRoles", "permissions"],

    components: {
        AppLayout,
        DeleteTeamForm,
        MemberListModule,
        Copyright,
        NavSettings,
        NavCongregations,
        OwnerModule,
        DetailsModule,
        MemberInviteModule,
        MemberManagerModule
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
