<template>
    <section class="app-container max-w-none bg-gray-100 flex flex-col h-screen">
        <nav-main></nav-main>
        <section class="flex h-full w-full overflow-hidden">
            <nav-sub></nav-sub>
            <div class="content-container flex-1 w-full relative">
                <transition name="fade">

                </transition>
            </div>
        </section>
    </section>
</template>
<script>
import NavMain from "../Components/NavMain";
import NavSub from "../Components/NavSub"
export default {
    components: {
        NavMain,
        NavSub
    }
}
</script>
