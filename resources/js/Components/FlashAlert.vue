<template>
    <div
        class="absolute bottom-4 right-4 px-5 py-4 text-xxs rounded-lg shadow-md flex items-center text-white font-bold uppercase"
        :class="classStyles[style].bg"
        style="z-index: 99999; min-width: 200px"
        v-if="show && message"
    >
        <div class="flex p-2 rounded-lg text-base mr-3" :class="classStyles[style].iconBG">
            <i :class="classStyles[style].icon"></i>
        </div>
        <div class="message flex flex-col">
            <span>{{ classStyles[style].title }}</span>
            <span class="opacity-60">{{ message }}</span>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            show: false,
            classStyles: {
                success: {
                    bg: "bg-indigo-500",
                    iconBG: "bg-indigo-600",
                    icon: "far fa-check-circle",
                    title: "Success"
                },
                warning: {
                    bg: "bg-yellow-500",
                    iconBG: "bg-yellow-600",
                    icon: "far fa-exclamation-triangle",
                    title: "Warning"
                },
                danger: {
                    bg: "bg-red-500",
                    iconBG: "bg-red-600",
                    icon: "far fa-exclamation-circle",
                    title: "Error"
                }
            }
        };
    },

    watch: {
        "$page.props.jetstream.flash": function() {
            if (this.$page.props.jetstream.flash == null) return;
            this.show = true;
            setTimeout(() => {
                this.show = false;
            }, 2500);
        }
    },

    computed: {
        style() {
            return this.$page.props.jetstream.flash?.alertStyle || "success";
        },
        message() {
            return this.$page.props.jetstream.flash?.alert || "";
        }
    }
};
</script>
