<template>
    <div class="flex-auto flex flex-col h-full bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800" v-if="$page.props.street">
        <AddHouse />
        <AddApartment />
        <EditHouse />
        <EditApartment />
        <div
            class="title-phone-editor w-full py-6 px-8 flex justify-between items-center border-b border-gray-100 border-solid bg-white relative dark:bg-gray-700 dark:border-gray-600"
        >
            <div class="title text-xxs uppercase font-bold text-gray-300">
                Field Ministry List
            </div>
            <div class="buttons flex text-xxs text-white absolute right-0 mr-6">
                <button
                    @click="saveAll()"
                    class="rounded-lg bg-green-400 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold"
                    v-if="!housesToDelete.length && !apartmentsToDelete.length && $page.props.houses.length"
                >
                    <i class="fas fa-save"></i>
                </button>
                <button
                    class="rounded-lg bg-rose-400 flex items-center h-8 w-8 px-4 uppercase font-bold justify-center"
                    @click="deleteSelected()"
                    v-if="housesToDelete.length || apartmentsToDelete.length"
                >
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button
                    class="rounded-lg bg-indigo-500 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold ml-2"
                    @click="$modal.show('add-house')"
                >
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="grid-territory-editor-field" class="flex flex-col overflow-hidden" v-show="$page.props.houses.length">
            <div
                class="list-header grid row border-b border-solid border-gray-100 text-gray-300 uppercase font-bold text-xxs px-6 bg-white dark:border-gray-600 dark:bg-gray-700"
            >
                <div class="column w-full px-2 py-3"></div>
                <div class="column w-full px-2 py-3">#</div>
                <div class="column w-full px-2 py-3">Type</div>
                <div class="column w-full px-2 py-3">Sym</div>
                <div class="column w-full px-2 py-3">Notes</div>
                <div class="column w-full px-2 py-3"></div>
            </div>
            <div id="field-editor-smooth-scroll" class="scroll w-full flex-1 overflow-auto">
                <div class="scroll-wrapper">
                    <template v-for="(house, house_index) in $page.props.houses">
                        <div
                            :id="house.number"
                            class="list-content grid row text-gray-300 font-bold text-xxs px-6 hover:bg-gray-50 border-b border-gray-100 border-solid dark:border-gray-600 dark:hover:bg-gray-700 "
                            :key="house.id"
                            @input="housesWillUpdate(house_index)"
                        >
                            <div
                                class="column w-full px-2 py-4 text-indigo-600 text-xs cursor-pointer"
                                @click="$modal.show('add-apartment', { house_id: house.id })"
                            >
                                <i class="far fa-plus"></i>
                            </div>
                            <div class="column w-full">
                                <input type="text" v-model="house.number" />
                            </div>
                            <div class="column w-full">
                                <select v-model="house.type">
                                    <option value="1">House</option>
                                    <option value="2">Building</option>
                                </select>
                            </div>
                            <div class="column w-full">
                                <select v-model="house.symbol">
                                    <option value="NC">NC</option>
                                    <option value="NH">NH</option>
                                    <option value="H">H</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                </select>
                            </div>
                            <div class="column w-full">
                                <input type="text" v-model="house.observations" />
                            </div>
                            <div class="column w-full flex justify-end items-center">
                                <div
                                    class="bg-white border rounded border-gray-300 w-3.5 h-3.5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-200 dark:border-gray-600 dark:bg-gray-700"
                                >
                                    <input
                                        type="checkbox"
                                        class="opacity-0 absolute"
                                        @click="housesWillDelete(house_index)"
                                    />
                                    <svg
                                        class="fill-current hidden w-2 h-2 text-indigo-500 dark:text-indigo-400 pointer-events-none"
                                        viewBox="0 0 20 20"
                                    >
                                        <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                    </svg>
                                </div>
                                <button
                                    class="text-gray-300 text-xs"
                                    @click="$modal.show('edit-house', { house: house })"
                                >
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                        <template v-for="(apt, apt_index) in house.apartments">
                            <div
                                :id="apt.number"
                                class="list-content grid row text-gray-300 font-bold text-xxs px-6 hover:bg-gray-50 border-b border-gray-100 border-solid dark:border-gray-600 dark:hover:bg-gray-700"
                                :key="apt.id"
                                @input="housesWillUpdate(house_index)"
                            >
                                <div class="column w-full px-2 py-4 text-indigo-600 text-xs"></div>
                                <div class="column w-full">
                                    <input
                                        type="text"
                                        style="text-align: right; padding-right: 3rem !important;"
                                        v-model="apt.number"
                                    />
                                </div>
                                <div class="column w-full"></div>
                                <div class="column w-full">
                                    <select v-model="apt.symbol">
                                        <option value="NC">NC</option>
                                        <option value="NH">NH</option>
                                        <option value="H">H</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                    </select>
                                </div>
                                <div class="column w-full">
                                    <input type="text" v-model="apt.observations" />
                                </div>
                                <div class="column w-full flex justify-end items-center">
                                    <div
                                        class="bg-white border rounded border-gray-300 w-3.5 h-3.5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-200 dark:border-gray-600 dark:bg-gray-700"
                                    >
                                        <input
                                            type="checkbox"
                                            class="opacity-0 absolute"
                                            @click="apartmentsWillDelete([house_index, apt_index])"
                                        />
                                        <svg
                                            class="fill-current hidden w-2 h-2 text-indigo-500 dark:text-indigo-400 pointer-events-none"
                                            viewBox="0 0 20 20"
                                        >
                                            <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                        </svg>
                                    </div>
                                    <button
                                        class="text-gray-300 text-xs"
                                        @click="
                                            $modal.show('edit-apartment', {
                                                apartment: apt,
                                                house: house
                                            })
                                        "
                                    >
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
        <div
            class="w-full h-full flex flex-1 justify-center items-center relative"
            v-show="$page.props.houses.length == 0"
        >
            <div class="flex text-xxs uppercase text-gray-300 font-bold justify-center items-center relative z-10">
                <div class="info text-center">
                    <div class="title">No House Numbers on this Street</div>
                    <div class="opacity-50 mb-4">Please conduct a census and add a new house number</div>
                    <button
                        @click="$modal.show('add-house')"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                    >
                        Add House
                    </button>
                </div>
            </div>
            <div
                id="particles"
                class="slide-up-particles absolute top-0 left-0 w-full block z-0"
                style="height: 100%"
            ></div>
        </div>
    </div>
