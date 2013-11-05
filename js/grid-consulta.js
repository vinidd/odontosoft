$(document).ready(function() {
    $('.calendar').find('td.calendar-day').live('click', function() {
        createConsulta($(this).find('.calendar-day-number').attr('id'));
    });
});

function createConsulta(day) {
    //modal
    console.log(day);
    console.log(day.substring(0, 2));
    $('#' + day).parent().each(function() {
        console.log('id: ' + $(this).attr('id'));
    });
}