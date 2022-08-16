<template lang="">
    <modal
        name="edit-street"
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
                    <i class="fas fa-road"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Edit Street</div>
                    <div class="subtitle opacity-60">Fill the form below to edit this street</div>
                </div>
            </div>
            <button @click="$modal.hide('edit-street')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase dark:border-b dark:border-gray-600">
            <div class="input-row mb-3">
                <div class="input-col">
                    <label for="#name">Name</label>
                    <input
                        autofocus
                        type="text"
                        v-model="name"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    />
                </div>
            </div>
        </div>
        <div
            class="modal-options bg-gray-100 rounded-b-lg w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-700"
        >
            <button
                @click="editStreet()"
                class="inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Edit Street</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            id: null,
            name: null,
            order: null
        };
    },
    methods: {
        beforeOpen(event) {
            console.log(event);
            this.id = event.params.street.id;
            this.name = event.params.street.name;
            this.order = event.params.street.order;
        },

        editStreet() {
            this.$inertia.put(
                route("territories.editor.street.update", {
                    territory: this.$page.props.territory.data.id,
                    street: this.id
                }),
                {
                    name: this.name,
                    order: this.order
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-street");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Street Saved"
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
            this.id = null;
            this.name = null;
        }
    }
};
</script>
