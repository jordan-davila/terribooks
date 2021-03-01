<template>
    <div
        id="navigation-assignments-scroll"
        style="flex: 0 295px;"
        class="flex flex-col h-full border-r border-gray-200 border-solid bg-white"
    >
        <div class="assignment-list-by-type w-full px-14 py-8 border-b border-gray-200 border-solid">
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
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg'
                                : 'text-gray-500 bg-gray-100'
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
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg'
                                : 'text-gray-500 bg-gray-100'
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
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg'
                                : 'text-gray-500 bg-gray-100'
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
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <inertia-link
                :href="route('assignments.publisher.show', [publisher])"
                class="uppercase font-bold py-3 flex justify-between items-center"
                v-for="publisher in $page.props.publishers.data"
                :key="publisher.id"
            >
                <div class="info flex items-center">
                    <span
                        class="w-10 h-10 flex justify-center items-center text-xs rounded-lg"
                        :class="
                            route().current('assignments.publisher.show', { publisher: publisher })
                                ? 'text-indigo-600 bg-indigo-100 shadow-lg'
                                : 'text-gray-500 bg-gray-100'
                        "
                    >
                        <div class="initials">{{ publisher.initials }}</div>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>{{ publisher.name }}</span>
                        <span class="opacity-60">Assignments: {{ publisher.assignment_count }} </span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </inertia-link>
        </div>
    </div>
</template>
<script>
import Scrollbar from "smooth-scrollbar";
export default {
    mounted() {
        let options = {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        };

        Scrollbar.init(document.querySelector("#navigation-assignments-scroll"), options);
    }
};
</script>
