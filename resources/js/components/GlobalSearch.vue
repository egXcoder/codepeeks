<template>
  <div class="position-relative search-container">
    <div class="search-flex">
      <input ref="search" v-model="search" class="form-control" placeholder="Search..." />
      <i @click="focusSearch()" class="fas fa-search"></i>
    </div>
    <div class="search-results" v-if="showSearchByClicking && results.length">
      <template v-for="(result, index) in results">
        <a :key="index" :href="'/' + result.topic_name + '/' + result.tutorial_name">
          {{ result.tutorial_name }} <span style="color: black">@</span>
          <span>{{ result.topic_name }}</span>
        </a>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: null,
      results: [],
      showSearchByClicking: true,
    };
  },
  watch: {
    search() {
      if (!this.search) {
        this.results = [];
        return;
      }

      window.axios.get("/api/tutorials/search?search=" + this.search).then((response) => {
        this.results = response.data.data;
      });
    },
  },
  mounted() {
    let handler = (event) => {
      let clicked = event.target;
      if (
        $(clicked).hasClass("search-container") ||
        $(clicked).parents(".search-container").length
      ) {
        this.showSearchByClicking = true;
        return;
      }

      this.showSearchByClicking = false;
    };

    window.document.addEventListener("click", handler);

    this.$on("hooks:beforeDestroy", function () {
      window.document.removeEventListener("click", handler);
    });
  },
  methods: {
    focusSearch() {
      $(this.$refs.search).focus();
    },
  },
};
</script>

<style lang="scss" scoped>
.search-container {
  .search-flex {
    display: flex;
    input {
      flex-grow: 1;
      outline: none;
      box-shadow: none;
    }
    i {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0rem 1rem;
      background: var(--secondary-color);
      color: white;
      cursor: pointer;
    }
  }
  .search-results {
    display: flex;
    flex-flow: column;
    position: absolute;
    top: 40px;
    max-height: 300px;
    overflow: auto;
    width: 100%;
    background: white;
    a {
      text-decoration: none;
      color: black;
      padding: 7px;
      &:hover {
        background: var(--secondary-color);
      }
    }
  }
}
</style>