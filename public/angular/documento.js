var AppDocumento = angular.module('AppDocumento',[]);

AppDocumento.controller(
    'DocumentoController',
    [ '$scope', '$http', createController ]
);

/**
 * Constroller da página de Documento
 */
function createController( $scope, $http ) {
    $scope.filtroproduto = '';
    $scope.snProdutoFiltradoExiste = null;
    $scope.snAtualizandoVenda = false;

    //Dados da modal de novo produto
    $scope.arrDadosVenda = {
        id_documento : null,
        vl_total_documento : 0,
        sn_documento_confirmado : false,   
        sn_documento_cancelado : false
    };

    //Lista de produtos da venda
    $scope.arrProdutosVenda = [];

    /**
     * Realizar o filtro na lista de produtos
     */
    $scope.realizarFiltro = function(){
        $scope.snProdutoFiltradoExiste = null;

        let arrDados = {
            filtroproduto : $scope.filtroproduto
         };

        $http.post(
            'produto/get-venda',
            arrDados
        )
        .success(
            function(data){
                //se não achou produto
                if(data.dados.length == 0){
                    $scope.snProdutoFiltradoExiste = false;
                    return false;
                }

                let produto = data.dados[0];

                //adiciona produto a venda
                $scope.arrProdutosVenda.push(produto);

                //atualiza a venda com o produto
                $scope.atualizaVenda(
                    produto.id_produto, 
                    produto.vl_produto
                );
            }
        );
    }

    /*
    * Atualiza/cria a venda 
    */
    $scope.atualizaVenda = function(
        id_produto,
        vl_produto
    ){
        //por segurança verifica se ja não esta executando a ação
        if($scope.snAtualizandoVenda){
            return false;
        }

        $scope.snAtualizandoVenda = true;

        //se ainda não tem id cria
        if($scope.arrDadosVenda.id_documento == null) {
            $scope.setVenda(
                id_produto, 
                vl_produto
            );

            return false;
        }

        //atualiza valor do produto
        $scope.arrDadosVenda.vl_total_documento = $scope.arrDadosVenda.vl_total_documento + vl_produto; 

        let arrDados = {
            id_produto : id_produto,
            vl_total_documento: $scope.arrDadosVenda.vl_total_documento
        };

        $http.post(
            'documento/update-produto',
            arrDados
        )
        .success(
            function(data){
                //finaliza
                $scope.snAtualizandoVenda = false;
            }
        );
    }

    /**
     * Atualiza/cria a venda 
     */
    $scope.setVenda = function(
        id_produto,
        vl_produto
    ){
        let arrDados = {
            id_produto : id_produto,
            vl_total_documento: vl_produto
        };

        //seta com o valor do produto
        $scope.arrDadosVenda.vl_total_documento = vl_produto;        

        $http.post(
            'documento/set',
            arrDados
        )
        .success(
            function(data){
                //seta o id da venda
                $scope.arrDadosVenda.id_documento = data.dados[0].id_documento;      

                $scope.snAtualizandoVenda = false;
            }
        );
    }

    /**
     * Atualiza/cria a venda 
     */
    $scope.confirmarVenda = function()
    {
        let arrDados = {
            sn_documento_confirmado : true,
            sn_documento_cancelado : false,
            id_documento : $scope.arrDadosVenda.id_documento
        };   

        $http.post(
            'documento/update',
            arrDados
        )
        .success(
            function(data){
                document.location.href = "../public";
            }
        );
    }

    /**
     * Atualiza/cria a venda 
     */
    $scope.cancelarVenda = function()
    {
        let arrDados = {
            sn_documento_confirmado : false,
            sn_documento_cancelado : true,
            id_documento : $scope.arrDadosVenda.id_documento
        };   

        $http.post(
            'documento/update',
            arrDados
        )
        .success(
            function(data){
                document.location.href = "../public";
            }
        );
    }
}