<template>
  <div id="app">
    <div class="card">
      <FormReviews />
      <div class="line"></div>
      <div class="framereview">
        <ListReviews />
      </div>
    </div>
  </div>
</template>

<script>
import ListReviews from "./components/listReviews.vue";
import FormReviews from "./components/formReviews.vue";

export default {
  name: "App",
  data: function () {
    return {};
  },
  components: {
    ListReviews,
    FormReviews,
  },
  methods: {},
};
</script>

<style>
body {
  margin: 0px;
  overflow: hidden;
}
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  color: #2c3e50;
  padding: 0px;
  text-align: center;
  display: flex;
  width: 100%;
}

.card {
  width: 411px;
  height: 823px;
  position: relative;
  overflow: hidden;
  background: rgb(255, 255, 255);
  margin: 0 auto;
  margin-top: 20px;
  border: 3px solid black;
}

.line {
  padding: 25px 15px;
  border-bottom: 1px solid black;
}

.framereview {
  overflow-y: scroll;
  overflow-x: hidden;
  height: 48vh;
}

/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f7f7f7;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
