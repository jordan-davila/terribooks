<template lang="">
    <div class="editor-options w-80 h-full flex flex-col bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-600" style="flex: 0 295px;">
        <div class="assignment-list px-14 pt-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>By Type</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <inertia-link
                :href="getEditorLink('field')"
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('territories.editor.field.*')
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg dark:bg-slate-600 dark:text-gray-200 border-indigo-500 border-solid border'
                                : 'text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-300'
                        "
                    >
                        <i class="fas fa-home-lg-alt"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Field</span>
                        <span class="opacity-60">Ministry</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="getEditorLink('phone')"
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('territories.editor.phone.*')
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg dark:bg-slate-600 dark:text-gray-200 border-indigo-500 border-solid border'
                                : 'text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-300'
                        "
                    >
                        <i class="fas fa-phone"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Phone</span>
                        <span class="opacity-60">Ministry</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
            <inertia-link
                :href="getEditorLink('business')"
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('territories.editor.business.*')
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg dark:bg-slate-600 dark:text-gray-200 border-indigo-500 border-solid border'
                                : 'text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-300'
                        "
                    >
                        <i class="fas fa-building"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Business</span>
                        <span class="opacity-60">Ministry</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
        </div>
        <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center px-14">
            <span>Streets</span>
            <button
                @click="$modal.show('add-street')"
                class="w-5 h-5 text-gray-300 text-xxs bg-white border border-gray-300 rounded-md leading-none dark:bg-gray-700 dark:border-gray-600"
            >
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div id="street-picker-smooth-scroll" class="street-list w-full flex-1 overflow-auto">
            <div class="street-list w-full px-14">
                <div class="wrapper pb-8" v-if="$page.props.territory.data.streets.length != 0">
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
                                    :href="
                                        route(`territories.editor.${$page.props.type.toLowerCase()}.show`, [
                                            $page.props.territory.data.id,
                                            street.id
                                        ])
                                    "
                                >
                                    {{ street.name }}
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
                                <div class="popper rounded-md shadow-lg bg-white overflow-hidden z-10 dark:bg-gray-600">
                                    <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                                        <!-- Account Management -->
                                        <button
                                            @click="$modal.show('edit-street', { street: street })"
                                            class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left dark:hover:bg-gray-700"
                                        >
                                            Edit Street
                                        </button>
                                        <button
                                            @click="
                                                $modal.show('confirmation', {
                                                    type: 'warning',
                                                    title: 'Delete Street',
                                                    message:
                                                        'Are you sure you want to delete this street? This action can not be undone.',
                                                    action: () => deleteStreet(street.id)
                                                })
                                            "
                                            class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left dark:hover:bg-gray-700"
                                        >
                                            Delete Street
                                        </button>
                                    </div>
                                </div>
                                <button slot="reference" class="w-6 h-6 text-gray-300 text-sm">
                                    <i class="far fa-ellipsis-h"></i>
                                </button>
                            </popper>
                        </div>
                    </template>
                </div>
                <div class="wrapper pb-8 mt-8" v-else>
                    <div class="text-center uppercase font-bold text-gray-300 text-xxs">
                        <div class="title">No Streets on this Territory</div>
                        <div class="info">
                            <span class="opacity-50 mr-1">To proceed, click on the</span>
                            <i class="fas fa-plus text-gray-300"></i>
                            <span class="opacity-50">button above to add a new street</span>
                        </div>
                    </div>
                </div>
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
        Scrollbar.init(document.querySelector("#street-picker-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
        this.$page.props.street && this.scrollToStreet();
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
        },

        getEditorLink(type) {
            let territory = this.$page.props.territory
                ? this.$page.props.territory.data
                : this.$page.props.territories.data.cities[0].territories[0].id;
            return typeof this.$page.props.street != "undefined"
                ? route(`territories.editor.${type}.show`, [territory, this.$page.props.street.id])
                : route(`territories.editor.${type}.index`, territory);
        },

        deleteStreet(id) {
            this.$inertia.delete(route("territories.editor.street.delete", [this.$page.props.territory.data.id, id]), {
                preserveScroll: true,
                onSuccess: page => {
                    this.$modal.hide("confirmation");
                    this.$page.props.jetstream.flash = {
                        alertStyle: "success",
                        alert: "Street Deleted"
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
