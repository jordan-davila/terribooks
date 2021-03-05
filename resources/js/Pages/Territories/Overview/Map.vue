<template lang="">
    <div class="w-full h-full rounded-lg shadow-lg overflow-hidden bg-white">
        <l-map ref="map" :zoom="zoom" :center="center" :options="options" class="w-full h-full">
            <l-tile-layer :url="url" :options="options_tile" />
            <l-geo-json
                ref="geojson"
                @ready="getBoundsJSON()"
                :geojson="getGeoJSONCoordinates()"
                :options-style="styles.purple"
            />
        </l-map>
    </div>
</template>
<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LGeoJson } from "vue2-leaflet";
import { MapMixin } from "@/Pages/Territories/Mixins/Map";

export default {
    mixins: [MapMixin],
    components: { LMap, LTileLayer, LGeoJson },

    updated() {
        this.getBoundsJSON();
    },

    methods: {
        getBoundsJSON(feature, layer) {
            this.$page.props.territory.data.coordinates && this.$refs.map.fitBounds(this.$refs.geojson.getBounds());
        },
        getGeoJSONCoordinates() {
            let json = JSON.parse(
                `{ "type": "FeatureCollection", "features": [ { "type": "Feature", "properties": {}, "geometry": { "type": "Polygon", "coordinates": ${
                    this.$page.props.territory.data.coordinates ? this.$page.props.territory.data.coordinates : "{}"
                } } } ] }`
            );
            return json;
        }
    }
};
</script>
