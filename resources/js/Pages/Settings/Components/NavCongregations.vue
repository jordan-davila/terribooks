<template>
    <nav style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white">
        <div class="territory-list w-full flex-1 px-14 py-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>Congregation Settings</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <button
                @click="scrollToSetting('#owner-details')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-book-user"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Owner Details</span>
                        <span class="opacity-60">Contact</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#update-details')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-info-square"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Update Details</span>
                        <span class="opacity-60">Name & Location</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#city-manager')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
                v-if="$page.props.permissions.canUpdateTeam"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-city"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>City Manager</span>
                        <span class="opacity-60">Update Cities</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#invite-members')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
                v-if="$page.props.permissions.canAddTeamMembers"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Invite Members</span>
                        <span class="opacity-60">Ask to Join</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#member-manager')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Member Manager</span>
                        <span class="opacity-60">Update Users</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#delete')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
                v-if="$page.props.permissions.canDeleteTeam"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100"
                    >
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Delete</span>
                        <span class="opacity-60">Permanently</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
        </div>
    </nav>
</template>
<script>
import Scrollbar from "smooth-scrollbar";
export default {
    methods: {
        scrollToSetting(setting) {
            let child = document.querySelector(setting);
            let scroll = Scrollbar.get(document.querySelector("#congregation-settings-smooth-scroll"));
            scroll.scrollTo(0, child.offsetTop, 1000);
        }
    }
};
</script>
