<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <NavSettings />
            <section class="flex flex-1 relative overflow-hidden">
                <div class="settings-container flex flex-col flex-1 h-full overflow-y-auto py-8 px-14 ">
                    <div class="module rounded-lg shadow-lg bg-white flex h-full justify-center items-center">
                        <div class="flex flex-col p-8 text-gray-300 uppercase font-bold text-xxs text-center">
                            <div class="code text-6xl mb-4">503</div>
                            <div class="title">Under Maintenance</div>
                            <p class="opacity-60">This page is currently under maintenance. Come back soon.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Scrollbar from "smooth-scrollbar";
import Copyright from "@/Components/Copyright";
import NavSettings from "@/Pages/Settings/Components/NavSettings";

export default {
    components: {
        AppLayout,
        Copyright,
        NavSettings
    },

    mounted() {
        Scrollbar.init(document.querySelector("#profile-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
