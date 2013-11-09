$(document).ready(function() {
    $('.calendar').find('td.calendar-day').live('click', function() {
        $('#header-data').text($(this).find('.calendar-day-number').attr('id').replace(/-/g, '/'));
        $('#data').val(changeData($(this).find('.calendar-day-number').attr('id')));
        createConsulta($(this).find('.calendar-day-number').attr('id'));
    });
    $('.calendar').find('td.calendar-current-day').live('click', function() {
        $('#data').val(changeData($(this).find('.calendar-day-number').attr('id')));
        $('#header-data').text($(this).find('.calendar-day-number').attr('id').replace(/-/g, '/'));
        createConsulta($(this).find('.calendar-day-number').attr('id'));
    });
    $('#Consulta_horario').live('blur', function() {
        if ($(this).val() !== '') {
            $.ajax({
                type: "POST",
                data: {horario: $(this).val(), data: $('#data').val()},
                url: $('#url').val() + '/consulta/confereHorario',
                success: function(data) {
                    if (data) {
                        $('#Consulta_horario').val('');
                        $('#Consulta_horario').css('border-color', '#B94A48');
                        $('#horario_em').show();
                    }
                }
            });
        }
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
            $('#collapse-receptor').append('<br><div class="accordion" id="accordion2"><div class="accordion-group"><div class="accordion-heading head"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse' + $(this).attr('id') + '"><span class="legend"><span id="horario"></span> &nbsp; <span id="status"></span></span><div class="separator"><span class="right"><i class="icon-angle-down icon-large"></i></span></div></a></div><div id="collapse' + $(this).attr('id') + '" class="accordion-body collapse"><div class="accordion-inner"><span id="cliente"></span><span id="dentista"></span><span id="duracao"></span><span id="descricao"></span></div></div></div>');
//            console.log($(this).attr('id'));
            var jt = $(this).attr('class');
            j1 = jt.split(' ');
            $('.head').addClass(j1[0]);

            $.ajax({
                type: "POST",
                data: "id=" + $(this).attr('id'),
                url: $('#url').val() + '/consulta/buscaConsulta',
                success: function(data) {
                    console.log(data);
                }
            });
        });
    });
}

function changeData(date) {
    var year = date.substring(6);
    var month = date.substring(3, 5);
    var day = date.substring(0, 2);

    return year + '-' + month + '-' + day;
}