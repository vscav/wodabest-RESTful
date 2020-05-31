<template>
    <div class="container table">
        <v-filter type="ranking"></v-filter>
        <div class="row mt-4">
            <div class="col">
                <div v-if="loading" class="container text-center mt-5 mb-5">
                    <loader />
                </div>
                <div v-else class="card shadow-large">
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
import axios from "axios";

export default {
    name: "ranked-projects-list",

    data: function() {
        return {
            loading: true
        };
    },

    created() {
        this.$store.dispatch("users/retrieveUsers");
        this.retrieveTopProjects();
    },

    computed: {
        count() {
            return this.$store.getters["ranking/count"];
        },
        topProjects() {
            return this.$store.getters["ranking/topProjects"];
        }
    },

    methods: {
        async retrieveTopProjects() {
            const { data } = await axios.post("/api/projects/ranking/" + this.$store.getters["ranking/filter"]);
            this.loading = false;
            this.$store.dispatch("ranking/feedTopProjects", data);
        },
        // Utils (simulate slow async)
        async stall(stallTime = 1000) {
            await new Promise(resolve => setTimeout(resolve, stallTime));
        }
    }
};
</script>
