<template lang="">
    <div class="w-full h-full rounded-lg shadow-lg overflow-hidden bg-white">
        <l-map ref="map" :zoom="zoom" :center="center" :options="options" class="w-full h-full">
            <l-tile-layer :url="url" :options="options_tile" />
            <l-feature-group ref="editableLayer">
                <l-geo-json
                    ref="geojson"
                    :geojson="getAllCoordinates()"
                    :options="config"
                    :options-style="styles.purple"
                />
            </l-feature-group>
        </l-map>
    </div>
</template>
<script>
import { latLng } from "leaflet";
import LDraw from "leaflet-draw";
import "leaflet-draw/dist/leaflet.draw.css";
import { LMap, LTileLayer, LGeoJson, LFeatureGroup } from "vue2-leaflet";
import { MapMixin } from "@/Pages/Territories/Mixins/Map";

export default {
    mixins: [MapMixin],
    components: { LMap, LTileLayer, LGeoJson, LFeatureGroup },
    computed: {
        config() {
            return { onEachFeature: this.onEachFeatureFunction };
        },
        onEachFeatureFunction() {
            return (feature, layer) => {
                if (feature.properties.id == this.$page.props.territory.data.id) {
                    this.editableLayer.clearLayers();
                    this.options.zoomSnap = 1;
                    this.$refs.map.fitBounds(layer.getBounds());
                    this.editableLayer.addLayer(layer);
                    layer.setStyle(this.styles.green);
                } else {
                    layer.bindTooltip(feature.properties.code, {
                        permanent: true,
                        className: "map-label"
                    });
                    layer.on({
                        click: e => {
                            this.$inertia.visit(route("territories.map.show", e.target.feature.properties.id), {
                                method: "get",
                                preserveState: true,
                                onSuccess: page => {}
                            });
                        }
                    });
                }
            };
        },
        editableLayer() {
            return new window.L.FeatureGroup().addTo(this.$refs.map.mapObject);
        },
        drawControl() {
            return new window.L.Control.Draw({
                position: "topright",
                draw: {
                    polygon: {
                        allowIntersection: false
                    },
                    polyline: false,
                    circle: false,
                    rectangle: false,
                    marker: false,
                    circlemarker: false
                }
            });
        },
        editControl() {
            return new L.Control.Draw({
                position: "topright",
                draw: false,
                edit: {
                    featureGroup: this.editableLayer,
                    remove: true
                }
            });
        }
    },

    mounted() {
        this.$nextTick(() => {
            const map = this.$refs.map.mapObject;
            map.on(window.L.Draw.Event.CREATED, e => {
                let geojson = e.layer.toGeoJSON();
                if (geojson.geometry.coordinates[0]) {
                    this.saveCoordinates(geojson.geometry.coordinates);
                }
            });
            map.on(window.L.Draw.Event.EDITED, e => {
                let geojson = e.layers.toGeoJSON();
                if (geojson.features[0]) {
                    this.saveCoordinates(geojson.features[0].geometry.coordinates);
                }
            });
            map.on(window.L.Draw.Event.DELETED, e => {
                this.saveCoordinates(null);
            });
        });
    },

    updated() {
        if (this.$page.props.territory.data.coordinates) {
            this.$refs.map.mapObject.addControl(this.editControl);
            this.$refs.map.mapObject.removeControl(this.drawControl);
        } else {
            this.$refs.map.mapObject.addControl(this.drawControl);
            this.$refs.map.mapObject.removeControl(this.editControl);
        }
    },

    methods: {
        getAllCoordinates() {
            let data = {
                type: "FeatureCollection",
                features: []
            };

            this.$page.props.territories.data.cities.forEach(city => {
                city.territories.forEach(territory => {
                    if (territory.coordinates) {
                        data.features.push({
                            type: "Feature",
                            id: territory.id,
                            properties: { code: territory.code, id: territory.id },
                            geometry: {
                                type: "Polygon",
                                coordinates: JSON.parse(territory.coordinates)
                            }
                        });
                    }
                });
            });

            return data;
        },

        saveCoordinates(coordinates) {
            this.$inertia.put(
                route("territories.update.coordinates", this.$page.props.territory.data.id),
                { coordinates: coordinates ? JSON.stringify(coordinates) : null },
                {
                    preserveScroll: true,
                    onSuccess: page => {
                        this.$modal.hide("edit-territory");
                        this.$page.props.jetstream.flash = {
                            alertStyle: "success",
                            alert: coordinates ? "Territory Coordinates Saved" : "Territory Coordinates Deleted"
                        };
                    },
                    onError: page => {
                        this.$page.props.jetstream.flash = {
                            alertStyle: "danger",
                            alert: "Sorry, something went wrong"
                        };
                    }
                }
            );
        }
    }
};
</script>
