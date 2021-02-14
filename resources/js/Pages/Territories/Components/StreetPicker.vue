<template lang="">
    <div class="editor-options w-80 h-full flex flex-col bg-white border-r border-gray-200">
        <div
            class="text-xxs text-gray-300 w-full pt-12 pb-4 uppercase font-bold flex justify-between items-center px-14"
        >
            <span>Streets</span>
            <button class="w-6 h-6 text-gray-300 text-sm">
                <i class="fas fa-caret-down"></i>
            </button>
        </div>
        <div id="street-picker-smooth-scroll" class="street-list w-full flex-1 overflow-auto">
            <div class="street-list w-full px-14">
                <div class="wrapper pb-8">
                    <template v-for="street in $page.props.territory.data.streets">
                        <div
                            class="text-xxs text-gray-700 w-full py-3 font-bold flex justify-between items-center"
                            :key="street.id"
                        >
                            <div class="flex flex-start items-center">
                                <button class="w-5 h-5 text-gray-300 text-sm mr-4 cursor-move">
                                    <i class="fas fa-grip-vertical"></i>
                                </button>
                                <inertia-link
                                    preserve-state
                                    :id="'street-link-' + street.id"
                                    @click="scrollToStreet(street.id)"
                                    :class="
                                        $page.props.street.id == street.id
                                            ? 'text-indigo-600 uppercase'
                                            : 'text-gray-300 uppercase opacity-75'
                                    "
                                    :href="route(route().current(), [$page.props.territory.data.id, street.id])"
                                >
                                    {{ street.name }}
                                </inertia-link>
                            </div>
                            <button class="w-6 h-6 flex justify-center text-gray-300 text-sm">
                                <i class="far fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Scrollbar from "smooth-scrollbar";

export default {
    mounted() {
        Scrollbar.init(document.querySelector("#street-picker-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });

        this.scrollToStreet();
    },

    methods: {
        scrollToStreet(id) {
            let link_id = id || this.$page.props.street.id;
            let child = document.querySelector("#street-link-" + link_id);
            let scroll = Scrollbar.get(document.querySelector("#street-picker-smooth-scroll"));
            scroll.scrollTo(0, child.offsetTop - 200, 1000);
        },

        classes(link) {
            let classes = "uppercase text-xxs ";
            classes += route().current(link) ? "text-indigo-600 font-black" : "text-gray-300 font-bold";
            return classes;
        }
    }
};
</script>
