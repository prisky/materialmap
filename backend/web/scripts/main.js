/* 
 * Copyright Andrew Blake 2014.
 */
// listen click, open modal and .load content
$('#modalButton').click(function (){
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});
 
// serialize form, render response and close modal
function submitForm($form) {
	$.post(
		$form.attr("action"),
		$form.serialize()
	)
	.done(function(result) {
		$form.parent().html(result);
	})
	.fail(function() {
		console.log("server error");
	});
	return false;
}

