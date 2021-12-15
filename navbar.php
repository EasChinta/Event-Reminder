<?php 
	function number_suffix($number){
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		 if ((($number % 100) >= 11) && (($number%100) <= 13)){
			return $number. 'th';
		 }else{
			return $number.$ends[$number % 10];
		 }
	}
	
	$notifications=[];
	$current_month_day=date("m-d");
	$sql="select * from reminders where DATE_FORMAT(DATE, '%m-%d')='{$current_month_day}'";
	$res=$con->query($sql);
	if($res->num_rows>0){
		while($row=$res->fetch_assoc()){
			$age=(date("Y")-date("Y",strtotime($row["DATE"])))+1;
			$notifications[]="<i class='fa fa-bell'></i> Reminder: <b>{$row["DESCRIPTION"]}</b>".number_suffix($age)." Birthday. date of birth is <b>".date("d-m-Y",strtotime($row["DATE"]))."</b>";
		}
	}
?>

<div style="display:flex; margin-top:5rem;">
<div style="width: 75%; height: 40px; border-bottom: 2px solid black; ">
</div>
<div>
  <span>
    <h1>logo</h1>
  </span>
</div>
</div>