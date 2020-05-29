<template>
    <div>
        <search-bar />

        <auth-filter />

        <v-filter type="projects" />

        <div v-if="countFilteredProjects == 0 && !loading" class="mt-4">
            <p>{{ $t("no_projects") }}</p>
        </div>

        <div v-else class="text-center mt-4">
            <p class="small text-muted para-desc mx-auto mb-0">
                {{
                    $t("result") +
                        countFilteredProjects +
                        " " +
                        (countFilteredProjects > 1
                            ? $t("projects")
                            : $t("project"))
                }}
            </p>
        </div>

        <div v-if="loading" class="container text-center mt-5 mb-5">
            <div class="group">
                <div class="bigSqr">
                    <div class="square first"></div>
                    <div class="square second"></div>
                    <div class="square third"></div>
                    <div class="square fourth"></div>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="container">
                <div class="row projects-wrapper">
                    <project-item
                        v-for="project in projectsFilteredToShow"
                        :key="project.id"
                        :project="project"
                    />
                </div>
            </div>
            <div
                @click="loadMore"
                v-show="countFilteredProjects > countprojectsFilteredToShow"
                class="col-12 mb-0 text-center mt-5"
            >
                <v-button class="btn btn-primary">
                    {{ $t("load_more") }}
                </v-button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import * as types from "../store/mutation-types";

export default {
    name: "projects-list",

    data: function() {
        return {
            loading: true
        };
    },

    created() {
        this.$store.dispatch("users/retrieveUsers");
        this.$store.dispatch("likes/retrieveLikes");
        this.retrieveProjects();
    },

    computed: {
        count() {
            return this.$store.getters["projects/count"];
        },
        countFilteredProjects() {
            return this.$store.getters["projects/countFilteredProjects"];
        },
        countprojectsFilteredToShow() {
            return this.$store.getters["projects/countFilteredProjectsToShow"];
        },
        projectsFiltered() {
            return this.$store.getters["projects/projectsFiltered"];
        },
        projectsFilteredToShow() {
            return this.$store.getters["projects/projectsFilteredToShow"];
        }
    },

    methods: {
        async retrieveProjects() {
            const { data } = await axios.get("/api/projects");
            this.loading = false;
            this.$store.dispatch("projects/feedProjects", data);
        },
        loadMore() {
            this.$store.dispatch("projects/updateShow");
        }
    }
};
</script>
