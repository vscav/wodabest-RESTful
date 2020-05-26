<template>
    <div class="container">
        <div class="row pt-2">
            <div class="offset-md-3 col-12 col-md-6">
                <div class="form-group position-relative">
                    <input
                        :placeholder="$t('search_by_keywords')"
                        v-model="search"
                        class="form-control"
                        type="text"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "search-bar",

    data: () => ({
        search: ""
    }),

    watch: {
        search: function() {
            this.$store.dispatch("projects/updateKeywords", this.search);
        }
    }
};
</script>
