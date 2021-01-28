<template>
    <AppLayout>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <TerritoryPicker />
            <div class="flex flex-1 relative">
                <div class="stars-container flex flex-col flex-1 overflow-y-auto relative w-full"></div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import TerritoryPicker from "@/Pages/Territories/Components/TerritoryPicker";
export default {
    props: ["territory", "territories"],
    components: {
        AppLayout,
        TerritoryPicker
    }
};
</script>
