<template>
    <AppLayout>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <div class="flex flex-1 justify-center items-center relative p-14">
                <div
                    class="flex flex-col p-8 relative text-xxs w-96 bg-white rounded-lg shadow-lg uppercase text-gray-300"
                >
                    <div class="font-bold text-sm mb-4">
                        Before you can manage your territories, please create a new congregation or join one.
                    </div>
                    <div class="font-bold text-xxs mb-2">Create A New Congregation</div>
                    <p class="mb-4">
                        To create a new congregation, go to <b class="font-bold">Congregations</b> >
                        <b class="font-bold">Create Congregation</b>
                        or click on the following link:
                        <button @click="$modal.show('add-congregation')" class="text-indigo-600 uppercase font-bold">
                            Create Congregation
                        </button>
                    </p>
                    <div class="font-bold text-xxs mb-2">Create A New Congregation</div>
                    <p>
                        To join a congregation, please ask the bother in charge of the territories to send you an invite
                        under <b class="font-bold">Congregations</b> > <b class="font-bold">Congregation Settings</b> >
                        <b class="font-bold">Invite Members</b>. <br /><br />
                        As soon as the invitation has been made, you should receive an email with a link to join your
                        congregation.
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import TerritoryPicker from "@/Pages/Territories/Components/TerritoryPicker";
export default {
    props: ["territory", "territories"],
    components: {
        AppLayout,
        TerritoryPicker
    }
};
</script>
