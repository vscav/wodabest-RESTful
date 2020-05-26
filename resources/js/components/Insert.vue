<template>
    <div class="container mt-100">
        <div class="row justify-content-center" id="counter">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 v-if="locale == 'en'" class="title mb-4">
                        {{ $t("a") }}
                        <span class="text-primary">{{ $t("efficient") }}</span>
                        {{ $t("web_app") }}
                    </h4>
                    <h4 v-else class="title mb-4">
                        {{ $t("a") + " " + $t("web_app") }}
                        <span class="text-primary">{{ $t("efficient") }}</span>
                    </h4>
                    <p class="text-muted para-desc mx-auto mb-0">
                        {{ $t("technologies_introduction") }}
                    </p>

                    <div class="row mt-5 pt-3 justify-content-center">
                        <div
                            v-for="technologie in technologies"
                            :key="technologie"
                            class="col-lg-2 col-md-2 col-6 text-center mt-4 mt-sm-0"
                        >
                            <img
                                :src="
                                    'img/technologies/' +
                                        technologie +
                                        '-logo.svg'
                                "
                                style="height: 40px;"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "technologies-insert",

    props: {
        technologies: Array
    },

    computed: mapGetters({
        locale: "lang/locale"
    })
};
</script>
