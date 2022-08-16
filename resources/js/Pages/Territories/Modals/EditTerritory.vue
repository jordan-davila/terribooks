<template>
    <modal
        name="edit-territory"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-white shadow-lg overflow-hidden dark:bg-gray-700"
        @before-open="beforeOpen"
        @closed="reset"
    >
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between dark:bg-slate-800 dark:border-slate-700"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-green-100 rounded-lg w-8 h-8 text-green-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Edit Territory</div>
                    <div class="subtitle opacity-60">Fill the form below to edit this territory</div>
                </div>
            </div>
            <button @click="$modal.hide('edit-territory')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase dark:border-b dark:border-gray-600">
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label for="#name">Order Number</label>
                    <input
                        autofocus
                        type="number"
                        v-model="number"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
                <div class="input-col">
                    <label for="#phone">Type</label>
                    <select
                        name="type"
                        v-model="city_id"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option :value="city.id" v-for="city in $page.props.territories.data.cities" :key="city.id">
                            {{ city.name }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div
            class="modal-options bg-gray-100 rounded-b-lg w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-700"
        >
            <button
                @click="editTerritory()"
                class="inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Edit Territory</span>
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
            city_id: null
        };
    },
    methods: {
        beforeOpen(event) {
            this.id = event.params.territory.id;
            this.number = event.params.territory.order;
            this.city_id = event.params.territory.city_id;
            console.log(event.params.territory);
        },

        editTerritory() {
            this.$inertia.put(
                route("territories.update", this.id),
                { number: this.number, city_id: this.city_id },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-territory");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Territory Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Sorry, something went wrong"
                        };
                    }
                }
            );
        },
        reset() {
            this.number = null;
            this.city_id = null;
            this.id = null;
        }
    }
};
</script>
