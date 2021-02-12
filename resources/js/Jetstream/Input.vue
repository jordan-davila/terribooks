<template>
    <input
        class="border-gray-200 text-xs py-3 px-3 rounded-md shadow-sm"
        :value="value"
        @input="$emit('input', $event.target.value)"
        ref="input"
    />
</template>

<script>
export default {
    props: ["value"],

    methods: {
        focus() {
            this.$refs.input.focus();
        }
    }
};
</script>
