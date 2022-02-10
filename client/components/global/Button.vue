<template>
  <button :type="nativeType" :disabled="loading" :class="{
    'btn-loading': loading
  }"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'VButton',

  props: {


    nativeType: {
      type: String,
      default: 'submit'
    },

    loading: {
      type: Boolean,
      default: false
    },

  }
}
</script>
