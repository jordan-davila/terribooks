<template>
    <div
        class="flex-auto flex flex-col h-full bg-white shadow-lg rounded-lg overflow-hidden text-gray-300 relative justify-center items-center"
    >
        <div class="flex text-xxs uppercase text-gray-300 font-bold justify-center items-center relative z-10">
            <div class="info text-center">
                <div class="title">No Streets on this Territory</div>
                <div class="opacity-50 mb-4">Click on the button below to add a new street</div>
                <button
                    @click="$modal.show('add-street')"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                >
                    Add Street
                </button>
            </div>
        </div>
        <div
            id="particles"
            class="slide-up-particles absolute top-0 left-0 w-full block z-0"
            style="height: 100%"
        ></div>
    </div>
</template>
<script>
import EditorLayout from "@/Pages/Territories/Editor/Layout";
import { Config } from "@/Mixins/Config";
import "particles.js";

export default {
    props: ["territory"],
    layout: EditorLayout,
    mixins: [Config],
    data() {
        return {};
    },

    mounted() {
        window.particlesJS("particles", this.particleParams);
    },

    methods: {
        saveAll() {
            if (this.phonesToUpdate.length === 0) return;
            this.$inertia.put(
                route("territories.editor.phone.update.all", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id
                }),
                { phones: this.phonesToUpdate.map(index => this.$page.props.phones[index]) },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.phonesToUpdate = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Phone Numbers Saved"
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
            if (this.phonesToDelete.length === 0) return;
            this.$inertia.visit(
                route("territories.editor.phone.delete.selected", {
                    territory: this.$page.props.territory.data.id,
                    street: this.$page.props.street.id
                }),
                {
                    method: "delete",
                    data: {
                        phones: this.phonesToDelete.map(index => this.$page.props.phones[index])
                    },
                    preserveScroll: true,
                    onSuccess: page => {
                        this.phonesToDelete = [];
                        this.$page.props.jetstream.flash = {
                            alertType: "success",
                            alert: "Phone Numbers Deleted"
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
