<template>
    <AppLayout>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <div class="flex flex-1 justify-center items-center relative p-14">
                <div
                    class="flex flex-col justify-center items-center p-8 relative text-xxs w-full h-full bg-white rounded-lg shadow-lg uppercase text-gray-300"
                >
                    <div class="info w-96 flex flex-col items-center justify-center text-center relative z-10">
                        <div class="font-bold text-sm mb-4">
                            Before you can manage your territories, please create a new congregation or join one.
                        </div>
                        <div class="font-bold text-xxs mb-2">Create A New Congregation</div>
                        <p class="mb-4">
                            To create a new congregation, go to <b class="font-bold">Congregations</b> >
                            <b class="font-bold">Create Congregation</b>
                            or click on the button below:
                        </p>
                        <div class="font-bold text-xxs mb-2">Join A Congregation</div>
                        <p class="mb-4">
                            To join a congregation, please ask the brother in charge of the territories to send you an
                            invite under <b class="font-bold">Congregations</b> >
                            <b class="font-bold">Congregation Settings</b> > <b class="font-bold">Invite Members</b>.
                            <br /><br />
                            As soon as the invitation has been made, you should receive an email with a link to join the
                            congregation.
                        </p>
                        <button
                            @click="$modal.show('add-congregation')"
                            class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                        >
                            Create Congregation
                        </button>
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
import { Config } from "@/Mixins/Config";
import "particles.js";

export default {
    mixins: [Config],
    components: {
        AppLayout
    },

    mounted() {
        window.particlesJS("particles", this.particleParams);
    }
};
</script>
