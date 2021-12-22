<template>
    <div
        id="invite-members"
        class="module-container px-14 pt-8 text-gray-300"
        v-if="$page.props.permissions.canAddTeamMembers"
    >
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-gray-800">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 dark:bg-gray-700 dark:border-gray-600">
                <div class="title">Invite Members</div>
                <div class="subtitle opacity-60">Add users to help you manage your congregation's territories.</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="input-row grid grid-cols-1 gap-2 mb-3">
                    <div class="input-col">
                        <label>Email</label>
                        <input
                            name="email"
                            type="email"
                            v-model="addTeamMemberForm.email"
                            :disabled="!$page.props.permissions.canUpdateTeam"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 dark:border-gray-600"
                        />
                    </div>
                </div>
                <div class="input-row grid grid-cols-1 gap-2 mb-3">
                    <!-- Role -->
                    <div class="input-col" v-if="$page.props.availableRoles.length > 0">
                        <label>Role</label>
                        <div
                            class="relative flex z-0 mt-2 border border-gray-200 rounded-lg cursor-pointer overflow-hidden dark:border-gray-600"
                        >
                            <button
                                type="button"
                                class="relative px-4 py-3 flex justify-start items-center w-full border-r border-gray-200 last:border-r-0 dark:border-gray-600"
                                @click="addTeamMemberForm.role = role.key"
                                v-for="role in $page.props.availableRoles"
                                :key="role.key"
                            >
                                <div
                                    :class="{
                                        'opacity-50': addTeamMemberForm.role && addTeamMemberForm.role != role.key
                                    }"
                                >
                                    <div class="flex items-center">
                                        <div
                                            class="text-xxs uppercase text-gray-300 font-bold"
                                            :class="{ 'font-semibold': addTeamMemberForm.role == role.key }"
                                        >
                                            {{ role.name }}
                                        </div>
                                        <div
                                            class="text-base ml-2 leading-none h-5 w-5 text-green-400"
                                            v-if="addTeamMemberForm.role == role.key"
                                        >
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xxs uppercase text-gray-300 text-left">
                                        {{ role.description }}
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module-options bg-gray-50 w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-800 dark:border-t dark:border-solid dark:border-gray-600">
                <button
                    @click="addTeamMember()"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-red active:bg-indigo-600 transition ease-in-out duration-150"
                >
                    Invite User
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            addTeamMemberForm: this.$inertia.form({
                email: "",
                role: null
            }),

            updateRoleForm: this.$inertia.form({
                role: null
            })
        };
    },

    methods: {
        addTeamMember() {
            this.addTeamMemberForm.post(route("team-members.store", this.$page.props.team), {
                preserveScroll: true,
                onSuccess: page => {
                    this.addTeamMemberForm.reset();
                    this.$page.props.flash = {
                        type: "success",
                        message: "Member Invited."
                    };
                }
            });
        }
    }
};
</script>
