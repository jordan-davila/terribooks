<template>
    <section class="app-container max-w-none bg-gray-100 flex flex-col h-screen dark:bg-gray-900 overflow-hidden">
        <TooSmall />
        <FlashBanner />
        <FlashAlert />
        <NavMain />
        <template v-if="$page.props.territory">
            <ExportTerritoryModal />
            <AddTerritory />
            <EditTerritory />
        </template>
        <ConfirmationModal />
        <AddCongregationModal />
        <section class="flex h-full w-full overflow-hidden">
            <slot name="navsub"></slot>
            <div class="content-container flex-1 w-full relative">
                <slot></slot>
            </div>
        </section>
    </section>
</template>

<script>
import NavMain from "@/Components/NavMain";
import FlashAlert from "@/Components/FlashAlert";
import FlashBanner from "@/Components/FlashBanner";
import ExportTerritoryModal from "@/Pages/Territories/Modals/ExportTerritory";
import ConfirmationModal from "@/Modals/ConfirmationModal";
import AddCongregationModal from "@/Modals/AddCongregationModal";
import AddTerritory from "@/Pages/Territories/Modals/AddTerritory";
import EditTerritory from "@/Pages/Territories/Modals/EditTerritory";
import TooSmall from "@/Pages/TooSmall";

export default {
    components: {
        NavMain,
        FlashAlert,
        FlashBanner,
        ExportTerritoryModal,
        ConfirmationModal,
        AddCongregationModal,
        AddTerritory,
        EditTerritory,
        TooSmall
    },

    mounted() {
        let theme = this.$inertia.page.props.user.theme;
        document.body.classList.add(theme)
    },
};
</script>
