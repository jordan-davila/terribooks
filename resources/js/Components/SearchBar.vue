<template>
    <div class="relative flex-1">
        <div
            class="search flex flex-1 justify-center items-center text-gray-300 font-normal h-full relative border-r border-solid border-gray-200 dark:border-gray-600"
        >
            <SearchFocus @keyup="focusSearch"></SearchFocus>
            <i class="far fa-search absolute top-0 left-0 mt-6 ml-8"></i>
            <input
                v-model="query"
                @blur="visible = false"
                @focus="visible = true"
                @keydown.esc="visible = false"
                @keyup="performSearch"
                @input="softReset"
                @keydown.up.prevent="highlightPrev"
                @keydown.down.prevent="highlightNext"
                @keydown.enter.prevent="goToRoute(null)"
                ref="search"
                type="text"
                class="bg-white h-full w-full px-16 text-xs border-0 rounded-none focus:outline-none text-gray-400 placeholder-gray-300 focus:border-indigo-600 focus:border-solid focus:border-b-2 dark:bg-gray-800"
                placeholder='Search Territories  ( Type " / " To Focus )'
            />
        </div>
        <div
            id="search-picker-smooth-scroll"
            @mousedown.prevent="visible = true"
            v-show="query.length > 0 && visible == true"
            class="search-results w-full shadow-lg flex flex-col bg-white bottom-0 left-0 text-xxs text-gray-300 max-h-96 overflow-auto dark:bg-gray-700"
            style="z-index: 9999"
        >
            <template v-if="Object.keys(results).length > 0">
                <div class="scroll-container w-full pb-4">
                    <div
                        class="group pt-6 px-8 last:mb-6"
                        v-for="(group, type) in results"
                        :key="type"
                    >
                        <div class="search-group-title font-bold uppercase mb-4">{{ type }}</div>
                        <button
                            :id="'result-' + type + '-' + index"
                            class="result w-full flex justify-between items-center py-3 px-2 cursor-pointer"
                            @click.prevent="goToRoute(result)"
                            @mousedown.prevent="visible = true"
                            v-for="(result, index) in group"
                            :key="index"
                        >
                            <div class="flex w-full items-center justify-start">
                                <div
                                    :class="[
                                        highlight_index === index && currentType() === type
                                            ? 'bg-indigo-100 shadow-lg text-indigo-600 border-indigo-600 border dark:bg-slate-600 dark:text-gray-200'
                                            : 'bg-gray-100 text-gray-500 dark:bg-slate-600 dark:text-gray-300'
                                    ]"
                                    class="w-10 h-10 flex justify-center items-center text-xs rounded-lg font-bold mr-4"
                                >
                                    {{
                                        territoryCode(
                                            result.searchable.city_name,
                                            result.searchable.order
                                        )
                                    }}
                                </div>
                                <div
                                    class="info font-bold text-xxs text-gray-300 flex flex-col items-start justify-center"
                                >
                                    <template v-if="result.title == 'Field'">
                                        <div class="details">
                                            <span class="uppercase opacity-60">House Number: </span>
                                            <span>
                                                {{ result.searchable.number }}
                                            </span>
                                        </div>
                                        <div class="details">
                                            <span class="uppercase opacity-60">Street Name: </span>
                                            <span>
                                                {{ result.searchable.street_name }}
                                            </span>
                                        </div>
                                    </template>
                                    <template v-else-if="result.title == 'Phone'">
                                        <div class="details">
                                            <span class="uppercase opacity-60">Phone Number: </span>
                                            <span>
                                                {{ result.searchable.phone }}
                                            </span>
                                        </div>
                                        <div class="details">
                                            <span class="uppercase opacity-60">Street Name: </span>
                                            <span>
                                                {{ result.searchable.street_name }}
                                            </span>
                                        </div>
                                        <div class="details">
                                            <span class="uppercase opacity-60">Owner Name: </span>
                                            <span>
                                                {{ result.searchable.name }}
                                            </span>
                                        </div>
                                    </template>
                                    <template v-else-if="result.title == 'Street'">
                                        <div class="details">
                                            <span class="uppercase opacity-60">Street Name: </span>
                                            <span>
                                                {{ result.searchable.street_name }}
                                            </span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="link-icon text-xs text-gray-300">
                                <i class="fas fa-external-link"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </template>
            <div class="result w-full h-16 flex justify-center items-center text-xs" v-else>
                <div class="name flex text-center">No results for '{{ query }}'</div>
            </div>
        </div>
    </div>
</template>

<script>
import Scrollbar from "smooth-scrollbar";
import SearchFocus from "./SearchFocus";
import _ from "lodash";

export default {
    components: { SearchFocus },
    data() {
        return {
            query: "",
            visible: false,
            results: {},
            highlight_type: 0,
            highlight_index: 0
        };
    },

    mounted() {
        Scrollbar.init(document.querySelector("#search-picker-smooth-scroll"), {
            damping: 0.1,
            renderByPixels: true,
            alwaysShowTracks: false,
            continuousScrolling: true
        });
    },

    methods: {
        territoryCode(city_name, order) {
            return (
                city_name
                    .split(/\s/)
                    .reduce((response, word) => (response += word.slice(0, 1)), "") + order
            );
        },

        goToRoute(result) {
            result
                ? this.$inertia.get(
                      route(result.url, [
                          result.searchable.territory_id,
                          result.searchable.street_id
                      ]),
                      { preserveState: true }
                  )
                : this.$inertia.get(
                      route(this.results[this.currentType()][this.highlight_index].url, [
                          this.results[this.currentType()][this.highlight_index].searchable
                              .territory_id,
                          this.results[this.currentType()][this.highlight_index].searchable
                              .street_id
                      ]),
                      { preserveState: true }
                  );

            this.visible = false;
            this.$refs.search.blur();
        },

        focusSearch(e) {
            if (e.key === "/") {
                this.$refs.search.focus();
            } else if (e.key === "Escape") {
                this.$refs.search.blur();
            }
        },

        softReset() {
            this.visible = true;
            this.results = {};
            this.highlight_index = 0;
            this.highlight_type = 0;
        },

        currentType() {
            return Object.keys(this.results)[this.highlight_type];
        },

        highlightPrev() {
            if (this.highlight_index > 0) {
                this.highlight_index--;
                this.scrollToResult();
            } else if (this.highlight_type > 0) {
                this.highlight_type--;
                this.highlight_index = this.results[this.currentType()].length - 1;
                this.scrollToResult();
            }
        },

        highlightNext() {
            if (this.highlight_index < this.results[this.currentType()].length - 1) {
                this.highlight_index++;
                this.scrollToResult();
            } else if (this.highlight_type < _.size(this.results) - 1) {
                this.highlight_type++;
                this.highlight_index = 0;
                this.scrollToResult();
            }
        },

        scrollToResult() {
            let child = document.querySelector(
                "#result-" + this.currentType() + "-" + this.highlight_index
            );
            let scroll = Scrollbar.get(document.querySelector("#search-picker-smooth-scroll"));
            scroll.scrollTo(0, child.offsetTop - 200, 1000);
        },

        performSearch: _.debounce(function() {
            this.$inertia.get(
                route("search", {
                    team: this.$page.props.user.current_team
                }),
                { query: this.query },
                {
                    preserveState: true,
                    onSuccess: page => {
                        this.results = this.$page.props.search;
                    }
                }
            );
        }, 1000)
    }
};
</script>
