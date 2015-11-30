/**
 * Classe de utilidades javscript
 * @returns {Utilidade}
 */
var Utilidade = function() {
    
    this.projeto = '/marfra/public';
    
    this.getCidades = function(idEstado, idComboCidade, idCidade) {
        if (idEstado === '-1') {
            $('#'+idComboCidade).html('<option value="-1">----</option>')
                        .select2({language: 'pt-BR'});
            return;
        }
        
        var cidade = -1;
        if (idCidade !== undefined) {
            cidade = idCidade;
        }
        
        jQuery.get(this.projeto + '/get-cidades/' + idEstado, function(cidades) {
            jQuery('#'+idComboCidade).empty();
            jQuery.each(cidades, function(key, value) {
                var selected = (cidade == value.id) ? 'selected' : '';
                jQuery('#'+idComboCidade).append('<option value="' + value.id + '" ' + selected + '>' + value.nome + '</option>');
            });
            jQuery('#'+idComboCidade).select2({language: 'pr-BR'});
        });
    };
    
    this.pesquisaCEP = function(cep, idEndereco, idBairro, idEstado) {
        
        var cepCount = cep.replace('_', '');
        if (cepCount.length === 9) {
            jQuery.get('//apps.widenet.com.br/busca-cep/api/cep.json?code=' + cep, function(retorno) {
                if (retorno.status === 1) {
                    jQuery('#'+idEndereco).val(retorno.address);
                    jQuery('#'+idBairro).val(retorno.district);
                    
                    var option = $('option[data-sigla^="'+retorno.state+'"]').attr('value');
                    $('#'+idEstado).val(option).trigger('change');
                }
            });
        }
    };
    
    /**
     * Método responsável por retornar uma listagem de clientes de acordo
     * com o tipo de cliente informado
     * @param {type} idTipo
     * @param {type} idComboCliente
     * @param {type} idCliente
     * @returns {undefined}
     */
    this.getClientes = function(idTipo, idComboCliente, idCliente) {
        if (idTipo === '') {
            jQuery('#'+idComboCliente).html('').select2({placeholder: 'Selecione', language: 'pt-BR'});
            jQuery('#'+idComboCliente).val(null).trigger("change");
            return;
        }
        
        var cliente = '';
        if (idCliente !== undefined) {
            cliente = idCliente;
        }
        
        jQuery('#'+idComboCliente).html('').select2({placeholder: 'Carregando...', language: 'pt-BR'});
        jQuery('#'+idComboCliente).val(null).trigger("change");
        
        jQuery.get(this.projeto + '/get-clientes/' + idTipo, function(clientes) {
            jQuery('#'+idComboCliente).empty();
            jQuery.each(clientes, function(key, value) {
                var selected = (cliente == value.id) ? 'selected' : '';
                jQuery('#'+idComboCliente).append('<option value="' + value.id + '" ' + selected + '>' + value.nome + '</option>');
            });
            jQuery('#'+idComboCliente).select2({placeholder: 'Selecione', language: 'pr-BR'});
            if (cliente === '') {
                jQuery('#'+idComboCliente).val(null).trigger("change");
            }
        });
    };
    
    this.modalExclusao = function(obj) {
        var nome = obj.attr('data-nome');
        var href = obj.attr('data-href');
        
        $('.modal-body').html('<p>Deseja realmente excluir o registro <strong>' + nome + '</strong>?</p>');
        $('.btn-modal-confirm').attr('href', href);
    };
    
    this.toggleButton = function(e) {
        var id = $(e).attr('data-id');
        if ($(e).hasClass('collapsed')) {
            $('.fa-chevron-up[data-id="'+id+'"]').show();
            $('.fa-chevron-down[data-id="'+id+'"]').hide();
        } else {
            $('.fa-chevron-up[data-id="'+id+'"]').hide();
            $('.fa-chevron-down[data-id="'+id+'"]').show();
        }
    };
};
