
<template>
  <div id="videoContainer"></div>
</template>
<style>
#videoContainer {
    position: absolute;
    width: 100% !important;
    height: 100% !important;
}
.jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-inline:not(.jw-text-live), .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-volume {
    height: 80px;
    width: 80px;
}
.jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-inline:not(.jw-text-live) .jw-svg-icon, .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-volume .jw-svg-icon {
    height: 50px;
    width: 50px;
}
.jw-controlbar .jw-icon:hover {
    transform: scale(1.2);
    transition: transform 150ms ease 0s;
}
.jw-reset .jw-icon-rewind {
    display: none;
}
.jw-progress {
    background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA 51%, #1FA2FF 100%);
}
.jw-knob {
  width: 20px;
  height: 20px;
  background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA 51%, #1FA2FF 100%);
}
/* .jw-svg-icon-buffer path {
  display: none;
} */
.jw-svg-icon-buffer path {
    display: none;
}
.jw-svg-icon-fullscreen path {
    display: none;
}

.jw-svg-icon-buffer {
  background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8WlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDggNzkuMTY0MDM2LCAyMDE5LzA4LzEzLTAxOjA2OjU3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIwLTA5LTAxVDEzOjExOjMzKzAyOjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMC0wOS0wMVQxMzoyMzo0MCswMjowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMC0wOS0wMVQxMzoyMzo0MCswMjowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo3MTJiZWVjNy1hYmI5LWExNGQtYjExNS04Yzc1NWVmMTg2NDciIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDoxOTM3NzJjNy0zMmRkLWM1NDAtOTkwZS0zY2QxNWM3MWMyM2IiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDowNWUxYjExMC04NDc5LTVmNGYtODY5OC0wMzNjYThlZmYyMWUiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjA1ZTFiMTEwLTg0NzktNWY0Zi04Njk4LTAzM2NhOGVmZjIxZSIgc3RFdnQ6d2hlbj0iMjAyMC0wOS0wMVQxMzoxMTozMyswMjowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo3MTJiZWVjNy1hYmI5LWExNGQtYjExNS04Yzc1NWVmMTg2NDciIHN0RXZ0OndoZW49IjIwMjAtMDktMDFUMTM6MjM6NDArMDI6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMS4wIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz72ljniAAAOoklEQVR4nO3de5QU1Z0H8O/v3urpYXgPzAwgBI0RSVCj7vpIjiyoLHLiEg3MDCNJdI+C7vpaQdQVNxs9J4giIeL6iA4nG9DIPEAwhPiK65McX2t0QWVx2VUElJlhePa8uu797R8w48x090xPd3X3dPXv84+nbt2u+nnmy+3bXdV1CT7nVO2bpEDTWDsXgeg8MOcz4QNt7OrWOSP/Pd31MHO6T5kRlOkCvLZw5qIB//aT23/ASv+AQJeA6IRYfbUxG1rmjJwNIG1/bQlWFrkbUEuq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');
    background-size: contain;
    background-repeat: no-repeat;
}
.jw-svg-icon-fullscreen {
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAACXBIWXMAAAsTAAALEwEAmpwYAAAF8WlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDggNzkuMTY0MDM2LCAyMDE5LzA4LzEzLTAxOjA2OjU3ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjEuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIwLTA5LTAxVDEwOjM1OjIwKzAyOjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMC0wOS0wMVQxMTowODozMCswMjowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMC0wOS0wMVQxMTowODozMCswMjowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpmZTNiYjdiMi0wNTkzLTdkNDItYjEwOC01MjA3MGRhMTAwZGIiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDo4Nzk0YmJkYi0wZWFkLWYxNDgtYmU3My0xMDc1YjE0MGQ5ZDkiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpmM2M4NWZiZS0yNmE2LWJjNDQtYjYwMi05YTgxNzkzNzk3YzMiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmYzYzg1ZmJlLTI2YTYtYmM0NC1iNjAyLTlhODE3OTM3OTdjMyIgc3RFdnQ6d2hlbj0iMjAyMC0wOS0wMVQxMDozNToyMCswMjowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDpmZTNiYjdiMi0wNTkzLTdkNDItYjEwOC01MjA3MGRhMTAwZGIiIHN0RXZ0OndoZW49IjIwMjAtMDktMDFUMTE6MDg6MzArMDI6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMS4wIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz54iImMAAAJ/klEQVR4nO3asWqWZxyH4SclcRRXEaxHoEunksVMXUTBOQfRI+lBZBaULJ3iEjp18giCIF3F0Qxfp44BNcn3b777uo7gBw/v+97wvHubzWYBAC0/TQ8AALZPAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgKD96QHbdu/N57/WWo+md3BnvDg6P/4wPYLvd3Z48nStdTq9gzvj09fXD36dHrFNuQBYa/2y1jqYHgFsxePpAdwZD6cHbFvxCuCf6QHcGZfTA7g2Z8i3yn0bigEAAHkCAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAHC1g+kBXJszhCvsTw/gxr2aHrBjLqYH8MMulufhpr2dHsDNEQA76Oj8+N30Bph2dH78Za3lWbghZ4cnL6c3cLNcAQBAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABA0P70gEGX0wNuwcH0AGDneXfuiGIAvJgecMsupgcAO+n9WuvZ9Ahuzt5ms5nesFW//b7r338AfsSff5xOT9gq/wAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAE7W02m+kNW3Xvzeen0xtu2cXR+fGX6RHAbjk7PLm/1noyveM2fX394MP0hm3anx4w4HSt9XitdTk95BYcrLVerbXeDe8Ads/ztdbbtbvvzo9rrZ+nh2xTMQD+czA9AOAO8u7cEf4BAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAIAgAQAAQQIAAIIEAAAECQAACBIAABAkAAAgSAAAQJAAAICg/ekB3Lyzw5OX0xt2yPuj8+Mv0yP4fmeHJ/fXWs+nd8D/lQDYPW+nB+yYZ2utD9Mj+CFPlucBruQKAK52OT2Aa3OGcAUBAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIEgAAECQAACBIAABAkAAAgCABAABBAgAAggQAAAQJAAAIKgbAw+kB3BkH0wO4NmfIt8p9G/anBwz4e631aHoEsBUfpwdwZ3yaHrBte5vNZnoDALBlxSsAAMgTAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIEgAAECQAACAIAEAAEECAACCBAAABAkAAAgSAAAQJAAAIOhfeTZMkdkj+WAAAAAASUVORK5CYII=');
    background-size: contain;
    background-repeat: no-repeat;
}

