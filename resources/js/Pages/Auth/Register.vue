<template>
    <div class="register-container text-gray-300 bg-gray-100 w-full h-screen flex flex-col items-center justify-center">
        <div class="logo-container flex items-center mb-8">
            <div class="h-full text-gray-300 text-base flex justify-center items-center mr-3">
                <Logo class="w-6" />
            </div>
            <inertia-link :href="route('welcome')" class="text-gray-900 text-2xl font-bold">
                <div>terri<span class="text-indigo-600">books</span></div>
            </inertia-link>
        </div>
        <div class="module-card w-96 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <form @submit.prevent="submit">
                    <div>
                        <label for="name">Name</label>
                        <input
                            id="name"
                            type="text"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
                    </div>

                    <div class="mt-4">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="form.email"
                            required
                        />
                    </div>

                    <div class="mt-4">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                        <label for="terms">
                            <div class="flex items-center">
                                <div
                                    class="bg-white border rounded border-gray-300 w-4 h-4 flex flex-shrink-0 justify-center items-center focus-within:border-indigo-200"
                                >
                                    <input type="checkbox" class="opacity-0 absolute" v-model="form.terms" />
                                    <svg
                                        class="fill-current hidden w-2 h-2 text-indigo-500 pointer-events-none"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    I agree to the
                                    <a
                                        target="_blank"
                                        :href="route('terms.show')"
                                        class="text-indigo-500 hover:text-indigo-700"
                                    >
                                        Terms of Service
                                    </a>
                                    and
                                    <a
                                        target="_blank"
                                        :href="route('policy.show')"
                                        class="text-indigo-500 hover:text-indigo-700"
                                    >
                                        Privacy Policy
                                    </a>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <inertia-link :href="route('login')" class="text-gray-400 hover:text-indigo-500 mr-4">
                            Already registered?
                        </inertia-link>

                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </button>
                    </div>
                </form>
            </div>
            <div
                class="card-errors text-xxs uppercase w-full px-8 py-6 font-bold border-t border-gray-100"
                v-if="Object.keys($page.props.errors).length > 0"
            >
                <div class="title">Please fix the following errors:</div>
                <ul class="errors list-disc text-xxs uppercase font-bold text-red-600 mt-2">
                    <li v-for="(error, key) in $page.props.errors" :key="key">{{ error }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "@/Components/Logo";
export default {
    components: { Logo },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                terms: false
            })
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("register"), {
                onFinish: () => this.form.reset("password", "password_confirmation")
            });
        }
    }
};
</script>
<style>
input:checked + svg {
    display: block;
}
</style>
