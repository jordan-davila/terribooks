<template>
    <div class="flex-auto flex flex-col h-full bg-gray-50 shadow-lg rounded-lg">
        <div
            class="title-phone-editor w-full py-6 px-8 flex justify-between items-center border-b border-gray-200 border-solid bg-white"
        >
            <div class="title text-xxs uppercase font-bold text-gray-300">
                Business Ministry List
            </div>
            <div class="buttons flex">
                <button
                    class="rounded-full bg-green-400 py-1 px-4 text-white text-xxs font-bold uppercase"
                >
                    <i class="fas fa-save mr-2"></i>
                    <span>Save All</span>
                </button>
                <button
                    class="rounded-full bg-indigo-500 py-1 px-2 text-white text-xxs font-bold uppercase ml-2"
                >
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="grid-territory-editor-business" class="flex flex-col overflow-hidden">
            <div
                class="list-header grid row border-b border-solid border-gray-200 text-gray-300 uppercase font-bold text-xxs px-6"
            >
                <div class="column w-full px-2 py-3">Name</div>
                <div class="column w-full px-2 py-3">#</div>
                <div class="column w-full px-2 py-3">Apt</div>
                <div class="column w-full px-2 py-3">Phone</div>
                <div class="column w-full px-2 py-3">Sym</div>
                <div class="column w-full px-2 py-3"></div>
            </div>
            <div id="business-editor-smooth-scroll" class="scroll w-full flex-1 overflow-auto">
                <div class="scroll-wrapper"></div>
            </div>
        </div>
    </div>
</template>
<script>
import EditorLayout from "@/Pages/Territories/Editor/Layout";
import Scrollbar from "smooth-scrollbar";

export default {
    props: ["territory"],
    // Using the shorthand
    layout: EditorLayout,
    mounted() {
        Scrollbar.init(document.querySelector("#business-editor-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    }
};
</script>
