<script type="text/javascript">
function getAjaxResponse(strurl, strcontainer) {
    	dojo.xhrGet({
        	url: strurl,
        	handleAs: "text",
			sync: true,
        	load: function(data) {
          		dojo.byId(strcontainer).innerHTML = data;
        	}
    	});
}
</script>

<?php
class Tester_Model_Tester
{
  	public function fetchResponse($strurl, $strcontainer) {
    // zend style fetch uses any js ajax integrated above
    echo "<script>getAjaxResponse('$strurl', '$strcontainer')</script>";
  }
}
?>