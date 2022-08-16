<template>
    <nav
        class="flex flex-col justify-end h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden text-gray-300 text-xs dark:bg-gray-800 dark:border-gray-600"
    >
        <inertia-link
            :href="route('policy.show')"
            class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400 dark:border-gray-500"
        >
            Privacy & Policy
        </inertia-link>
        <inertia-link
            :href="route('terms.show')"
            class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400 dark:border-gray-500"
        >
            Terms & Conditions
        </inertia-link>
        <div class="section text-vertical w-full py-6 flex flex-col justify-center items-center">
            Copyright © {{ new Date().getFullYear() }} Terribooks. All Rights Reserved
        </div>
        <div class="icons text-gray-300 text-sm h-16 w-full flex flex-col justify-center items-center cursor-pointer" @click="updateTheme()">
            <i class="fas fa-toggle-on" v-if="this.$inertia.page.props.user.theme === 'dark'"></i>
            <i class="fas fa-toggle-off" v-else></i>
        </div>
    </nav>
</template>
<script>
export default {
    methods: {
        updateTheme() {
            document.body.classList.remove(this.$inertia.page.props.user.theme)
            this.$inertia.visit("/theme",
                {
                    method: "put",
                    preserveScroll: true,
                    onSuccess: page => {
                        document.body.classList.add(this.$inertia.page.props.user.theme)
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Theme Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Sorry, something went wrong"
                        };
                    }
                }
            );
        },
    },
};
</script>
