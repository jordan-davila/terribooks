<template>
    <div
        id="city-manager"
        class="module-container px-14 pt-8 text-gray-300"
        v-if="$page.props.permissions.canUpdateTeam"
    >
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                <div class="title">City Manager</div>
                <div class="subtitle opacity-60">
                    Added cities will automatically have a territory associated with it
                </div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="input-row mb-3 flex items-center">
                    <div class="input-col flex-1 mr-4">
                        <label>Name</label>
                        <input
                            ref="name"
                            name="name"
                            type="text"
                            v-model="name"
                            :disabled="!$page.props.permissions.canUpdateTeam"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                        />
                    </div>
                    <div class="input-col">
                        <label class="opacity-0">Add</label>
                        <button
                            @click="addCity"
                            class="flex items-center justify-center mt-2 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                        >
                            Add
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase border-t border-gray-100">
                <div
                    class="cities mb-4 flex items-center justify-between w-full"
                    v-for="(city, index) in $page.props.territories.data.cities"
                    :key="city.id"
                >
                    <div class="flex items-center flex-1 mr-4">
                        <input
                            type="text"
                            class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                            v-model="city.name"
                        />
                    </div>

                    <div class="flex items-center">
                        <button
                            @click="
                                $modal.show('confirmation', {
                                    type: 'warning',
                                    title: 'Delete City',
                                    message:
                                        'Are you sure you want to delete this city and its territories? This action can not be undone.',
                                    action: () => deleteCity(index)
                                })
                            "
                            class="inline-flex items-center justify-center border border-transparent rounded-md font-semibold text-xxs text-red-600 uppercase hover:opacity-90 transition ease-in-out duration-150 mr-2 leading-none"
                        >
                            Delete
                        </button>
                        <button
                            @click="saveCity(index)"
                            class="inline-flex items-center justify-center border border-transparent rounded-md font-semibold text-xxs text-indigo-600 uppercase hover:opacity-90 transition ease-in-out duration-150 leading-none"
                        >
                            Save
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
            name: ""
        };
    },

    methods: {
        addCity() {
            this.$inertia.post(
                route("teams.city.store", this.$page.props.team.id),
                { name: this.name },
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.name = "";
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "City Added to Congregation"
                        };
                    },
                    onError: () => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Something Went Wrong"
                        };
                    }
                }
            );
        },

        saveCity(index) {
            this.$inertia.put(
                route("teams.city.update", [
                    this.$page.props.team.id,
                    this.$page.props.territories.data.cities[index].id
                ]),
                { name: this.$page.props.territories.data.cities[index].name },
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "City Saved"
                        };
                    },
                    onError: () => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Something Went Wrong"
                        };
                    }
                }
            );
        },

        deleteCity(index) {
            this.$inertia.delete(
                route("teams.city.delete", [
                    this.$page.props.team.id,
                    this.$page.props.territories.data.cities[index].id
                ]),
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.$modal.hide("confirmation");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "City Deleted"
                        };
                    },
                    onError: () => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Something Went Wrong"
                        };
                    }
                }
            );
        }
    }
};
</script>
