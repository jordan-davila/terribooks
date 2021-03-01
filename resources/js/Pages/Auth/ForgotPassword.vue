<template>
    <div class="text-gray-300 bg-gray-100 w-full h-screen flex flex-col items-center justify-center">
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
                <div class="mb-4 text-xxs uppercase text-gray-300">
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset link that will allow you to choose a new one.
                </div>

                <div v-if="status" class="mb-4 font-bold text-xxs uppercase text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="form.email"
                            required
                            autofocus
                        />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Email Password Reset Link
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
    props: {
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ""
            })
        };
    },

    methods: {
        submit() {
            this.form.post(this.route("password.email"));
        }
    }
};
</script>
