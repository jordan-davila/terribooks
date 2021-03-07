<template>
    <div
        id="member-manager"
        class="module-container px-14 pt-8 text-gray-300"
        :class="$page.props.user.current_team.user_id == $page.props.user.id ? 'pt-8' : 'py-8'"
        v-if="$page.props.team.users.length > 0"
    >
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">Member Manager</div>
                <div class="subtitle opacity-60">Update or remove users from your congregation.</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div
                    class="flex items-center justify-between mb-6 last:mb-0"
                    v-for="user in $page.props.team.users"
                    :key="user.id"
                >
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full" :src="user.profile_photo_url" :alt="user.name" />
                        <div class="info flex flex-col ml-4 text-xxs text-gray-300 uppercase font-bold">
                            <span>{{ user.name }}</span>
                            <span class="opacity-60">{{ user.email }}</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <!-- Manage Team Member Role -->
                        <popper
                            :ref="'rolePicker-' + user.id"
                            trigger="clickToOpen"
                            :options="{
                                placement: 'bottom',
                                modifiers: {
                                    flip: { enabled: false },
                                    offset: { offset: '0,-5' }
                                }
                            }"
                            v-if="
                                $page.props.user.current_team.user_id == $page.props.user.id &&
                                    $page.props.availableRoles.length
                            "
                        >
                            <div class="popper rounded-md shadow-lg w-48 bg-white overflow-hidden">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-gray-300 font-bold">
                                        Switch Role
                                    </div>
                                    <button
                                        @click="updateRole(user, role.key)"
                                        class="block w-full px-6 py-2 leading-5 text-gray-300 uppercase text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                        v-for="role in $page.props.availableRoles"
                                        :key="role.key"
                                    >
                                        <div class="flex items-center">
                                            <svg
                                                v-if="role.key == user.membership.role"
                                                class="mr-2 h-5 w-5 text-green-400"
                                                fill="none"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>{{ role.name }}</div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <button
                                slot="reference"
                                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-red active:bg-indigo-600 transition ease-in-out duration-150 mr-2"
                            >
                                {{ displayableRole(user.membership.role) }}
                            </button>
                        </popper>

                        <div
                            class="mr-4 text-xxs uppercase text-gray-300 font-bold"
                            v-else-if="$page.props.availableRoles.length"
                        >
                            {{ displayableRole(user.membership.role) }}
                        </div>

                        <!-- Leave Team -->
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                            @click="
                                $modal.show('confirmation', {
                                    type: 'warning',
                                    title: 'Leave Congregation',
                                    message: 'Are you sure you want to leave this congregation?',
                                    action: () => removeTeamMember(user)
                                })
                            "
                            v-if="$page.props.user.id === user.id"
                        >
                            Leave
                        </button>

                        <!-- Remove Team Member -->
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                            @click="
                                $modal.show('confirmation', {
                                    type: 'warning',
                                    title: 'Remove Member',
                                    message: 'Are you sure you want to remove this member from the congregation?',
                                    action: () => leaveTeam()
                                })
                            "
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
import Popper from "vue-popperjs";
export default {
    components: { Popper },
    data() {
        return {};
    },
    methods: {
        displayableRole(role) {
            return this.$page.props.availableRoles.find(r => r.key === role).name;
        },

        updateRole(user, role) {
            this.$inertia.put(
                route("team-members.update", [this.$page.props.team, user]),
                { role },
                {
                    preserveScroll: true,
                    // Refs for some reason is wrapped in an array
                    onSuccess: () => this.$refs["rolePicker-" + user.id][0].doClose()
                }
            );
        },

        leaveTeam() {
            this.leaveTeamForm.delete(route("team-members.destroy", [this.$page.props.team, this.$page.props.user]));
        },

        removeTeamMember(member) {
            this.$inertia.delete(route("team-members.destroy", [this.$page.props.team, member]), {
                errorBag: "removeTeamMember",
                preserveScroll: true,
                preserveState: true,
                onSuccess: () =>
                    (this.$page.props.flash = {
                        type: "success",
                        message: "Member Removed"
                    })
            });
        }
    }
};
</script>
