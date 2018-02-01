<?php
	/* Set Timezone */
	date_default_timezone_set("Europe/Berlin");

	/* Date & Time */
	$date = strtotime(date("Y-m-d"));
	$time = date("H:i:s", time());
	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);
	$firstDay = mktime(0,0,0,$month, 1, $year);
	$title = strftime('%B', $firstDay);
	$dayOfWeek = date('D', $firstDay);
	$daysInMonth = cal_days_in_month(0, $month, $year);

	/* Name of week days */
	$timestamp = strtotime('next Sunday');
	$weekDays = array();
	for ($i = 0; $i < 7; $i++) {
		$weekDays[] = strftime('%a', $timestamp); 	// %a = shortened week days | %A = advertised week days
		$timestamp = strtotime('+1 day', $timestamp);
	}
	$blank = date('w', strtotime("{$year}-{$month}-01"));
?>

<html>
	<head>
		<title> Calendar Timezone: Berlin </title>
		<style>
			body  {
					background-color: black;
					background-image: url("bg.png");
					background-size: cover;
					color: white;
				  }

			table {
					font-size:	30px;
					width: 600px;
					position: fixed;
		  			top: 50%;
		  			left: 50%;
				    margin-top: -250px;
				    margin-left: -350px;
				  }

			.clock {
					 float: right;
					 font-size: 30px;
				   }
		</style>
	</head>
<body>
	<!-- Create timewatch -->
	<div class="clock">
		<?php echo $time; ?>
	</div>

	<!-- Create Calendar -->
	<table>
		<tr>
			<th colspan="7"> <?php echo $title ?> <?php echo $year ?> </th>
		</tr>
		<tr>
			<?php foreach($weekDays as $key => $weekDay) { ?>
				<td><?php echo $weekDay ?></td>
			<?php } ?>
		</tr>
		<tr>
			<?php for($i = 0; $i < $blank; $i++) { ?>
				<td></td>
			<?php } ?>
			<?php for($i = 1; $i <= $daysInMonth; $i++) { ?>
				<?php if($day == $i) { ?>
					<td><strong><?php echo $i ?></strong></td>
				<?php } else { ?>
					<td><?php echo $i ?></td>
				<?php } ?>
				<?php if(($i + $blank) % 7 == 0) { ?>
					</tr><tr>
				<?php } ?>
			<?php } ?>
			<?php for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++) { ?>
				<td></td>
			<?php } ?>
		</tr>
	</table>
</body>
</html>