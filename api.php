<?php
     // API SEDERHNA
     header('Access-Control-Allow-Methods: GET, POST');
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Origin: *");
     include_once 'config/Database.php';

     class api {
          private $db = "";

          function __construct() {
               $database = new Database();
               $this->db = $database->koneksi();
          }

          function createReview($nama, $komentar, $rating){
               $getReviews = $this->db->prepare("insert into review (nama, komentar, rating)
                                               VALUES (:nama, :komentar, :rating)");
               $getReviews->execute(['nama' => $nama, 'komentar' => $komentar, 'rating' => $rating]);

               $id = $this->db->lastInsertId();

               return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil disimpan']);
          }


          function deleteReview($id){
               $deleteReviews = $this->db->prepare("DELETE FROM review WHERE id = :id");
               $deleteReviews->execute(['id' => $id]);

               return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil dihapus']);
          }

          function updateReview($id, $nama, $komentar, $rating){
               $getReviews = $this->db->prepare("UPDATE review SET nama = :nama,
                                                               komentar = :komentar,
                                                               rating = :rating
                                                               WHERE id = :id");
               $getReviews->execute(['id' => $id,
                                   'nama' => $nama,
                                   'komentar' => $komentar,
                                   'rating' => $rating]);

               return json_encode(['status' => true, 'id' => $id, 'pesan' => 'data berhasil diubah']);
          }

          function allReviews(){
               $getReviews = $this->db->prepare("SELECT * FROM review ORDER BY id DESC");
               $getReviews->execute();
               $reviews = $getReviews->fetchAll(PDO::FETCH_ASSOC);

               return json_encode($reviews);
          }

          function getReview($id = false){
               $getReviews = $this->db->prepare("SELECT * FROM review WHERE id = :id");
               $getReviews->execute(['id' => $id]);
               $reviews = $getReviews->fetchAll(PDO::FETCH_ASSOC);

               return json_encode($reviews);
          }
     }

     $api = new Api();
     $f = $_GET["f"] ?? false;

     if($f == "CREATE"){
          echo $api->createReview($_POST['nama'], $_POST['komentar'], $_POST['rating']);
     }
     else if($f == "UPDATE"){
          echo $api->updateReview($_POST['id'], $_POST['nama'], $_POST['komentar'], $_POST['rating']);
     }
     else if($f == "DELETE"){
          echo $api->deleteReview($_POST['id']);
     }
     else{
          if(isset($_GET['id'])){
               echo $api->getReview($_GET['id']);
          }else{
               echo $api->allReviews();
          }
     }

?>
