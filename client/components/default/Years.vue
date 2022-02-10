<template>
    <ul class="registration-years-choice">
      <li @click="selectYear(year)" v-for="(year, i) in getYears" :key="i" :class="years.includes(year) ? 'active':''"><i class="fas fa-check-circle"></i><h6>{{year}}</h6></li>
    </ul>
</template>
<script>
export default {
  name: "Years",
  data: () => ({
    years:[]
  }),
  computed: {
    getYears () {
      const year = new Date().getFullYear()
      return Array.from({length: year - 1980}, (value, index) => year - index)
    }
  },
  methods: {
    selectYear(id) {
      this.years.push(id)
    }
  }
};
</script>
