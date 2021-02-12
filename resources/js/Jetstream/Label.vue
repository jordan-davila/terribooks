<template>
    <label class="block text-xxs uppercase text-gray-300 font-bold">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
export default {
    props: ["value"]
};
</script>
