<template>
    <section class="app-container max-w-none flex flex-col relative">
        <TooSmall />
        <SupportUs />
        <header class="relative w-full">
            <div
                id="particlesJs"
                class="slide-up-particles absolute top-0 left-0 w-full block z-0"
                style="height: 150vh"
            ></div>
            <nav class="flex relative z-10 justify-between w-full h-16 py-4 px-16 text-gray-700">
                <div class="flex items-center h-16">
                    <div class="logo-container flex items-center h-full">
                        <div class=" h-full flex justify-center items-center">
                            <Logo class="w-4" />
                        </div>
                        <inertia-link
                            :href="route('welcome')"
                            class="flex justify-between items-center text-gray-900 font-bold h-full pl-2 mr-4"
                        >
                            <div class="logo text-lg">terri<span class="text-indigo-600">books</span></div>
                        </inertia-link>
                    </div>
                    <div class="menu flex text-xxs cursor-pointer h-full">
                        <inertia-link
                            class="h-full flex items-center px-4 uppercase font-bold"
                            :href="route('welcome')"
                        >
                            Home
                        </inertia-link>
                        <a
                            class="h-full flex items-center px-4 uppercase font-bold"
                            @click.prevent="$modal.show('support-us')"
                        >
                            Support Us
                        </a>
                        <a class="h-full flex items-center px-4 uppercase font-bold" href="mailto:info@terribooks.com">
                            Contact Us
                        </a>
                        <a class="h-full flex items-center px-4 uppercase font-bold" href="/docs">
                            Docs
                        </a>
                    </div>
                </div>
                <div class="login-register h-16 flex items-center">
                    <inertia-link
                        :href="route('login')"
                        class="text-xxs font-bold px-4 py-2 text-indigo-600 uppercase hover:opacity-90 transition ease-in-out duration-150 mr-2"
                        v-if="!$page.props.user"
                    >
                        Login
                    </inertia-link>
                    <inertia-link
                        :href="route('register')"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                        v-if="!$page.props.user"
                    >
                        Register
                    </inertia-link>
                    <inertia-link
                        :href="route('dashboard')"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                        v-if="$page.props.user"
                    >
                        Dashboard
                    </inertia-link>
                </div>
            </nav>
            <div class="headline relative z-10 bg-transparent h-full py-24 flex flex-col items-center justify-center">
                <div class="font-bold text-gray-800 text-6xl text-center mb-16">
                    We made territory<br />management simple
                </div>
                <div class="font-bold text-gray-300 uppercase text-base text-center mb-6">
                    No long training needed, ready to start within seconds
                </div>
                <inertia-link
                    :href="route('register')"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                >
                    Try it now
                </inertia-link>
            </div>
            <div class="mac-app-container relative z-10">
                <img src="/images/home-mac-terribooks.png" />
            </div>
        </header>
        <section id="features" class="features-container w-full bg-gray-50 p-8">
            <div class="rounded-lg bg-indigo-600 w-full h-full flex items-center justify-center px-24 py-24">
                <div class="image w-96 mr-16">
                    <img src="/images/map.svg" alt="" />
                </div>
                <div class="info w-96">
                    <div class="text-white text-4xl mb-4 font-bold">Features & Tools</div>
                    <div class="text-indigo-200 text-lg mb-4">
                        A system that comes packed with all the necesary tools needed to maintain and organize
                        territories.
                    </div>
                    <div class="list text-sm font-medium text-indigo-200">
                        <div class="item mb-2">
                            <i class="fas fa-check mr-2 text-white"></i>
                            <span>Field, Phone and Business List Editor</span>
                        </div>
                        <div class="item mb-2">
                            <i class="fas fa-check mr-2 text-white"></i>
                            <span>Create and Print Map Cards</span>
                        </div>
                        <div class="item mb-2">
                            <i class="fas fa-check mr-2 text-white"></i>
                            <span>Territrory Assignment System</span>
                        </div>
                        <div class="item mb-2">
                            <i class="fas fa-check mr-2 text-white"></i>
                            <span>Invite Users to Manage your Territories</span>
                        </div>
                        <div class="item mb-2">
                            <i class="fas fa-check mr-2 text-white"></i>
                            <span>Export and Print System</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="get-started w-full bg-gray-50 p-8 relative">
            <div
                id="particlesJs-Bottom"
                class="slide-up-particles absolute top-0 left-0 w-full block z-0"
                style="height: 125vh"
            ></div>
            <div class="headline relative z-10 bg-transparent h-full py-32 flex flex-col items-center justify-center">
                <div class="font-bold text-gray-800 text-6xl text-center mb-16">
                    Ready to Start?
                </div>
                <div class="font-bold text-gray-300 text-2xl text-center mb-8">
                    Be among the first users and register today!
                </div>
                <inertia-link
                    :href="route('register')"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                >
                    Try it now
                </inertia-link>
            </div>
        </section>
        <section class="support-us w-full bg-gray-50 px-8 pt-8 pb-4 z-10">
            <div class="rounded-lg bg-gray-200 w-full h-full flex items-center justify-between px-16 py-8">
                <div class="flex">
                    <div class="icon w-12 h-12 flex items-center justify-center bg-white shadow-lg rounded-lg mr-4">
                        <i class="text-lg text-gray-800 fas fa-heart"></i>
                    </div>
                    <div class="support-info text-gray-500 font-bold flex flex-col items-start justify-center">
                        <span>Help us keep this tool alive and running.</span>
                        <button
                            @click="$modal.show('support-us')"
                            class="text-gray-600 font-bold hover:text-indigo-600"
                        >
                            Click here to learn more about our operation costs.
                        </button>
                    </div>
                </div>
                <a
                    href="https://www.paypal.com/donate?hosted_button_id=8EXRUWZT4UAJJ"
                    target="_blank"
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-bold text-xxs text-white uppercase hover:opacity-90 transition ease-in-out duration-150"
                    >Support Us</a
                >
            </div>
        </section>
        <section class="support-us w-full bg-gray-50 px-8 pb-8 z-10">
            <div class="rounded-lg bg-gray-800 w-full h-72 flex items-center justify-between px-16 py-8">
                <div class="flex flex-col justify-start items-start">
                    <div class="logo-container flex items-center h-full mb-2">
                        <inertia-link
                            :href="route('welcome')"
                            class="flex justify-between items-center text-gray-200 font-bold h-full"
                        >
                            <div class="logo text-lg">terri<span class="text-indigo-600">books</span></div>
                        </inertia-link>
                    </div>
                    <div class="slogan text-gray-300 font-bold text-sm mb-24">
                        Territory<br />Management<br />Made Simple
                    </div>
                    <div class="copyrights text-gray-100 font-bold text-sm">
                        Copyright © {{ new Date().getFullYear() }} Terribooks. All Rights Reserved
                    </div>
                </div>
                <div class="flex justify-end items-start text-sm font-bold text-gray-300 h-full">
                    <div class="flex flex-col mr-12">
                        <div class="col-title text-white mb-2">Links</div>
                        <inertia-link :href="route('welcome')" class="mb-2 hover:text-indigo-600">Home</inertia-link>
                        <a href="#features" class="mb-2 hover:text-indigo-600">Features</a>
                        <inertia-link :href="route('login')" class="mb-2 hover:text-indigo-600">Login</inertia-link>
                        <inertia-link :href="route('register')" class="mb-2 hover:text-indigo-600"
                            >Register</inertia-link
                        >
                    </div>
                    <div class="flex flex-col mr-12">
                        <div class="col-title text-white mb-2">Resoureces</div>
                        <a href="#" class="mb-2 hover:text-indigo-600">Documentation</a>
                        <a href="#" class="mb-2 hover:text-indigo-600">Quick Start guide</a>
                        <a href="#" class="mb-2 hover:text-indigo-600">Changelog</a>
                    </div>
                    <div class="flex flex-col h-full">
                        <div class="col-title text-white mb-2">Company</div>
                        <inertia-link :href="route('terms.show')" class="mb-2 hover:text-indigo-600"
                            >Terms of Services</inertia-link
                        >
                        <inertia-link :href="route('policy.show')" class="mb-2 hover:text-indigo-600"
                            >Privacy Policy</inertia-link
                        >
                        <a href="#" class="mb-2 hover:text-indigo-600">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
import Logo from "@/Components/Logo";
import { Config } from "@/Mixins/Config";
import TooSmall from "@/Pages/TooSmall";
import SupportUs from "@/Modals/SupportUs";
import "particles.js";

export default {
    components: { Logo, TooSmall, SupportUs },
    mixins: [Config],
    mounted() {
        window.particlesJS("particlesJs", this.particleParams);
        window.particlesJS("particlesJs-Bottom", this.particleParams);
    }
};
</script>
