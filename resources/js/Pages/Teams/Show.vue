<template>
    <AppLayout>
        <div id="profile-smooth-scroll" class="content-container flex flex-col w-full h-full overflow-y-auto">
            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <update-team-name-form :team="team" :permissions="permissions" />

                    <team-member-manager class="mt-10 sm:mt-0"
                                :team="team"
                                :available-roles="availableRoles"
                                :user-permissions="permissions" />

                    <template v-if="permissions.canDeleteTeam && ! team.personal_team">
                        <jet-section-border />

                        <delete-team-form class="mt-10 sm:mt-0" :team="team" />
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import TeamMemberManager from './TeamMemberManager'
    import AppLayout from '@/Layouts/AppLayout'
    import DeleteTeamForm from './DeleteTeamForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import UpdateTeamNameForm from './UpdateTeamNameForm'
    import Scrollbar from "smooth-scrollbar";

    export default {
        props: [
            'team',
            'availableRoles',
            'permissions',
        ],

        components: {
            AppLayout,
            DeleteTeamForm,
            JetSectionBorder,
            TeamMemberManager,
            UpdateTeamNameForm,
        },

        mounted() {
            Scrollbar.init(document.querySelector("#team-smooth-scroll"), {
                damping: 0.1,
                renderByPixels: true,
                alwaysShowTracks: false,
                continuousScrolling: true
            });
        }
    }
</script>
