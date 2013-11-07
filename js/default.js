/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    jQuery(function($) {
        $(".telefone").mask("(99)9999-9999");
    });

    if (!$('#cliente-form').find('#Pessoa_nome').val()) {
        $('#cliente-form').find('#Pessoa_sexo_0').attr('checked', 'checked');
        $('#cliente-form').find('#Endereco_tipo_0').attr('checked', 'checked');
    }

    $('#cliente-form').find('.telefone').live('blur', function() {

        temp1 = $('#cliente-form').find('#Telefone_residencial').val();
        temp1 = limpaTelefone(temp1);

        temp2 = $('#cliente-form').find('#Telefone_celular').val();
        temp2 = limpaTelefone(temp2);

        temp3 = $('#cliente-form').find('#Telefone_comercial').val();
        temp3 = limpaTelefone(temp3);

        if (temp1.length === 10 || temp2.length === 10 || temp3.length === 10) {
            $('#cliente-form').find('.telefone').each(function() {
                $(this).css('border-color', '#468847');
                $('#Telefone_em').css('color', '#468847');
                $('#cliente-button').removeAttr('disabled');
                $('#cliente-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#cliente-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
                $('#cliente-button').attr('disabled', 'disabled');
                $('#cliente-form').find('.tel_label').each(function() {
                    $(this).css('color', '#B94A48');
                });
            });
        }
    });

    $('#cliente-form').find('#id_cidade').live('blur', function() {
        if ($(this).val() && $('#cliente-form').find('#Endereco_id_cidade').val()) {
            $(this).css('border-color', '#468847');
            $('.cidade_label').css('color', '#468847');
            $('#cliente-form').find('#id_cidade_em_').hide();
        } else {
            $(this).css('border-color', '#B94A48');
            $('#cliente-form').find('#Endereco_id_cidade').val('');
            $('.cidade_label').css('color', '#B94A48');
            $('#cliente-form').find('#id_cidade_em_').show();
        }
    });

    if (!$('#dentista-form').find('#Pessoa_nome').val()) {
        $('#dentista-form').find('#Pessoa_sexo_0').attr('checked', 'checked');
        $('#dentista-form').find('#Endereco_tipo_0').attr('checked', 'checked');
    }

    $('#dentista-form').find('.telefone').live('blur', function() {

        temp1 = $('#dentista-form').find('#Telefone_residencial').val();
        temp1 = limpaTelefone(temp1);

        temp2 = $('#dentista-form').find('#Telefone_celular').val();
        temp2 = limpaTelefone(temp2);

        temp3 = $('#dentista-form').find('#Telefone_comercial').val();
        temp3 = limpaTelefone(temp3);

        if (temp1.length === 10 || temp2.length === 10 || temp3.length === 10) {
            $('#dentista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#468847');
                $('#Telefone_em').css('color', '#468847');
                $('#dentista-button').removeAttr('disabled');
                $('#dentista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#dentista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
                $('#dentista-button').attr('disabled', 'disabled');
                $('#dentista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#B94A48');
                });
            });
        }
    });

    $('#dentista-form').find('#id_cidade').live('blur', function() {
        if ($(this).val() && $('#dentista-form').find('#Endereco_id_cidade').val()) {
            $(this).css('border-color', '#468847');
            $('.cidade_label').css('color', '#468847');
            $('#dentista-form').find('#id_cidade_em_').hide();
        } else {
            $(this).css('border-color', '#B94A48');
            $('#dentista-form').find('#Endereco_id_cidade').val('');
            $('.cidade_label').css('color', '#B94A48');
            $('#dentista-form').find('#id_cidade_em_').show();
        }
    });

    if (!$('#recepcionista-form').find('#Pessoa_nome').val()) {
        $('#recepcionista-form').find('#Pessoa_sexo_0').attr('checked', 'checked');
        $('#recepcionista-form').find('#Endereco_tipo_0').attr('checked', 'checked');
    }

    $('#recepcionista-form').find('.telefone').live('blur', function() {

        temp1 = $('#recepcionista-form').find('#Telefone_residencial').val();
        temp1 = limpaTelefone(temp1);

        temp2 = $('#recepcionista-form').find('#Telefone_celular').val();
        temp2 = limpaTelefone(temp2);

        temp3 = $('#recepcionista-form').find('#Telefone_comercial').val();
        temp3 = limpaTelefone(temp3);

        if (temp1.length === 10 || temp2.length === 10 || temp3.length === 10) {
            $('#recepcionista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#468847');
                $('#Telefone_em').css('color', '#468847');
                $('#recepcionista-button').removeAttr('disabled');
                $('#recepcionista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#recepcionista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
                $('#recepcionista-button').attr('disabled', 'disabled');
                $('#recepcionista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#B94A48');
                });
            });
        }
    });

    $('#recepcionista-form').find('#id_cidade').live('blur', function() {
        if ($(this).val() && $('#recepcionista-form').find('#Endereco_id_cidade').val()) {
            $(this).css('border-color', '#468847');
            $('.cidade_label').css('color', '#468847');
            $('#recepcionista-form').find('#id_cidade_em_').hide();
        } else {
            $(this).css('border-color', '#B94A48');
            $('#recepcionista-form').find('#Endereco_id_cidade').val('');
            $('.cidade_label').css('color', '#B94A48');
            $('#recepcionista-form').find('#id_cidade_em_').show();
        }
    });
    
    $('#consulta-form').find('#id_cliente').live('blur', function() {
        if ($(this).val() && $('#consulta-form').find('#Cliente_id_cliente').val()) {
            $(this).css('border-color', '#468847');
            $('#consulta-form').find('#id_cliente_em_').hide();
        } else {
            $(this).css('border-color', '#B94A48');
            $('#consulta-form').find('#Cliente_id_cliente').val('');
            $('#consulta-form').find('#id_cliente_em_').show();
        }
    });
    
    $('#consulta-form').find('#id_dentista').live('blur', function() {
        if ($(this).val() && $('#consulta-form').find('#Dentista_id_dentista').val()) {
            $(this).css('border-color', '#468847');
            $('#consulta-form').find('#id_dentista_em_').hide();
        } else {
            $(this).css('border-color', '#B94A48');
            $('#consulta-form').find('#Dentista_id_dentista').val('');
            $('#consulta-form').find('#id_dentista_em_').show();
        }
    });
    
    $('#consulta-form').find('.telefone').live('blur', function() {

        temp1 = $('#consulta-form').find('#Telefone_residencial').val();
        temp1 = limpaTelefone(temp1);

        temp2 = $('#consulta-form').find('#Telefone_celular').val();
        temp2 = limpaTelefone(temp2);

        temp3 = $('#consulta-form').find('#Telefone_comercial').val();
        temp3 = limpaTelefone(temp3);

        if (temp1.length === 10 || temp2.length === 10 || temp3.length === 10) {
            $('#consulta-form').find('.telefone').each(function() {
                $(this).css('border-color', '#468847');
                $('#Telefone_em').hide();
                //$('#consulta-button').removeAttr('disabled');
                $('#consulta-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#consulta-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').show();
                //$('#consulta-button').attr('disabled', 'disabled');
                $('#consulta-form').find('.tel_label').each(function() {
                    $(this).css('color', '#B94A48');
                });
            });
        }
    });
});

