<template>
  <footer class="footer footer-bar bg-light shadow-large mt-5">
    <div class="container text-center">
      <div class="row align-items-center">
        <div class="col-sm-12">
          <a href="https://www.ingenieur-imac.fr" target="_blank">
            <div class="nav-logo col-12 p-1">
              <img src="/img/imac-logo.png" />
            </div>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "v-footer",

  data: () => ({
    appName: window.config.appName
  })
};
</script>
