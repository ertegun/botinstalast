<template>
  <div>
    <router-link to="/" tag="a" class="link">Anasayfa</router-link>
    <router-link to="/about" tag="a" class="link">Hakkında</router-link>
    <router-link to="/contact" tag="a" class="link">İletişim</router-link>
    <router-link to="/post/29185270565491969640461529474138112" tag="a" class="link">İnstagram post</router-link>
    <a href="https://github.com/vuejs-templates/webpack-simple">webpack-simple</a>
    <a href="http://localhost">NGINX SERVER 80</a>
    <a href="http://localhost/api">NGINX API</a>

    <hr />
  </div>
</template>

 <script>
module.exports = {
  data: function() {
    fetch("http://localhost/api/mesaj_listesi.php", {
      method: "POST",
      body: JSON.stringify({
        mid: this.$route.params.mid
      })
    })
      .then(json => {
        console.log('OK');
      });
    return {
      msg: "Hello Post",
      image_url:this.image_url,
      video_url:this.video_url,
      carousel_media:this.carousel_media,
      caption:this.caption
    };
  }
};
</script>
