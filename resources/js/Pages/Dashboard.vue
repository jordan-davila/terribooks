<template>
    <AppLayout>
        <template v-slot:navsub>
            <Copyright />
        </template>
        <div class="content-container flex w-full h-full overflow-hidden relative">
            <!-- Territory Picker -->
            <div
                style="flex: 0 36rem;"
                class="star-info flex flex-col h-full border-r border-gray-200 border-solid bg-white dark:bg-gray-800 py-12 px-16 dark:border-gray-600"
            >
                <div class="uppercase font-bold text-xxs text-gray-300 mb-2">
                    Dashboard ·
                    <template v-if="$page.props.user.current_team">
                        {{ $page.props.user.current_team.name }}
                    </template>
                </div>
                <h1 class="font-black text-gray-700 text-4xl mb-4 dark:text-indigo-500">
                    Welcome, <br />
                    {{ user.name }}
                </h1>
                <div class="flex card-container mb-8">
                    <div
                        class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 mr-4 justify-center items-center dark:bg-gray-700"
                    >
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">Territories</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center dark:bg-gray-600">
                            <span class="text-gray-400 font-semibold text-lg dark:text-gray-200">
                                <template v-if="$page.props.territories">
                                    {{ $page.props.territories.data.territory_count }}
                                </template>
                                <template v-else>
                                    0
                                </template>
                            </span>
                        </div>
                    </div>
                    <div
                        class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 mr-4 justify-center items-center dark:bg-gray-700"
                    >
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">Congregations</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center dark:bg-gray-600">
                            <span class="text-gray-400 font-semibold text-lg dark:text-gray-200">
                                {{ Object.keys($page.props.user.all_teams).length }}
                            </span>
                        </div>
                    </div>
                    <div class="cards flex flex-col rounded-lg bg-gray-100 w-32 h-32 p-4 justify-center items-center dark:bg-gray-700">
                        <div class="uppercase font-bold text-xxs text-gray-400 mb-2 dark:text-gray-300">Users</div>
                        <div class="circle rounded-full bg-white w-16 h-16 flex justify-center items-center dark:bg-gray-600">
                            <span class="text-gray-400 font-semibold text-lg dark:text-gray-200">
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
                    <template v-if="$page.props.user.current_team">
                        <inertia-link
                            :href="route('teams.show', [$page.props.user.current_team.id])"
                            target="_blank"
                            class="mb-3 inline-flex"
                        >
                            <i class="fas fa-link mr-2"></i>
                            <span class="text-gray-400">Update Congregation Details</span>
                        </inertia-link>
                    </template>
                    <inertia-link :href="route('dashboard')" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">Documentation</span>
                    </inertia-link>
                    <a href="https://wol.jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-gray-400">SOURCE CODE</span>
                    </a>
                    <a href="https://wol.jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-indigo-600 dark:text-indigo-500 dark:font-bold">Watchtower Online Library</span>
                    </a>
                    <a href="https://jw.org/en/" target="_blank" class="mb-3 inline-flex">
                        <i class="fas fa-link mr-2"></i> <span class="text-indigo-600 dark:text-indigo-500 dark:font-bold">JW.ORG</span>
                    </a>
                </div>
            </div>
            <div class="flex flex-1 relative py-8 px-14 overflow-hidden">
                <div class="daily-text flex-auto h-full bg-gray-50 p-10 shadow-lg rounded-lg dark:bg-gray-800">
                    <div class="uppercase font-bold text-xxs text-gray-300 mb-2">
                        Daily Text
                    </div>
                    <h1 class="title font-black text-gray-700 text-3xl mb-4 dark:text-gray-500" v-html="title"></h1>
                    <div class="font-regular text-gray-400 text-sm mb-4 dark:text-gray-300" v-html="text"></div>
                    <div class="font-regular text-gray-400 text-sm leading-6 dark:text-gray-300" v-html="content"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
import Copyright from "@/Components/Copyright";

export default {
    props: ["user"],
    components: {
        AppLayout,
        JetApplicationLogo,
        Copyright
    },

    data() {
        return {
            title: "Monday, January&nbsp;25",
            text:
                '<em>They all became filled with holy spirit and started to speak in different languages.​—</em><a href="/wol/bc/r1/lp-e/1102021400/79/0" data-bid="80-1" class="b"><em>Acts 2:4</em></a><em>.</em>',
            content:
                'If you were one of the disciples gathered in the upper room at Pentecost 33&nbsp;C.E., there would be no question in your mind that you were anointed by holy spirit. (<a href="/wol/bc/r1/lp-e/1102021400/80/0" data-bid="81-1" class="b">Acts 2:5-12</a>) But do all those who are anointed by holy spirit receive their anointing in some spectacular manner and at the same time in their life? No. Consider the matter of timing. That group of about 120 Christians were not the only ones anointed by holy spirit on that day. Later that day, about 3,000 others also received the promised holy spirit. Their anointing occurred when they got baptized. (<a href="/wol/bc/r1/lp-e/1102021400/81/0" data-bid="82-1" class="b">Acts 2:37, 38,</a><a href="/wol/bc/r1/lp-e/1102021400/81/1" data-bid="82-2" class="b">&nbsp;41</a>) But in the years that followed, not all anointed Christians received their anointing at their baptism. The Samaritans received their anointing sometime after their baptism. (<a href="/wol/bc/r1/lp-e/1102021400/82/0" data-bid="83-1" class="b">Acts 8:14-17</a>) And in what certainly was an exceptional instance, Cornelius and his household were anointed even before they got baptized.​—<a href="/wol/bc/r1/lp-e/1102021400/83/0" data-bid="84-1" class="b">Acts 10:44-48</a>. <a href="/wol/pc/r1/lp-e/1102021400/24/0"><em>w20.01 </em>20-21 ¶2-4</a>'
        };
    },

    created() {
        this.dailyText();
    },

    methods: {
        dailyText() {
            // const proxyurl = "https://cors-anywhere.herokuapp.com/";
            const proxyurl = "https://cors.terribooks.com/";
            const date = this.getDate();
            axios
                .get(proxyurl + "https://wol.jw.org/wol/dt/r1/lp-e/" + date)
                .then(response => {
                    const doc = new DOMParser().parseFromString(response.data.items[0].content, "text/html");
                    const data = doc.querySelectorAll("[data-pid]");
                    this.title = data[0].innerHTML;
                    this.text = data[1].innerHTML;
                    this.content = data[2].innerHTML;
                })
                .then(() => {
                    this.fixLinks();
                });
        },

        getDate() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            return (today = yyyy + "/" + mm + "/" + dd);
        },

        fixLinks() {
            let text = new DOMParser().parseFromString(this.text, "text/html");
            let content = new DOMParser().parseFromString(this.content, "text/html");
            [...content.querySelectorAll("a"), ...text.querySelectorAll("a")].forEach(link => {
                let _href = link.getAttribute("href");
                link.setAttribute("href", "https://wol.jw.org/en" + _href);
                link.setAttribute("target", "_blank");
            });

            this.text = text.querySelector("body").innerHTML;
            this.content = content.querySelector("body").innerHTML;
        }
    }
};
</script>
