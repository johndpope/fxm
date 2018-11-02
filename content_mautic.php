<?php
require './vendor/autoload.php';
session_start();

use Mautic\Auth\ApiAuth;
?>




	<script src="js/jquery-1.11.2.min.js"></script>   

<!--
<div id="mauticform_wrapper_tst" class="mauticform_wrapper">
	<form autocomplete="false" role="form" method="post" action="https://www.musicianbooster.com/2.9.2/form/submit?formId=2" id="mauticform_tst" data-mautic-form="tst">
		<div class="mauticform-error" id="mauticform_tst_error"></div>
		<div class="mauticform-message" id="mauticform_tst_message"></div>
		<div class="mauticform-innerform">


			<div class="mauticform-page-wrapper mauticform-page-1" data-mautic-form-page="1">

				<div id="mauticform_tst_mail"  class="mauticform-row mauticform-email mauticform-field-1">
					<label id="mauticform_label_tst_mail" for="mauticform_input_tst_mail" class="mauticform-label">mail</label>


					<input id="mauticform_input_tst_mail" name="mauticform[mail]" value="" class="mauticform-input" type="email" />



					<span class="mauticform-errormsg" style="display: none;"></span>
				</div>

				<div id="mauticform_tst_submit"  class="mauticform-row mauticform-button-wrapper mauticform-field-2">
					<button type="submit" name="mauticform[submit]" id="mauticform_input_tst_submit" name="mauticform[submit]" value="" class="mauticform-button btn btn-default" value="1">Envoyer</button>
				</div>
			</div>
		</div>

		<input type="hidden" name="mauticform[formId]" id="mauticform_tst_id" value="2"/>
		<input type="hidden" name="mauticform[return]" id="mauticform_tst_return" value=""/>
		<input type="hidden" name="mauticform[formName]" id="mauticform_tst_name" value="tst"/>
	</form>
</div>
-->
<button onclick="insertMautic();">test</button>


<script>
	function insertMautic() {
		$.post(
			'https://www.musicianbooster.com/2.9.2/form/submit?formId=2', 
			{
				'mauticform[mail]' : 'local@jjppxo.com',
				'mauticform[formId]' : '2',
				'mauticform[submit]' : '1',
				'mauticform[return]' : '',
				'mauticform[formName]' : 'tst'
			},
			function(data){
				var forgotPass = data.trim();
			},
			'text'
			);
		return false;
	}

	

</script>

<?php
// ApiAuth->newAuth() will accept an array of Auth settings
$settings = array(
    'userName'   => 'Romain',             // Create a new user       
    'password'   => 'metalgear:Mautic8'              // Make it a secure password
    );
/*
// Initiate the auth object specifying to use BasicAuth
$initAuth = new ApiAuth();
$auth = $initAuth->newAuth($settings, 'BasicAuth');
use Mautic\MauticApi;
$api = new MauticApi();
$contactApi = $api->newApi('contacts', $auth, "https://www.musicianbooster.com/2.9.2");
var_dump($contactApi);

$data = array(
	'firstname' => 'Jim',
	'lastname'  => 'Contact',
	'email'     => 'jim@his-site.com',
	'ipAddress' => $_SERVER['REMOTE_ADDR']
	);

$contact = $contactApi->create($data);
var_dump($contact);

$response = $contactApi->get();
//$contact = $response[$contactApi->itemName()];
var_dump($response);
*/