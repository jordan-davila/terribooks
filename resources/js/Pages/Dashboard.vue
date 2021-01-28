<template>
    <AppLayout>
        <template v-slot:navsub>
            <nav class="flex flex-col justify-end h-full w-16 bg-white border-r border-gray-200 border-solid overflow-hidden text-gray-300 text-xs">
                <inertia-link :href="route('policy.show')" class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400">
                    Privacy & Policy
                </inertia-link>
                <inertia-link :href="route('terms.show')" class="section text-vertical w-full py-6 flex flex-col justify-center items-center border-l-2 border-white border-solid hover:border-indigo-600 hover:text-gray-400">
                    Terms & Conditions
                </inertia-link>
                <div class="section text-vertical w-full py-6 flex flex-col justify-center items-center">
                    Copyright © {{ new Date().getFullYear() }} Terribooks. All Rights Reserved
                </div>
            </nav>
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
        <!-- Territory Picker -->
            <div style="flex: 0 36rem;" class="star-info flex flex-col h-full border-r border-gray-200 border-solid bg-white py-12 px-16">
                <div class="uppercase font-bold text-xxs text-gray-300 mb-2">
                    Dashboard  ·  {{ $page.props.user.current_team.name }}
                </div>
                <h1 class="font-black text-gray-700 text-4xl mb-4">
                    Welcome, <br/> {{ user.name }}
                </h1>
                <div class="flex card-container mb-8">
                    <div class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 mr-4 justify-center items-center">
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2">Territories</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center">
                            <span class="text-gray-400 font-semibold text-lg">{{ $page.props.territories.data.territory_count }}</span>
                        </div>
                    </div>
                    <div class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 mr-4 justify-center items-center">
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2">Congregations</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center">
                            <span class="text-gray-400 font-semibold text-lg">{{ user.all_teams.length }}</span>
                        </div>
                    </div>
                    <div class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 justify-center items-center">
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2">Users</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center">
                            <span class="text-gray-400 font-semibold text-lg">
                                <!-- *TODO* Add get_all_users_in_team function -->
                                2
                            </span>
                        </div>
                    </div>
                </div>
                <div class="uppercase font-bold text-xxs text-gray-300 mb-4">Quick Links</div>
                <div class="quick-links text-xs flex flex-col uppercase text-gray-400">
                    <inertia-link :href="route('profile.show')" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">Update Profile</span>
                    </inertia-link>
                    <inertia-link :href="route('teams.show', [$page.props.user.current_team.id])" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">Update Congregation Details</span>
                    </inertia-link>
                    <inertia-link :href="route('dashboard')" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">Documentation</span>
                    </inertia-link>
                    <a href="https://wol.jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">SOURCE CODE</span>
                    </a>
                    <a href="https://wol.jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-indigo-600">Watchtower Online Library</span>
                    </a>
                    <a href="https://jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-indigo-600">JW.ORG</span>
                    </a>
                </div>
            </div>
            <div class="flex flex-1 relative py-8 px-14 overflow-hidden">
                <div class="daily-text flex-auto h-full bg-gray-50 p-10 shadow-lg rounded-lg">
                    <div class="uppercase font-bold text-xxs text-gray-300 mb-2">
                        Daily Text
                    </div>
                    <h1 class="title font-black text-gray-700 text-3xl mb-4" v-html="title"></h1>
                    <div class="font-regular text-gray-400 text-sm mb-4" v-html="text"></div>
                    <div class="font-regular text-gray-400 text-sm leading-6" v-html="content"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        props: ['user'],
        components: {
            AppLayout,
            JetApplicationLogo,
        },

        data() {
            return {
                title: 'Monday, January&nbsp;25',
                text: '<em>They all became filled with holy spirit and started to speak in different languages.​—</em><a href="/wol/bc/r1/lp-e/1102021400/79/0" data-bid="80-1" class="b"><em>Acts 2:4</em></a><em>.</em>',
                content: 'If you were one of the disciples gathered in the upper room at Pentecost 33&nbsp;C.E., there would be no question in your mind that you were anointed by holy spirit. (<a href="/wol/bc/r1/lp-e/1102021400/80/0" data-bid="81-1" class="b">Acts 2:5-12</a>) But do all those who are anointed by holy spirit receive their anointing in some spectacular manner and at the same time in their life? No. Consider the matter of timing. That group of about 120 Christians were not the only ones anointed by holy spirit on that day. Later that day, about 3,000 others also received the promised holy spirit. Their anointing occurred when they got baptized. (<a href="/wol/bc/r1/lp-e/1102021400/81/0" data-bid="82-1" class="b">Acts 2:37, 38,</a><a href="/wol/bc/r1/lp-e/1102021400/81/1" data-bid="82-2" class="b">&nbsp;41</a>) But in the years that followed, not all anointed Christians received their anointing at their baptism. The Samaritans received their anointing sometime after their baptism. (<a href="/wol/bc/r1/lp-e/1102021400/82/0" data-bid="83-1" class="b">Acts 8:14-17</a>) And in what certainly was an exceptional instance, Cornelius and his household were anointed even before they got baptized.​—<a href="/wol/bc/r1/lp-e/1102021400/83/0" data-bid="84-1" class="b">Acts 10:44-48</a>. <a href="/wol/pc/r1/lp-e/1102021400/24/0"><em>w20.01 </em>20-21 ¶2-4</a>',
            };
        },

        created() {
            this.dailyText();
            this.fixLinks();
        },

        methods: {
            dailyText() {
                const proxyurl = "https://cors-anywhere.herokuapp.com/";
                const date = this.getDate()
                axios.get(proxyurl + 'https://wol.jw.org/wol/dt/r1/lp-e/' + date)
                .then((response) => {
                    const doc = new DOMParser().parseFromString(response.data.items[0].content, "text/html");
                    const data = doc.querySelectorAll("[data-pid]");
                    this.title = data[0].innerHTML;
                    this.text = data[1].innerHTML;
                    this.content = data[2].innerHTML;
                });
            },

            getDate() {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                return today = yyyy+'/'+mm+'/'+dd;
            },

            fixLinks() {
                let text = new DOMParser().parseFromString(this.text, "text/html");
                let content = new DOMParser().parseFromString(this.content, "text/html");
                [...content.querySelectorAll('a'), ...text.querySelectorAll('a')].forEach((link) => {
                    let _href = link.getAttribute("href");
                    link.setAttribute("href", "https://wol.jw.org/en" + _href);
                    link.setAttribute("target", "_blank");
                });

                this.text = text.querySelector('body').innerHTML
                this.content = content.querySelector('body').innerHTML
            }
        },
    }
</script>
