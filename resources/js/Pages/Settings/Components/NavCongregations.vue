<template>
    <nav style="flex: 0 295px;" class="flex flex-col h-full border-r border-gray-200 border-solid bg-white">
        <div class="territory-list w-full flex-1 px-14 py-8">
            <div class="text-xxs text-gray-300 w-full py-4 uppercase font-bold flex justify-between items-center">
                <span>Congregation Settings</span>
                <button class="w-6 h-6 text-gray-300 text-sm">
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                <div class="info flex items-center">
                    <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                        <i class="fas fa-book-user"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Name & Owner</span>
                        <span class="opacity-60">Information</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </a>
            <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                <div class="info flex items-center">
                    <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                        <i class="fas fa-city"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Cities</span>
                        <span class="opacity-60">Add Cities</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </a>
            <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                <div class="info flex items-center">
                    <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Members</span>
                        <span class="opacity-60">Invite Users</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </a>
            <a href="#" class="uppercase font-bold py-4 flex justify-between items-center">
                <div class="info flex items-center">
                    <span class="w-10 h-10 flex justify-center items-center text-xs rounded-lg text-gray-500 bg-gray-100">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300">
                        <span>Delete</span>
                        <span class="opacity-60">Permanently</span>
                    </div>
                </div>
                <button class="text-gray-300 text-xxs">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </a>
        </div>
    </nav>
</template>
<script>
export default {};
</script>
