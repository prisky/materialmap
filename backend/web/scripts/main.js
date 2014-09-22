/* 
 * Copyright Andrew Blake 2014.
 */
// listen click, open modal and .load content
$('#modalButton').click(function (){
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
});
