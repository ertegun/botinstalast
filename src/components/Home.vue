<template>
  <div>
    <div class="row">
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <img src="/src/assets/crow.png" />
            <span class="card-title">Gri Karga</span>
            <!-- <a class="btn-floating halfway-fab waves-effect waves-light red">
              <i class="material-icons">add</i>
            </a>-->
          </div>
          <div class="card-content">
            <p>
              <!-- {{msg}} -->
              Arkadaşınla paylaştığın postu arkadaşın takip etmediği için göremiyor mu?
              Önce benimle paylaş.Bende sana onun görebileceği linki mesaj olarak atayım.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- <router-link to="/" tag="a" class="link">Anasayfa</router-link>
    <router-link to="/about" tag="a" class="link">Hakkında</router-link>
    <router-link to="/contact" tag="a" class="link">İletişim</router-link>
    <router-link to="/post/29185270565491969640461529474138112" tag="a" class="link">İnstagram post</router-link>
    <a href="https://github.com/vuejs-templates/webpack-simple">webpack-simple</a>
    <a href="http://localhost">NGINX SERVER 80</a>
    <a href="http://localhost/api">NGINX API</a>-->
    <!-- {{globalVar}} -->
    <hr />
  </div>
</template>

 <script>
// module.exports = {
//   data: function() {
//     fetch(this.$root.server_url + "/api/inboxtodb.php", {
//       method: "POST",
//       body: JSON.stringify({
//         mid: this.$route.params.mid
//       })
//     }).then(json => {
//       console.log("OK", this.$root.server_url);
//       fetch(this.$root.server_url + "/api/sender.php", {
//         method: "POST"
//       }).then(json => {
//         console.log("OK");
//       }); //fetch2end
//     });

//     return {
//       msg: "Hello Post",
//       name:'Home',
//       metaInfo: {
//       title: 'My Example App',
//       // titleTemplate: '%s - Yay!',
//       htmlAttrs: {
//         lang: 'en',
//         amp: true
//       }
//     }
//     };
//   }
// };

export default {
  name: "Home",
  metaInfo: {
    // title will be injected into parent titleTemplate
    title: "Home"
  },
  // msg:'asdasdasd0',
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
    return {msg:'ddddd'}
  }
};
</script>
