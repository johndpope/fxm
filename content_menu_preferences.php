

<div class="menuMaker mobileOnly menuMakerComplete">
	<a href="fxm.php?page=account"><span id="MONCOMPTEClicker" class="makerBlocks <?php if($prefpage=="account") echo "makerBlocksSelected" ?>"><?php echo($lang['myaccount']); ?></span></a>									

	<a href="fxm.php?page=preferences"><span id="PREFSClicker" class="makerBlocks <?php if($prefpage=="preferences") echo "makerBlocksSelected" ?>"><?php echo($lang['preferences']); ?></span></a>		
	<a href="fxm.php?page=sub"><span id="MESSUBSClicker" class="makerBlocks <?php if($prefpage=="sub") echo "makerBlocksSelected" ?>"><?php echo($lang['mysubscriptions']); ?></span></a>	

	<?php
	if(!$hasSubscribed || (($hasSubscribed && allowedToSubscribe($validSubscription) != null)))
	{
		?>
		<a href="fxm.php?page=subscribe"><span id="SABONNERClicker" class="makerBlocks <?php if($prefpage=="subscribe") echo "makerBlocksSelected" ?>"><?php echo($lang['subscribe']); ?></span></a>	


		<?php
	}
	?>
	
	<a onclick="logout();" href="#"><span id="LOGOUTClicker" class="makerBlocks <?php if($prefpage=="logout") echo "makerBlocksSelected" ?>"><?php echo($lang['logout']); ?></span></a>	

	<p></p>
</div>

