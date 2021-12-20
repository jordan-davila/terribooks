export const MapMixin = {
    data() {
        return {
            url:
                "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmVrb2t5b3lhIiwiYSI6ImNpajFybm12ejAwYm11OGx3bGU2dm40YnkifQ.TWrT0b6VeJatdyINpMeooQ",
            zoom: 14,
            center: [40.7717552, -74.19549],
            options: {
                zoomDelta: 0.25,
                zoomSnap: 0.75,
                attributionControl: false,
                zoomControl: false
            },
            options_tile: {
                id: this.$inertia.page.props.user.theme === "dark" ? "nekokyoya/ckb804r1x1tqc1ijzj1o4abkt" : "nekokyoya/cij1rocih00268ykqxc2j3ukq",
                tileSize: 512,
                zoomOffset: -1,
            },
            styles: {
                purple: {
                    fillColor: "#6366F1",
                    weight: 3,
                    opacity: 1,
                    color: "white",
                    dashArray: "3",
                    fillOpacity: 0.3
                },
                green: {
                    fillColor: "#6EE7B7",
                    weight: 3,
                    opacity: 1,
                    color: "white",
                    dashArray: "3",
                    fillOpacity: 0.3
                }
            }
        };
    }
};
