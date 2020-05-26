<template>
  <div>
    <page-title
      :title="$t('upload')"
      :text="$t('upload_introduction')"
    ></page-title>
    <create-form :user="user"></create-form>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  middleware: "auth",

  computed: mapGetters({
    user: "auth/user"
  }),

  metaInfo() {
    return { title: this.$t("upload") };
  }
};
</script>
