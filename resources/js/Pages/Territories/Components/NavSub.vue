<template lang="">
    <nav
        class="flex flex-col justify-between h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden"
    >
        <div class="flex flex-col flex-1 justify-center items-center">
            <div class="sections text-gray-300 text-xxs font-bold uppercase w-full">
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="
                        $page.props.territory
                            ? route('territories.show', [$page.props.territory.data.id])
                            : route('territories.show', [$page.props.territories.data.cities[0].territories[0].id])
                    "
                    class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500"
                    :class="route().current('territories.show') ? 'border-indigo-600' : 'border-white'"
                >
                    Overview
                </inertia-link>
                <inertia-link
                    :href="
                        $page.props.territory
                            ? route('territories.editor.field.index', [$page.props.territory.data.id])
                            : route('territories.editor.field.index', [
                                  $page.props.territories.data.cities[0].territories[0].id
                              ])
                    "
                    class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500 cursor-pointer"
                    :class="route().current('territories.editor.*') ? 'border-indigo-600' : 'border-white'"
                >
                    Editor
                </inertia-link>
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="
                        $page.props.territory
                            ? route('territories.map.show', [$page.props.territory.data.id])
                            : route('territories.map.show', [
                                  'field',
                                  $page.props.territories.data.cities[0].territories[0].id
                              ])
                    "
                    class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500"
                    :class="route().current('territories.other') ? 'border-indigo-600' : 'border-white'"
                >
                    Map
                </inertia-link>
                <inertia-link
                    preserve-scroll
                    preserve-state
                    :href="
                        $page.props.territory
                            ? route('assignments.type.show', ['field', $page.props.territory.data.id])
                            : route('assignments.type.show', [
                                  'field',
                                  $page.props.territories.data.cities[0].territories[0].id
                              ])
                    "
                    class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-solid hover:border-indigo-500"
                    :class="route().current('assignments.*') ? 'border-indigo-600' : 'border-white'"
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
export default {};
</script>
