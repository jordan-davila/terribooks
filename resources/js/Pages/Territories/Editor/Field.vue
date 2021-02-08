<template>
    <div class="flex-auto flex flex-col h-full bg-gray-50 shadow-lg rounded-lg overflow-hidden">
        <AddHouse />
        <AddApartment />
        <div
            class="title-phone-editor w-full py-6 px-8 flex justify-between items-center border-b border-gray-200 border-solid bg-white"
        >
            <div class="title text-xxs uppercase font-bold text-gray-300">
                Field Ministry List
            </div>
            <div class="buttons flex text-xxs text-white">
                <button
                    class="rounded-full bg-green-400 flex items-center h-6 px-4 uppercase font-bold"
                    @click="saveAll()"
                >
                    <i class="fas fa-save mr-2"></i>
                    <span>Save All</span>
                </button>
                <button
                    class="rounded-full bg-indigo-500 flex items-center justify-center h-6 w-6 ml-2"
                    @click="$modal.show('add-house')"
                >
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="grid-territory-editor-field" class="flex flex-col overflow-hidden">
            <div
                class="list-header grid row border-b border-solid border-gray-200 text-gray-300 uppercase font-bold text-xxs px-6 bg-white"
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
                    <template v-for="(house, index) in $page.props.houses">
                        <div
                            :id="house.number"
                            class="list-content grid row text-gray-300 font-bold text-xxs px-6 hover:bg-white border-b border-gray-100 border-solid"
                            :key="house.id"
                            @input="housesWillUpdate(index)"
                        >
                            <div
                                class="column w-full px-2 py-4 text-indigo-600 text-xs"
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
                            <div class="column w-full"></div>
                        </div>
                        <template v-for="apt in house.apartments">
                            <div
                                :id="apt.number"
                                class="list-content grid row text-gray-300 font-bold text-xxs px-6 hover:bg-white border-b border-gray-100 border-solid"
                                :key="apt.id"
                                @input="apartmentsWillUpdate(index)"
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
                                    <input type="text" v-model="apt.onservations" />
                                </div>
                                <div class="column w-full"></div>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import EditorLayout from "@/Pages/Territories/Editor/Layout";
import Scrollbar from "smooth-scrollbar";
import AddHouse from "@/Pages/Territories/Modals/AddHouse";
import AddApartment from "@/Pages/Territories/Modals/AddApartment";

export default {
    props: ["territory"],
    layout: EditorLayout,
    components: { AddHouse, AddApartment },
    data() {
        return {
            housesToUpdate: []
        };
    },
    mounted() {
        Scrollbar.init(document.querySelector("#field-editor-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });

        this._keyListener = function(e) {
            if (e.key === "s" && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.saveAll();
            }
            if (e.key === "d" && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.$modal.show("add-house");
            }
        };

        document.addEventListener("keydown", this._keyListener.bind(this));
    },

    beforeDestroy() {
        document.removeEventListener("keydown", this._keyListener);
    },

    methods: {
        housesWillUpdate(index) {
            this.housesToUpdate = _.union(this.housesToUpdate, [index]);
        },

        apartmentsWillUpdate(index) {
            this.apartmentsToUpdate = _.union(this.apartmentsToUpdate, [index]);
        },

        saveAll() {
            // Check For Houses to Update
            // This will update the entire selected house->apartment group.
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
                        this.phonesToUpdate = [];
                        this.$page.props.flash = {
                            type: "success",
                            message: "Phone Numbers Saved"
                        };
                    },
                    onError: page => {
                        this.$page.props.flash = { type: "error", message: "Something Went Wrong" };
                    }
                }
            );
        }
    }
};
</script>
