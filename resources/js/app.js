require("./bootstrap");

// Import modules...
import Vue from "vue";
import { App as InertiaApp, plugin as InertiaPlugin } from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";
import VModal from "vue-js-modal";

// Import CSS for Plugins
import "leaflet/dist/leaflet.css";
// import "vue-js-modal/dist/styles.css";

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VModal);

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
