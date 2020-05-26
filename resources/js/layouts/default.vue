<template>
  <div class="main-layout bg-light">
    <navbar />
    <div class="main-content container bg-light">
      <child />
    </div>
    <v-footer />
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
