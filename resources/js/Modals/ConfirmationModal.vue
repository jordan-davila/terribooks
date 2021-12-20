<template lang="">
    <modal
        name="confirmation"
        draggable
        width="430px"
        height="auto"
        focusTrap
        classes="w-80 rounded-lg bg-gray-900 shadow-lg"
        @before-open="beforeOpen"
        @before-close="beforeClose"
    >
        <div class="modal-title w-full py-8 px-8 flex justify-between items-center text-gray-300">
            <div class="relative flex items-center">
                <div
                    v-if="type == 'warning'"
                    class="icon bg-rose-100 rounded-full w-8 h-8 text-red-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-trash-alt"></i>
                </div>
                <div
                    v-else
                    class="icon bg-indigo-100 rounded-full w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="fas fa-info-circle"></i>
                </div>
                <span class="text-xxs uppercase font-bold">{{ title }}</span>
            </div>
            <button @click="$modal.hide('confirmation')" class="opacity-60">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 mb-8 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row grid grid-cols-1 gap-2 mb-3">
                <div class="input-col text-gray-300 font-bold text-xxs uppercase">{{ message }}</div>
            </div>
        </div>
        <div
            class="modal-options bg-gray-100 w-full py-6 px-8 flex justify-end items-center text-gray-300 rounded-b-lg"
        >
            <button
                @click="action"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 focus:outline-none transition ease-in-out duration-150"
                :class="type == 'warning' ? 'bg-rose-600' : 'bg-indigo-600'"
            >
                <span>Confirm</span>
            </button>
        </div>
    </modal>
</template>
<script>
export default {
    data() {
        return {
            title: null,
            message: null,
            type: null,
            action: null
        };
    },
    methods: {
        beforeOpen(event) {
            this.title = event.params.title;
            this.message = event.params.message;
            this.type = event.params.type;
            this.action = event.params.action;
        },

        beforeClose() {
            this.title = null;
            this.message = null;
            this.type = null;
            this.action = null;
        }
    }
};
</script>
