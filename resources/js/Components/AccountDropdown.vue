<template lang="">
    <popper
        trigger="clickToOpen"
        :options="{
            placement: 'bottom-end',
            positionFixed: false,
            modifiers: {
                flip: { enabled: false },
                offset: { offset: '100, -10' },
                preventOverflow: { padding: -10 }
            }
        }"
    >
        <div class="popper rounded-md shadow-lg w-48 bg-white overflow-hidden dark:bg-gray-700">
            <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-gray-300 font-bold">
                    Manage Account
                </div>

                <inertia-link
                    :href="route('profile.show')"
                    class="block px-4 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:hover:bg-gray-600"
                >
                    Profile
                </inertia-link>

                <inertia-link
                    :href="route('profile.show')"
                    class="block px-4 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                    v-if="$page.props.jetstream.hasApiFeatures"
                >
                    Profile
                </inertia-link>

                <div class="border-t border-gray-100 dark:border-gray-500"></div>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <button
                        type="submit"
                        class="block px-4 py-2 w-full text-left uppercase leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out dark:hover:bg-gray-600"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <div slot="reference" class="flex px-8 justify-center items-center h-full">
            <button
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out"
            >
                <img
                    class="h-8 w-8 rounded-full object-cover"
                    :src="$page.props.user.profile_photo_url"
                    :alt="$page.props.user.name"
                />
            </button>
            <span v-else class="inline-flex rounded-md">
                <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                >
                    {{ $page.props.user.name }}
                    <svg
                        class="ml-2 -mr-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </span>
        </div>
    </popper>
</template>
<script>
import Popper from "vue-popperjs";
export default {
    components: { Popper },
    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        }
    }
};
</script>
