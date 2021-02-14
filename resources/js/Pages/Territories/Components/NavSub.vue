<template lang="">
    <nav
        class="flex flex-col justify-between h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden"
    >
        <div class="flex flex-col flex-1 justify-center items-center">
            <div class="sections text-gray-300 text-xs w-full">
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="route('territories.show', [$page.props.territory.data.id])"
                    :class="classes('territories.show')"
                >
                    Overview
                </inertia-link>
                <popper
                    ref="editorTypePicker"
                    trigger="clickToOpen"
                    :options="{
                        placement: 'left',
                        modifiers: {
                            flip: { enabled: true },
                            offset: { offset: '20,20' }
                        }
                    }"
                >
                    <div class="popper rounded-md shadow-lg w-60 bg-white overflow-hidden z-50">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 text-xxs uppercase">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-gray-300 font-bold">
                                Select Type
                            </div>

                            <inertia-link
                                preserve-state
                                @click="$refs.editorTypePicker.doClose()"
                                :href="getEditorLink('field')"
                                class="block px-6 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            >
                                Field
                            </inertia-link>

                            <inertia-link
                                preserve-state
                                @click="$refs.editorTypePicker.doClose()"
                                :href="getEditorLink('phone')"
                                class="block px-6 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            >
                                Phone
                            </inertia-link>

                            <inertia-link
                                preserve-state
                                @click="$refs.editorTypePicker.doClose()"
                                :href="getEditorLink('business')"
                                class="block px-6 py-2 leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                            >
                                Business
                            </inertia-link>
                        </div>
                    </div>
                    <a slot="reference" class="cursor-pointer" :class="classes('territories.editor.*')">
                        Editor
                    </a>
                </popper>

                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="route('territories.show', [$page.props.territory.data.id])"
                    :class="classes('territories.other')"
                >
                    Map
                </inertia-link>
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="route('territories.show', [$page.props.territory.data.id])"
                    :class="classes('territories.other')"
                >
                    Assignments
                </inertia-link>
                <a
                    @click.prevent="$modal.show('export')"
                    class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500 border-white cursor-pointer"
                >
                    Export
                </a>
            </div>
        </div>
        <div class="icons text-gray-300 text-sm h-16 w-full flex flex-col justify-center items-center">
            <i class="far fa-share-alt"></i>
        </div>
    </nav>
</template>
<script>
import Popper from "vue-popperjs";
export default {
    components: { Popper },
    methods: {
        classes(link) {
            let classes =
                "section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500 ";
            classes += route().current(link) ? "border-indigo-600" : "border-white";
            return classes;
        },

        getEditorLink(type) {
            return typeof this.$page.props.street != "undefined"
                ? route(`territories.editor.${type}.show`, [
                      this.$page.props.territory.data.id,
                      this.$page.props.street.id
                  ])
                : route(`territories.editor.${type}.index`, this.$page.props.territory.data.id);
        }
    }
};
</script>
