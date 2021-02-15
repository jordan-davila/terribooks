<template lang="">
    <modal name="export" draggable width="430px" height="auto" classes="rounded-lg bg-white shadow-lg" @opened="opened">
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-lg w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-download"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Export Territory</div>
                    <div class="subtitle opacity-60">Fill the below form for more options</div>
                </div>
            </div>
            <button @click="$modal.hide('export')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
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
        <div class="modal-options bg-gray-50 w-full py-6 px-8 flex justify-end items-center text-gray-300">
            <button
                @click="exportPDF()"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
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
