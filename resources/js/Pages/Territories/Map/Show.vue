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
import Map from "@/Pages/Territories/Map/Map";

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
