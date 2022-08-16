<template>
    <div id="update-details" class="module-container px-14 pt-8 text-gray-300">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-gray-800">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 dark:bg-gray-700 dark:border-gray-600">
                <div class="title">Profile Info</div>
                <div class="subtitle opacity-60">Update your account's profile information and email address.</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="input-row grid grid-cols-2 gap-2 mb-3">
                    <div class="input-col">
                        <label>Name</label>
                        <input
                            name="name"
                            type="text"
                            v-model="form.name"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 dark:border-gray-600"
                        />
                    </div>
                    <div class="input-col">
                        <label>Email</label>
                        <input
                            name="name"
                            type="email"
                            v-model="form.email"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 dark:border-gray-600"
                        />
                    </div>
                </div>
            </div>
            <div class="modal-options bg-gray-50 w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-800 dark:border-t dark:border-solid dark:border-gray-600">
                <button
                    @click="updateProfileInformation"
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
                _method: "PUT",
                name: this.$page.props.user.name,
                email: this.$page.props.user.email
            })
        };
    },

    methods: {
        updateProfileInformation() {
            this.form.post(route("user-profile-information.update"), {
                errorBag: "updateProfileInformation",
                preserveScroll: true,
                onSuccess: () => {
                    this.$page.props.jetstream.flash = {
                        alertStyle: "success",
                        alert: "Profile Information Saved"
                    };
                },
                onError: () => {
                    this.$page.props.jetstream.flash = {
                        alertStyle: "danger",
                        alert: "Sorry, something went wrong"
                    };
                }
            });
        }
    }
};
</script>
