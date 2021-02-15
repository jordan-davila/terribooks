<template lang="">
    <modal
        name="edit-apartment"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-gray-900 shadow-lg"
        @before-open="getApartmentData"
        @opened="opened"
        @closed="reset"
    >
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-green-100 rounded-lg w-8 h-8 text-green-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-house-user"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Edit Apartment Number</div>
                    <div class="subtitle opacity-60">Update the following details</div>
                </div>
            </div>
            <button @click="$modal.hide('edit-apartment')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-1 gap-2 mb-3">
                <div class="input-col">
                    <label for="#name">Number</label>
                    <input
                        ref="number"
                        name="number"
                        type="text"
                        v-model="number"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
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
        <div class="modal-options bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300">
            <button
                @click="editApartment()"
                class="inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Edit Apartment Number</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            id: null,
            number: null,
            symbol: "NC",
            color: "none",
            observations: null,
            house_id: null,
            house_number: null
        };
    },
    methods: {
        getApartmentData(event) {
            this.id = event.params.apartment.id;
            this.number = event.params.apartment.number;
            this.symbol = event.params.apartment.symbol;
            this.color = event.params.apartment.color;
            this.observations = event.params.apartment.observations;
            this.house_id = event.params.apartment.house_id;
            this.house_number = event.params.house.number;
        },

        opened() {
            this.$refs.number.focus();
        },

        editApartment() {
            this.$inertia.put(
                route("territories.editor.field.update.apartment", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id,
                    apartment: this.id
                }),
                {
                    id: this.id,
                    house_id: this.house_id,
                    number: this.number,
                    type: this.type,
                    symbol: this.symbol,
                    color: this.color,
                    observations: this.observations
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-apartment");
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Apartment Number Added"
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
            this.number = null;
            this.house_id = 0;
            this.symbol = "NC";
            this.color = "none";
            this.observations = null;
            this.house_number = null;
        }
    }
};
</script>
