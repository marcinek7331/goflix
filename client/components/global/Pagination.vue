<template>
  <ul v-if="data.data" class="page-numbers">
    <li>
      <a class="previous page-numbers"
        href="#"
        @click.prevent="paginateTo(previousPage)"
        ><i class="fas fa-chevron-left"></i></a
      >
    </li>
    <li
      v-for="(_page, index) in pages"
      :key="index"
    >
      <a v-if="!isActive(_page)" class="page-numbers"
        href="#"
        @click.prevent="paginateTo(_page)"
      >{{ _page }}
      </a>
      <span v-else class="page-numbers current">{{ _page }}</span>
    </li>
    <li
      v-if="showNextPrev"
      :class="[
        listItemClass,
        !hasNext ? (disableClassIn === 'li' ? disableClass : '') : ''
      ]"
    >
      <a class="next page-numbers"
        href="#"
        @click.prevent="paginateTo(nextPage)"
        ><i class="fas fa-chevron-right"></i></a
      >
    </li>
  </ul>
</template>
<script>
export default {
  name: "Pagination",
  props: {
    data: {
      // laravel pagination data object
      type: Object,
      required: true
    },
    onEachSide: {
      // number of pages each side of current page
      type: Number,
      default: 3
    },
    showNextPrev: {
      // show next previous button
      type: Boolean,
      default: true
    },
    dots: {
      // dots of hidden numbers
      type: String,
      default: "..."
    },
    useStyle: {
      // pagination style
      type: String,
      default: "default",
      validator: value => {
        return ["default", "bootstrap", "custom"].indexOf(value) !== -1;
      }
    },
    alignment: {
      // custom alignment
      type: String,
      default: null,
      validator: value => {
        return [null, "left", "center", "right"].indexOf(value) !== -1;
      }
    },
    activeClass: {
      // pagination active class
      type: String,
      default: "current"
    },
    activeClassIn: {
      // active class placement
      type: String,
      default: "a",
      validator: value => {
        return ["li", "a"].indexOf(value) !== -1;
      }
    },
    listClass: {
      // list (ul) class
      type: String,
      default: "pagination"
    },
    listItemClass: {
      // lit item (li) class
      type: String,
      default: "page-item"
    },
    contentAlignClass: {
      // content align class
      type: String,
      default: "justify-content-center"
    },
    linkClass: {
      // link class
      type: String,
      default: "page-link"
    },
    disableClass: {
      // disable class
      type: String,
      default: "disabled"
    },
    disableClassIn: {
      // diable class placement
      type: String,
      default: "li",
      validator: value => {
        return ["li", "a"].indexOf(value) !== -1;
      }
    },
    previousText: {
      // previous button text
      type: String,
      default: "Previous"
    },
    nextText: {
      // next  button text
      type: String,
      default: "Next"
    }
  },
  computed: {
    isResourceApi() {
      return this.data.meta ? true : false;
    },
    hasPrevious() {
      // has previous page
      return this.currentPage > 1;
    },
    previousPage() {
      // previous page
      return this.currentPage - 1;
    },
    currentPage() {
      // current page
      return this.isResourceApi
        ? this.data.meta.current_page
        : this.data.current_page;
    },
    nextPage() {
      // next page number
      return this.currentPage + 1;
    },
    hasNext() {
      // has next page
      return this.nextPage <= this.totalPage;
    },
    totalPage() {
      // total pages
      return this.isResourceApi
        ? this.data.meta.last_page
        : this.data.last_page;
    },
    pages() {
      // if less
      if (this.onEachSide <= -1) {
        return this.totalPage;
      }
      // pages
      let pages = [];
      for (let i = 1; i <= this.totalPage; i++) {
        if (
          i == 1 ||
          (this.currentPage - this.onEachSide <= i &&
            this.currentPage + this.onEachSide >= i) ||
          i == this.currentPage ||
          i == this.totalPage
        ) {
          pages.push(i);
        } else if (
          i == this.currentPage - (this.onEachSide + 1) ||
          i == this.currentPage + (this.onEachSide + 1)
        ) {
          pages.push(this.dots);
        }
      }
      return pages;
    },
    customAlign() {
      // custom align
      let _align = "";
      if (this.alignment == "left") {
        _align = "default-left";
      } else if (this.alignment == "center") {
        _align = "default-center";
      } else if (this.alignment == "right") {
        _align = "default-right";
      }
      return _align;
    }
  },
  methods: {
    isActive(pageNumber) {
      // is active
      return pageNumber == this.currentPage;
    },
    isDot(content) {
      return content == this.dots ? true : false;
    },
    paginateTo(pageNumber) {
      // if page number is not valid
      if (pageNumber < 1 || pageNumber > this.totalPage) {
        return;
      }
      // goto page
      this.$emit("paginateTo", pageNumber);
    }
  }
};
</script>
