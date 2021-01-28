<template>
    <div class="content-container my-12 mx-16 w-full h-full">
        <div class="content bg-white shadow rounded-sm w-full h-full"></div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },

        data() {
            return {
                title: '',
                text: '',
                content: '',
            };
        },

        created() {
            this.dailyText();
        },

        methods: {
            dailyText() {
                const proxyurl = "https://cors-anywhere.herokuapp.com/";
                const date = this.getDate()
                console.log(date);
                axios.get(proxyurl + 'https://wol.jw.org/wol/dt/r1/lp-e/' + date)
                .then((response) => {
                    const doc = new DOMParser().parseFromString(response.data.items[0].content, "text/html");
                    this.title = doc.querySelector('#p71').innerHTML;
                    this.text = doc.querySelector('#p72').innerHTML;
                    this.content = doc.querySelector('#p73').innerHTML;
                });
            },

            getDate() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                return today = yyyy+'/'+mm+'/'+dd;
            }
        },
    }
</script>
