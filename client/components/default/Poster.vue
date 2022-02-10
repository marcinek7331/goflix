<template>
  <div v-if="type=='movie'" class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
    <div class="poster animation">
        <div class="inner" >
          <a :title="data.original_title.length > 0 ? data.title+' / '+data.original_title : data.title">
            <img v-lazy="'https://image.tmdb.org/t/p/w342'+data.poster_path"  :alt="data.original_title.length > 0 ? data.title+' / '+data.original_title : data.title" class="img-responsive">
          </a>
          <div class="glimmer"></div>
          <p class="play"></p>
        </div>
        <h1 class="film_title" v-text="data.original_title.length > 0 ? data.title+' / '+data.original_title : data.title"></h1>
        <div class="film_year">{{data.release_date.substr(0, 4)}}</div>
        <div v-if="animation" class="active"></div>
    </div>
  </div>
  <div v-else class="col-6 col-xs-4 col-md-2 col-sm-2 col-lg-2">
    <div class="poster animation">
        <div class="inner" >
          <a :title="data.original_name.length > 0 ? data.name+' / '+data.original_name : data.name">
            <img v-lazy="'https://image.tmdb.org/t/p/w342'+data.poster_path" :alt="data.original_name.length > 0 ? data.name+' / '+data.original_name : data.name" class="img-responsive">
          </a>
          <div class="glimmer"></div>
          <p class="play"></p>
        </div>
        <h1 class="film_title" v-text="data.original_name.length > 0 ? data.name+' / '+data.original_name : data.name"></h1>
        <div class="film_year">{{data.first_air_date.substr(0, 4)}}</div>
        <div v-if="animation" class="active"></div>
    </div>
  </div>
</template>

<script>
import Card from '~/components/default/Card'

export default {
    components: {Card},
    name: 'Poster',
    props: ['data', 'active', 'type'],
    data() {
        return {
            zHeight: 80,
            rotation: 10,
        }
    },
    computed: {
      animation() {
        return this.active == this.data.id ? true : false
      }
    },
    methods: {
        render(el, x, y, factor) {
            x *= factor;
            y *= factor;
            el.style.transform =
                'rotateY(' + x + 'deg)' +
                'rotateX(' + y + 'deg)' +
                'translateZ(' + this.zHeight + 'px)' +
                'translateX(' + (3 * -x) + 'px)' +
                'translateY(' + (3 * y) + 'px)';
        },
        shimmer(x, y, dx, dy) {
            this.glimmer.style.background = 'radial-gradient( circle at ' +
                x + 'px ' + y + 'px, ' +
                'rgba(255,255,255,' + Math.max(Math.abs(dx), Math.abs(dy)) / 2 + ') 0%,' +
                'rgba(255,255,255,0) 100% )';
        },
        move(ev) {
          if(!this.animation) {
            let x = ev.offsetX,
                y = ev.offsetY,
                w = this.$el.offsetWidth,
                w2 = w / 2,
                h = this.$el.offsetHeight,
                h2 = h / 2,
                rot = this.rotation,
                _x, _y;

            // calculate x rotattion
            _x = (1 / w2) * (x - w2) * rot * -1;

            // calculate y rotation
            _y = (1 / h2) * (y - h2) * rot;

            // draw
            this.render(this.inner, _x, _y, 1);
            this.render(this.play, _x, _y, 0.5);
            this.shimmer(x, y, (1 / w2) * (x - w2), (1 / h2) * (y - h2));
          }
          else {
            this.stop()
          }
        },
        stop(ev) {
            this.inner.style.transform = '';
            this.glimmer.style.background = '';
        }
    },
    mounted() {
        this.glimmer = this.$el.querySelector('.glimmer');
        this.inner = this.$el.querySelector('.inner');
        this.play = this.$el.querySelector('.play');

        this.$el.addEventListener('mousemove', ev => {
            window.requestAnimationFrame(() => {
                this.move(ev);
            });
        });
        this.$el.addEventListener('mouseleave', ev => {
            window.requestAnimationFrame(() => {
                this.stop(ev);
            });
        });
    }
}
</script>
