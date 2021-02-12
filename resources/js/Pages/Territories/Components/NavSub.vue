<template lang="">
    <nav class="flex flex-col justify-between h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden">
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
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="route('territories.editor.field.index', [$page.props.territory.data.id])"
                    :class="classes('territories.editor.*')"
                >
                    Editor
                </inertia-link>
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
export default {
    methods: {
        classes(link) {
            let classes =
                "section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500 ";
            classes += route().current(link) ? "border-indigo-600" : "border-white";
            return classes;
        }
    }
};
</script>
