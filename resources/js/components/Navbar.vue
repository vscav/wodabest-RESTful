<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-large">
            <div class="container">
                <router-link
                    :to="{ name: user ? 'home' : 'welcome' }"
                    class="navbar-brand"
                >
                    <div class="nav-logo col-12">
                        <img src="/img/logo/wodabest-small.png" />
                    </div>
                </router-link>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarToggler"
                    aria-controls="navbarToggler"
                    aria-expanded="false"
                >
                    <span class="navbar-toggler-icon" />
                </button>

                <div id="navbarToggler" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <locale-dropdown />
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <!-- Authenticated -->
                        <li v-if="user" class="nav-item">
                            <router-link
                                :to="{ name: 'home' }"
                                class="nav-link"
                                active-class="active"
                            >
                                {{ $t("home") }}
                            </router-link>
                        </li>
                        <li v-if="user" class="nav-item">
                            <router-link
                                :to="{ name: 'game' }"
                                class="nav-link"
                                active-class="active"
                            >
                                {{ $t("game") }}
                            </router-link>
                        </li>
                        <li v-if="user" class="nav-item">
                            <router-link
                                :to="{ name: 'gallery' }"
                                class="nav-link"
                                active-class="active"
                            >
                                {{ $t("gallery") }}
                            </router-link>
                        </li>
                        <li v-if="user" class="nav-item">
                            <router-link
                                :to="{ name: 'leaderboard' }"
                                class="nav-link"
                                active-class="active"
                            >
                                {{ $t("leaderboard") }}
                            </router-link>
                        </li>
                        <li v-if="user" class="nav-item">
                            <router-link
                                :to="{ name: 'upload' }"
                                class="nav-link"
                                active-class="active"
                            >
                                {{ $t("upload") }}
                            </router-link>
                        </li>
                        <li v-if="user" class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle text-dark"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <img
                                    :src="user.photo_url"
                                    class="rounded-circle profile-photo mr-1"
                                />
                                {{ user.name }}
                            </a>
                            <div class="dropdown-menu bg-light">
                                <router-link
                                    :to="{ name: 'settings.profile' }"
                                    class="dropdown-item pl-3"
                                >
                                    <fa icon="cog" fixed-width />
                                    {{ $t("settings") }}
                                </router-link>

                                <div class="dropdown-divider" />
                                <a
                                    href="#"
                                    class="dropdown-item pl-3"
                                    @click.prevent="logout"
                                >
                                    <fa icon="sign-out-alt" fixed-width />
                                    {{ $t("logout") }}
                                </a>
                            </div>
                        </li>
                        <!-- Guest -->
                        <template v-else>
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'login' }"
                                    class="nav-link"
                                    active-class="active"
                                >
                                    {{ $t("login") }}
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link
                                    :to="{ name: 'register' }"
                                    class="nav-link"
                                    active-class="active"
                                >
                                    {{ $t("register") }}
                                </router-link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";

export default {
    components: {
        LocaleDropdown
    },

    computed: mapGetters({
        user: "auth/user"
    }),

    methods: {
        async logout() {
            // Log out the user.
            await this.$store.dispatch("auth/logout");

            // Redirect to login.
            this.$router.push({ name: "login" });
        }
    }
};
</script>
