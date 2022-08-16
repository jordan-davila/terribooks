<template>
    <div
        id="navigation-assignments-scroll"
        style="flex: 0 295px;"
        class="flex flex-col h-full border-r border-gray-200 border-solid bg-white dark:bg-gray-800 dark:border-gray-600"
    >
        <div class="assignment-list-by-type w-full px-14 py-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>By Type</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <inertia-link
                :href="
                    $page.props.territory
                        ? route('assignments.type.show', ['field', $page.props.territory.data.id])
                        : route('assignments.type.index', ['field'])
                "
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('assignments.type.show', { type: 'field' })
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg border-indigo-600 border dark:bg-slate-600 dark:text-gray-200'
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
                :href="
                    $page.props.territory
                        ? route('assignments.type.show', ['phone', $page.props.territory.data.id])
                        : route('assignments.type.index', ['phone'])
                "
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('assignments.type.show', { type: 'phone' })
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg border-indigo-600 border dark:bg-slate-600 dark:text-gray-200'
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
                :href="
                    $page.props.territory
                        ? route('assignments.type.show', ['business', $page.props.territory.data.id])
                        : route('assignments.type.index', ['business'])
                "
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-if="$page.props.user.current_team"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('assignments.type.show', { type: 'business' })
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg border-indigo-600 border dark:bg-slate-600 dark:text-gray-200'
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
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>By Publisher</span>
                <button
                    @click="$modal.show('add-publisher')"
                    class="w-5 h-5 text-gray-300 text-xxs bg-white border border-gray-300 rounded-md leading-none dark:bg-gray-700 dark:border-gray-600"
                >
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <template v-if="$page.props.publishers.data.length != 0">
                <div
                    class="uppercase font-bold py-3 flex justify-between items-center"
                    v-for="publisher in $page.props.publishers.data"
                    :key="publisher.id"
                >
                    <div class="info flex items-center">
                        <inertia-link
                            :href="route('assignments.publisher.show', [publisher])"
                            class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                            :class="
                                route().current('assignments.publisher.show', { publisher: publisher })
                                    ? 'text-indigo-600 bg-indigo-100 shadow-lg dark:bg-slate-600 dark:text-gray-200'
                                    : 'text-gray-500 bg-gray-100 dark:bg-gray-700 dark:text-gray-300'
                            "
                        >
                            <div class="initials">{{ publisher.initials }}</div>
                        </inertia-link>
                        <inertia-link
                            :href="route('assignments.publisher.show', [publisher])"
                            class="info flex flex-col ml-4 text-xxs text-gray-300"
                        >
                            <span>{{ publisher.name }}</span>
                            <span class="opacity-60">Assignments: {{ publisher.assignment_count }} </span>
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
                                    @click="$modal.show('edit-publisher', { publisher: publisher })"
                                    class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left dark:hover:bg-gray-700"
                                >
                                    Edit Publisher
                                </button>
                                <button
                                    @click="
                                        $modal.show('confirmation', {
                                            type: 'warning',
                                            title: 'Delete Publisher',
                                            message:
                                                'Are you sure you want to delete this publisher? This action can not be undone.',
                                            action: () => deletePublisher(publisher.id)
                                        })
                                    "
                                    class="block px-4 py-2 leading-5 text-gray-300 font-bold uppercase hover:bg-gray-50 w-full text-left dark:hover:bg-gray-700"
                                >
                                    Delete Publisher
                                </button>
                            </div>
                        </div>
                        <button slot="reference" class="w-6 h-6 text-gray-300 text-xs">
                            <i class="far fa-ellipsis-h"></i>
                        </button>
                    </popper>
                </div>
            </template>
            <template v-else>
                <div class="wrapper pb-8 mt-8">
                    <div class="text-center uppercase font-bold text-gray-300 text-xxs">
                        <div class="title">No Publishers Yet</div>
                        <div class="info">
                            <span class="opacity-50 mr-1">To proceed, click on the</span>
                            <i class="fas fa-plus text-gray-300"></i>
                            <span class="opacity-50">button above to add a new publisher</span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import Scrollbar from "smooth-scrollbar";
import Popper from "vue-popperjs";

export default {
    components: { Popper },
    mounted() {
        let options = {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        };

        Scrollbar.init(document.querySelector("#navigation-assignments-scroll"), options);
    },

    methods: {
        deletePublisher(id) {
            this.$inertia.delete(route("teams.publisher.delete", [this.$page.props.user.current_team.id, id]), {
                preserveScroll: true,
                onSuccess: page => {
                    this.$modal.hide("confirmation");
                    this.$page.props.jetstream.flash = {
                        alertStyle: "success",
                        alert: "Publisher Deleted"
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
