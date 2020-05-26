<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <introduction />
            <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                <div
                    class="card login-page shadow-large rounded p-4 position-relative bg-light"
                >
                    <div class="text-center">
                        <h5 class="mb-4 pb-2">{{ $t("register") }}</h5>
                    </div>
                    <form
                        @submit.prevent="register"
                        @keydown="form.onKeydown($event)"
                        class="login-form"
                    >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label
                                        >{{ $t("name") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        v-model="form.name"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'name'
                                            )
                                        }"
                                        class="form-control"
                                        type="text"
                                        name="name"
                                    />
                                    <has-error :form="form" field="name" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label
                                        >{{ $t("email") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        v-model="form.email"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'email'
                                            )
                                        }"
                                        class="form-control"
                                        type="email"
                                        name="email"
                                    />
                                    <has-error :form="form" field="email" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label
                                        >{{ $t("password") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        v-model="form.password"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'password'
                                            )
                                        }"
                                        class="form-control"
                                        type="password"
                                        name="password"
                                    />
                                    <has-error :form="form" field="password" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label
                                        >{{ $t("confirm_password") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        v-model="form.password_confirmation"
                                        :class="{
                                            'is-invalid': form.errors.has(
                                                'password_confirmation'
                                            )
                                        }"
                                        class="form-control"
                                        type="password"
                                        name="password_confirmation"
                                    />
                                    <has-error
                                        :form="form"
                                        field="password_confirmation"
                                    />
                                </div>
                            </div>
                            <div class="col-12 mb-0">
                                <v-button
                                    class="btn btn-primary w-100"
                                    :loading="form.busy"
                                >
                                    {{ $t("register") }}
                                </v-button>
                            </div>
                            <div class="mx-auto">
                                <p class="mb-0 mt-3">
                                    <small class="text-dark mr-2">{{
                                        $t("account")
                                    }}</small>
                                    <router-link
                                        :to="{ name: 'login' }"
                                        class="small ml-auto my-auto"
                                    >
                                        <a class="text-dark font-weight-bold">{{
                                            $t("login")
                                        }}</a>
                                    </router-link>
                                </p>
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

export default {
    middleware: "guest",

    metaInfo() {
        return { title: this.$t("register") };
    },

    data: () => ({
        form: new Form({
            name: "",
            email: "",
            password: "",
            password_confirmation: ""
        }),
        // We don't verify email for now
        mustVerifyEmail: false
    }),

    computed: {
        countUsers() {
            return this.$store.getters["users/count"];
        }
    },

    created() {
        this.$store.dispatch("users/retrieveUsers");
    },

    methods: {
        async register() {
            // Register the user.
            const { data } = await this.form.post("/api/register");

            // Must verify email fist.
            if (data.status) {
                this.mustVerifyEmail = true;
            } else {
                // Log in the user.
                const {
                    data: { token }
                } = await this.form.post("/api/login");
                
                // Save the token.
                this.$store.dispatch("auth/saveToken", { token });

                // Update the user.
                await this.$store.dispatch("auth/updateUser", { user: data });

                // Redirect home.
                this.$router.push({ name: "home" });
            }
        }
    }
};
</script>
