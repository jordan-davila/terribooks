<template>
    <div id="owner-details" class="module-container px-14 pt-8 text-gray-300">
        <div class="module-card w-full bg-white rounded-lg shadow-lg overflow-hidden dark:bg-gray-800">
            <div class="setting-title text-xxs uppercase w-full px-8 py-6 font-bold border-b border-gray-100 dark:bg-gray-700 dark:border-gray-600">
                <div class="title">Owner Details</div>
                <div class="subtitle opacity-60">Contact the owner of this congregation account.</div>
            </div>
            <div class="card-content px-8 py-6 flex justify-between">
                <div class="flex items-center">
                    <img
                        class="w-12 h-12 rounded-full object-cover"
                        :src="$page.props.team.owner.profile_photo_url"
                        :alt="$page.props.team.owner.name"
                    />
                    <div class="info flex flex-col ml-4 text-xxs text-gray-300 uppercase font-bold">
                        <span>{{ $page.props.team.owner.name }}</span>
                        <span class="opacity-60">{{ $page.props.team.owner.email }}</span>
                    </div>
                </div>
                <div class="options">
                    <a
                        :href="'mailto:' + $page.props.team.owner.email"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                    >
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {};
</script>
