/**
 * Classe de Produtos, utilizada no formulário de orçamento do Técnico Orçamentista
 * @returns {undefined}
 */
var Produto = function() {
    
    this.projeto = '/marfra/public';
    
    this.adicionar = function(produto) {
        
        $('.info-padrao-produto').removeClass('has-error');
        $('.alert-produto').hide();
        
        if (produto === '') {
            $('.info-padrao-produto').addClass('has-error');
            $('.alert-produto').show();
            return;
        }
        
        var ajaxurl = this.projeto + '/get-bloco-produtos/' + produto;
        $.ajax({
            url: ajaxurl,
            type: "GET",
            beforeSend: function () { $('.btn-addProduto').attr('disabled', true); },
            error: function () { $('.btn-addProduto').attr('disabled', false); },
            success: function(data){
                $('#bloco-produtos').append(data);
                $('.btn-addProduto').attr('disabled', false);
                // iChecks
                $('.i-checks').iCheck({checkboxClass: 'icheckbox_square-green', radioClass: 'iradio_square-green'});
            }
        });
    };
    
    this.excluir = function(id) {
        $('#'+id).remove();
    };
    
    this.adicionaOpicional = function(opicional, id) {
        
        $('#info-produto-'+id).removeClass('has-error');
        $('#alert-subproduto-'+id).hide();
        
        if (opicional === '') {
            $('#info-produto-'+id).addClass('has-error');
            $('#alert-subproduto-'+id).show();
            return;
        }
        
        var ajaxurl = this.projeto + '/get-bloco-opicional/' + opicional + '/' + id;
        $.ajax({
            url: ajaxurl,
            type: "GET",
            beforeSend: function () { $('#btn-subproduto-'+id).attr('disabled', true); },
            error: function () { $('#btn-subproduto-'+id).attr('disabled', false); },
            success: function(data){
                $('#bloco-subproduto-'+id).append(data);
                $('#btn-subproduto-'+id).attr('disabled', false);
                // iChecks
                $('.i-checks').iCheck({checkboxClass: 'icheckbox_square-green', radioClass: 'iradio_square-green'});
            }
        });
    };
};