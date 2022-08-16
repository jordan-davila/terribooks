<template>
    <nav style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white dark:bg-gray-800 dark:border-gray-600">
        <div class="territory-list w-full flex-1 px-14 py-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>Account Settings</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <button
                @click="scrollToSetting('#profile-photo')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100 dark:bg-slate-600 dark:text-gray-200"
                    >
                        <i class="fas fa-camera-alt"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Profile Photo</span>
                        <span class="opacity-60">Select or Remove</span>
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
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100 dark:bg-slate-600 dark:text-gray-200"
                    >
                        <i class="fas fa-info-square"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Update Details</span>
                        <span class="opacity-60">Name & Email</span>
                    </div>
                </div>
                <div class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </button>
            <button
                @click="scrollToSetting('#update-password')"
                class="uppercase font-bold py-4 flex justify-between items-center w-full"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100 dark:bg-slate-600 dark:text-gray-200"
                    >
                        <i class="fas fa-lock-alt"></i>
                    </span>
                    <div class="info flex flex-col items-start ml-4 text-xxs text-gray-300">
                        <span>Update Password</span>
                        <span class="opacity-60">Secure Account</span>
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
            let scroll = Scrollbar.get(document.querySelector("#profile-smooth-scroll"));
            scroll.scrollTo(0, child.offsetTop, 1000);
        }
    }
};
</script>
