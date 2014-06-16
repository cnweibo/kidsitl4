$(function(){
	$("li").has(".dropdown-menu").hover(
		function() {
			$(this).find(".dropdown-menu").slideDown();
		},
		function() {
			$(this).find(".dropdown-menu").slideUp();
		}
	);
});
$('#bishunsearchform').on('submit',function(e){
	var formdata = $(this).serialize();
	var bshtml = "";
	$.ajax({
		url: 'bishun',
		type: 'POST',
		data: formdata,
		success: function(results){
			$("#bishuncontainer").html(results
				);
		}
	});
	 e.preventDefault();
});