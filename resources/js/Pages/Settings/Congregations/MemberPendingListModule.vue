<template>
    <div
        class="module-container px-14 pt-8 text-gray-300"
        v-if="$page.props.team.team_invitations.length > 0 && $page.props.permissions.canAddTeamMembers"
    >
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">Pending Member Invitations</div>
                <div class="subtitle opacity-60">
                    An invitaion email has been sent to these users.
                </div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div
                    class="flex items-center justify-between mb-2"
                    v-for="invitation in $page.props.team.team_invitations"
                    :key="invitation.id"
                >
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-2"></i>
                        <div class="text-gray-300">{{ invitation.email }}</div>
                    </div>

                    <div class="flex items-center">
                        <button
                            @click="cancelTeamInvitation(invitation)"
                            v-if="$page.props.permissions.canRemoveTeamMembers"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-xxs text-red-600 uppercase hover:opacity-90 transition ease-in-out duration-150"
                        >
                            Cancel Invite
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Popper from "vue-popperjs";
export default {
    components: { Popper },
    methods: {
        cancelTeamInvitation(invitation) {
            this.$inertia.delete(route("team-invitations.destroy", invitation), {
                preserveScroll: true
            });
        }
    }
};
</script>
