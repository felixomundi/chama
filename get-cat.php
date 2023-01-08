<?php
include "db_config.php";
$category_id = $_POST["category_id"];
$result = mysqli_query($con, "SELECT * FROM plans where id = $category_id");
?>
<option value="">Read Terms</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["terms"]; ?></option>
    <?php
}
?>