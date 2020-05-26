<template>
      <div class="container">
        <div class="row pt-2">
          <ul
            class="col container-filter list-unstyled categories-filter text-center mb-0"
          >
            <li class="list-inline-item">
              <a
              @click="changeFilter('all')"
                :class="{ active: filter == 'all' }"
                class="categories d-block text-muted rounded"
                >{{ $t('all') }}</a
              >
            </li>
            <li v-for="category in allCategories"
          :key="category.slug" class="list-inline-item">
              <a
                @click="changeFilter(category.slug)"
                :class="{ active: filter == category.slug }"
                class="categories d-block text-muted rounded"
                >{{ $t(category.slug) }}</a
              >
            </li>
          </ul>
        </div>
      </div>
</template>

<script>
export default {
  name: "v-filter",

  props: {
    type: String
  },

  computed: {
    filter() {
      return this.switchFilterFromType(this.type);
    },
    allCategories() {
      return this.$store.getters["categories/allCategories"];
    }
  },

  created() {
    this.$store.dispatch("categories/retrieveCategories");
  },

  methods: {
    changeFilter(filter) {
      this.$store.dispatch(this.type + "/updateFilter", filter);
      this.$store.dispatch("projects/defaultShow");
    },
    switchFilterFromType(type) {
      const Types = {
        projects: this.$store.state.projects.filter,
        games: this.$store.state.games.filter,
        ranking: this.$store.state.ranking.filter
      };
      return Types[type];
    }
  }
};
</script>