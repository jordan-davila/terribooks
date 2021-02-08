<template lang="">
    <modal
        name="edit-phone"
        draggable
        width="430px"
        height="auto"
        focusTrap
        classes="w-80 rounded-lg bg-gray-900 shadow-lg"
        @before-open="getPhoneData"
        @opened="opened"
        @closed="reset"
    >
        <div class="modal-title w-full py-8 px-8 flex justify-between items-center text-gray-300">
            <div class="relative flex items-center">
                <div
                    class="icon bg-green-100 rounded-full w-8 h-8 text-green-500 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-phone-plus"></i>
                </div>
                <span class="text-xxs uppercase font-bold">Edit Phone Number</span>
            </div>
            <button @click="$modal.hide('edit-phone')" class="opacity-60">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 mb-8 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
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
                    <label for="#number">Number</label>
                    <input
                        name="number"
                        type="text"
                        v-model="number"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
                <div class="input-col">
                    <label for="#apartment">Apartment</label>
                    <input
                        name="apartment"
                        type="text"
                        v-model="apartment"
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
        <div
            class="modal-options bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300"
        >
            <button
                @click="savePhone()"
                class="py-2 px-4 rounded-full flex items-center uppercase text-xxs font-bold text-white bg-green-400"
            >
                <i class="fas fa-plus mr-2"></i>
                <span>Save Phone Number</span>
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
            apartment: null,
            observations: null,
            symbol: "NC",
            color: "none"
        };
    },
    methods: {
        opened() {
            this.$refs.name.focus();
        },
        formatPhone() {
            let x = this.phone.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.phone = !x[2] ? x[1] : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
        },
        getPhoneData(event) {
            this.id = event.params.phone.id;
            this.name = event.params.phone.name;
            this.phone = event.params.phone.phone;
            this.number = event.params.phone.number;
            this.apartment = event.params.phone.apartment;
            this.observations = event.params.phone.observations;
            this.symbol = event.params.phone.symbol;
            this.color = event.params.phone.color;
            this.street_id = event.params.phone.street_id;
        },
        savePhone() {
            this.$inertia.put(
                route("territories.editor.phone.update", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id,
                    phone: this.id
                }),
                {
                    id: this.id,
                    name: this.name,
                    phone: this.phone,
                    number: this.number,
                    apartment: this.apartment,
                    observations: this.observations,
                    symbol: this.symbol,
                    color: this.color,
                    street_id: this.street_id
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-phone");
                        this.$page.props.flash = {
                            type: "success",
                            message: "Phone Number Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.flash = { type: "error", message: "Something Went Wrong" };
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
            this.apartment = null;
            this.observations = null;
            this.symbol = "NC";
            this.color = "none";
        }
    }
};
</script>
