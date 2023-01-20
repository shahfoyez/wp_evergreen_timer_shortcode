<style>
	.foy-countdown .foy-dot{
		font-size: 25px;
		margin-top: 0px;
		color: #ffffff;
		background: #424242;
		padding: 10px 2px 0px 2px;
		margin: 0px;
	}
	.foy-time-label{
		margin: 0px;
		font-size: 10px;
	}
	.foy-countdown .foy-countdown-items{
		display: flex;
		justify-content: center;
	}
	.foy-countdown .foy-days, .foy-hours, .foy-minutes, .foy-seconds{
		text-align: center;
		padding: 5px 5px 0px 5px;
		width: 20%;
		background: #EDEDED;
		border-radius: 5px;
	}
	.foy-countdown .foy-days p, .foy-hours p, .foy-minutes p, .foy-seconds p, .foy-divider p{
		line-height: 24px;
		text-transform: uppercase;
		color: #6E6E6E;
	    font-size: 11px;
	    font-weight: 400;

	}
	.foy-countdown .foy-time{
		color: #909090;
	    font-size: 26px;
	    font-weight: 600;
	    margin: 0px;
	}
	.foy-countdown .foy-dot{
		color: #979797 !important;
		background: none !important;
	}
	.foy-days, .foy-days-divider{
		display: none;
	}
	.foy-time-label{
		font-size: 8px !important;
		line-height: 20px !important

	}
</style>
function timer_function( $atts ){
	$id = $atts['id'];
	ob_start();
	?>

	<div class="foy-countdown">
		<div class="foy-countdown-items"> 
			<div class="foy-days">
				<p class="foy-time <?php echo $id.'days'?>" id="<?php echo $id.'days'?>"></p>
				<p class="foy-time-label"> Days</p>
			</div>
			<div class="foy-divider foy-days-divider">
				<p class="foy-dot">:</p>
				<p class="foy-time-label"></p>
			</div>
			<div class="foy-hours">
				<p class="foy-time <?php echo $id.'hours'?>" id="<?php echo $id.'hours'?>"></p>
				<p class="foy-time-label"> Hours</p>
			</div>
			<div class="foy-divider">
				<p class="foy-dot">:</p>
				<p class="foy-time-label"></p>
			</div>
			<div class="foy-minutes">
				<p class="foy-time <?php echo $id.'mins'?>" id="<?php echo $id.'mins'?>"></p>
				<p class="foy-time-label"> Minutes</p>
			</div>
			<div class="foy-divider">
				<p class="foy-dot">:</p>
				<p class="foy-time-label"></p>
			</div>
			<div class="foy-seconds">
				<p class="foy-time <?php echo $id.'secs'?>" id="<?php echo $id.'secs'?>"></p>
				<p class="foy-time-label"> Seconds</p>
			</div>
		</div>
	</div>
	<?php
	$output = ob_get_clean();
	return $output;	 
}
add_shortcode( 'timer-html', 'timer_function' );


function timer_function1( $atts ){
	$interval = $atts['interval'];
	$id = $atts['id'];
	global $wpdb;
	date_default_timezone_set("Asia/Dhaka");
	// echo date_default_timezone_get();
	$current_date = date('Y-m-d H:i:s');
	$results = $wpdb->get_results("SELECT * FROM wp_timer WHERE id = $id");
	// $wpdb->insert('wp_timer', array('id' => 1, 'end_time' =>  )); 
	if($id!= "" && !$results){
		$ent = date('Y-m-d H:i:s', strtotime($current_date. ' + '.$interval.' hours'));
		$wpdb->insert('wp_timer', array('id' => $id, 'end_time' => $ent)); 
		echo "New timer has created";
	}else{
		foreach ($results as $time){
			$end_time =  $time->end_time;
		} 
		
		if ( $current_date <  $end_time ) { ?>
			<script>
			// Set the date we're counting down to
			var database_time = <?php echo json_encode($end_time, JSON_HEX_TAG); ?>;
			var id = <?php echo json_encode($id, JSON_HEX_TAG); ?>;
			var countDownDate = new Date(database_time).getTime();
			// function to change default timezone
			function changeTimezone(date, ianatz) {
				var invdate = new Date(date.toLocaleString('en-US', {
					timeZone: ianatz
				}));
				var diff = date.getTime() - invdate.getTime();
				return new Date(date.getTime() - diff);
			}
			// Update the count down every 1 second
			var x = setInterval(function() {
				// Get today's date and time
				// var now = new Date().getTime();
				var here = new Date();
				// change default timezone
				var now = changeTimezone(here, "Asia/Dhaka").getTime();
				// console.log("Here"+here);
				// console.log("Now"+changeTimezone(here, "Asia/Dhaka"));

				// Find the distance between now and the count down date
				var distance = countDownDate - now;
					
				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
					
				// Result is output to the specific element
				days = ("0" + days).slice(-2)
				var elems = document.getElementsByClassName(id+"days");
				for(var i = 0; i < elems.length; i++) {
					elems[i].innerHTML = days;
				}
				
				hours = ("0" + hours).slice(-2)
				var elems = document.getElementsByClassName(id+"hours");
				for(var i = 0; i < elems.length; i++) {
					elems[i].innerHTML = hours ;
				}

				minutes = ("0" + minutes).slice(-2)
				var elems = document.getElementsByClassName(id+"mins");
				for(var i = 0; i < elems.length; i++) {
					elems[i].innerHTML = minutes ;
				}
				
				seconds = ("0" + seconds).slice(-2)
				var elems = document.getElementsByClassName(id+"secs");
				for(var i = 0; i < elems.length; i++) {
					elems[i].innerHTML = seconds ;
				}
				
				// If the count down is over
				if (distance < 0) {
					clearInterval(x);
					var elems = document.getElementsByClassName(id+"days");
					for(var i = 0; i < elems.length; i++) {
						elems[i].innerHTML = '00';
					}
					var elems = document.getElementsByClassName(id+"hours");
					for(var i = 0; i < elems.length; i++) {
						elems[i].innerHTML = '00';
					}
					var elems = document.getElementsByClassName(id+"mins");
					for(var i = 0; i < elems.length; i++) {
						elems[i].innerHTML = '00';
					}
					var elems = document.getElementsByClassName(id+"secs");
					for(var i = 0; i < elems.length; i++) {
						elems[i].innerHTML = '00';
					}
				}
			}, 1000);
			</script>
		<?php
		}else{
			$date = $end_time;
			$new_time = date('Y-m-d H:i:s', strtotime($date. ' + '.$interval.' hours'));
			$execute = $wpdb->query
			("
			UPDATE `wp_timer` 
			SET `end_time` = '$new_time'
			WHERE `wp_timer`.`id` = $id
			");
		}
	} 
}
add_shortcode( 'foy-timer', 'timer_function1' );
