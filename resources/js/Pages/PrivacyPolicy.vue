<template>
    <div class="text-gray-300 bg-gray-100 w-full h-screen flex flex-col items-center p-8 justify-center">
        <div class="logo-container flex items-center mb-8">
            <div class="h-full text-gray-300 text-base flex justify-center items-center mr-3">
                <Logo class="w-6" />
            </div>
            <inertia-link :href="route('welcome')" class="text-gray-900 text-2xl font-bold">
                <div>terri<span class="text-indigo-600">books</span></div>
            </inertia-link>
        </div>
        <div id="smooth-scroll" class="module-card bg-white rounded-lg shadow-lg overflow-auto px-14 py-10">
            <div v-html="policy" class="w-full bg-white overflow-hidden prose pb-20"></div>
        </div>
    </div>
</template>
<script>
import Logo from "@/Components/Logo";
import Scrollbar from "smooth-scrollbar";
export default {
    props: ["policy"],
    components: { Logo },
    mounted() {
        Scrollbar.init(document.querySelector("#smooth-scroll"), {
            damping: 0.1,
            thumbMinSize: 10,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
