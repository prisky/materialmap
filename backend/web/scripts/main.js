/* 
 * Copyright Andrew Blake 2014.
 */
// listen click, open modal and .load content
$('#modalButton').click(function (){
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'), function () {
            // as per http://stackoverflow.com/questions/17384464/jquery-focus-not-working-in-chrome
            setTimeout(function() {
                $('[data-focus]').first().focus();
            }, 800);
        });
});