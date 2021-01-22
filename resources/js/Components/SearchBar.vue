<template>
    <div class="relative flex-1">
        <div class="search flex flex-1 justify-center items-center text-gray-300 font-normal h-full relative border-r border-solid border-gray-200">
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
                @keydown.enter.prevent="goToProfile(null)"
                ref="search"
                type="text"
                class="bg-transparent h-full w-full px-16 text-sm focus:outline-none text-gray-400 placeholder-gray-300 focus:border-indigo-600 focus:border-solid focus:border-b-2"
                placeholder='Search Territories  ( Type " / " To Focus )'
            />
        </div>
        <div
            @mousedown.prevent="visible = true"
            v-if="query.length > 0 && visible"
            class="search-results w-full flex flex-col bg-gray-900 border border-solid border-gray-700 bottom-0 left-0 text-sm text-white z-50"
        >
            <template v-if="results">
                <a
                    :class="{ 'bg-gray-800': highlight === index }"
                    class="result w-full flex justify-between items-center px-8 py-3 border-b border-solid border-gray-700 hover:bg-gray-800 cursor-pointer"
                    v-for="(star, index) in results"
                    :key="index"
                    @click.prevent="goToProfile(star.id)"
                    @mousedown.prevent="visible = true"
                >
                    <div class="avatar h-16 w-16 bg-contain rounded-full" :style="`background-image: url(${star.avatar})`"></div>
                    <div class="info text-sm flex-1 ml-8">
                        <div class="flex justify-between">
                            <span class="text-gray-500">#{{ star.categories[0].name }}</span>
                            <span class="text-indigo-600">{{ star.price }}</span>
                        </div>
                        <div class="name text-white font-semibold">{{ star.name }}</div>
                    </div>
                </a>
            </template>
            <div class="result w-full h-16 flex justify-center items-center" v-else>
                <div class="name flex text-center">No hay resultados para '{{ query }}'</div>
            </div>
        </div>
    </div>
</template>

<script>
import SearchFocus from "./SearchFocus";
import _ from "lodash";

export default {
    components: { SearchFocus },
    data() {
        return { query: "", visible: false, results: null, highlight: 0 };
    },
    methods: {
        focusSearch(e) {
            if (e.key === "/") {
                this.$refs.search.focus();
            } else if (e.key === "Escape") {
                this.$refs.search.blur();
            }
        },
        softReset() {
            this.visible = true;
            this.results = null;
            this.highlight = 0;
        },
        goToProfile(id) {
            this.visible = false;
            this.$refs.search.blur();
            id ? this.$router.push(`/estrella/${id}`) : this.$router.push(`/estrella/${this.results[this.highlight].id}`);
        },
        highlightPrev() {
            if (this.highlight > 0) this.highlight--;
        },
        highlightNext() {
            if (this.highlight < this.results.length - 1) this.highlight++;
        },
        performSearch: _.debounce(function() {
            console.log(this.query);
            // axios.get(`/api/search/stars?query=${this.query}`).then(data => {
            //     this.results = data.data.data;
            // });
        }, 1000)
    }
};
</script>
