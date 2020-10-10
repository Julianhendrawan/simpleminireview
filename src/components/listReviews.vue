<template>
  <div class="listReviews">
    <!-- hasil output -->
    <div
      v-for="(row, index) in reviews"
      :key="index"
      class="cardreview cardreviewhover"
    >
      <button class="btnedit btnedithover" @click="editReview(row.id)">
        Edit
      </button>
      <button @click="submitRemove(row.id)" class="btndelete btndeletehover">
        Delete
      </button>
      <div class="foto"></div>
      <h4 class="nama">{{ row.nama }} {{ index }}</h4>
      <h5 class="tanggal">2 Desember 2018</h5>
      <img class="bintangrev" src="../assets/brev.png" />
      <br />
      <h5 class="komentar">{{ row.komentar }}</h5>
      <div class="fotoreview"><br />Gambar</div>
    </div>
  </div>
</template>

<script type="text/javascript">
import axios from "axios";

export default {
  name: "listReviews",
  data: function () {
    return {
      reviews: [],
    };
  },
  methods: {
    editReview(id) {
      let dataForm = this.reviews.find((review) => review.id === id);
      this.$root.$emit("emitForm", dataForm);
    },
    submitRemove(id) {
      let params = new URLSearchParams();
      params.append("id", id);

      axios
        .post("http://localhost/simpleminireview/review/delete", params)
        .then((response) => {
          let data = {
            id: response.data.id,
          };
          this.reviews.splice(data, 1);
          this.getData();
        });
    },
    resetInput() {
      this.id = 0;
      this.nama = "";
      this.komentar = "";
    },
    getData() {
      axios.get("http://localhost/simpleminireview/review").then((response) => {
        this.reviews = response.data;
      });
    },
  },
  mounted() {
    this.getData();

    this.$root.$on("emitUpdateReview", (data) => {
      let reviewIndex = this.reviews.findIndex(
        (review) => review.id === data.id
      );

      this.reviews[reviewIndex].nama = data.nama;
      this.reviews[reviewIndex].komentar = data.komentar;
    });
    this.$root.$on("emitSaveReview", (data) => {
      let newReview = {
        id: data.id,
        nama: data.nama,
        komentar: data.komentar,
      };
      this.reviews.unshift(newReview);
      this.editReview(data.id);
    });
  },
};
</script>

<style>
.btnedit {
  margin-left: -90px;
  margin-right: 5px;
  border: 1px solid black;
  font-size: 12px;
  margin-top: 15px;
  letter-spacing: 1px;
  cursor: pointer;
  border-radius: 2px;
  padding: 7px 25px;
  outline: none;
  float: right;
  background: #fffc68;
}

.btnedithover:hover {
  background: #c5c221;
}

.btndelete {
  margin-left: -90px;
  margin-right: 5px;
  border: 1px solid black;
  font-size: 12px;
  margin-top: 50px;
  letter-spacing: 1px;
  cursor: pointer;
  border-radius: 2px;
  padding: 7px 17px;
  outline: none;
  float: right;
  background: #ff8686;
}

.btndeletehover:hover {
  background: #c74f4f;
}

.cardreview {
  width: 80%;
  height: 200px;
  position: relative;
  overflow: hidden;
  background: rgb(255, 255, 255);
  margin: 0 auto;
  margin-top: 20px;
  border: 2px solid black;
  background: #ffffff;
}

.cardreviewhover:hover {
  background: #f8f8f8;
}

.foto {
  width: 50px;
  height: 50px;
  margin-left: 10px;
  margin-top: 10px;
  border: 2px solid black;
  border-radius: 50%;
  background: #e6e5e5;
}

.nama {
  margin-top: -50px;
  margin-left: -32%;
  font-size: 16px;
}

.tanggal {
  margin-top: -20px;
  margin-left: -15%;
  font-size: 14px;
  color: #979797;
}

.komentar {
  margin-top: -5px;
  margin-left: -15%;
  font-size: 14px;
}

.fotoreview {
  width: 110px;
  height: 50px;
  margin-left: 80px;
  margin-top: 10px;
  border: 2px solid black;
  background: #e6e5e5;
}

.bintangrev {
  margin-left: 80px;
  margin-top: -20px;
  width: 70px;
  height: 20px;
  float: left;
}
</style>