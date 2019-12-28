var AppProduto = angular.module('AppProduto',[]);

AppProduto.controller(
    'ProdutoController',
    [ '$scope', '$http', createController ]
);

/**
 * Constroller da página de produto
 */
function createController( $scope, $http ) {
    $scope.filtroproduto = '';

    //Dados da modal de novo produto
    $scope.arrNovoProduto = {
        ds_codigo_produto : '',
        ds_produto : '',
        vl_produto : 0.00,   
    };

    //Lista de produtos da tabela
    $scope.arrProdutos = [];

    $scope.isProdutoInserido = false;

    //Realizar o filtro na lista de produtos
    $scope.realizarFiltro = function(){

        let arrDados = {
            filtroproduto : $scope.filtroproduto
         };

        $http.post(
            'produto/get',
            arrDados
        )
        .success(
            function(data){
              $scope.arrProdutos = data.dados;
            }
        );
     }

     //Adicionar um novo produto a base
    $scope.adicionarProduto = function(){
        $http.post(
            'produto/set',
            $scope.arrNovoProduto
        )
        .success(
            function(data){
                //$scope.isProdutoInserido = data.sucesso;
                //se deu certo atualiza a listagem, mostra mensagem
                /*if(data.sucesso == true){
                    /*setTimeout(
                        function() {
                            $('#myModal').modal('hide');
                            $('.modal-backdrop').hide();
                        }, 1000
                    );
                }

                $scope.isProdutoInserido = false;*/
            }
        );
     }
}