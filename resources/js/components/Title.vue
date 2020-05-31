<template>
    <div class="container">
        <div class="row mt-5 pt-3">
            <div class="col-lg-12">
                <div class="title-heading">
                    <h2 class="heading mb-4">
                        {{ title }}
                    </h2>
                    <p v-if="text" class="text-muted para-desc">
                        {{ text }}
                    </p>
                    <div v-if="information" class="d-flex flex-row align-items-center">
                        <span class="badge badge-dot">
                            <i class="bg-success"></i>
                        </span>
                        <p class="mt-3 ml-3 text-muted text-sm">{{ information }}</p>
                    </div>
                    <hr role="separator" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "page-title",

    props: {
        title: { type: String, default: null },
        text: { type: String, default: null },
        information: { type: String, default: null }
    }
};
</script>
