<template>
  <div>
    <router-link to="/" tag="a" class="link">Anasayfa</router-link>
    <router-link to="/about" tag="a" class="link">Hakkında</router-link>
    <router-link to="/contact" tag="a" class="link">İletişim</router-link>
    <router-link to="/post/29185270565491969640461529474138112" tag="a" class="link">İnstagram post</router-link>
    <a href="https://github.com/vuejs-templates/webpack-simple">webpack-simple</a>
    <a href="http://localhost">NGINX SERVER 80</a>
    <a href="http://localhost/api">NGINX API</a>
    <!-- {{globalVar}} -->
    <hr />
  </div>
</template>

 <script>
module.exports = {
  data: function() {
    fetch(this.$root.server_url + "/api/inboxtodb.php", {
      method: "POST",
      body: JSON.stringify({
        mid: this.$route.params.mid
      })
    }).then(json => {
      console.log("OK", this.$root.server_url);
       fetch(this.$root.server_url + "/api/sender.php", {
      method: "POST"
    }).then(json => {
      console.log("OK");
    }); //fetch2end
    });

   
    return {
      msg: "Hello Post"
    };
  }
};
</script>
