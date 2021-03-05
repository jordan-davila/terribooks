<template lang="">
    <div style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white">
        <div id="territory-picker-smooth-scroll" class="territory-list w-full flex-1 px-14 pt-8">
            <div class="wrapper pb-8">
                <template v-for="city in $page.props.territories.data.cities">
                    <div
                        class="text-xxs text-gray-300 w-full py-3 uppercase font-bold flex justify-between items-center"
                        :key="city.id"
                    >
                        <span>{{ city.name }}</span>
                        <button
                            @click="$modal.show('add-territory', { city_id: city.id })"
                            class="w-5 h-5 text-gray-300 text-xxs bg-white border border-gray-300 rounded-md leading-none"
                        >
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <template v-for="territory in city.territories">
                        <div
                            :id="'link-' + territory.id"
                            @click="scrollToTerritory(territory.id)"
                            class="uppercase font-bold py-4 flex justify-between items-center"
                            :key="territory.code"
                        >
                            <div class="info flex items-center">
                                <inertia-link
                                    preserve-state
                                    :href="route(currentRoute(), [territory.id])"
                                    :class="classes(territory.id)"
                                    >{{ territory.code }}</inertia-link
                                >
                                <inertia-link
                                    preserve-state
                                    :href="route(currentRoute(), [territory.id])"
                                    v-bind:class="[
                                        { 'opacity-60': route().params.territory != territory.id },
                                        'info flex flex-col ml-4 text-xxs text-gray-300'
                                    ]"
                                >
                                    <span>
                                        {{ territory.house_count + " House #" }}
                                    </span>
                                    <span>
                                        {{ territory.phone_count + " Phone #" }}
                                    </span>
                                </inertia-link>
                            </div>
                            <popper
                                trigger="clickToOpen"
                                :options="{
                                    placement: 'bottom',
                                    modifiers: {
                                        flip: { enabled: false },
                                        offset: { offset: '0,-5' }
                                    }
                                }"
                            >
                                <div class="popper rounded-md shadow-lg bg-white overflow-hidden z-10">
                                    <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                                        <!-- Account Management -->
                                        <button
                                            @click="$modal.show('edit-territory', { territory: territory })"
                                            class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left"
                                        >
                                            Edit Territory
                                        </button>
                                        <button
                                            @click="
                                                $modal.show('confirmation', {
                                                    type: 'warning',
                                                    title: 'Delete Territory',
                                                    message:
                                                        'Are you sure you want to delete this territory? This action can not be undone.',
                                                    action: () => deleteTerritory(territory.id)
                                                })
                                            "
                                            class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left"
                                        >
                                            Delete Territory
                                        </button>
                                    </div>
                                </div>
                                <button slot="reference" class="w-6 h-6 text-gray-300 text-sm">
                                    <i class="far fa-ellipsis-h"></i>
                                </button>
                            </popper>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </div>
</template>
<script>
import Scrollbar from "smooth-scrollbar";
import Popper from "vue-popperjs";

export default {
    components: { Popper },
    mounted() {
        Scrollbar.init(document.querySelector("#territory-picker-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });

        this.scrollToTerritory();
    },

    watch: {
        "$page.props.territory.data": function() {
            this.scrollToTerritory();
        }
    },

    methods: {
        classes(id) {
            let classes = "w-10 h-10 flex justify-center items-center text-xs rounded-lg ";
            classes +=
                route().params.territory == id
                    ? "text-indigo-600 bg-indigo-100 shadow-lg"
                    : "text-gray-500 bg-gray-100";
            return classes;
        },

        scrollToTerritory(id) {
            let link_id = id || this.$page.props.territory.data.id;
            let child = document.querySelector("#link-" + link_id);
            let scroll = Scrollbar.get(document.querySelector("#territory-picker-smooth-scroll"));
            scroll.scrollTo(0, child.offsetTop - 200, 1000);
        },

        currentRoute() {
            // *TODO* Fine a better solution //
            //  Don't use routes with editor.[type].show, instead replace them witho editor.[type].index
            let current_route = route().current();
            let split_route = current_route.split(".");
            if (split_route.length > 3) split_route[3] = "index";
            return split_route.join(".");
        },

        deleteTerritory(id) {
            this.$inertia.delete(route("territories.delete", id), {
                preserveScroll: true,
                onSuccess: page => {
                    this.$modal.hide("confirmation");
                    this.$page.props.jetstream.flash = {
                        alertStyle: "success",
                        alert: "Territory Deleted"
                    };
                },
                onError: page => {
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
