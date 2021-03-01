<template lang="">
    <modal
        name="edit-business"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-gray-900 shadow-lg"
        @before-open="getPhoneData"
        @closed="reset"
    >
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-green-100 rounded-lg w-8 h-8 text-green-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-building"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Edit Business Number</div>
                    <div class="subtitle opacity-60">Update the following details</div>
                </div>
            </div>
            <button @click="$modal.hide('edit-business')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row mb-3">
                <div class="input-col">
                    <label for="#name">Name</label>
                    <input
                        ref="name"
                        name="name"
                        type="text"
                        v-model="name"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
            </div>
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label for="#number">Number</label>
                    <input
                        name="number"
                        type="text"
                        v-model="number"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
                <div class="input-col">
                    <label for="#phone">Phone</label>
                    <input
                        name="phone"
                        type="text"
                        v-model="phone"
                        placeholder="(000) 000-0000"
                        @input="formatPhone()"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 placeholder-gray-300"
                    />
                </div>
            </div>
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label for="#symbol">Symbol</label>
                    <select
                        name="symbol"
                        v-model="symbol"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option value="NC">NC</option>
                        <option value="NH">NH</option>
                        <option value="H">H</option>
                        <option value="M">M</option>
                        <option value="N">N</option>
                    </select>
                </div>
                <div class="input-col">
                    <label for="#color">Color</label>
                    <select
                        name="color"
                        v-model="color"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option value="none">None</option>
                        <option value="yellow">Yellow</option>
                        <option value="red">Red</option>
                        <option value="green">Green</option>
                        <option value="purple">Purple</option>
                    </select>
                </div>
            </div>
            <div class="input-row mb-3">
                <div class="input-col">
                    <label for="observations">Observations / Notes</label>
                    <textarea
                        name="observations"
                        v-model="observations"
                        class="w-full h-24 border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    ></textarea>
                </div>
            </div>
        </div>
        <div
            class="modal-options rounded-b-lg bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300"
        >
            <button
                @click="saveBusiness()"
                class="inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Save Business Number</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            id: null,
            street_id: null,
            name: null,
            phone: null,
            number: null,
            observations: null,
            symbol: "NC",
            color: "none"
        };
    },
    methods: {
        formatPhone() {
            let x = this.phone.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.phone = !x[2] ? x[1] : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
        },
        getPhoneData(event) {
            this.id = event.params.business.id;
            this.name = event.params.business.name;
            this.phone = event.params.business.phone;
            this.number = event.params.business.number;
            this.observations = event.params.business.observations;
            this.symbol = event.params.business.symbol;
            this.color = event.params.business.color;
            this.street_id = event.params.business.street_id;
        },

        saveBusiness() {
            this.$inertia.put(
                route("territories.editor.business.update", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id,
                    business: this.id
                }),
                {
                    id: this.id,
                    name: this.name,
                    phone: this.phone,
                    number: this.number,
                    observations: this.observations,
                    symbol: this.symbol,
                    color: this.color,
                    street_id: this.street_id
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-business");
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Business Number Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.jetstream.flash = {
                            alertType: "error",
                            alert: "Something Went Wrong"
                        };
                    }
                }
            );
        },
        reset() {
            this.id = null;
            this.street_id = null;
            this.name = null;
            this.phone = null;
            this.number = null;
            this.observations = null;
            this.symbol = "NC";
            this.color = "none";
        }
    }
};
</script>