</template>
<script>
import EditorLayout from "@/Pages/Territories/Editor/Layout";
import AddHouse from "@/Pages/Territories/Modals/AddHouse";
import EditHouse from "@/Pages/Territories/Modals/EditHouse";
import AddApartment from "@/Pages/Territories/Modals/AddApartment";
import EditApartment from "@/Pages/Territories/Modals/EditApartment";
import Scrollbar from "smooth-scrollbar";
import { Config } from "@/Mixins/Config";
import "particles.js";

export default {
    props: ["territory"],
    layout: EditorLayout,
    components: { AddHouse, AddApartment, EditHouse, EditApartment },
    mixins: [Config],
    data() {
        return {
            housesToUpdate: [],
            housesToDelete: [],
            apartmentsToDelete: [],
            fieldKeyListener: null
        };
    },
    mounted() {
        if (this.$page.props.street) {
            window.particlesJS("particles", this.particleParams);
            Scrollbar.init(document.querySelector("#field-editor-smooth-scroll"), {
                damping: 0.1,
                renderByPixels: true,
                alwaysShowTracks: false,
                continuousScrolling: true
            });

            this.fieldKeyListener = function(e) {
                if (e.key === "s" && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    this.saveAll();
                }
                if (e.key === "d" && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    this.$modal.show("add-house");
                }
            };

            document.addEventListener("keydown", this.fieldKeyListener.bind(this));
        }
    },

    beforeDestroy() {
        document.removeEventListener("keydown", this.fieldKeyListener);
    },

    methods: {
        housesWillUpdate(index) {
            this.housesToUpdate = _.union(this.housesToUpdate, [index]);
        },

        housesWillDelete(index) {
            if (this.housesToDelete.includes(index)) {
                this.housesToDelete.splice(this.housesToDelete.indexOf(index), 1);
            } else {
                this.housesToDelete = _.union(this.housesToDelete, [index]);
            }
        },

        apartmentsWillDelete(indexes) {
            if (this.apartmentsToDelete.some(p => indexes.every((child, i) => child === p[i]))) {
                this.apartmentsToDelete.every((parent, index) =>
                    indexes.every((child, i) => {
                        child === parent[i] ? this.apartmentsToDelete.splice(index, 1) : null;
                    })
                );
            } else {
                this.apartmentsToDelete = _.union(this.apartmentsToDelete, [indexes]);
            }
        },

        deleteSelected() {
            if (this.apartmentsToDelete.length != 0) {
                this.$inertia.visit(
                    route("territories.editor.field.delete.selected.apartments", {
                        territory: this.$page.props.territory.data.id,
                        street: this.$page.props.street.id
                    }),
                    {
                        method: "delete",
                        data: {
                            apartments: this.apartmentsToDelete.map(
                                parent => this.$page.props.houses[parent[0]].apartments[parent[1]]
                            )
                        },
                        preserveScroll: true,
                        onSuccess: page => {
                            this.apartmentsToDelete = [];
                            this.$page.props.jetstream.flash = {
                                alertStyle: "success",
                                alert: "House Numbers Deleted"
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
            }

            if (this.housesToDelete.length != 0) {
                this.$inertia.visit(
                    route("territories.editor.field.delete.selected.houses", {
                        territory: this.$page.props.territory.data.id,
                        street: this.$page.props.street.id
                    }),
                    {
                        method: "delete",
                        data: {
                            houses: this.housesToDelete.map(index => this.$page.props.houses[index])
                        },
                        preserveScroll: true,
                        onSuccess: page => {
                            this.housesToDelete = [];
                            this.$page.props.flash = {
                                type: "success",
                                message: "Field Numbers Deleted"
                            };
                        },
                        onError: page => {
                            this.$page.props.flash = {
                                type: "error",
                                message: "Something Went Wrong"
                            };
                        }
                    }
                );
            }
        },

        saveAll() {
            if (this.housesToUpdate.length === 0) return;
            this.$inertia.put(
                route("territories.editor.field.update.all", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id
                }),
                { houses: this.housesToUpdate.map(index => this.$page.props.houses[index]) },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.housesToUpdate = [];
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: "Field Numbers Saved"
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
        }
    }
};
</script>
<style>
input:checked + svg {
    display: block;
}
</style>
