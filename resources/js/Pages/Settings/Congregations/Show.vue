<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <NavSettings />
            <nav style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white">
                <div class="territory-list w-full flex-1 px-14 py-8">
                    <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                        <span>Congregation Settings</span>
                        <button class="w-6 h-6 text-gray-300 text-sm">
                            <i class="fas fa-caret-down"></i>
                        </button>
                    </div>
                    <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                        <div class="info flex items-center">
                            <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                                <i class="fas fa-book-user"></i>
                            </span>
                            <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                                <span>Name & Owner</span>
                                <span class="opacity-60">Information</span>
                            </div>
                        </div>
                        <button class="text-gray-300 text-xxs">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </a>
                    <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                        <div class="info flex items-center">
                            <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                                <i class="fas fa-city"></i>
                            </span>
                            <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                                <span>Cities</span>
                                <span class="opacity-60">Add Cities</span>
                            </div>
                        </div>
                        <button class="text-gray-300 text-xxs">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </a>
                    <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                        <div class="info flex items-center">
                            <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                                <i class="fas fa-users"></i>
                            </span>
                            <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                                <span>Members</span>
                                <span class="opacity-60">Invite Users</span>
                            </div>
                        </div>
                        <button class="text-gray-300 text-xxs">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </a>
                    <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                        <div class="info flex items-center">
                            <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                            <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                                <span>Delete</span>
                                <span class="opacity-60">Permanently</span>
                            </div>
                        </div>
                        <button class="text-gray-300 text-xxs">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </a>
                </div>
            </nav>
            <section id="team-smooth-scroll" class="flex flex-1 relative py-8 px-14 overflow-hidden">
                <div class="flex-auto">
                    <div class="settings-container flex flex-col flex-1 h-full overflow-y-auto">
                        <update-team-name-form :team="team" :permissions="permissions" />

                        <team-member-manager
                            class="mt-10 sm:mt-0"
                            :team="team"
                            :available-roles="availableRoles"
                            :user-permissions="permissions"
                        />

                        <template v-if="permissions.canDeleteTeam && !team.personal_team">
                            <jet-section-border />
                            <delete-team-form class="mt-10 sm:mt-0" :team="team" />
                        </template>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>

<script>
import TeamMemberManager from "./TeamMemberManager";
import AppLayout from "@/Layouts/AppLayout";
import DeleteTeamForm from "./DeleteTeamForm";
import JetSectionBorder from "@/Jetstream/SectionBorder";
import UpdateTeamNameForm from "./UpdateTeamNameForm";
import Scrollbar from "smooth-scrollbar";
import Copyright from "@/Components/Copyright";
import NavSettings from "@/Components/NavSettings";

export default {
    props: ["team", "availableRoles", "permissions"],

    components: {
        AppLayout,
        DeleteTeamForm,
        JetSectionBorder,
        TeamMemberManager,
        UpdateTeamNameForm,
        Copyright,
        NavSettings
    },

    mounted() {
        Scrollbar.init(document.querySelector("#team-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
