<template lang="">
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
                    <div class="block px-4 py-2 text-xs text-gray-400 font-medium">
                        Manage Account
                    </div>

                    <inertia-link :href="route('profile.show')" class="block px-4 py-2 text-xs leading-5 text-gray-400 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Profile
                    </inertia-link>

                    <inertia-link :href="route('profile.show')" class="block px-4 py-2 text-xs leading-5 text-gray-400 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" v-if="$page.props.jetstream.hasApiFeatures">
                        Profile
                    </inertia-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <button type="submit" class="block w-full px-4 py-2 text-xs leading-5 text-gray-400 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
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
</template>
<script>
import Popper from 'vue-popperjs';
export default {
    components: { Popper },
    methods: {
        logout() { this.$inertia.post(route('logout')); },
    },
}
</script>
