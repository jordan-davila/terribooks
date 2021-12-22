<template>
    <div id="delete" class="module-container px-14 py-8 text-gray-300" v-if="$page.props.permissions.canDeleteTeam">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-gray-800">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 dark:bg-gray-700 dark:border-gray-600">
                <div class="title">Delete Congregation</div>
                <div class="subtitle opacity-60">Delete the current congregation and all its territories.</div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold opacity-60 uppercase">
                Once a congregation is deleted, all of its resources and data will be permanently deleted. Before
                deleting, please download all the territories that you wish to retain. Please note that this action can
                not be undone. Proceed with caution.
            </div>
            <div class="module-options bg-gray-50 w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-800 dark:border-t dark:border-solid dark:border-gray-600">
                <button
                    @click="
                        $modal.show('confirmation', {
                            type: 'warning',
                            title: 'Delete Congregation',
                            message:
                                'Are you sure you want to delete this congregation and its territories? This action can not be undone.',
                            action: () => deleteCongregation()
                        })
                    "
                    class="inline-flex items-center justify-center px-4 py-2 bg-rose-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                >
                    <i class="fas fa-exclamation-square mr-2"></i>
                    Delete Congregation
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: this.$inertia.form()
        };
    },

    methods: {
        deleteCongregation() {
            this.form.delete(route("teams.destroy", this.$page.props.team), {
                errorBag: "deleteTeam"
            });
        }
    }
};
</script>
