<template>
    <div>
        <search-bar />

        <auth-filter />

        <v-filter type="projects" />

        <div v-if="countFilteredProjects == 0" class="mt-4">
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
</template>

<script>
export default {
    name: "projects-list",

    created() {
        this.$store.dispatch("users/retrieveUsers");
        this.$store.dispatch("projects/retrieveProjects");
        this.$store.dispatch("likes/retrieveLikes");
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
        loadMore() {
            this.$store.dispatch("projects/updateShow");
        }
    }
};
</script>
