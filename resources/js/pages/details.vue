<template>
    <div>
        <page-title :title="project.title"></page-title>
        <section class="section">
            <div class="container">
                <div class="row">
                    <div
                        class="col-lg-6 col-md-6 col-12 order-md-1 order-2 mt-4 mt-sm-0 pt-2 pt-sm-0"
                    >
                        <img
                            :src="'/img/upload/' + project.filename"
                            :alt="project.description"
                            class="img-fluid rounded"
                        />
                    </div>
                    <details-view
                        v-if="project !== undefined"
                        :project="project"
                    ></details-view>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    middleware: "auth",

    created() {
        this.$store.dispatch("projects/retrieveProject", this.$route.params.id);
    },

    computed: {
        project() {
            return this.$store.getters["projects/project"];
        }
    },

    metaInfo() {
        return { title: this.$t("project") };
    }
};
</script>
