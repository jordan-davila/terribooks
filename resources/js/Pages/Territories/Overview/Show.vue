<template>
    <AppLayout>
        <template v-slot:navsub>
            <NavSub />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <TerritoryPicker />
            <div class="flex flex-1 relative">
                <div class="flex flex-1 relative w-full h-full p-8">
                    <div
                        class="overview absolute top-14 left-14 w-80 bg-white shadow-lg rounded-lg p-8 dark:bg-gray-800"
                        style="z-index: 998"
                    >
                        <div
                            class="text-xxs text-gray-300 mb-4 w-full uppercase font-bold flex justify-between items-center"
                        >
                            <span>Overview</span>
                            <button class="w-6 h-6 text-gray-300 text-sm">
                                <i class="fas fa-caret-down"></i>
                            </button>
                        </div>
                        <div class="territory-info flex items-center mb-8">
                            <div
                                class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-indigo-600 bg-indigo-100 shadow-lg font-bold mr-4 dark:bg-slate-600 dark:text-gray-200"
                            >
                                {{ $page.props.territory.data.code }}
                            </div>
                            <div class="details text-xxs text-gray-300 uppercase font-bold flex flex-col">
                                <span>
                                    {{ $page.props.territory.data.city_name + " " + $page.props.territory.data.order }}
                                </span>
                                <span class="opacity-60" v-if="$page.props.territory.data.current_assignee">
                                    Assigned To: {{ $page.props.territory.data.current_assignee }}
                                </span>
                                <span class="opacity-60" v-else>No Current Assignee</span>
                            </div>
                        </div>
                        <div class="territory-stats flex items-center">
                            <inertia-link
                                :href="route('territories.editor.field.index', $page.props.territory.data.id)"
                                class="cards flex flex-col rounded-lg bg-gray-100 w-20 h-20 p-3 mr-4 justify-center items-center hover:shadow-md transition-all ease-out dark:bg-gray-700"
                            >
                                <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">
                                    House
                                </div>
                                <div class="circle rounded-full bg-white flex justify-center items-center dark:bg-gray-600">
                                    <span
                                        class="text-gray-400 font-semibold text-sm h-8 w-8 flex justify-center items-center dark:text-gray-200"
                                    >
                                        {{ $page.props.territory.data.house_count }}
                                    </span>
                                </div>
                            </inertia-link>
                            <inertia-link
                                :href="route('territories.editor.phone.index', $page.props.territory.data.id)"
                                class="cards flex flex-col rounded-lg bg-gray-100 w-20 h-20 p-3 mr-4 justify-center items-center hover:shadow-md transition-all ease-out dark:bg-gray-700"
                            >
                                <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">
                                    PHONE
                                </div>
                                <div class="circle rounded-full bg-white flex justify-center items-center dark:bg-gray-600">
                                    <span
                                        class="text-gray-400 font-semibold text-sm h-8 w-8 flex justify-center items-center dark:text-gray-200"
                                    >
                                        {{ $page.props.territory.data.phone_count }}
                                    </span>
                                </div>
                            </inertia-link>
                            <inertia-link
                                :href="route('territories.editor.phone.index', $page.props.territory.data.id)"
                                class="cards flex flex-col rounded-lg bg-gray-100 w-20 h-20 p-3 justify-center items-center hover:shadow-md transition-all ease-out dark:bg-gray-700"
                            >
                                <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">
                                    Business
                                </div>
                                <div class="circle rounded-full bg-white flex justify-center items-center dark:bg-gray-600">
                                    <span
                                        class="text-gray-400 font-semibold text-sm h-8 w-8 flex justify-center items-center dark:text-gray-200"
                                    >
                                        {{ $page.props.territory.data.business_count }}
                                    </span>
                                </div>
                            </inertia-link>
                        </div>
                    </div>
                    <Map />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import TerritoryPicker from "@/Pages/Territories/Components/TerritoryPicker";
import NavSub from "@/Pages/Territories/Components/NavSub";
import Map from "@/Pages/Territories/Overview/Map";

export default {
    props: ["territory"],
    components: {
        AppLayout,
        TerritoryPicker,
        NavSub,
        Map
    }
};
</script>
