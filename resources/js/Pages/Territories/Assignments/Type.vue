<template>
    <div class="flex flex-1 relative">
        <div class="pl-14 pr-6 py-8 text-gray-300 flex-1">
            <div class="flex-auto flex flex-col h-full bg-white shadow-lg rounded-lg overflow-hidden">
                <div
                    class="setting-title flex items-center justify-between text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 relative"
                >
                    <div class="title text-xxs uppercase font-bold text-gray-300">
                        <div class="title">Current Assignments</div>
                        <div class="subtitle opacity-60">List of all the current assignments</div>
                    </div>
                    <div class="buttons flex text-xxs text-white absolute right-0 mr-6">
                        <button
                            @click="saveAllCurrentAssignments()"
                            class="rounded-lg bg-green-400 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold"
                        >
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden">
                    <div
                        class="list-header grid row border-b border-solid border-gray-100 text-gray-300 uppercase font-bold text-xxs px-6 bg-white"
                        style="grid-template-columns: 1fr 140px 100px 30px;"
                    >
                        <div class="column w-full px-2 py-3">Territory</div>
                        <div class="column w-full px-2 py-3">Publisher</div>
                        <div class="column w-full px-2 py-3">Date In</div>
                        <div class="column w-full px-2 py-3"></div>
                    </div>
                    <div id="current-assignments-scroll" class="scroll w-full flex-1 overflow-auto">
                        <div class="scroll-wrapper">
                            <div
                                class="list-header grid row text-gray-300 font-bold text-xxs px-6 border-solid border-b border-gray-100 hover:bg-gray-50"
                                :class="assignment.territory.id == $page.props.territory.data.id && 'bg-gray-50'"
                                style="grid-template-columns: 1fr 140px 100px 30px;"
                                v-for="(assignment, index) in $page.props.current_assignments"
                                v-bind:key="assignment.id"
                                @input="currentAssignmentsWillUpdate(index)"
                            >
                                <div
                                    class="column w-full px-2 py-3 flex items-center"
                                    :class="
                                        assignment.territory.id == $page.props.territory.data.id && 'text-indigo-600'
                                    "
                                >
                                    <inertia-link
                                        preserve-state
                                        :href="
                                            route('assignments.type.show', [$page.props.type, assignment.territory.id])
                                        "
                                    >
                                        {{ assignment.territory.code }}
                                    </inertia-link>
                                </div>
                                <div class="column w-full">
                                    <select name="symbol" v-model="assignment.publisher_id" class="w-full text-xs">
                                        <option value="null">None</option>
                                        <option
                                            v-for="user in $page.props.publishers.data"
                                            :value="user.id"
                                            :key="user.id"
                                        >
                                            {{ user.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="column w-full">
                                    <date-picker
                                        mode="date"
                                        :masks="{ input: ['MM-DD-YYYY'], data: ['YYYY-MM-DD'] }"
                                        v-model="assignment.date_in"
                                        :popover="{ visibility: 'focus' }"
                                        @input="currentAssignmentsWillUpdate(index)"
                                    >
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <input type="text" :value="inputValue" v-on="inputEvents" />
                                        </template>
                                    </date-picker>
                                </div>
                                <div class="column w-full flex justify-center items-center">
                                    <button
                                        class="text-gray-300 text-sm"
                                        @click="$modal.show('mark-as-complete', { assignment: assignment })"
                                    >
                                        <i class="far fa-check-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pr-14 py-8 text-gray-300 flex-1">
            <div class="w-full bg-white rounded-lg shadow-lg overflow-hidden w-full h-full">
                <div
                    class="setting-title flex items-center justify-between text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 relative"
                >
                    <div class="title text-xxs uppercase font-bold text-gray-300">
                        <div class="title">{{ territory.data.code }}: Past Assignments</div>
                        <div class="subtitle opacity-60">List of previous assignments</div>
                    </div>
                    <div class="buttons flex text-xxs text-white absolute right-0 mr-6">
                        <button
                            @click="saveAllPastAssignments()"
                            class="rounded-lg bg-green-400 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold"
                            v-if="!pastAssignmentsToDelete.length"
                        >
                            <i class="fas fa-save"></i>
                        </button>
                        <button
                            @click="deleteSelectedPastAssignments()"
                            class="rounded-lg bg-red-400 flex items-center h-8 w-8 px-4 uppercase font-bold justify-center"
                            v-if="pastAssignmentsToDelete.length"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col overflow-hidden">
                    <div
                        class="list-header grid row border-b border-solid border-gray-100 text-gray-300 uppercase font-bold text-xxs px-6 bg-white"
                        style="grid-template-columns: 1fr 100px 100px 30px;"
                    >
                        <div class="column w-full px-2 py-3">Publisher</div>
                        <div class="column w-full px-2 py-3">Date In</div>
                        <div class="column w-full px-2 py-3">Date Out</div>
                        <div class="column w-full px-2 py-3"></div>
                    </div>
                    <div id="current-assignments-scroll" class="scroll w-full flex-1 overflow-auto">
                        <div class="scroll-wrapper">
                            <div
                                class="list-header grid row text-gray-300 font-bold text-xxs px-6 border-solid border-b border-gray-100 hover:bg-gray-50"
                                style="grid-template-columns: 1fr 100px 100px 30px;"
                                v-for="(assignment, index) in $page.props.past_assignments"
                                v-bind:key="assignment.id"
                                @input="pastAssignmentsWillUpdate(index)"
                            >
                                <div class="column w-full">
                                    <select name="symbol" v-model="assignment.publisher_id" class="w-full text-xs">
                                        <option
                                            v-for="user in $page.props.publishers.data"
                                            :value="user.id"
                                            :key="user.id"
                                        >
                                            {{ user.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="column w-full">
                                    <date-picker
                                        mode="date"
                                        :masks="{ input: ['MM-DD-YYYY'], data: ['YYYY-MM-DD'] }"
                                        v-model="assignment.date_in"
                                        :popover="{ visibility: 'focus' }"
                                        @input="pastAssignmentsWillUpdate(index)"
                                    >
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <input type="text" :value="inputValue" v-on="inputEvents" />
                                        </template>
                                    </date-picker>
                                </div>
                                <div class="column w-full">
                                    <date-picker
                                        mode="date"
                                        :masks="{ input: ['MM-DD-YYYY'], data: ['YYYY-MM-DD'] }"
                                        v-model="assignment.date_out"
                                        :popover="{ visibility: 'focus' }"
                                        @input="pastAssignmentsWillUpdate(index)"
                                    >
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <input type="text" :value="inputValue" v-on="inputEvents" />
                                        </template>
                                    </date-picker>
                                </div>
                                <div class="column w-full px-2 py-3 flex items-center justify-end">
                                    <div
                                        class="bg-white border rounded border-gray-300 w-3.5 h-3.5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-200 relative"
                                    >
                                        <input
                                            type="checkbox"
                                            class="opacity-0 absolute"
                                            @click="pastAssignmentsWillDelete(index)"
                                        />
                                        <svg
                                            class="fill-current hidden w-2 h-2 text-indigo-500 pointer-events-none"
                                            viewBox="0 0 20 20"
                                        >
                                            <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AssignmentLayout from "@/Pages/Territories/Assignments/Layout";
import Scrollbar from "smooth-scrollbar";
import DatePicker from "v-calendar/lib/components/date-picker.umd";

export default {
    props: ["territory"],
    layout: AssignmentLayout,
    components: {
        DatePicker
    },

    data() {
        return {
            currentAssignmentsToUpdate: [],
            pastAssignmentsToUpdate: [],
            pastAssignmentsToDelete: [],
            assignmentKeyListener: null
        };
    },

    mounted() {
        Scrollbar.init(document.querySelector("#current-assignments-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });

        this.assignmentKeyListener = function(e) {
            if (e.key === "s" && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.saveAllCurrentAssignments();
                this.saveAllPastAssignments();
            }
        };

        document.addEventListener("keydown", this.assignmentKeyListener.bind(this));
    },

    beforeDestroy() {
        document.removeEventListener("keydown", this.assignmentKeyListener);
    },

    methods: {
        currentAssignmentsWillUpdate(index) {
            this.currentAssignmentsToUpdate = _.union(this.currentAssignmentsToUpdate, [index]);
        },

        pastAssignmentsWillUpdate(index) {
            this.pastAssignmentsToUpdate = _.union(this.pastAssignmentsToUpdate, [index]);
        },

        pastAssignmentsWillDelete(index) {
            if (this.pastAssignmentsToDelete.includes(index)) {
                this.pastAssignmentsToDelete.splice(this.pastAssignmentsToDelete.indexOf(index), 1);
            } else {
                this.pastAssignmentsToDelete = _.union(this.pastAssignmentsToDelete, [index]);
            }
        },

        formatDate() {
            console.log(date);
            return date => date.year + "-" + date.month + "-" + date.day;
        },

        saveAllCurrentAssignments() {
            if (this.currentAssignmentsToUpdate.length === 0) return;
            this.$inertia.put(
                route("assignments.update.all"),
                {
                    assignments: this.currentAssignmentsToUpdate.map(
                        index => this.$page.props.current_assignments[index]
                    )
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.currentAssignmentsToUpdate = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Assignments Saved"
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

        saveAllPastAssignments() {
            if (this.pastAssignmentsToUpdate.length === 0) return;
            this.$inertia.put(
                route("assignments.update.all"),
                {
                    assignments: this.pastAssignmentsToUpdate.map(index => this.$page.props.past_assignments[index])
                },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.pastAssignmentsToUpdate = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Assignments Saved"
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

        deleteSelectedPastAssignments() {
            if (this.pastAssignmentsToDelete.length === 0) return;
            this.$inertia.visit(route("assignments.delete.selected"), {
                method: "delete",
                data: {
                    assignments: this.pastAssignmentsToDelete.map(index => this.$page.props.past_assignments[index])
                },
                preserveScroll: true,
                onSuccess: page => {
                    this.pastAssignmentsToDelete = [];
                    this.$page.props.jetstream.flash = {
                        alertType: "success",
                        alert: "Assignments Deleted"
                    };
                },
                onError: page => {
                    this.$page.props.jetstream.flash = {
                        alertType: "error",
                        alert: "Something Went Wrong"
                    };
                }
            });
        }
    }
};
</script>
<style>
input:checked + svg {
    display: block;
}
</style>
