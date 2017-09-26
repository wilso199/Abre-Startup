<?php
	
	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Module Settings
	$drawerhidden=1;
	
	//Login Validation
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	
	//Check to see if user needs startup screen
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');	
	
	$setting_startup="";
	$sql = "SELECT * FROM profiles where email='".$_SESSION['useremail']."'";
	$result = $db->query($sql);
	$setting_startup_count=mysqli_num_rows($result);
	while($row = $result->fetch_assoc()) {
		$setting_startup=htmlspecialchars($row['startup'], ENT_QUOTES);
		$setting_aup=htmlspecialchars($row['AUP'], ENT_QUOTES);
	}
	
	if($setting_startup==1 or $setting_aup==1 or $setting_startup_count==0)
	{
		
?>
		<div class='startup'>
		<div class="slider fullscreen">
		<ul class="slides" style="background-color: <?php echo sitesettings("sitecolor"); ?>">
						
			<?php

			//Slides Required for Staff			
			if($_SESSION['usertype']=="staff")
			{
			?>
				<li>
					<img src="">
					<div class="caption center-align">
						<div>
							<span class="startup_title" style='font-weight:500'>Open Enrollment</span><br><br>
							<span class="startup_text"><iframe src="https://docs.google.com/document/d/1GytPtZKM-YB_J_m4shojr_ZbSVsYTFQTE4ZrajA2Zpk/pub?embedded=true" width="100%" frameBorder="0"></iframe></span>
							<span><br><br><a class='mdl-button mdl-js-button mdl-button--raised mdl-color--grey-100 mdl-color-text--black' href='https://edu.hcsdoh.net/docs/treasurer/2017-open-enrollment-for-health-benefits/' target='_blank'>View Documents</a></span>
						</div>
					</div>
					<div class='startupbutton'><button class="mdl-button mdl-js-button mdl-button--raised mdl-color--grey-100 mdl-color-text--black next">Got It</button></div>
				</li>
			<?php	
			}
			?>
			
			<!--Slides Required for All-->
			<li>
				<img src="">
				<div class="caption center-align">
					<span class="startup_title" style='font-weight:500'>Acceptable Use Policy</span><br><br>
					<span class="startup_text"><b>The Main Idea - </b> It is acceptable to use technology in Hamilton as long as it supports education.</span>
				</div>
				<div class='startupbutton'><button class="mdl-button mdl-js-button mdl-button--raised mdl-color--grey-100 mdl-color-text--black next">Next</button></div>
			</li>
			<li>
				<img src="">
				<div class="caption center-align" style='font-weight:500'>
					<span class="startup_title" style='font-weight:500'>Review the Policy</span><br><br>
					<span class="startup_text"><iframe src="https://docs.google.com/document/d/1FQBEng7aZCQt-L8RLCNA8x2OmJqlDu9Lpm86u5I_0a4/pub?embedded=true" width="100%" frameBorder="0"></iframe></span>
				</div>
				<div class='startupbutton'><button class="mdl-button mdl-js-button mdl-button--raised mdl-color--grey-100 mdl-color-text--black next">Got It</button></div>
			</li>
			
			<!--Final Startup Slide-->
			<li>
				<img src="">
				<div class="caption center-align">
					<span class="startup_title" style='font-weight:500'>Get Started</span><br><br>
					<span class="startup_text">You're all set! Click below to get started.</span>
				</div>
				<div class='startupbutton'><button class="mdl-button mdl-js-button mdl-button--raised mdl-color--grey-100 mdl-color-text--black closeaction">Get Started</button></div>
			</li>
									
		</ul>
		</div>  
		</div>
	
	
		<script>
		
			$(document).ready(function(){
				
				//Begin Startup
				$('.slider').slider({
					interval:999999,
					transition: 300
				});
				$('.slider').slider('pause');
				
				$( ".next" ).click(function() {
					$('.slider').slider('next');
					$('.slider').slider('pause');
				});
				
				$( ".close" ).click(function() {
					$('.startup').fadeOut();
					$('.slider').slider('pause');
					<?php 
						echo "$.ajax('$portal_root/modules/startup/setup.php');";
					?>
					streamCheck();
				});
				
				$( ".closeaction" ).click(function() {
					//window.open('https://edu.hcsdoh.net/docs/treasurer/2017-open-enrollment-for-health-benefits/', '_blank');
					$('.startup').fadeOut();
					$('.slider').slider('pause');
					<?php 
						echo "$.ajax('$portal_root/modules/startup/setup.php');";
					?>
					streamCheck();
				});
				
				function iframescale()
				{
					var height = $(window).height();
					$('iframe').css('height', height * 0.5 | 0);
				}

				iframescale();
				$(window).resize(iframescale);
				
				
			
			});
		        
		</script>
	
<?php
		
	}
	
?>