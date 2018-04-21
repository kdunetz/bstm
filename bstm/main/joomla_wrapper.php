<?php include("header.php"); ?>

									
										<script language="javascript" type="text/javascript">
function iFrameHeight() {
	var h = 0;
	if ( !document.all ) {
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if( document.all ) {
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
</script>
<div class="contentpane">
	<div class="componentheading">
	</div>
<iframe 	id="blockrandom"
	name="iframe"
	src="http://www.bringsavingstome.com/coupons/staging/home.php?action=search&tab=1&subtab=1&auth=1"
	width="100%"
	height="500"
	scrolling="auto"
	align="top"
	frameborder="0"
	class="wrapper">
	This option will not work correctly. Unfortunately, your browser does not support inline frames.</iframe>
</div>

<?php include("footer.php"); ?>
