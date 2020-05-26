<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <div
                    class="card login-page bg-white rounded p-4 position-relative bg-whiter"
                >
                    <div class="text-center">
                        <h5 class="mb-4 pb-2">{{ $t("add") }}</h5>
                    </div>
                    <form
                        @submit.prevent="addProject"
                        @keydown="form.onKeydown($event)"
                        class="login-form"
                    >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label
                                        >{{ $t("image") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        @change="imageChanged"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'image'
                                            )
                                        }"
                                        class="form-control"
                                        type="file"
                                        name="image"
                                        required=""
                                    />
                                    <has-error :form="form" field="image" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label
                                        >{{ $t("title") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        v-model="form.title"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'title'
                                            )
                                        }"
                                        class="form-control"
                                        type="text"
                                        name="title"
                                        required=""
                                    />
                                    <has-error :form="form" field="title" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label
                                        >{{ $t("description") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <textarea
                                        v-model="form.description"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'description'
                                            )
                                        }"
                                        class="form-control"
                                        type="text"
                                        name="description"
                                        required=""
                                    />
                                    <has-error
                                        :form="form"
                                        field="description"
                                    />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label
                                        >{{ $t("category") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <select
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'description'
                                            )
                                        }"
                                        class="form-control"
                                        v-model="form.category"
                                        name="category"
                                        required=""
                                    >
                                        <option disabled value="">{{
                                            $t("assign_category")
                                        }}</option>
                                        <option
                                            v-for="category in allCategories"
                                            :key="category.name"
                                            :value="category.slug"
                                        >
                                            {{ $t(category.slug) }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="category" />
                                </div>
                            </div>
                            <div
                                v-if="
                                    form.title != '' &&
                                        form.description != '' &&
                                        form.category != ''
                                "
                                class="col-12 mb-0"
                            >
                                <v-button
                                    class="btn btn-primary w-100"
                                    :loading="form.busy"
                                >
                                    {{ $t("upload") }}
                                </v-button>
                            </div>
                            <div v-else class="col-12 mb-0">
                                <p>{{ $t("form_rule") }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { mapGetters } from "vuex";

export default {
    name: "create-form",

    data: () => ({
        form: new Form({
            title: "",
            description: "",
            category: ""
        })
    }),

    created() {
        this.$store.dispatch("categories/retrieveCategories");
    },

    computed: {
        ...mapGetters({ user: "auth/user" }),
        allCategories() {
            return this.$store.getters["categories/allCategories"];
        }
    },

    methods: {
        getAllCategories() {
            return this.$store.getters["categories/allCategories"];
        },
        imageChanged(e) {
            let fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            fileReader.onload = e => {
                this.form.image = e.target.result;
            };
        },
        async addProject() {
            await this.$store.dispatch("projects/addProject", {
                user_id: this.user.id,
                title: this.form.title,
                description: this.form.description,
                category: this.form.category,
                image: this.form.image
            });

            this.form.reset();

            this.$router.push("/gallery");
        }
    }
};
</script>
