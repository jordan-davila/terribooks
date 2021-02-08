<template>
    <section class="app-container max-w-none bg-gray-100 flex flex-col h-screen">
        <Flash v-bind:flash="$page.props.flash" />
        <NavMain></NavMain>
        <section class="flex h-full w-full overflow-hidden">
            <slot name="navsub"></slot>
            <div class="content-container flex-1 w-full relative">
                <slot></slot>
            </div>
        </section>
    </section>
</template>

<script>
import NavMain from "@/Components/NavMain";
import Flash from "@/Components/Flash";

export default {
    components: {
        NavMain,
        Flash
    }
};
</script>
