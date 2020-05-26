<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-8">
        <div
          class="card login-page shadow-large rounded p-4 position-relative bg-whiter"
        >
          <div class="text-center">
            <h5 class="mb-4 pb-2">{{ $t("your_password") }}</h5>
          </div>
          <form
            @submit.prevent="update"
            @keydown="form.onKeydown($event)"
            class="login-form"
          >
            <alert-success :form="form" :message="$t('password_updated')" />
            <div class="row">
              <div class="col-12">
                <div class="form-group position-relative">
                  <label
                    >{{ $t("password") }}
                    <span class="text-danger">*</span></label
                  >
                  <input
                    v-model="form.password"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    class="form-control"
                    type="password"
                    name="password"
                  />
                  <has-error :form="form" field="password" />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group position-relative">
                  <label
                    >{{ $t("confirm_password") }}
                    <span class="text-danger">*</span></label
                  >
                  <input
                    v-model="form.password_confirmation"
                    :class="{
                      'is-invalid': form.errors.has('password_confirmation')
                    }"
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                  />
                  <has-error :form="form" field="password_confirmation" />
                </div>
              </div>

              <div class="col-12 mb-0">
                <v-button class="btn btn-primary w-100" :loading="form.busy">
                  {{ $t("update") }}
                </v-button>
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
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      password: "",
      password_confirmation: ""
    })
  }),

  methods: {
    async update() {
      const data = await this.form.patch("/api/settings/password");
      console.log(data);
      this.form.reset();
    }
  }
};
</script>
