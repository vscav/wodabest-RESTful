<template>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div v-if="loading" class="container text-center mt-5 mb-5">
                        <loader />
                    </div>
                    <div v-else class="row align-items-center">
                        <div
                            class="col-lg-6 col-md-6 mt-4 mt-lg-0 pt-2 pt-lg-0"
                        >
                            <div
                                class="rounded text-center shadow-large position-relative overflow-hidden"
                            >
                                <img
                                    v-if="random[0]"
                                    :src="'/img/upload/' + random[0].filename"
                                    class="img-fluid"
                                    alt="Front artistic work"
                                />
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div
                                    class="col-lg-12 col-md-12 mt-4 mt-lg-0 pt-2 pt-lg-0"
                                >
                                    <div
                                        class="rounded text-center shadow-large position-relative overflow-hidden"
                                    >
                                        <img
                                            v-if="random[1]"
                                            :src="
                                                '/img/upload/' +
                                                    random[1].filename
                                            "
                                            class="img-fluid"
                                            alt="Front artistic work"
                                        />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 mt-4 pt-2">
                                    <div
                                        class="rounded text-center shadow-large position-relative overflow-hidden"
                                    >
                                        <img
                                            v-if="random[2]"
                                            :src="
                                                '/img/upload/' +
                                                    random[2].filename
                                            "
                                            class="img-fluid"
                                            alt="Front artistic work"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                    <div class="section-title ml-lg-5">
                        <h6 class="text-muted">
                            {{ $t("Hello") + " " + user.name + " !" }}
                        </h6>
                        <h2 class="mb-4">
                            <span class="font-weight-bold">{{ name }}</span>
                            {{ $t("today") }}
                        </h2>
                        <p class="text-muted">
                            {{ $t("home_introduction") }}
                        </p>

                        <div class="row justify-content-center" id="counter">
                            <div
                                v-if="loading"
                                class="container text-center mt-5 mb-5"
                            >
                                <loader />
                            </div>

                            <div v-if="!loading" class="col-md-4 col-6 mt-4">
                                <div class="counter-box text-center">
                                    <h3 class="counter-value mt-3">
                                        {{ countUsers }}
                                    </h3>
                                    <h6 class="counter-head font-weight-normal">
                                        {{ $t("users") }}
                                    </h6>
                                </div>
                            </div>

                            <div v-if="!loading" class="col-md-4 col-6 mt-4">
                                <div class="counter-box text-center">
                                    <h3 class="counter-value mt-3">
                                        {{ countProjects }}
                                    </h3>
                                    <h6 class="counter-head font-weight-normal">
                                        {{ $t("projects") }}
                                    </h6>
                                </div>
                            </div>

                            <div v-if="!loading" class="col-md-4 col-6 mt-4">
                                <div class="counter-box text-center">
                                    <h3 class="counter-value mt-3">
                                        {{ countGames }}
                                    </h3>
                                    <h6 class="counter-head font-weight-normal">
                                        {{ $t("games_played") }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div v-if="!loading" class="col-12 mb-4 text-center mt-4">
                            <router-link
                                :to="{ name: 'game' }"
                                class="navbar-brand"
                            >
                                <v-button class="btn btn-primary">
                                    {{ $t("play") }}
                                </v-button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
    middleware: "auth",

    data: () => ({
        name: window.config.appName,
        loading: true
    }),

    computed: {
        ...mapGetters({ user: "auth/user" }),
        countCategories() {
            return this.$store.getters["categories/count"];
        },
        countUsers() {
            return this.$store.getters["users/count"];
        },
        countProjects() {
            return this.$store.getters["projects/count"];
        },
        countGames() {
            return this.$store.getters["games/count"];
        },
        random() {
            return this.$store.getters["projects/randomProjects"];
        }
    },

    created() {
        this.$store.dispatch("users/retrieveUsers");
        this.$store.dispatch("categories/retrieveCategories");
        this.$store.dispatch("games/retrieveGames");
        this.retrieveProjects();
    },

    methods: {
        async retrieveProjects() {
            const { data } = await axios.get("/api/projects");
            this.loading = false;
            this.$store.dispatch("projects/feedProjects", data);
        }
    },

    metaInfo() {
        return { title: this.$t("home") };
    }
};
</script>
