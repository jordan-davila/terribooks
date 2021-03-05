<template>
    <div class="flex-auto flex flex-col h-full bg-white shadow-lg rounded-lg overflow-hidden">
        <AddBusiness />
        <EditBusiness />
        <div
            class="title-phone-editor w-full py-6 px-8 flex justify-between items-center border-b border-gray-100 border-solid bg-white relative"
        >
            <div class="title text-xxs uppercase font-bold text-gray-300">
                Business Ministry List
            </div>
            <div class="buttons flex text-xxs text-white absolute right-0 mr-6">
                <button
                    @click="saveAll()"
                    class="rounded-lg bg-green-400 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold"
                    v-if="!businessesToDelete.length && $page.props.businesses.length"
                >
                    <i class="fas fa-save"></i>
                </button>
                <button
                    @click="deleteSelected()"
                    class="rounded-lg bg-red-400 flex items-center h-8 w-8 px-4 uppercase font-bold justify-center"
                    v-if="businessesToDelete.length"
                >
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button
                    class="rounded-lg bg-indigo-500 flex items-center justify-center h-8 w-8 px-4 uppercase font-bold ml-2"
                    @click="$modal.show('add-business')"
                >
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="flex flex-col overflow-hidden" v-show="$page.props.businesses.length">
            <div
                class="list-header grid row border-b border-solid border-gray-100 text-gray-300 uppercase font-bold text-xxs px-6 bg-white"
                style="grid-template-columns: 1fr 40px 103px 50px 1.5fr 32px;"
            >
                <div class="column w-full px-2 py-3">Name</div>
                <div class="column w-full px-2 py-3">#</div>
                <div class="column w-full px-2 py-3">Phone</div>
                <div class="column w-full px-2 py-3">Sym</div>
                <div class="column w-full px-2 py-3">Notes</div>
                <div class="column w-full px-2 py-3"></div>
            </div>
            <div id="business-editor-smooth-scroll" class="scroll w-full flex-1 overflow-auto">
                <div class="scroll-wrapper">
                    <div
                        :id="business.number"
                        class="list-content grid row text-gray-300 font-bold text-xxs px-6 hover:bg-gray-50 border-b border-gray-100 border-solid"
                        style="grid-template-columns: 1fr 40px 103px 50px 1.5fr 32px;"
                        v-for="(business, index) in $page.props.businesses"
                        :key="business.id"
                        @input="businessesWillUpdate(index)"
                    >
                        <div class="column w-full">
                            <input type="text" v-model="business.name" />
                        </div>
                        <div class="column w-full">
                            <input type="text" v-model="business.number" />
                        </div>
                        <div class="column w-full">
                            <input type="text" v-model="business.phone" @input="formatPhone(index)" />
                        </div>
                        <div class="column w-full">
                            <select v-model="business.symbol">
                                <option value="NC">NC</option>
                                <option value="NH">NH</option>
                                <option value="H">H</option>
                                <option value="M">M</option>
                                <option value="N">N</option>
                            </select>
                        </div>
                        <div class="column w-full">
                            <input type="text" v-model="business.observations" />
                        </div>
                        <div class="column w-full flex justify-end items-center">
                            <div
                                class="bg-white border rounded border-gray-300 w-3.5 h-3.5 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-indigo-200"
                            >
                                <input
                                    type="checkbox"
                                    class="opacity-0 absolute"
                                    @click="businessesWillDelete(index)"
                                />
                                <svg
                                    class="fill-current hidden w-2 h-2 text-indigo-500 pointer-events-none"
                                    viewBox="0 0 20 20"
                                >
                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                </svg>
                            </div>
                            <button
                                class="text-gray-300 text-xs"
                                @click="$modal.show('edit-business', { business: business })"
                            >
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-full h-full flex flex-1 justify-center items-center relative"
            v-show="$page.props.businesses.length == 0"
        >
            <div class="flex text-xxs uppercase text-gray-300 font-bold justify-center items-center relative z-10">
                <div class="info text-center">
                    <div class="title">No Businesses on this Street</div>
                    <div class="opacity-50 mb-4">Please conduct a census and add a new business number</div>
                    <button
                        @click="$modal.show('add-business')"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                    >
                        Add Business
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
import AddBusiness from "@/Pages/Territories/Modals/AddBusiness";
import EditBusiness from "@/Pages/Territories/Modals/EditBusiness";
import Scrollbar from "smooth-scrollbar";
import { Config } from "@/Mixins/Config";
import "particles.js";

export default {
    props: ["territory"],
    components: { AddBusiness, EditBusiness },
    layout: EditorLayout,
    mixins: [Config],
    data() {
        return {
            businessesToUpdate: [],
            businessesToDelete: [],
            businessKeyListener: null
        };
    },
    mounted() {
        window.particlesJS("particles", this.particleParams);
        Scrollbar.init(document.querySelector("#business-editor-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });

        this.businessKeyListener = function(e) {
            if (e.key === "s" && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.saveAll();
            }
            if (e.key === "d" && (e.ctrlKey || e.metaKey)) {
                e.preventDefault();
                this.$modal.show("add-business");
            }
        };

        document.addEventListener("keydown", this.businessKeyListener.bind(this));
    },
    beforeDestroy() {
        document.removeEventListener("keydown", this.businessKeyListener);
    },
    methods: {
        businessesWillUpdate(index) {
            this.businessesToUpdate = _.union(this.businessesToUpdate, [index]);
        },

        businessesWillDelete(index) {
            if (this.businessesToDelete.includes(index)) {
                this.businessesToDelete.splice(this.businessesToDelete.indexOf(index), 1);
            } else {
                this.businessesToDelete = _.union(this.businessesToDelete, [index]);
            }
        },

        formatPhone(index) {
            let x = this.$page.props.businesses[index].phone.replace(/\D/g, "").match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.$page.props.businesses[index].phone = !x[2]
                ? x[1]
                : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
        },

        saveAll() {
            if (this.businessesToUpdate.length === 0) return;
            this.$inertia.put(
                route("territories.editor.business.update.all", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id
                }),
                { businesses: this.businessesToUpdate.map(index => this.$page.props.businesses[index]) },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.businessesToUpdate = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Business Numbers Saved"
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

        deleteSelected() {
            if (this.businessesToDelete.length === 0) return;
            this.$inertia.visit(
                route("territories.editor.business.delete.selected", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id
                }),
                {
                    method: "delete",
                    data: {
                        businesses: this.businessesToDelete.map(index => this.$page.props.businesses[index])
                    },
                    preserveScroll: true,
                    onSuccess: page => {
                        this.businessesToDelete = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Business Numbers Deleted"
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
        }
    }
};
</script>
<style>
input:checked + svg {
    display: block;
}
</style>
