<template>
  <div class="container">
    <div class="row pt-2">
      <ul
        class="col container-filter list-unstyled categories-filter text-center mb-0"
      >
        <li class="list-inline-item">
          <a
            :class="{ active: filter == false }"
            @click="changeUserFilter(false)"
            class="categories d-block text-muted rounded"
            >{{ $t('all') }}</a
          >
        </li>
        <li class="list-inline-item">
          <a
            :class="{ active: filter == true }"
            @click="changeUserFilter(true)"
            class="categories d-block text-muted rounded"
            >{{ $t('yours') }}</a
          >
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "auth-filter",

  computed: {
    filter() {
      return this.$store.state.projects.userFilter;
    }
  },

  methods: {
    changeUserFilter(filter) {
      this.$store.dispatch("projects/updateUserFilter", filter);
      this.$store.dispatch("projects/defaultShow");
    }
  }
};
</script>
