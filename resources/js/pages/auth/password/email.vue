<template>
<section class="mt-4 user-pages d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8">
            <div class="card login-page rounded p-4 position-relative bg-whiter">
              <div class="text-center">
                <h5 class="mb-4 pb-2">{{ $t('email') }}</h5>
              </div>
              <form
                @submit.prevent="send"
                @keydown="form.onKeydown($event)"
                class="login-form"
              >
              <alert-success :form="form" :message="status" />
                <div class="row">
                  <div class="col-12">
                    <div class="form-group position-relative">
                      <label
                        >{{ $t("email")
                        }} <span class="text-danger">*</span></label
                      >
                      <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
              <has-error :form="form" field="email" />
                    </div>
                  </div>

                  <div class="col-12 mb-0">
                    <v-button
                      class="btn btn-primary w-100"
                      :loading="form.busy"
                    >
                      {{ $t('send_password_reset_link') }}
                    </v-button>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
