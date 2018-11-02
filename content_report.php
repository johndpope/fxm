<?php	

include("php/drillTools.php"); 

$contactObject = "";
if(isset($_GET['type']))
{
	$contactObject = $_GET['type'];


}	


if(isset($_POST['validate']))
{
	if(!isset($uid))
	{	
		$uid = "";
		$address = $_POST['user-email'];
	}
	else
	{
		$address = $connectedAs;
	}
	$body = $_POST['inputNote'];
	$body = str_replace("\n","<br />",$body);
	$contactObject = $_POST['contactObject'];
	$sendAmail = $authenticate->sendAmail($uid,$address,$contactObject,$body);
	//var_dump($sendAmail);
	if(!$sendAmail['error'])
		$messInfo = $sendAmail['message'];
	else 
		$messErr = $sendAmail['message'];	

		//include("php/lang.php");

}	


?>

<script type="text/javascript">		
	window.onload = function(){ 

		<?php
		if($messErr != "") 
			{ ?>

				$('body').notif({title:"<?php echo $messErr; ?>", cls:'error', timeout:5000});<?php
			} ?>

			<?php if($messInfo != "") { ?>

				$('body').notif({title:"<?php echo $messInfo; ?>", cls:'success', timeout:5000});
				<?php } ?>
			}



		</script>

		<div class="content-container">
			<div class="block-container">
				<div class="unique-block">
					<div class="block-content">

						<div class="circleContainer">
							<div class="circleBlue">

							</div>
							<img alt="Character" src="images/contacts.png" class="circleImg" />
						</div>
						<h3>Rapports</h3>



						<section id="banner">

							<article id="main" class="container special">
								<p>			
									<?php
									$srs1 = $authenticate->getSQLsrs1();
									$srs7 = $authenticate->getSQLsrs7();
									$srs30 = $authenticate->getSQLsrs30();

									// $users1 = $authenticate->getSQLusers1();
									// $users7 = $authenticate->getSQLusers7();




									echo "<br/>SRS 01 : ".$srs1["id"];
									echo "<br/>SRS 07 : ".$srs7["id"];
									echo "<br/>SRS 30 : ".$srs30["id"];

									//var_dump($users);				


									$users = $authenticate->getSQLusers(1);
									$users7 = $authenticate->getSQLusers(8);
									$users30 = $authenticate->getSQLusers(30);
									?>
									<p/>USERS 1
									<table>						
										<tr><td>Users</td><td>Facebook</td><td>Google</td></tr>
										<tr><td><?php echo $users["users"]; ?></td><td><?php echo $users["Facebook"]; ?></td><td><?php echo $users["Google"]; ?></td></tr>
									</table>
									<p/>USERS 7
									<table>						
										<tr><td>Users</td><td>Facebook</td><td>Google</td></tr>
										<tr><td><?php echo $users7["users"]; ?></td><td><?php echo $users7["Facebook"]; ?></td><td><?php echo $users7["Google"]; ?></td></tr>
									</table>
									<p/>USERS 30
									<table>						
										<tr><td>Users</td><td>Facebook</td><td>Google</td></tr>
										<tr><td><?php echo $users30["users"]; ?></td><td><?php echo $users30["Facebook"]; ?></td><td><?php echo $users30["Google"]; ?></td></tr>
									</table>


								</p>
							</article>
						</section>	

						
					</div>

				</div>
			</div>

		</div>
