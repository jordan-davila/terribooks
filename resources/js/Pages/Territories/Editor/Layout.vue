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
                    <slot></slot>
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
    components: {
        AppLayout,
        TerritoryPicker,
        StreetPicker,
        NavSub
    }
};
</script>
