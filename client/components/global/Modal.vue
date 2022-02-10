<template>
   <div class="modal-body" @keyup.esc="close" @keydown.esc="close" v-bind:class="{'active': activated }">
      <div class="modal-content">
           <div class="modal-content-container">
             <div class="modal-content-header">
               <slot name="header"></slot>
             </div>
             <div class="modal-content-body">
               <slot name="body"></slot>
             </div>
           </div>
      </div>
      <div class="modal-close" @click="close"><i class="icon-Close"></i></div>
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
          this.$emit('accept')
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
