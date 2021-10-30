<template>
    <div
        class="w-full mx-auto text-white px-10 py-3 text-xxs uppercase"
        :class="classStyles[style].bg"
        v-if="show && message"
    >
        <div class="flex items-center justify-between flex-wrap">
            <div class="flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg text-base mr-2" :class="classStyles[style].iconBG">
                    <i :class="classStyles[style].icon"></i>
                </span>

                <p class="ml-3 font-bold text-white">
                    {{ message }}
                </p>
            </div>

            <div class="flex-shrink-0 sm:ml-3">
                <button type="button" class="text-sm" @click.prevent="show = false">
                    <i class="fas fa-times"></i>
                </button>
            </div>
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
        }
    },

    computed: {
        style() {
            return this.$page.props.jetstream.flash?.bannerStyle || "success";
        },

        message() {
            return this.$page.props.jetstream.flash?.banner || "";
        }
    }
};
</script>
