<template>
    <div class="col-lg-6 col-md-12 order-2 order-lg-1 mt-5 mt-lg-0">
        <div class="section-title mr-lg-5">
            <h6 class="text-muted">
                {{ $t("a_family") }}
            </h6>
            <h2 class="mb-4">
                <span class="font-weight-bold">{{ appName }}</span>
            </h2>
            <p class="text-muted">
                {{ $t("authentification_introduction_1") }}
            </p>
            <p class="text-muted">
                {{ $t("authentification_introduction_2") }}
            </p>
            <p class="text-muted">
                {{ $t("authentification_introduction_3") }}
            </p>
            <p class="text-muted">
                {{ $t("authentification_introduction_4") }}
            </p>
            <h4 class="text-dark">{{ $t("join") }} !</h4>
        </div>
    </div>
</template>

<script>
export default {
    name: "introduction",

    data: () => ({
        appName: window.config.appName,
    })
};
</script>
