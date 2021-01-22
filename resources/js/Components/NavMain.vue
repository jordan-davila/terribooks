<template lang="">
    <nav class="flex justify-between w-full h-16 bg-white border-b border-gray-200 border-solid z-50">
        <div class="w-16 h-full border-solid border-gray-200 border-r text-gray-400 text-base flex justify-center items-center">
            <Logo class="w-4"/>
        </div>
        <inertia-link :href="route('welcome')" class="flex justify-center items-center border-solid border-gray-200 border-r text-gray-800 font-bold h-full px-24">
            <div class="logo text-lg">terri<span class="text-indigo-600">books</span></div>
        </inertia-link>
        <SearchBar></SearchBar>
        <div class="menu flex text-xs font-medium cursor-pointer">
            <inertia-link
                :href="route('dashboard')"
                class="text-gray-400 text-xs justify-center items-center px-8 flex capitalize hover:border-indigo-600 border-b-2 border-solid border-white">
                Dashboard
            </inertia-link>
            <inertia-link
                :href="route('territory')"
                class="text-gray-400 text-xs justify-center items-center px-8 flex capitalize hover:border-indigo-600 border-b-2 border-solid border-white">
                Territories
            </inertia-link>
            <inertia-link
                :href="route('teams.show', $page.props.user.current_team)"
                class="text-gray-400 text-xs justify-center items-center px-8 flex capitalize hover:border-indigo-600 border-b-2 border-solid border-white">
                Congregations
            </inertia-link>
            <inertia-link
                :href="route('profile.show')"
                class="text-gray-400 text-xs justify-center items-center px-8 flex capitalize hover:border-indigo-600 border-b-2 border-solid border-white"
            >
                Docs
            </inertia-link>
            <!-- Settings Dropdown -->
            <popper
            trigger="clickToOpen"
            :options="{
                placement: 'auto',
                modifiers: {
                    flip: { enabled: false },
                    offset: { offset: '80,-70' }
                    }
                }">
                <div class="popper rounded-md shadow-lg w-48 bg-white overflow-hidden">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Account
                        </div>

                        <inertia-link :href="route('profile.show')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            Profile
                        </inertia-link>

                        <inertia-link :href="route('profile.show')" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" v-if="$page.props.jetstream.hasApiFeatures">
                            Profile
                        </inertia-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <button type="submit" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                <div slot="reference" class="flex px-8 justify-center items-center h-full">
                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </button>
                    <span v-else class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{ $page.props.user.name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </div>
            </popper>
        </div>
    </nav>
</template>
<script>
import Popper from 'vue-popperjs';
import JetApplogo from '@/Jetstream/ApplicationMark'
import SearchBar from "./SearchBar";
import Logo from "./Logo";

export default {
    components: {
        Popper,
        JetApplogo,
        SearchBar,
        Logo
    },

    methods: {
        logout() {
                this.$inertia.post(route('logout'));
            },
    },
}
</script>
