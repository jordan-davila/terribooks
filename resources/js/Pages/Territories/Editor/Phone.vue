<template>
    <AppLayout>
        <template v-slot:navsub>
            <NavSub />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <TerritoryPicker />
            <div class="flex flex-1 relative">
                <StreetPicker />
                <div class="flex flex-1 relative p-8 overflow-hidden">
                    <div class="daily-text flex-auto flex flex-col h-full bg-gray-50 shadow-lg rounded-lg">
                        <div class="title-editor w-full py-6 px-8 flex justify-between items-center border-b border-gray-200 border-solid">
                            <div class="title text-xxs uppercase font-bold text-gray-300">Field Ministry List</div>
                            <div class="buttons flex">
                                <button class="rounded-full bg-green-400 py-1 px-4 text-white text-xxs font-bold uppercase">
                                    <i class="fas fa-save mr-2"></i>
                                    <span>Save All</span>
                                </button>
                                <button class="rounded-full bg-indigo-500 py-1 px-2 text-white text-xxs font-bold uppercase ml-2">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="grid-territory-editor-phone">
                            <div class="list-header grid row border-b border-solid border-gray-200 text-gray-300 uppercase font-bold text-xxs px-6">
                                <div class="column w-full px-2 py-3">Name</div>
                                <div class="column w-full px-2 py-3">#</div>
                                <div class="column w-full px-2 py-3">Apt</div>
                                <div class="column w-full px-2 py-3">Phone</div>
                                <div class="column w-full px-2 py-3">Sym</div>
                                <div class="column w-full px-2 py-3"></div>
                            </div>
                            <div class="list-header grid row text-gray-300 font-bold text-xxs px-6" v-for="phone in $page.props.phones" :key="phone.id">
                                <div class="column w-full px-2 py-3">{{ phone.name }}</div>
                                <div class="column w-full px-2 py-3">{{ phone.number }}</div>
                                <div class="column w-full px-2 py-3">{{ phone.apartment }}</div>
                                <div class="column w-full px-2 py-3">{{ phone.phone }}</div>
                                <div class="column w-full px-2 py-3">{{ phone.symbol }}</div>
                                <div class="column w-full px-2 py-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import TerritoryPicker from "@/Pages/Territories/Components/TerritoryPicker";
import NavSub from "@/Pages/Territories/Components/NavSub";
import StreetPicker from "@/Pages/Territories/Components/StreetPicker";

export default {
    props: ["territory"],
    components: {
        AppLayout,
        TerritoryPicker,
        StreetPicker,
        NavSub
    }
};
</script>
