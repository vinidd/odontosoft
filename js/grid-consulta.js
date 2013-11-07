$(document).ready(function() {
    $('.calendar').find('td.calendar-day').live('click', function() {
        createConsulta($(this).find('.calendar-day-number').attr('id'));
    });
});

function createConsulta(day) {
    //modal
    $('#create-consulta').modal('toggle');
    $('#create-consulta').find('#collapse-receptor').empty();
//    console.log(day);
//    console.log(day.substring(0, 2));
    $('#' + day).parent().each(function() {
        $(this).find('.calendar-text').each(function() {
            $('#collapse-receptor').append('<div class="accordion" id="accordion2"><div class="accordion-group"><div class="accordion-heading head"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse' + $(this).attr('id') + '"><span class="legend"><span id="horario"></span> &nbsp; <span id="status"></span></span><div class="separator"><span class="right"><i class="icon-angle-down icon-large"></i></span></div></a></div><div id="collapse' + $(this).attr('id') + '" class="accordion-body collapse"><div class="accordion-inner"><span id="cliente"></span><span id="dentista"></span><span id="duracao"></span><span id="descricao"></span></div></div></div>');
//            console.log($(this).attr('id'));
            var jt = $(this).attr('class');
            j1 = jt.split(' ');
            $('.head').addClass(j1[0]);
            
            $.ajax({
                type: "POST",
                data: "id=" + $(this).attr('id'),
                url: $('#url').val() + '/consulta/buscaConsulta',
                success: function (data) {
                    console.log(data);
                }
            });
        });
    });
}