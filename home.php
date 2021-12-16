<?php
session_start();
require("config.php");

if (!isset($_SESSION["login_info"])) {
  header("location:index.php");
}

$reminders = [];
$current_month_day = date("m-d");
$current_year = date("Y");


$sql = "SELECT * FROM reminders WHERE DATE_FORMAT(DATE, '%m-%d')='{$current_month_day}' AND C_YEAR<>'{$current_year}'";
$res = $con->query($sql);
if ($res->num_rows > 0) {
  while ($row = $res->fetch_assoc()) {
    $reminders[] = $row;
  }
}

if (isset($_POST["reg"])) {
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  $description = mysqli_real_escape_string($con, $_POST["description"]);
  $erinnerung = mysqli_real_escape_string($con, $_POST["erinnerung"]);
  $date = date("Y-m-d", strtotime($_POST["date"]));

  $sql = "INSERT INTO reminders (DESCRIPTION,ERINNERUNG,DATE,C_YEAR) VALUES ('{$description}','{$erinnerung}','{$date}','-')";
  if ($con->query($sql)) {
  } else {
    echo "<div class='alert alert-danger'>Failed Try Again</div>";
  }
}


$notifications=[];
$current_month_day=date("m-d");
$sql="SELECT * FROM reminders WHERE DATE_FORMAT(DATE, '%m-%d')='{$current_month_day}'";
$res=$con->query($sql);
if($res->num_rows>0){
  while($row=$res->fetch_assoc()){
    $date=(date("Y")-date("Y",strtotime($row["DOB"])))+1;
    $notifications[]="<i class='fa fa-bell'></i> Reminder <b>{$row["DESCRIPTION"]} </b> event is today <b>".date("d-m-Y",strtotime($row["DATE"]))."</b> 
    <a style='position:absolute; right:20px ' href='delete_reminder.php?id={$row["ID"]}' class=''>X</a>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body>
  <?php include "logo.php"; ?>

  <div class="section">

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

    <div class="middle container">
        <div class="add-reminder mt-5">
          <form action='home.php' method='post' autocomplete='off'>
            <label>Date</label>
            <input type="text" class="datepicker" name='date' placeholder="dd-mm-yyyy" required>

            <label>Description</label>
            <input type="text" class="" name='description' placeholder="Description" required>

            <label>Erinnerung</label>
            <select name="erinnerung" id="erinnerung">
              <option value="1 Tag">1 Tag</option>
              <option value="2 Tage">2 Tage</option>
              <option value="4 Tage">4 Tage</option>
              <option value="1 Woche">1 Woche</option>
              <option value="2 Woche">2 Woche</option>
            </select>
            <br>
            <input type='submit' name='reg' value='Speichern' class='mt-2 mb-5 submit-button'>
          </form>
      </div>

      <div class='reminder-message mt-5'>
        <?php foreach ($notifications as $row) : ?>
          <div class="alert alert-primary mb-3 pt-4 pb-4" href="#"><?php echo $row; ?></div>
        <?php endforeach; ?>

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
      <div class="borders mt-5"></div>
    </div>

    
			
			
				


  
    <!-- RIGHT PART OF THE SCREEN -->
    <div class="right"></div>
  </div>
</body>

</html>