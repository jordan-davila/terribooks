<template>
    <div style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white dark:bg-gray-800 dark:border-gray-600">
        <div class="territory-list w-full flex-1 px-14 py-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>Settings</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <inertia-link
                :href="route('teams.show', $page.props.user.current_team)"
                class="uppercase font-bold py-4 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span :class="classes('teams.show')">
                        <i class="fas fa-globe-americas"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Congregation</span>
                        <span class="opacity-60">Settings</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="route('profile.show')"
                class="uppercase font-bold py-4 flex justify-between items-center"
            >
                <div class="info flex items-center">
                    <span :class="classes('profile.show')">
                        <i class="fas fa-user"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Account</span>
                        <span class="opacity-60">Settings</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="route('settings.maintenance')"
                class="uppercase font-bold py-4 flex justify-between items-center"
            >
                <div class="info flex items-center">
                    <span :class="classes('dashboard')">
                        <i class="fas fa-download"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Export</span>
                        <span class="opacity-60">Settings</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="route('settings.maintenance')"
                class="uppercase font-bold py-4 flex justify-between items-center"
            >
                <div class="info flex items-center">
                    <span :class="classes('dashboard')">
                        <i class="fas fa-palette"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Appearances</span>
                        <span class="opacity-60">Dark / Light</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="route('settings.maintenance')"
                class="uppercase font-bold py-4 flex justify-between items-center"
            >
                <div class="info flex items-center">
                    <span :class="classes('dashboard')">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Miscellaneous</span>
                        <span class="opacity-60">Settings</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="route('settings.maintenance')"
                class="uppercase font-bold py-4 flex justify-between items-center"
            >
                <div class="info flex items-center">
                    <span :class="classes('dashboard')">
                        <i class="fas fa-heart" style="user-select: auto;"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Support Us</span>
                        <span class="opacity-60">Donate</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        classes(link) {
            let classes = "w-10 h-10 flex justify-center items-center text-xs rounded-lg hidden";
            classes += route().current(link) ? "text-indigo-600 bg-indigo-100 shadow-lg border-indigo-600 border-solid border dark:bg-slate-600 dark:text-gray-200" : "text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-300";
            return classes;
        }
    }
};
</script>
