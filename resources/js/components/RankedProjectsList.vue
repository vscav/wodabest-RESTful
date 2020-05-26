<template>
    <div class="container table">
        <v-filter type="ranking"></v-filter>
        <div class="row mt-4">
            <div class="col">
                <div class="card shadow-large">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ $t("rank") }}</th>
                                    <th scope="col">{{ $t("project") }}</th>
                                    <th scope="col">{{ $t("editing") }}</th>
                                    <th scope="col">{{ $t("score") }}</th>
                                    <th scope="col">{{ $t("wins") }}</th>
                                    <th scope="col">{{ $t("losses") }}</th>
                                    <th scope="col">
                                        {{ $t("victory_ratio") }}
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <ranked-project-item
                                    v-for="(project, index) in topProjects"
                                    :index="index"
                                    :key="project.id"
                                    :project="project"
                                />
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ranked-projects-list",

    created() {
        this.$store.dispatch("users/retrieveUsers");
        this.$store.dispatch("ranking/retrieveTopProjects");
    },

    computed: {
        count() {
            return this.$store.getters["ranking/count"];
        },
        topProjects() {
            return this.$store.getters["ranking/topProjects"];
        }
    }
};
</script>

<style></style>
