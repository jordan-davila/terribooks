<template>
    <div class="module-container px-14 pt-8 text-gray-300">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100">
                Congregation Details
            </div>
            <div class="card-content px-8 py-6 text-xxs font-bold uppercase">
                <div class="input-row grid grid-cols-2 gap-2 mb-3">
                    <div class="input-col">
                        <label>Name</label>
                        <input
                            ref="name"
                            name="name"
                            type="text"
                            v-model="name"
                            :disabled="!$page.props.permissions.canUpdateTeam"
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
            <div class="modal-options bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300">
                <button
                    @click="update"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-red active:bg-indigo-600 transition ease-in-out duration-150"
                >
                    Update
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: this.$page.props.team.name,
            states: this.getStates(),
            state: "NJ"
        };
    },

    methods: {
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
        },

        update() {
            this.$inertia.put(
                route("teams.update", this.$page.props.team.id),
                { name: this.name },
                {
                    errorBag: "updateTeamName",
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$page.props.flash = {
                            type: "success",
                            message: "Congregation Details Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.flash = { type: "error", message: "Something Went Wrong" };
                    }
                }
            );
        }
    }
};
</script>
