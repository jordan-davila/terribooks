<template>
    <div id="profile-photo" class="module-container px-14 pt-8 text-gray-300">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">Profile Photo</div>
                <div class="subtitle opacity-60">Add or update your profile picture</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="flex justify-between items-center" v-if="$page.props.jetstream.managesProfilePhotos">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview" />

                    <!-- Current Profile Photo -->
                    <div class="flex items-center" v-show="!photoPreview">
                        <img
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name"
                            class="w-12 h-12 rounded-full object-cover"
                        />
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="flex items-center" v-show="photoPreview">
                        <span
                            class="w-12 h-12 rounded-full object-cover"
                            :style="
                                'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                    photoPreview +
                                    '\');'
                            "
                        >
                        </span>
                    </div>

                    <div class="options">
                        <button
                            class="inline-flex items-center justify-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                            type="button"
                            @click.prevent="selectNewPhoto"
                        >
                            Select A New Photo
                        </button>

                        <button
                            type="button"
                            class="inline-flex items-center justify-center px-4 py-2 bg-rose-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150 ml-2"
                            @click.prevent="deletePhoto"
                            v-if="$page.props.user.profile_photo_path"
                        >
                            Remove Photo
                        </button>
                        <button
                            type="button"
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150 ml-2"
                            @click.prevent="updateProfileInformation"
                            v-if="photoPreview"
                        >
                            Save Photo
                        </button>
                    </div>
                </div>
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
                email: this.$page.props.user.email,
                photo: null
            }),

            photoPreview: null
        };
    },

    methods: {
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(route("user-profile-information.update"), {
                errorBag: "updateProfileInformation",
                preserveScroll: true,
                onSuccess: () => {
                    this.photoPreview = null;
                }
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = e => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia.delete(route("current-user-photo.destroy"), {
                preserveScroll: true,
                onSuccess: () => (this.photoPreview = null)
            });
        }
    }
};
</script>
