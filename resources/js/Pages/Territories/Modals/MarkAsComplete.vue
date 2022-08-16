<template lang="">
    <modal
        name="mark-as-complete"
        draggable
        width="430px"
        height="auto"
        classes="rounded-lg bg-white shadow-lg !overflow-visible dark:bg-gray-700"
        @before-open="beforeOpen"
        @closed="reset"
    >
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between dark:bg-slate-800 dark:border-slate-700"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-lg w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-house-user"></i>
                </div>
                <div class="flex flex-col" v-if="territory">
                    <div class="title">Mark {{ territory.code }} As Complete</div>
                    <div class="subtitle opacity-60">
                        Mark this assignment as complete
                    </div>
                </div>
            </div>
            <button @click="$modal.hide('mark-as-complete')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase dark:border-b dark:border-gray-600">
            <div class="input-row grid grid-cols-1 gap-2 mb-3">
                <div class="input-col">
                    <label for="#name">Publisher</label>
                    <select
                        name="symbol"
                        v-model="publisher_id"
                        class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3"
                    >
                        <option v-for="user in $page.props.publishers.data" :value="user.id">{{ user.name }}</option>
                    </select>
                </div>
            </div>
            <div class="input-row grid grid-cols-2 gap-2 mb-3">
                <div class="input-col">
                    <label for="#symbol">Date In</label>
                    <date-picker v-model="date_in" :popover="{ visibility: 'focus' }">
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 focus:outline-none bg-transparent"
                                :value="inputValue"
                                v-on="inputEvents"
                            />
                        </template>
                    </date-picker>
                </div>
                <div class="input-col">
                    <label for="#color">Date Out</label>
                    <date-picker v-model="date_out" :popover="{ visibility: 'focus' }">
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="w-full border-gray-200 border border-solid rounded-md mt-2 text-xs py-3 px-3 focus:outline-none bg-transparent"
                                :value="inputValue"
                                v-on="inputEvents"
                            />
                        </template>
                    </date-picker>
                </div>
            </div>
        </div>
        <div
            class="modal-options rounded-b-lg bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300 dark:bg-gray-700"
        >
            <button
                @click="markAsComplete()"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                <span>Mark As Complete</span>
            </button>
        </div>
    </modal>
</template>
<script>
import moment from "moment";
import DatePicker from "v-calendar/lib/components/date-picker.umd";

export default {
    components: { DatePicker },
    data() {
        return {
            id: null,
            publisher_id: null,
            date_in: null,
            date_out: null,
            territory: null
        };
    },
    methods: {
        beforeOpen(event) {
            this.id = event.params.assignment.id;
            this.publisher_id = event.params.assignment.publisher_id;
            this.date_in = event.params.assignment.date_in;
            this.territory = event.params.assignment.territory;
            this.date_out = moment(new Date()).format("YYYY-MM-DD");
        },

        markAsComplete() {
            this.$inertia.put(
                route("assignments.mark.complete", {
                    assignment: this.id
                }),
                {
                    publisher_id: this.publisher_id,
                    date_in: this.date_in,
                    date_out: this.date_out
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("mark-as-complete");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Assignment Marked as Complete"
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
            this.publisher_id = null;
            this.date_in = null;
            this.date_out = null;
        }
    }
};
</script>
