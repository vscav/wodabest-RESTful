<template>
  <div>
    <page-title
      :title="$t('game')"
      :text="$t('game_introduction')"
    ></page-title>
    <game-view></game-view>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("game") };
  }
};
</script>
