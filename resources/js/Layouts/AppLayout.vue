<template>
    <section class="app-container max-w-none bg-gray-100 flex flex-col h-screen">
        <FlashBanner />
        <FlashAlert />
        <NavMain />
        <template v-if="$page.props.territory">
            <ExportTerritoryModal />
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

export default {
    components: {
        NavMain,
        FlashAlert,
        FlashBanner,
        ExportTerritoryModal,
        ConfirmationModal,
        AddCongregationModal
    }
};
</script>
