<template>
  <div class="position-relative search-container">
    <input type="search" v-model="search" class="form-control" placeholder="Search..." />
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
      console.log(clicked, $(clicked).parents(".search-container"));
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
};
</script>

<style lang="scss" scoped>
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
</style>