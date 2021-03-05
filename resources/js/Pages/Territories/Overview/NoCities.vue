<template>
    <AppLayout>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <div class="flex flex-1 justify-center items-center relative p-14">
                <div
                    class="flex flex-col justify-center items-center p-8 relative text-xxs w-full h-full bg-white rounded-lg shadow-lg uppercase text-gray-300"
                >
                    <div class="info w-96 flex flex-col items-center justify-center text-center relative z-10">
                        <div class="font-bold text-sm mb-4">
                            No Cities in this Congregation
                        </div>
                        <p class="mb-4">
                            To create a new city, go to <b class="font-bold">Congregations</b> >
                            <b class="font-bold">Congregation Settings</b> > <b class="font-bold">City Manager</b>, or
                            click on the following link:
                        </p>
                        <inertia-link
                            :href="route('teams.show', $page.props.user.current_team.id)"
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                        >
                            Congregation Settings
                        </inertia-link>
                    </div>
                    <div
                        id="particles"
                        class="slide-up-particles absolute top-0 left-0 w-full block z-0"
                        style="height: 100%"
                    ></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import TerritoryPicker from "@/Pages/Territories/Components/TerritoryPicker";
import { Config } from "@/Mixins/Config";
import "particles.js";

export default {
    props: ["territory", "territories"],
    mixins: [Config],
    components: {
        AppLayout,
        TerritoryPicker
    },

    mounted() {
        window.particlesJS("particles", this.particleParams);
    }
};
</script>
