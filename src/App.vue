<template>
  <div id="app">
    <div class="card">
      <FormReviews
        :propKirimReview="kirimReview"
        :propUpdateReview="updateReview"
        :propDataForm="dataForm"
      />
      <div class="line"></div>
      <div class="framereview">
        <ListReviews
          :propReviews="reviews"
          :propRemoveReview="removeReview"
          :propEditReview="editReview"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ListReviews from "./components/listReviews.vue";
import FormReviews from "./components/formReviews.vue";
import axios from "axios";

export default {
  name: "App",
  data: function () {
    return {
      dataForm: {},
      reviews: [],
    };
  },
  components: {
    ListReviews,
    FormReviews,
  },
  methods: {
    editReview(id) {
      this.dataForm = this.reviews.find((review) => review.id === id);
    },
    kirimReview(nama, komentar) {
      let newId = 0;
      if (this.reviews.length === 0) {
        newId = 1;
      } else {
        newId = this.reviews[this.reviews.length - 1].id + 1;
      }

      let newReview = { id: newId, nama: nama, komentar: komentar };
      this.reviews.push(newReview);
      this.editReview(newId);
    },
    updateReview(id, nama, komentar) {
      let reviewIndex = this.reviews.findIndex((review) => review.id === id);

      this.reviews[reviewIndex].nama = nama;
      this.reviews[reviewIndex].komentar = komentar;
    },
    removeReview(id) {
      let reviewIndex = this.reviews.findIndex((review) => review.id === id);
      this.reviews.splice(reviewIndex, 1);
    },
    getData() {
      axios.get("http://localhost/simpleminireview/review").then((response) => {
        console.log(response);
        this.reviews = response.data;
      });
    },
  },
  mounted() {
    this.getData();
  },
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
