<template>
    <nav
        class="flex flex-col justify-end h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden text-gray-300 text-xs"
    >
        <inertia-link
            :href="route('policy.show')"
            class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400"
        >
            Privacy & Policy
        </inertia-link>
        <inertia-link
            :href="route('terms.show')"
            class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400"
        >
            Terms & Conditions
        </inertia-link>
        <div class="section text-vertical w-full py-6 flex flex-col justify-center items-center">
            Copyright © {{ new Date().getFullYear() }} Terribooks. All Rights Reserved
        </div>
    </nav>
</template>
<script>
export default {};
</script>
