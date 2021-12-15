<?php
session_start();
include "config.php";


if (isset($_POST["update"])) {
  $id = $_POST["id"];
  $description = $_POST["description"];
  $erinnerung = $_POST["erinnerung"];
  $date = date("Y-m-d", strtotime($_POST["date"]));
  $sql = "UPDATE reminders SET DESCRIPTION='$description',ERINNERUNG='$erinnerung',DATE='$date' WHERE ID={$id}";
}

#Select reminder details from the table
$sql = "SELECT * FROM reminders WHERE ID='{$_GET["id"]}'";
$res = $con->query($sql);
if ($res->num_rows > 0) {
  $row = $res->fetch_assoc();
}


?>


<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body>
  <?php include "navbar.php"; ?>

  <div class='section'>

    <!-- LEFT PART OF THE SCREEN -->
    <div class="left">
      <nav>
        <li>
          <a class="nav-link mylinks" style="margin-top: 7rem;" href="home.php"><span class='fa fa-home'></span> Home</a>
        </li>
        <li>
          <a class="nav-link mylinks" href="articles.php"><span class='fas fa-newspaper'></span> Articles</a>
        </li>

        <li>
          <a class="nav-link mylinks" href="logout.php"><span class='fas fa-sign-out-alt'></span> Logout</a>
        </li>
      </nav>
    </div>



    <!-- MIDDLE PART OF THE SCREEN -->

    <!-- ENTER REMINDER -->
    <div class="middle container">
      <div class="add-reminder mt-5">
        <form action='home.php' method='post' autocomplete='off'>

          <input type="hidden" name="id" value="<?php echo $id; ?>">

          <label>Date</label>
          <input type="text" class="datepicker" name='date' value="<?php echo $date; ?>" required>

          <label>Description</label>
          <input type="text" class="" name='description' value="<?php echo $description; ?>" required>

          <label>Erinnerung</label>
          <select name="erinnerung" id="erinnerung" value="<?php echo $erinnerung; ?>">
            <option value="1 Tag">1 Tag</option>
            <option value="2 Tage">2 Tage</option>
            <option value="4 Tage">4 Tage</option>
            <option value="1 Woche">1 Woche</option>
            <option value="2 Woche">2 Woche</option>
          </select>
          <br>
          <input type='submit' name='update' value='Update & Save' class='mt-2 mb-5 submit-button'>
        </form>
      </div>
      <!-- ENTER REMINDER -->



      <!-- TABLE OF REMINDERS -->
      <div class='reminder-message mt-3'>
        <!-- <?php foreach ($notifications as $row) : ?>
          <div class="" href="#"><?php echo $row; ?></div>
        <?php endforeach; ?> -->

        <table class='table table-bordered mt-2'>
          <thead>
            <tr>
              <td>Datum</td>
              <td>Bezeichnung</td>
              <td>Erinnerung</td>
              <td>Aktion</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM reminders ORDER BY ID DESC";
            $res = $con->query($sql);
            if ($res->num_rows > 0) {
              $i = 0;
              while ($row = $res->fetch_assoc()) {
                $i++;
                echo "
										<tr>
                      <td>" . date("d-m-Y", strtotime($row["DATE"])) . "</td>
											<td>{$row["DESCRIPTION"]}</td>
											<td>{$row["ERINNERUNG"]}</td>
                      <td><a href='edit_reminder.php?id={$row["ID"]}' class=''>Edit</a>
                      <span>|</span>
                      <a href='delete_reminder.php?id={$row["ID"]}' class=''>Delete</a>
                      </td>
										</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="borders mt-3"></div>
    </div>


    <!-- RIGHT PART OF THE SCREEN -->
    <div class="right"></div>
  </div>
</body>

</html>