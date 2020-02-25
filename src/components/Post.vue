<template>
  <div>
    <div class="container" id="app">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              <img v-if="image_url!=''" class="responsive-img" v-bind:src="image_url" />
              <video
                v-if="video_url!=undefined"
                class="responsive-video"
                v-bind:src="video_url"
                controls
                autoplay
              >Your browser does not support the video tag.</video>
              <!-- <span class="card-title">Card Title</span> -->
            </div>
            <div class>
              <!-- <ul class="">
              <li v-for="(item,index) in carousel_media"  v-bind:key="item">
                <img class="responsive-img" v-if="item.media_type==1"
                  v-bind:src="item.image_versions2.candidates[0].url" />
                <video class="responsive-video" v-if="item.media_type==2" v-bind:src="item.video_versions[0].url"
                  controls autoplay>
                  Your browser does not support the video tag.
                </video>
                <div class="caption center-align">
                  <h5>-{{index+1}}-</h5>
                </div>
              </li>
              </ul>-->
            </div>
            <div class="card-content">
              <p>{{caption}} {{ $route.params.id }}</p>
            </div>
            <!-- <div class="card-action">
          <a href="#">This is a link</a>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
 <script>
module.exports = {
  data: function() {
    fetch("http://localhost/api/get_item.php", {
      method: "POST",
      body: JSON.stringify({
        mid: this.$route.params.mid
      })
    })
      .then(res => {
        return res.json();
      })
      .then(json => {
      
        console.log(this.$route.params.mid);
        // console.log(json.media_share.carousel_media);
        switch (json.media_share.media_type) {
          case 1: //image
            this.image_url = json.media_share.image_versions2.candidates[0].url;
            break;
          case 2: //video
            this.video_url = json.media_share.video_versions[0].url;
            break;
          case 8: //carousel_media
            this.carousel_media = json.media_share.carousel_media;
            this.carousel_media.forEach(element => {
              // console.log(element)
            });
            setTimeout(() => {
              var elems = document.querySelectorAll(".slider");
              var instances = M.Slider.init(elems);
            }, 1000);
            break;
          default:
            break;
        }
        this.caption = json.media_share.caption.text;
      });
    console.log("asd", this.video_url);
    return {
      msg: "Hello Post",
      image_url: this.image_url,
      video_url: this.video_url,
      carousel_media: this.carousel_media,
      caption: this.caption
    };
  }
};
</script>