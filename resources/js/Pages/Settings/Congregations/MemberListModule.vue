<template>
    <div class="module-container px-14 pt-8 text-gray-300" v-if="$page.props.team.users.length > 0">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">Member Manager</div>
                <div class="subtitle opacity-60">Update or remove users from your congregation.</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="flex items-center justify-between" v-for="user in $page.props.team.users" :key="user.id">
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full" :src="user.profile_photo_url" :alt="user.name" />
                        <div class="info flex flex-col ml-4 text-xxs text-gray-300 uppercase font-bold">
                            <span>{{ user.name }}</span>
                            <span class="opacity-60">{{ user.email }}</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <!-- Manage Team Member Role -->
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-red active:bg-indigo-600 transition ease-in-out duration-150 mr-2"
                            @click="manageRole(user)"
                            v-if="$page.props.permissions.canAddTeamMembers && $page.props.availableRoles.length"
                        >
                            {{ displayableRole(user.membership.role) }}
                        </button>

                        <div
                            class="mr-4 text-xxs uppercase text-gray-300 font-bold"
                            v-else-if="$page.props.availableRoles.length"
                        >
                            {{ displayableRole(user.membership.role) }}
                        </div>

                        <!-- Leave Team -->
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                            @click="confirmLeavingTeam"
                            v-if="$page.props.user.id === user.id"
                        >
                            Leave
                        </button>

                        <!-- Remove Team Member -->
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                            @click="confirmTeamMemberRemoval(user)"
                            v-if="$page.props.permissions.canRemoveTeamMembers"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            updateRoleForm: this.$inertia.form({
                role: null
            }),
            currentlyManagingRole: false,
            managingRoleFor: null
        };
    },
    methods: {
        displayableRole(role) {
            return this.$page.props.availableRoles.find(r => r.key === role).name;
        },

        manageRole(teamMember) {
            console.log(teamMember);
            this.managingRoleFor = teamMember;
            this.updateRoleForm.role = teamMember.membership.role;
            this.currentlyManagingRole = true;
        },

        updateRole() {
            this.updateRoleForm.put(route("team-members.update", [this.team, this.managingRoleFor]), {
                preserveScroll: true,
                onSuccess: () => (this.currentlyManagingRole = false)
            });
        },

        leaveTeam() {
            this.leaveTeamForm.delete(route("team-members.destroy", [this.team, this.$page.props.user]));
        },

        removeTeamMember() {
            this.removeTeamMemberForm.delete(route("team-members.destroy", [this.team, this.teamMemberBeingRemoved]), {
                errorBag: "removeTeamMember",
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => (this.teamMemberBeingRemoved = null)
            });
        }
    }
};
</script>
