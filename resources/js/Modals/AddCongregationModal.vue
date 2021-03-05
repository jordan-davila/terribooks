<template>
    <modal name="add-congregation" draggable width="430px" height="auto" classes="rounded-lg bg-gray-900 shadow-lg">
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-lg w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="far fa-globe-americas"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Add Congregation</div>
                    <div class="subtitle opacity-60">Fill the following form to add a new congregation</div>
                </div>
            </div>
            <button @click="$modal.hide('add-congregation')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label>Name</label>
                    <input
                        ref="name"
                        name="name"
                        type="text"
                        v-model="form.name"
                        autofocus
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
                <div class="input-col">
                    <label>State</label>
                    <select
                        name="state"
                        v-model="state"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option v-for="(st, index) in states" :key="index" :value="index">{{ st }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-options bg-gray-50 rounded-b-lg w-full py-6 px-8 flex justify-end items-center text-gray-300">
            <button
                @click="createCongregation"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                Add Congregation
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                name: ""
            }),
            states: this.getStates(),
            state: "NJ"
        };
    },

    methods: {
        createCongregation() {
            this.form.post(route("teams.store"), {
                preserveScroll: true
            });
        },

        getStates() {
            return {
                AL: "Alabama",
                AK: "Alaska",
                AS: "American Samoa",
                AZ: "Arizona",
                AR: "Arkansas",
                CA: "California",
                CO: "Colorado",
                CT: "Connecticut",
                DE: "Delaware",
                DC: "District Of Columbia",
                FM: "Federated States Of Micronesia",
                FL: "Florida",
                GA: "Georgia",
                GU: "Guam",
                HI: "Hawaii",
                ID: "Idaho",
                IL: "Illinois",
                IN: "Indiana",
                IA: "Iowa",
                KS: "Kansas",
                KY: "Kentucky",
                LA: "Louisiana",
                ME: "Maine",
                MH: "Marshall Islands",
                MD: "Maryland",
                MA: "Massachusetts",
                MI: "Michigan",
                MN: "Minnesota",
                MS: "Mississippi",
                MO: "Missouri",
                MT: "Montana",
                NE: "Nebraska",
                NV: "Nevada",
                NH: "New Hampshire",
                NJ: "New Jersey",
                NM: "New Mexico",
                NY: "New York",
                NC: "North Carolina",
                ND: "North Dakota",
                MP: "Northern Mariana Islands",
                OH: "Ohio",
                OK: "Oklahoma",
                OR: "Oregon",
                PW: "Palau",
                PA: "Pennsylvania",
                PR: "Puerto Rico",
                RI: "Rhode Island",
                SC: "South Carolina",
                SD: "South Dakota",
                TN: "Tennessee",
                TX: "Texas",
                UT: "Utah",
                VT: "Vermont",
                VI: "Virgin Islands",
                VA: "Virginia",
                WA: "Washington",
                WV: "West Virginia",
                WI: "Wisconsin",
                WY: "Wyoming"
            };
        }
    }
};
</script>
