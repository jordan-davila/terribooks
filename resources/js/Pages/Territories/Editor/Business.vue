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
                <div class="flex flex-col flex-1 overflow-y-auto relative w-full">
                    {{ territory.data.code }}
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
