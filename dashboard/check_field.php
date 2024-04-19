<? 
include "../frontend/db.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $fieldName = $_POST['fieldName'];
      $fieldValue = $_POST['fieldValue'];
      $tableName = $_POST['tableName'];

      $fieldValue = sanitizeInput($fieldValue);

      $query = 'SELECT COUNT(*) FROM $tableName WHERE $fieldName =?';
      $stmt = $conn ->prepare($query);
      $stmt ->bind_param('s', $fieldValue);
      $stmt->execute();
      print_r($stmt);

}
?>