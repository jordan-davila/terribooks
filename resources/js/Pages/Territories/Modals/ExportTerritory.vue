<template lang="">
    <modal
        name="export"
        draggable
        width="430px"
        height="auto"
        focusTrap
        classes="w-80 rounded-lg bg-gray-900 shadow-lg"
        @opened="opened"
    >
        <div class="modal-title w-full py-8 px-8 flex justify-between items-center text-gray-300">
            <div class="relative flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-full w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-download"></i>
                </div>
                <span class="text-xxs uppercase font-bold">Export Territory</span>
            </div>
            <button @click="$modal.hide('export')" class="opacity-60">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 mb-8 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label for="#symbol">Type</label>
                    <select
                        name="symbol"
                        v-model="type"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option value="field">Field</option>
                        <option value="phone">Phone</option>
                        <option value="business">Business</option>
                        <option value="map">Map Card</option>
                    </select>
                </div>
                <div class="input-col">
                    <label for="#name">Territory</label>
                    <select
                        name="symbol"
                        v-model="territory"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <template v-for="(city, index) in $page.props.territories.data.cities">
                            <option v-for="territory in city.territories" :value="territory.id" :key="territory.id">
                                {{ territory.code }}
                            </option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="input-row grid grid-cols-1 gap-2 mb-3" v-if="type === 'field'">
                <div class="input-col">
                    <label for="#symbol">Group By</label>
                    <select
                        name="symbol"
                        v-model="grouped"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option value="0">No Grouping</option>
                        <option value="1">Group By Odd & Even Numbers</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-options bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300">
            <button
                @click="exportPDF()"
                class="py-2 px-4 rounded-full flex items-center uppercase text-xxs font-bold text-white bg-indigo-500"
            >
                <i class="fas fa-file-pdf mr-2"></i>
                <span>Export as PDF</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            type: "field",
            territory: null,
            grouped: 0
        };
    },
    methods: {
        opened() {
            this.type = "field";
            this.territory = this.$page.props.territory.data.id;
        },

        exportPDF() {
            let url = `${window.location.origin}/territories/${this.territory}/export/${this.type}/download`;
            this.type === "field" && this.grouped == "1" ? (url += "?grouped=1") : null;
            window.open(url, "_blank");
        }
    }
};
</script>
