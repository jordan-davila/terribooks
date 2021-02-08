<template>
    <div
        v-show="show"
        class="absolute bottom-4 right-4 px-5 py-4 bg-white text-xxs rounded-lg shadow-md flex items-center text-gray-300 font-bold uppercase"
        style="z-index: 99999"
    >
        <div
            :class="[
                'icon rounded-full h-7 w-7 text-xs text-white flex items-center justify-center mr-4',
                bg
            ]"
        >
            <i :class="icon"></i>
        </div>
        <div class="message flex flex-col">
            <span>{{ type }}</span>
            <span class="opacity-60">{{ message }}</span>
        </div>
    </div>
</template>
<script>
const types = [
    { type: "success", icon: "fas fa-check", bg: "bg-green-300" },
    { type: "warning", icon: "fas fa-exclamation", bg: "bg-yellow-300" },
    { type: "error", icon: "fas fa-times", bg: "bg-red-300" }
];
export default {
    props: ["flash"],
    data() {
        return {
            type: "",
            message: "",
            bg: "",
            icon: "",
            show: false
        };
    },
    watch: {
        "$page.props.flash": function() {
            console.log(this.$page.props.flash.type);
            let flash = _.filter(types, ["type", this.$page.props.flash.type])[0];
            this.message = this.$page.props.flash.message;
            this.bg = flash.bg;
            this.type = flash.type;
            this.icon = flash.icon;
            this.show = true;
            setTimeout(() => {
                this.show = false;
            }, 2000);
        }
    }
};
</script>
