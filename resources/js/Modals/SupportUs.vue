<template>
    <modal name="support-us" draggable width="430px" height="auto" classes="rounded-lg bg-gray-900 shadow-lg">
        <div
            class="modal-title text-xxs text-gray-300 uppercase w-full px-8 py-6 font-bold border-b border-gray-100 flex items-center justify-between"
        >
            <div class="title flex items-center">
                <div
                    class="icon bg-indigo-100 rounded-lg w-8 h-8 text-indigo-600 text-xs flex items-center justify-center mr-4"
                >
                    <i class="far fa-globe-americas"></i>
                </div>
                <div class="flex flex-col">
                    <div class="title">Support Us</div>
                    <div class="subtitle opacity-60">
                        Thank you for considering making<br />
                        a donation to Terribooks
                    </div>
                </div>
            </div>
            <button @click="$modal.hide('support-us')" class="text-sm opacity-60 ml-6">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="content px-8 py-6 text-gray-300 text-xxs font-bold uppercase">
            <div class="input-row mb-3">
                <div class="input-col">
                    <div class="info mb-2">
                        Many services are brought together in order to deliver the nessessary functionality of
                        Terribooks. This includes hosting, map providers, geocoding and e-mail services, all of which
                        are beyond the volunteer services that go into creating and maintaining Terribooks.
                    </div>
                    <div class="info">
                        Just a small donation of any amount can help us keep Terribooks.com running. Thank you.
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-options bg-gray-50 rounded-b-lg w-full py-6 px-8 flex justify-end items-center text-gray-300">
            <a
                href="https://www.paypal.com/donate?hosted_button_id=8EXRUWZT4UAJJ"
                target="_blank"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
            >
                Donate with Paypal
            </a>
        </div>
    </modal>
</template>
<script>
export default {};
</script>
