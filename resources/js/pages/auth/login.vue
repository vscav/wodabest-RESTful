<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <introduction />
            <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                <div
                    class="card login-page rounded shadow-large p-4 position-relative bg-light"
                >
                    <div class="text-center">
                        <h5 class="mb-4 pb-2">{{ $t("login") }}</h5>
                    </div>

                    <div class="col-12 mb-0 text-center">
                        <login-with-google />
                        <login-with-github />
                    </div>

                    <div class="col-12 text-center">
                        <p class="mb-0 mt-3">
                            <small class="text-dark">{{ $t("or") }}</small>
                        </p>
                    </div>
                    <form
                        @submit.prevent="login"
                        @keydown="form.onKeydown($event)"
                        class="login-form"
                    >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label
                                        >{{ $t("email") }}
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                    <input
                                        required=""
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
                                <div class="form-group position-relative">
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
                                        required=""
                                    />
                                    <has-error :form="form" field="password" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div class="form-group d-inline-block">
                                        <div
                                            class="custom-control custom-checkbox"
                                        >
                                            <checkbox
                                                v-model="remember"
                                                name="remember"
                                            >
                                                {{ $t("remember_me") }}
                                            </checkbox>
                                        </div>
                                    </div>
                                    <router-link
                                        :to="{ name: 'password.request' }"
                                        class="small ml-auto my-auto"
                                    >
                                        <div class="forgot-pass mb-0">
                                            <p
                                                class="text-dark font-weight-bold"
                                            >
                                                {{ $t("forgot_password") }}
                                            </p>
                                        </div>
                                    </router-link>
                                </div>
                            </div>

                            <div class="col-12 mb-0">
                                <v-button
                                    class="btn btn-primary w-100"
                                    :loading="form.busy"
                                >
                                    {{ $t("login") }}
                                </v-button>
                            </div>

                            <div class="col-12 text-center">
                                <p class="mb-0 mt-3">
                                    <small class="text-dark mr-2">{{
                                        $t("not_account")
                                    }}</small>
                                    <router-link
                                        :to="{ name: 'register' }"
                                        class="small ml-auto my-auto"
                                    >
                                        <a class="text-dark font-weight-bold">{{
                                            $t("register")
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
import LoginWithGithub from "~/components/LoginWithGithub";
import LoginWithGoogle from "~/components/LoginWithGoogle";

export default {
    middleware: "guest",

    components: {
        LoginWithGithub,
        LoginWithGoogle
    },

    metaInfo() {
        return { title: this.$t("login") };
    },

    data: () => ({
        form: new Form({
            email: "",
            password: ""
        }),
        remember: false
    }),

    methods: {
        async login() {
            // Submit the form.
            const { data } = await this.form.post("/api/login");
            
            // Save the token.
            this.$store.dispatch("auth/saveToken", {
                token: data.token,
                remember: this.remember
            });

            // Fetch the user.
            await this.$store.dispatch("auth/fetchUser");

            // Redirect home.
            this.$router.push({ name: "home" });
        }
    }
};
</script>
