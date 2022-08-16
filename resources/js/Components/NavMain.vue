<template lang="">
    <nav class="flex justify-between w-full h-16 bg-white border-b border-gray-200 border-solid dark:bg-gray-800 dark:border-gray-600" style="z-index: 999">
        <!-- Logo -->
        <div
            class="w-16 h-full border-solid border-gray-200 border-r text-gray-300 text-base flex justify-center items-center dark:border-gray-600"
        >
            <Logo class="w-4" />
        </div>
        <inertia-link
            :href="route('welcome')"
            class="flex justify-between items-center border-solid border-gray-200 border-r text-gray-900 font-bold h-full px-14 dark:text-gray-200 dark:border-gray-600"
            style="flex: 0 295px"
        >
            <div class="logo text-lg">terri<span class="text-indigo-600">books</span></div>
            <div class="logo text-gray-300 text-xxs mt pt">v2.7.0</div>
        </inertia-link>

        <!-- SearchBar Component with SearchFocus -->
        <SearchBar />

        <!-- Nav Links -->
        <div class="menu flex text-xs cursor-pointer">
            <inertia-link :href="route('dashboard')" :class="classes('dashboard')">
                Dashboard
            </inertia-link>
            <inertia-link :href="route('territories.index')" :class="classes('territories.*')">
                Territories
            </inertia-link>

            <!-- Congregation Dropdown -->
            <popper
                trigger="clickToOpen"
                :options="{
                    placement: 'bottom',
                    modifiers: {
                        flip: { enabled: false },
                        offset: { offset: '0,-5' }
                    }
                }"
            >
                <div class="popper rounded-md shadow-lg w-60 bg-white overflow-hidden dark:bg-gray-700">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 leading-5 text-gray-300 font-bold">
                            Manage Congregations
                        </div>

                        <inertia-link
                            :href="route('teams.show', $page.props.user.current_team)"
                            v-if="$page.props.user.belongsToAnyTeam"
                            class="block px-4 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:hover:bg-gray-600"
                        >
                            Congregation Settings
                        </inertia-link>

                        <button
                            @click="$modal.show('add-congregation')"
                            v-if="$page.props.jetstream.canCreateTeams"
                            class="block px-4 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out uppercase w-full text-left dark:hover:bg-gray-600"
                        >
                            Create Congregation
                        </button>

                        <!-- Congregation Switcher -->
                        <template v-if="$page.props.user.belongsToAnyTeam">
                            <div class="border-t border-gray-100 dark:border-gray-500"></div>
                            <div class="block px-4 leading-5 py-2 text-gray-300 font-bold">
                                Switch Congregations
                            </div>
                            <template v-for="congregation in $page.props.user.all_teams">
                                <form @submit.prevent="switchToTeam(congregation)" :key="congregation.id">
                                    <button
                                        type="submit"
                                        class="block w-full px-6 py-2 leading-5 text-gray-300 uppercase text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:hover:bg-gray-600"
                                    >
                                        <div class="flex items-center">
                                            <svg
                                                v-if="congregation.id == $page.props.user.current_team_id"
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
                                            <div>{{ congregation.name }}</div>
                                        </div>
                                    </button>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
                <div slot="reference" :class="'h-full ' + classes('teams.*')">
                    Congregations
                </div>
            </popper>
            <a href="/docs" :class="classes('profile.*')">
                Docs
            </a>

            <!-- Settings Dropdown -->
            <AccountDropdown />
        </div>
    </nav>
</template>
<script>
import SearchBar from "./SearchBar";
import AccountDropdown from "./AccountDropdown";
import Popper from "vue-popperjs";
import Logo from "./Logo";

export default {
    props: ["territory"],
    components: {
        AccountDropdown,
        SearchBar,
        Logo,
        Popper
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },

        classes(link) {
            let classes =
                "text-gray-300 font-bold uppercase text-xxs justify-center items-center px-8 flex hover:border-indigo-600 border-b-2 border-solid ";

            classes += route().current(link) ? "border-indigo-500" : "border-white dark:border-gray-600";

            return classes;
        }
    }
};
</script>