</style>
<script>
  // export
  export default {
    layout: 'player',
    head () {
      return {
        title: 'Odtwarzacz',
        // script: [
        //   {
        //     src: 'https://content.jwplatform.com/libraries/KB5zFt7A.js'
        //   },
        //   {
        //     src: 'https://cdn.jsdelivr.net/npm/p2p-media-loader-hlsjs@latest/build/p2p-media-loader-hlsjs.min.js'
        //   },
        //   {
        //     src: 'https://cdn.jsdelivr.net/npm/p2p-media-loader-core@latest/build/p2p-media-loader-core.min.js'
        //   },
        //   {
        //     src: 'https://cdn.jsdelivr.net/npm/fast-text-encoding@1.0.3/text.min.js'
        //   },
        // ]
      }
    },
    mounted() {
      var vp = jwplayer("videoContainer");
                  var config = {pipIcon:'disabled',"title":"","autostart":false,"repeat":false,"mute":false,"rewind":true,"image":"https://www.themoviedb.org/t/p/original/qw3J9cNeLioOLoR68WX7z79aCdK.jpg","abouttext":"GunDeveloper.com","aboutlink":"https:\/\/gundeveloper.com","tracks":[],"sources":[{"file":"https://goflix.pl/proxy/?url=https://vidoza.net/embed-0xizjjc9qpgo.html","type":"mp4","label":"Original"}],"sharing":false,"controls":true,"hlshtml":true,"primary":"html5","preload":"metadata","cast":[],"androidhls":true,"displaytitle":false,"displaydescription":false,"playbackRateControls":true,"captions":{"color":"#ffff00","backgroundOpacity":0}};

                  vp.setup(config);
                  vp.on("ready", function(){
                      document.getElementById("mContainer").style.display="none";
                      document.getElementById("videoContainer").style.display="block";
                      var mt = localStorage.getItem("jwplayer.mute");
                      var vl = localStorage.getItem("jwplayer.volume");
                      if(mt !== null) vp.setMute(mt);
                      if(vl !== null) vp.setVolume(parseInt(vl));
                  });

                  vp.on("beforePlay", function(){
                      var list = document.getElementsByClassName("jw-button-container");
                      var rewind = document.querySelector("[button=\"rewind\"]");
                      var forward = document.querySelector("[button=\"forward\"]");
                      if(list.length){
                          list[0].insertBefore(rewind, list[0].childNodes[2]);
                          list[0].insertBefore(forward, list[0].childNodes[4]);
                      }
                  });

                  vp.addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-forward" viewBox="0 0 1024 1024" focusable="false"><path d="M561.948444 262.712889l67.015112 79.644444 206.961777-174.08-56.832-38.627555a468.48 468.48 0 1 0 201.216 328.817778l-103.310222 13.141333a364.487111 364.487111 0 0 1-713.557333 139.605333 364.373333 364.373333 0 0 1 479.971555-435.541333l14.904889 5.973333-96.369778 81.066667zM329.955556 379.505778h61.610666v308.167111H329.955556zM564.167111 364.088889c61.269333 0 110.933333 45.511111 110.933333 101.717333v135.566222c0 56.149333-49.664 101.660444-110.933333 101.660445s-110.933333-45.511111-110.933333-101.660445V465.749333c0-56.149333 49.664-101.660444 110.933333-101.660444z m0 56.490667c-27.249778 0-49.322667 20.252444-49.322667 45.226666v135.566222c0 24.974222 22.072889 45.169778 49.322667 45.169778 27.192889 0 49.265778-20.195556 49.265778-45.169778V465.749333c0-24.917333-22.072889-45.169778-49.265778-45.169777z" p-id="7407"></path></svg>', "Forward 10 Seconds", function() {
                      var seek = 0, time = vp.getPosition() + 10;
                      seek = time <= 0 ? 0 : time;
                      vp.seek(seek);
                      return true;
                  }, "forward");

                  vp.addButton('<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-rewind" viewBox="0 0 1024 1024" focusable="false"><path d="M455.68 262.712889l-67.072 79.644444-206.904889-174.08 56.775111-38.627555a468.48 468.48 0 1 1-201.216 328.817778l103.310222 13.141333a364.487111 364.487111 0 0 0 713.614223 139.605333 364.373333 364.373333 0 0 0-479.971556-435.541333l-14.904889 5.973333 96.312889 81.066667zM329.955556 379.505778h61.610666v308.167111H329.955556zM564.167111 364.088889c61.269333 0 110.933333 45.511111 110.933333 101.717333v135.566222c0 56.149333-49.664 101.660444-110.933333 101.660445s-110.933333-45.511111-110.933333-101.660445V465.749333c0-56.149333 49.664-101.660444 110.933333-101.660444z m0 56.490667c-27.249778 0-49.322667 20.252444-49.322667 45.226666v135.566222c0 24.974222 22.072889 45.169778 49.322667 45.169778 27.192889 0 49.265778-20.195556 49.265778-45.169778V465.749333c0-24.917333-22.072889-45.169778-49.265778-45.169777z" p-id="7377"></path></svg>', "Rewind 10 Seconds", function() {
                      var seek = 0, time = vp.getPosition() - 10;
                      seek = time <= 0 ? 0 : time;
                      vp.seek(seek);
                      return true;
                  }, "rewind");
              				window.addEventListener("message", function(e) {
      					if (e.data == 'autoplay') {
      						vp.play();
      						var vid = document.getElementsByTagName("video")[0];
      						if (vid.requestFullscreen) {
      							vid.requestFullscreen();
      						} else if (vid.mozRequestFullScreen) {
      							vid.mozRequestFullScreen();
      						} else if (vid.webkitRequestFullscreen) {
      							vid.webkitRequestFullscreen();
      						}
      					}
      				});
      				window.onorientationchange = function(e) {
      					if (e.landscape) {
      						var vid = document.getElementsByTagName("video")[0];
      						if (vid.requestFullscreen) {
      							vid.requestFullscreen();
      						} else if (vid.mozRequestFullScreen) {
      							vid.mozRequestFullScreen();
      						} else if (vid.webkitRequestFullscreen) {
      							vid.webkitRequestFullscreen();
      						}
      					}
      				}


    }
  }
</script>
