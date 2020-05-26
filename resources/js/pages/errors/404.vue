<template>
    <section
        class="vh-100 d-flex align-items-center justify-content-center"
        style="background: url('images/bg/404.jpg') center center;"
    >
        <div class="bg-light"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="error-number display-1 font-weight-bold">404</p>
                    <h5 class="mb-4">{{ $t("page_not_found") }}</h5>
                    <div class="mt-4">
                        <router-link :to="{ name: 'welcome' }">
                            <a href="index.html" class="btn btn-primary">{{
                                $t("go_home")
                            }}</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "NotFound"
};
</script>
