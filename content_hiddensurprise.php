<?php	
// Include the SDK using the Composer autoloader
require 'vendor/autoload.php';

$s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAI3NTPEQ6TMUINDOA',
        'secret' => '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',
        ]
]);



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
						<h3>Mentions légales</h3>



						<section id="banner">

							<article id="main" class="container special">
								<p>			
									<br/><span class="bold">x</span>
<?php
									//phpinfo();

									?>
								</p>
							</article>
						</section>	

						
					</div>

				</div>
			</div>

		</div>
