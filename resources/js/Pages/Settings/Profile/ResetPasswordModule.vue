<template>
    <div id="update-password" class="module-container px-14 py-8 text-gray-300">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">Update Password</div>
                <div class="subtitle opacity-60">
                    Ensure your account is using a long, random password to stay secure.
                </div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="input-row grid grid-cols-1 gap-2 mb-3">
                    <div class="input-col">
                        <label>Current Password</label>
                        <input
                            ref="current_password"
                            name="name"
                            type="password"
                            v-model="form.current_password"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                        />
                    </div>
                </div>
                <div class="input-row grid grid-cols-1 gap-2 mb-3">
                    <div class="input-col">
                        <label>New Password</label>
                        <input
                            ref="password"
                            name="name"
                            type="password"
                            v-model="form.password"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                        />
                    </div>
                </div>
                <div class="input-row grid grid-cols-1 gap-2 mb-3">
                    <div class="input-col">
                        <label>Confirm Password</label>
                        <input
                            ref="password_confirmation"
                            name="name"
                            type="password"
                            v-model="form.password_confirmation"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                        />
                    </div>
                </div>
            </div>
            <div
                class="modal-options bg-gray-50 w-full py-6 px-8 flex items-center text-gray-300"
                :class="Object.keys($page.props.errors).length > 0 ? 'justify-between' : 'justify-end'"
            >
                <div class="errors" v-show="Object.keys($page.props.errors).length > 0">
                    <ul class="list-disc text-xxs uppercase font-bold text-red-600">
                        <li v-for="(error, key) in $page.props.errors.updatePassword" :key="key">{{ error }}</li>
                    </ul>
                </div>
                <button
                    @click="updatePassword"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                current_password: "",
                password: "",
                password_confirmation: ""
            })
        };
    },

    methods: {
        updatePassword() {
            this.form.put(route("user-password.update"), {
                errorBag: "updatePassword",
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset();
                    this.$page.props.jetstream.flash = {
                        alertStyle: "success",
                        alert: "Password Updated"
                    };
                },
                onError: () => {
                    this.$page.props.jetstream.flash = {
                        alertStyle: "danger",
                        alert: "Sorry, something went wrong"
                    };
                    if (this.form.errors.password) {
                        this.form.reset("password", "password_confirmation");
                        this.$refs.password.focus();
                    }
                    if (this.form.errors.current_password) {
                        this.form.reset("current_password");
                        this.$refs.current_password.focus();
                    }
                }
            });
        }
    }
};
</script>