function limpaTelefone(str) {
    str = str.replace(/\(/g, '');
    str = str.replace(/\)/g, '');
    str = str.replace(/\-/g, '');
    str = str.replace(/\_/g, '');
    return str;
}

function checkTelefone(name) {
    temp1 = $('#' + name + '-form').find('#Telefone_residencial').val();
    temp2 = $('#' + name + '-form').find('#Telefone_celular').val();
    temp3 = $('#' + name + '-form').find('#Telefone_comercial').val();

    if (temp1.length || temp2.length || temp3.length) {
        $('#' + name + '-button').removeAttr('disabled', 'disabled');
    } else {
        $('#' + name + '-button').attr('disabled', 'disabled');
    }
}

$(document).ready(function() {
    $('.accordion-toggle').live('click', function() {
        if ($($(this).attr('href')).hasClass('in')) {
            $(this).find('i').attr('class', 'icon-angle-up icon-large');
        } else {
            $(this).find('i').attr('class', 'icon-angle-down icon-large');
        }
    });
});

function addProcedimento(id, label) {
    if ($(".procedimentos-content").find("#receptor").find("tr#" + id).length) {
        alert("Você já adicionou o procedimento escolhido!");
    } else {
        $(".procedimentos-content").find("#receptor").append("<tr id='" + id + "'><td class='procedimento-label'>" + label + "</td><td class='delete'><a style='text-decoration:none;' onclick='deleteRow(this, id);' href='javascript:void(0)' title='' data-placement='right' data-toggle='tooltip' data-original-title='Excluir'><i class='icon-trash'></i></a></td><input type='hidden' name='Procedimento[]' value='" + id + "'></tr>");
        $(".procedimentos-content").show();
    }
}

function deleteRow(el, id) {
    var response = confirm("Deseja realmente excluir este item?\nOBS: A exclusão só será efetuada após o cadastro ser salvo!");

    if (response) {
        $('.procedimentos-content').append('<input type="hidden" name="Procedimento_delete[]" value="' + id + '">');
        el.parentNode.parentNode.remove();
    }
}

function btnReset() {
    $("#id_cliente").removeAttr("readonly");
    $("#Telefone_residencial").attr("readonly", "readonly");
    $("#Telefone_celular").attr("readonly", "readonly");
    $("#Telefone_comercial").attr("readonly", "readonly");
    $("#consulta-button").attr("disabled", "disabled");
}

function changeLang(lang) {
    $('#lang-form').find('#lang').val(lang);
}