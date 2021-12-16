<?php
  session_start();
  include "config.php";
  
  #Check if form submitted
  $message="";
  if($_SERVER["REQUEST_METHOD"]=='POST'){
    $description=mysqli_real_escape_string($con,$_POST["description"]);
    $erinnerung=mysqli_real_escape_string($con,$_POST["erinnerung"]);
    $date=mysqli_real_escape_string($con,$_POST["date"]);

    $sql="UPDATE reminders SET DESCRIPTION='{$description}',ERINNERUNG='{$erinnerung}',DATE='{$date}' WHERE ID='{$_GET["id"]}'";
    if($con->query($sql)){
      flash('msg','Reminder Updated Successfully');
    }else{
      flash('msg','Reminder Update Failed','red');
    }
  }
  
  #Select reminder details from the table
  $sql="SELECT * FROM reminders WHERE ID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
    $row=$res->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body>
  <?php include "logo.php"; ?>

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
        <form method='post' action='<?php echo $_SERVER["REQUEST_URI"]; ?>'>

          <label>Date</label>
          <input type="text" class="datepicker" name='date' required value="<?php echo $row["DATE"]; ?>">

          <label>Description</label>
          <input type='text' name='description' required value="<?php echo $row["DESCRIPTION"]; ?>">

          <label>Erinnerung</label>
          <select name="erinnerung" id="erinnerung" required value="<?php echo $row["ERINNERUNG"]; ?>">
            <option value="1 Tag">1 Tag</option>
            <option value="2 Tage">2 Tage</option>
            <option value="4 Tage">4 Tage</option>
            <option value="1 Woche">1 Woche</option>
            <option value="2 Woche">2 Woche</option>
          </select>
          <br>

          <a href="home.php" class="mt-2 mb-5 btn btn-secondary submit-button" style="margin-left: 3px;">Go back</a>
          <input type='submit' name='submit' class='mt-2 mb-5 submit-button btn btn-secondary' value='Update Details'>
          

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

<?php 
  }
?>