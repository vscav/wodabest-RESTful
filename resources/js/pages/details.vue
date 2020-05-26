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
              class="img-fluid rounded"
              alt=""
            />
          </div>
          <details-view v-if="project !== undefined" :project="project"></details-view>
          <!--<div class="col-lg-6 col-md-6 col-12 order-md-2 order-1">
            <div class="work-details rounded shadow-large p-4">
              <h5 class="title border-bottom pb-3 mb-3">Project details :</h5>
              <dl class="row mb-0">
                <dt class="col-md-4 col-5">Author :</dt>
                <dd class="col-md-8 col-7 text-muted">{{ project.user_id }}</dd>

                <dt class="col-md-4 col-5">Category :</dt>
                <dd class="col-md-8 col-7 text-muted">
                  {{ project.category_id }}
                </dd>

                <dt class="col-md-4 col-5">Date :</dt>
                <dd class="col-md-8 col-7 text-muted">
                  {{ project.updated_at }}
                </dd>

                <dt class="col-md-4 col-5">Score :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                  {{ project.score }}
                </dd>

                <dt class="col-md-4 col-5">Matchs joués :</dt>
                <dd class="col-md-8 col-7 text-muted">
                  {{ project.losses + project.wins }}
                </dd>

                <dt class="col-md-4 col-5">Victoires :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                  {{ project.wins }}
                </dd>

                <dt class="col-md-4 col-5">Défaites :</dt>
                <dd class="col-md-8 col-7 mb-0 text-muted">
                  {{ project.losses }}
                </dd>
              </dl>
            </div>
            <div class="mt-4 pt-2">
              <p class="text-muted mb-0">" {{ project.description }} "</p>
            </div>
          </div>-->
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
