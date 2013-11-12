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
                data: {horario: $(this).val(), data: $('#data').val(), id_dentista: $('#Dentista_id_dentista').val()},
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
            $('#collapse-receptor').append('<div class="accordion-group"><div class="accordion-heading head' + $(this).attr('id') + '"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse' + $(this).attr('id') + '"><span class="legend"><span id="horario"></span> - <span id="status"></span></span><div class="separator"><span class="right"><i class="icon-angle-down icon-large"></i></span></div></a></div><div id="collapse' + $(this).attr('id') + '" class="accordion-body collapse"><div class="accordion-inner"><a href="' + $('#url').val() + '/consulta/update/' + $(this).attr('id') + '" style="float:right;"><i class="icon-external-link"></i></a><span class="label-text">' + $('#cliente_text').val() + '</span><span id="cliente"></span><br><span class="label-text">' + $('#dentista_text').val() + '</span><span id="dentista"></span><br><span class="label-text">' + $('#duracao_text').val() + '</span><span id="duracao"></span><br><span class="label-text">' + $('#procedimento_text').val() + '</span><span id="procedimento"></span><br><span class="label-text">' + $('#descricao_text').val() + '</span><span id="descricao"></span></div></div>');
            var id = $(this).attr('id');
            var jt = $(this).attr('class');
            j1 = jt.split(' ');
            $('.head' + $(this).attr('id')).addClass(j1[0]);
            $.ajax({
                type: "POST",
                data: "id=" + $(this).attr('id'),
                url: $('#url').val() + '/consulta/buscaConsulta',
                success: function(data) {
                    obj = JSON.parse(data);
                    $('.head' + id).find('#horario').text(obj.horario);
                    $('.head' + id).find('#status').text(obj.status);
                    $('#collapse' + id).find('#cliente').text(obj.cliente);
                    $('#collapse' + id).find('#dentista').text(obj.dentista);
                    $('#collapse' + id).find('#duracao').text(obj.duracao);
                    $('#collapse' + id).find('#procedimento').text(obj.procedimento);
                    $('#collapse' + id).find('#descricao').text(obj.descricao);
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

function btnSubmit() {
    $('#consulta-form').submit();
}