<template>
    <AppLayout>
        <template v-slot:navsub>
            <NavSub />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <MarkAsComplete />
            <NavAssignments />
            <slot></slot>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import NavSub from "@/Pages/Territories/Components/NavSub";
import NavAssignments from "@/Pages/Territories/Components/NavAssignments";
import MarkAsComplete from "@/Pages/Territories/Modals/MarkAsComplete";

export default {
    props: ["territory"],
    components: {
        AppLayout,
        NavAssignments,
        MarkAsComplete,
        NavSub
    }
};
</script>
<style>
input:checked + svg {
    display: block;
}
</style>
