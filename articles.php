<?php
session_start();
require("config.php");

if (!isset($_SESSION["login_info"])) {
  header("location:index.php");
}

$reminders = [];
$current_month_day = date("m-d");
$current_year = date("Y");


$sql = "select * from reminders where DATE_FORMAT(DATE, '%m-%d')='{$current_month_day}' and YEAR<>'{$current_year}'";
$res = $con->query($sql);
if ($res->num_rows > 0) {
  while ($row = $res->fetch_assoc()) {
    $reminders[] = $row;
  }
}

#Send birthday wishes to Mail
foreach ($reminders as $reminder) {

  /*$to = $reminder["EMAIL"];

		$subject = "Birthday Greetings";

		$message = "<h3>Wish you Happy Birthday {$reminder["DESCRIPTION"]}</h3>";

		$header="From:reminder@domain.in"."\r\n";
		$header.="X-Mailer:PHP/".phpversion()."\r\n";
		$header.="Content-type:text/html; charset=iso-8859-1";  

		$response=mail($to,$subject,$message,$header);
		
		if($response==true){
			$sql="update reminders set YEAR='{$current_year}'  where ID='{$reminder["ID"]}'";
			$con->query($sql);
		}else{
			echo "Mail send Failed!!!";
		}*/
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body>
  <?php include "navbar.php"; ?>
  

  <div class="section">
  <div class="left">
  <nav>
              <li class="nav-item">
                <a class="nav-link mylinks" style="margin-top: 7rem;" href="home.php"><span class='fa fa-home'></span> Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link mylinks" href="articles.php"><span class='fas fa-newspaper'></span> Articles</a>
              </li>
           
              <li class="nav-item">
                <a class="nav-link mylinks" href="logout.php"><span class='fas fa-sign-out-alt'></span> Logout</a>
              </li>
            </nav>
  </div>
  <div class="middle">
  <h3>
              The most presidential lorem ipsum in history.
            </h3>
            <img src="https://images.unsplash.com/photo-1580130379624-3a069adbffc5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80" class="img-thumbnail" style="width:200px; height:200px; float:right;" alt="Obama picture">
            <p>
              We measure progress in the 23 million new jobs that were created when Bill Clinton was President - when the average American family saw its income go up $7,500 instead of down $2,000 like it has under George Bush. Indeed, faith should bring us together.
            </p>
            <p>
              America! Tonight, if you feel the same energy that I do, if you feel the same urgency that I do, if you feel the same passion I do, if you feel the same hopefulness that I do - if we do what we must do, then I have no doubts that all across the country, from Florida to Oregon, from Washington to Maine, the people will rise up in November, and John Kerry will be sworn in as president, and John Edwards will be sworn in as vice president, and this country will reclaim its promise, and out of this long political darkness a brighter day will come. They're telling me that their conversation about what it means to be Catholic continues. Now Ashley might have made a different choice. The attacks of September 11th, 2001 and the continued efforts of these extremists to engage in violence against civilians has led some in my country to view Islam as inevitably hostile not only to America and Western countries, but also to human rights. And I will host a Summit on Entrepreneurship this year to identify how we can deepen ties between business leaders, foundations and social entrepreneurs in the United States and Muslim communities around the world. But if we choose to be bound by the past, we will never move forward.
            </p>
            <p>
              Thank you, God Bless you, and God Bless the United States of America. 🇺🇸
            </p>
            <div class="borders mt-3"></div>
  </div>
  <div class="right"></div>
  </div>



</body>

</html>