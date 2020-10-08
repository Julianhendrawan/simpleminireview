<template>
  <div class="formreviews">
    <form @submit="kirimReview">
      <h2 class="title">
        Review <img class="bintang" src="../assets/brev.png" />
      </h2>
      <!-- input data -->
      <input type="text" class="inputnama" placeholder="id" v-model="id" />
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

      <!-- button input data -->
      <button class="btnupload btnuploadhover">Upload Gambar</button>
      <button type="submit" class="btnkirim btnkirimhover">Kirim</button>
    </form>
  </div>
</template>

<script type="text/javascript">
export default {
  name: "formReviews",
  props: {
    propKirimReview: {
      type: Function,
    },
    propUpdateReview: {
      type: Function,
    },
    propDataForm: {
      type: Object,
    },
  },
  data: function () {
    return {
      id: 0,
      nama: "",
      komentar: "",
    };
  },
  methods: {
    kirimReview(e) {
      e.preventDefault();
      if (this.id === 0) {
        this.propKirimReview(this.nama, this.komentar);
      } else {
        this.propUpdateReview(this.id, this.nama, this.komentar);
      }
    },
  },
  watch: {
    propDataForm: function (review) {
      this.id = review.id;
      this.nama = review.nama;
      this.komentar = review.komentar;
    },
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
  margin-top: 15px;
  width: 80%;
  height: 90px;
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