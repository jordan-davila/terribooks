<template lang="">
    <modal
        name="edit-house"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-gray-900 shadow-lg"
        @before-open="getHouseData"
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
                    <div class="title">Edit House Number</div>
                    <div class="subtitle opacity-60">Update the following details</div>
                </div>
            </div>
            <button @click="$modal.hide('edit-house')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
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
                <div class="input-col">
                    <label for="#phone">Type</label>
                    <select
                        name="type"
                        v-model="type"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option value="1">House</option>
                        <option value="2">Building</option>
                    </select>
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
                @click="editHouse()"
                class="inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <i class="fas fa-save mr-2"></i>
                <span>Edit House Number</span>
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
            type: 1,
            symbol: "NC",
            color: "none",
            observations: null,
            street_id: null
        };
    },
    methods: {
        getHouseData(event) {
            this.id = event.params.house.id;
            this.number = event.params.house.number;
            this.type = event.params.house.type;
            this.symbol = event.params.house.symbol;
            this.color = event.params.house.color;
            this.observations = event.params.house.observations;
            this.street_id = event.params.house.street_id;
        },

        opened() {
            this.$refs.number.focus();
        },

        editHouse() {
            this.$inertia.put(
                route("territories.editor.field.update.house", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id,
                    house: this.id
                }),
                {
                    id: this.id,
                    street_id: this.street_id,
                    number: this.number,
                    type: this.type,
                    symbol: this.symbol,
                    color: this.color,
                    observations: this.observations
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-house");
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "House Number Updated"
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
            this.number = null;
            this.type = 1;
            this.observations = null;
            this.symbol = "NC";
            this.color = "none";
        }
    }
};
</script>
