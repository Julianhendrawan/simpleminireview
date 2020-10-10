<template>
  <div class="formreviews">
    <form @submit="submitReview">
      <h2 class="title">
        Review <img class="bintang" src="../assets/brev.png" />
      </h2>
      <!-- input data -->
      <input
        type="text"
        class="inputnama"
        placeholder="id"
        v-model="id"
        hidden
      />
      <input
        type="text"
        class="inputnama"
        placeholder="Tulis Nama Kamu"
        v-model="nama"
      />

      <textarea
        type="text"
        class="inputreview"
        placeholder="Tulis Review Terbaik mu..."
        v-model="komentar"
      ></textarea>

      <input
        type="number"
        class="inputrating"
        placeholder="Nilai Rating 1 - 5"
        v-model="rating"
      />

      <!-- button input data -->
      <button class="btnupload btnuploadhover">Upload Gambar</button>
      <button type="submit" class="btnkirim btnkirimhover">Kirim</button>
    </form>
  </div>
</template>

<script type="text/javascript">
import axios from "axios";

export default {
  name: "formReviews",
  props: {},
  data: function () {
    return {
      id: 0,
      nama: "",
      komentar: "",
      rating: "",
    };
  },
  methods: {
    submitReview(e) {
      e.preventDefault();

      if (this.id === 0) {
        let params = new URLSearchParams();
        params.append("nama", this.nama);
        params.append("komentar", this.komentar);
        params.append("rating", this.rating);

        axios
          .post("http://localhost/simpleminireview/review/create", params)
          .then((response) => {
            let data = {
              id: response.data.id,
              nama: this.nama,
              komentar: this.komentar,
              rating: this.rating,
            };
            this.$root.$emit("emitSaveReview", data);
            this.resetInput();
          });
      } else {
        let params = new URLSearchParams();
        params.append("id", this.id);
        params.append("nama", this.nama);
        params.append("komentar", this.komentar);
        params.append("rating", this.rating);

        axios
          .post("http://localhost/simpleminireview/review/update", params)
          .then((response) => {
            let data = {
              id: response.data.id,
              nama: this.nama,
              komentar: this.komentar,
              rating: this.rating,
            };
            this.$root.$emit("emitUpdateReview", data);
            this.resetInput();
          });
      }
    },
    resetInput() {
      this.id = 0;
      this.nama = "";
      this.komentar = "";
      this.rating = "";
    },
  },
  mounted() {
    this.$root.$on("emitForm", (data) => {
      this.id = data.id;
      this.nama = data.nama;
      this.komentar = data.komentar;
      this.rating = data.rating;
    });
  },
};
</script>

<style>
.bintang {
  width: 160px;
  height: 30px;
  float: right;
  margin-right: 30px;
  margin-top: 10px;
}

.title {
  margin-left: 0%;
  font-size: 40px;
}

.inputnama {
  margin-left: 0;
  width: 80%;
  height: 30px;
  font-size: 18px;
  background: #e6e5e5;
}

.inputreview {
  margin-left: 0;
  margin-top: 10px;
  width: 80%;
  height: 90px;
  font-size: 18px;
  background: #e6e5e5;
}

.inputrating {
  margin-left: 0;
  margin-top: 5px;
  width: 80%;
  height: 30px;
  font-size: 18px;
  background: #e6e5e5;
}

.btnupload {
  margin-left: -10px;
  border: 1px solid black;
  font-size: 12px;
  margin-top: 15px;
  letter-spacing: 1px;
  cursor: pointer;
  border-radius: 2px;
  padding: 7px 25px;
  outline: none;
  background: #6cbdff;
}

.btnuploadhover:hover {
  background: #229afc;
}

.btnkirim {
  margin-left: 70px;
  border: 1px solid black;
  font-size: 12px;
  margin-top: 15px;
  letter-spacing: 1px;
  cursor: pointer;
  border-radius: 2px;
  padding: 7px 25px;
  outline: none;
  background: #2edb8e;
}

.btnkirimhover:hover {
  background: #0ea863;
}
</style>