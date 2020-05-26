<template>
  <div>
    <page-title
      :title="$t('gallery')"
      :text="$t('gallery_introduction')"
    ></page-title>
    <projects-list></projects-list>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("gallery") };
  }
};
</script>
