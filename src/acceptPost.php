<?php 

function get_connection(){
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "fake_db_name";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  return $conn;
}


function insert_user($user_data){
  $ret;
  $db_conn = get_connection();
  try {
   $sql = "INSERT INTO users (username)
    VALUES (:username)";
  $stmt = $db_conn->prepare($sql);
  $stmt->bindParam(':username', $user_data['name']);
  $stmt->execute();
  $ret = "Insert Successful";
  } catch(PDOException $e) {
    echo "Insert Failed: " . $e->getMessage();
    $ret = "Insert Failed";
  } finally {
    $db_conn = null;
  }
  return $ret;
}


$user = json_decode(file_get_contents('php://input'), true);

echo insert_user($user);
?>
