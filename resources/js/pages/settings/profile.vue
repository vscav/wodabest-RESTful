<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-8">
        <div
          class="card login-page shadow-large rounded p-4 position-relative bg-whiter"
        >
          <div class="text-center">
            <h5 class="mb-4 pb-2">{{ $t("your_info") }}</h5>
          </div>
          <form
            @submit.prevent="update"
            @keydown="form.onKeydown($event)"
            class="login-form"
          >
            <alert-success :form="form" :message="$t('info_updated')" />
            <div class="row">
              <div class="col-12">
                <div class="form-group position-relative">
                  <label
                    >{{ $t("name") }} <span class="text-danger">*</span></label
                  >
                  <input
                    v-model="form.name"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    class="form-control"
                    type="text"
                    name="name"
                  />
                  <has-error :form="form" field="name" />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group position-relative">
                  <label
                    >{{ $t("email") }} <span class="text-danger">*</span></label
                  >
                  <input
                    v-model="form.email"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                    class="form-control"
                    type="email"
                    name="email"
                  />
                  <has-error :form="form" field="email" />
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
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      name: "",
      email: ""
    })
  }),

  computed: mapGetters({
    user: "auth/user"
  }),

  created() {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key];
    });
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/api/settings/profile");

      this.$store.dispatch("auth/updateUser", { user: data });
    }
  }
};
</script>
