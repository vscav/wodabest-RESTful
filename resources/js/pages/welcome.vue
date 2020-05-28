<template>
    <div>
        <div class="container mt-5">
            <div class="text-center">
                <div class="container mt-60">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="section-title text-center mb-4 pb-2">
                                <div class="col-12 mb-4">
                                    <img
                                        class="img-fluid welcome-logo"
                                        src="/img/logo/wodabest.png"
                                        alt="Wodabest logo"
                                    />
                                </div>
                                <h3 class="title mb-4">
                                    {{ appName }}
                                </h3>
                                <div class="col-12 mb-4">
                                    <router-link
                                        :to="{ name: 'game' }"
                                        class="nav-link"
                                        active-class="active"
                                    >
                                        <v-button class="btn btn-primary">
                                            {{ $t("play") }}
                                        </v-button>
                                    </router-link>
                                </div>
                                <p class="text-muted para-desc mx-auto mb-0">
                                    {{ $t("welcome_introduction") }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <link-card :links="links" />
                </div>
            </div>
        </div>
        <technologies-insert :technologies="technologies" />
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    layout: "default",

    data: () => ({
        appName: window.config.appName,
        links: ["gallery", "leaderboard", "upload"],
        technologies: ["bootstrap", "vue", "vuex", "vue-router", "laravel"]
    }),

    metaInfo() {
        return { title: this.$t("welcome") };
    },

    computed: mapGetters({
        authenticated: "auth/check"
    })
};
</script>
