<template>
  <div>
    <page-title
      :title="$t('leaderboard')"
      :text="$t('ranking_introduction')"
      :information="$t('green_badge')"
    ></page-title>
    <ranked-projects-list></ranked-projects-list>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("leaderboard") };
  }
};
</script>
