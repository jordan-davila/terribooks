<template>
    <nav
        class="print-nav w-full h-16 flex justify-between items-center border-b border-gray-200 border-solid bg-white"
    >
        <div class="links text-xxs uppercase flex text-gray-300 font-bold h-full">
            <inertia-link
                :href="route('dashboard')"
                :class="classes('territories.print.field.index')"
            >
                Field
            </inertia-link>
            <inertia-link
                :href="route('dashboard')"
                :class="classes('territories.print.phone.index')"
            >
                Phones
            </inertia-link>
            <inertia-link
                :href="route('dashboard')"
                :class="classes('territories.print.business.index')"
            >
                Business
            </inertia-link>
            <inertia-link
                :href="route('dashboard')"
                class="px-8 h-full flex justify-center items-center"
            >
                Map Card
            </inertia-link>
        </div>
        <div class="options flex justify-end items-center h-full px-8 text-xxs text-white">
            <slot></slot>
        </div>
    </nav>
</template>
<script>
export default {
    methods: {
        classes(link) {
            let classes =
                "px-8 h-full flex justify-center items-center border-b-2 border-solid hover:border-indigo-500 ";
            classes += route().current(link) ? "border-indigo-600" : "border-white";
            return classes;
        }
    }
};
</script>
