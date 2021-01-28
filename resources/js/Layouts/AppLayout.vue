<template>
    <section class="app-container max-w-none bg-gray-100 flex flex-col h-screen">
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

export default {
    components: {
        NavMain,
    }
}
</script>
