/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {    
    jQuery(function($) {
        $(".telefone").mask("(99)9999-9999");
        $(".horario").mask("9?9", {placeholder: ""});
        $(".parcela").mask("9?9", {placeholder: ""});
        $(".money").maskMoney({thousands: '.', decimal: ',', allowZero: true});
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
                $('#cliente-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#cliente-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
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
                $('#dentista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#dentista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
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
                $('#recepcionista-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#recepcionista-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').css('color', '#B94A48');
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
                $('#consulta-form').find('.tel_label').each(function() {
                    $(this).css('color', '#468847');
                });
            });
        } else {
            $('#consulta-form').find('.telefone').each(function() {
                $(this).css('border-color', '#B94A48');
                $('#Telefone_em').show();
                $('#consulta-form').find('.tel_label').each(function() {
                    $(this).css('color', '#B94A48');
                });
            });
        }
    });

    $('#consulta-form').find('#Consulta_horario').live('blur', function() {
        if ($(this).val() > 24 || $(this).val() < 8) {
            $(this).val('');
            $(this).css('border-color', '#B94A48');
            $('#horario_em').show();
        } else {
            $(this).css('border-color', '#468847');
            $('#horario_em').hide();
        }
    });

    $('#id_procedimento').change(function() {
        $('#id_procedimento option:selected').each(function() {
            $.ajax({
                type: 'POST',
                url: $('#url').val() + '/procedimento/buscaValor',
                data: {id: $('#id_procedimento').val()},
                success: function(data) {
                    $('#Consulta_valor').val(data);
                    $('#valor_view').val(data);
                    
                    if ($('#cliente').val() === '') {
                        $('#valor_view').removeAttr('disabled');
                    }
                }
            });
        });
    });
});

function limpaTelefone(str) {
    str = str.replace(/\(/g, '');
    str = str.replace(/\)/g, '');
    str = str.replace(/\-/g, '');
    str = str.replace(/\_/g, '');
    return str;
}

