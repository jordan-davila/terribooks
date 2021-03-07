<template>
    <div
        style="z-index: 999999;"
        class="flex flex-col lg:hidden fixed bg-gray-800 top-0 left-0 right-0 bottom-0 items-center justify-center py-14"
    >
        <div class="logo-container flex items-center mb-8">
            <a href="https://terribooks-beta.evo/" class="text-gray-200 text-2xl font-bold"
                ><div>terri<span class="text-indigo-600">books</span></div></a
            >
        </div>
        <div class="info uppercase bg-white rounded-lg shadow-lg p-8 text-gray-300 w-80">
            <div
                class="title text-indigo-700 font-extrabold text-xl mb-2"
                style="
                    background: -webkit-linear-gradient(-90deg,#4338CA,#6D28D9);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                "
            >
                Too Small!
            </div>
            <div class="message text-xxs font-bold">
                At the moment, this site doesn't work well with tablets and mobile devices. In the meantime you could
                use your pc or laptop to navigate the site.
            </div>
        </div>
    </div>
</template>
<script>
export default {};
</script>
