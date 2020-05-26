<template>
    <div class="row">
        <div
            v-for="link in links"
            :key="link"
            class="col-lg-4 col-md-6 col-12 mt-4 pt-2"
        >
            <div
                class="feature feature-transition shadow-large p-4 rounded text-left"
            >
                <div class="icon text-center rounded-circle">
                    <img :src="'img/icons/' + link + '.svg'" />
                </div>
                <h5 class="mt-2">{{ $t(link) }}</h5>
                <p class="text-muted mb-0">
                    {{ $t("welcome_" + link + "_introduction") }}
                </p>
                <div class="mt-3 text-right">
                    <router-link
                        :to="{ name: link }"
                        class="nav-link"
                        active-class="active"
                    >
                        <a class="btn btn-icon btn-pills btn-outline-primary">
                            <img src="img/icons/chevron-right.svg" />
                        </a>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "link-card",

    props: {
        links: Array
    }
};
</script>