function limpaData(str) {
    str = str.replace(/\__/g, '');
    str = str.replace(/\_/g, '');
    str = str.replace(/\//g, '');
    return str;
}

function limpaCpf(str) {
    str = str.replace(/\___/g, '');
    str = str.replace(/\__/g, '');
    str = str.replace(/\_/g, '');
    str = str.replace(/\./g, '');
    str = str.replace(/\-/g, '');
    return str;
}

function limpaCep(str) {
    str = str.replace(/\_____/g, '');
    str = str.replace(/\___/g, '');
    str = str.replace(/\_/g, '');
    str = str.replace(/\./g, '');
    return str;
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
        alert($('#unique_msg').val());
    } else {
        $(".procedimentos-content").find("#receptor").append("<tr id='" + id + "'><td class='procedimento-label'>" + label + "</td><td class='delete'><a style='text-decoration:none;' onclick='deleteRow(this, id);' href='javascript:void(0)' title='' data-placement='right' data-toggle='tooltip' data-original-title='" + $('#delete').val() + "'><i class='icon-trash'></i></a></td><input type='hidden' name='Procedimento[]' value='" + id + "'></tr>");
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

function btnReset(admin) {
    $("#id_cliente").removeAttr("readonly");
    $("#consulta-button").attr("disabled", "disabled");
    $("#id_procedimento").empty();
    $("#id_procedimento").attr("disabled", "disabled");
    $("#Consulta_horario").attr("disabled", "disabled");

    if (admin === "1") {
        $("#Telefone_residencial").attr("readonly", "readonly");
        $("#Telefone_celular").attr("readonly", "readonly");
        $("#Telefone_comercial").attr("readonly", "readonly");
    }
}

function changeLang(lang) {
    $('#lang-form').find('#lang').val(lang);
}

function changeData(date) {
    var year = date.substring(6);
    var month = date.substring(3, 5);
    var day = date.substring(0, 2);

    return year + '-' + month + '-' + day;
}

function changeValor(valor) {
    valor = valor.replace(/\ /g, '');
    valor = valor.replace(/\R/g, '');
    valor = valor.replace(/\$/g, '');
    valor = valor.replace(/\./g, '');
    valor = valor.replace(/\,/g, '.');
    return valor;
}

function printValor(valor) {
    valor = valor.replace(/\./g, ',');
    valor = 'R$ ' + valor;
    return valor;
}

function gerarValorParcelas() {
    parcelas = $('#numero_parcelas').val();
    $('#_valor_parcelas').empty();
    
    if (parcelas === '' || parcelas < 0 || parcelas > 12) {
        $('#parcela-btn').attr('disabled', 'disabled');
        return;
    } else {
        valor_total = changeValor($('#_valor_consulta').text());
        valor_parcela = parseInt(valor_total) / parseInt(parcelas);
        valor_parcela = valor_parcela.toFixed(2);
        
        $('#_valor_parcelas').append('<label class="span2"><strong>' + $('#valor_txt').val() + '</strong></label><span>' + printValor(valor_parcela) + '</span>');
        $('#parcela-btn').removeAttr('disabled');
    }
}

function gerarParcelas(idConsulta, idPagamento, valor) {
    
    if ($('#tipo_pagamento').val() === '') {
        return;
    }
    
    if ($('#tipo_pagamento').val() === '3') {
        if ($('#numero_parcelas').val() === '' || $('#numero_parcelas').val() < 0 || $('#numero_parcelas').val() > 12) {
            return;
        }
    }
    
    $('#event-response').append('<img src="' + $('#url').val() + '/images/loading.gif">');
    $('#event-response').show();
    $('#parcela-btn').removeAttr('onclick');

    valor = changeValor(valor);
    tipo = $('#tipo_pagamento').val();
    num = 1;
    if (tipo == 3) {
        num = $('#numero_parcelas').val();
    }
    parcela = valor / num;

    $.ajax({
        type: 'POST',
        url: $('#url').val() + '/pagamento/gerarParcelas',
        data: {id_consulta: idConsulta, id_pagamento: idPagamento, tipo_pagamento: tipo, valor: parcela, numero: num},
        success: function(data) {
            if (data) {
                $('#event-response').empty();
                $('#event-response').text($('#sucesso').val());
                $('#event-response').attr('class', 'event-success');
                $('#elem_change').val('true');
            } else {
                $('#event-response').text($('#erro').val());
                $('#event-response').attr('class', 'event-fail');
            }
        }
    });
}

function openModalStatus(id_parcela) {
    $('#parcela_on').val(id_parcela);
    $('#modal-status').modal();
}

function changePagStatus() {
    if ($('#data_pagamento').val().length > 0) {
        $('#data_pagamento').css('border-color', '#CCCCCC');
        $('#status_error').hide();
        
        var r = confirm($('#confirm_msg').val());
        if (r === true) {
            $.ajax({
                type: 'POST',
                url: $('#url').val() + '/pagamento/changeStatusParcela',
                data: {id_parcela: $('#parcela_on').val(), data_pagamento: changeData($('#data_pagamento').val())},
                success: function(data) {
                    if (data) {
                        $('#data_pagamento_' + $('#parcela_on').val()).text($('#data_pagamento').val());
                        $('#status_parcela_' + $('#parcela_on').val()).text($('#pago').val());
                        $('#status_parcela_' + $('#parcela_on').val()).attr('class', 'btn-success');
                        $('#status_parcela_' + $('#parcela_on').val()).removeAttr('onclick');
                        $('#status_parcela_' + $('#parcela_on').val()).css('pointer', 'default');
                        $('#modal-status').modal('hide');
                    } else {
                        
                    }
                }
            });
        }
        
    } else {
        $('#data_pagamento').css('border-color', '#B94A48');
        $('#status_error').show();
    }
}

function valForm(form) {
    result = true;
    $('#' + form).find('.error').each(function() {
        if ($(this).is(':visible')) {
            result = false;
            return;
        }
    });
    //return result;
    if (result && valPessoa() && valUsuario() && valContato() && valEndereco()) {
        return true;
    } else {
        return false;
    }
}

function valPessoa() {
    nome = $('#Pessoa_nome').val();
    data_nascimento = limpaData($('#Pessoa_data_nascimento').val());
    cpf = limpaCpf($('#Pessoa_cpf').val());
    email = $('#Pessoa_email').val();
    
    if (nome === '' || data_nascimento === '' || cpf === '' || email === '') {
        return false;
    } else {
        return true;
    }
}

function valUsuario() {
    username = $('#UserGroupsUser_username').val();
    password = $('#UserGroupsUser_password').val();
    password_confirm = $('#UserGroupsUser_password_confirm').val();
    
    if (username === '' && password === '' && password_confirm === '') {
        return true;
    } else if (username !== '' && password !== '' && password_confirm !== '') {
        return true;
    }    
}

function valContato() {
    residencial = limpaTelefone($('#Telefone_residencial').val());
    celular = limpaTelefone($('#Telefone_celular').val());
    comercial = limpaTelefone($('#Telefone_comercial').val());
    
    if (residencial === '' && celular === '' && comercial === '') {
        return false;
    } else {
        return true;
    }
}

function valEndereco() {
    cep = limpaCep($('#Endereco_cep').val());
    rua = $('#Endereco_rua').val();
    numero = $('#Endereco_numero').val();
    bairro = $('#Endereco_bairro').val();
    cidade = $('#Endereco_id_cidade').val();
    
    if (cep === '' || rua === '' || numero === '' || bairro === '' || cidade === '') {
        return false;
    } else {
        return true;
    }
}