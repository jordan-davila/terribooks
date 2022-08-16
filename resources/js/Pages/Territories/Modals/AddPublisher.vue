<template lang="">
    <modal
        name="add-publisher"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-white shadow-lg overflow-hidden dark:bg-gray-700"
        @closed="reset"
    >
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between dark:bg-slate-800 dark:border-slate-700"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-lg w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-user-alt"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Add Publisher</div>
                    <div class="subtitle opacity-60">Fill the form below to add a new publisher</div>
                </div>
            </div>
            <button @click="$modal.hide('add-publisher')" class="text-sm opacity-60 ml-6">
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
                @click="addPublisher()"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Add Publisher</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            name: ""
        };
    },
    methods: {
        addPublisher() {
            this.$inertia.post(
                route("teams.publisher.store", {
                    team: this.$page.props.user.current_team.id
                }),
                {
                    name: this.name,
                    email: this.email,
                    phone: this.phone
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("add-publisher");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Publisher Added"
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
            this.name = "";
            this.email = "";
        }
    }
};
</script>
