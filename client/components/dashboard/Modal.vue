<template>
   <div class="modal-body" @keyup.esc="close" @keydown.esc="close" v-show="activated">
      <div class="mfp-bg my-mfp-zoom-in mfp-ready"></div>
      <div tabindex="-1" class="mfp-wrap mfp-close-btn-in mfp-auto-cursor my-mfp-zoom-in mfp-ready" style="overflow: hidden auto;">
         <div class="mfp-container mfp-inline-holder">
            <div class="mfp-content">
               <div id="modal-status" class="zoom-anim-dialog modal">
                  <h6 class="modal__title"><slot name="title"></slot></h6>
                  <p class="modal__text"><slot name="description"></slot></p>
                  <div class="modal__btns"><button type="button" @click="accept" class="modal__btn modal__btn--apply">Potwierdź</button> <button type="button" @click="close" class="modal__btn modal__btn--dismiss">Anuluj</button></div>
                  <button title="Close (Esc)" type="button" class="mfp-close">×</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
      name: "Modal",
      props: ["activated"],
      methods: {
        close() {
          this.$emit('update:activated', false)
          document.body.removeAttribute("style")
        },
        accept() {
          this.$emit('update:activated', false)
          this.$emit('acceptStatus')
        }
      },
      watch: {
        activated() {
          if(this.activated) {
            document.body.style.overflow = 'hidden'

          }
        }
      }
    }
</script>
