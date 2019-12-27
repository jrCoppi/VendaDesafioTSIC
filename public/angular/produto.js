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
    $scope.arrNovoProduto = [
        {
            ds_codigo_produto : '',
            ds_produto : '',
            vl_produto : 0.00,
        }
    ];

    //Lista de produtos da tabela
    $scope.arrProdutos = [
        {
            ds_codigo_produto : '1',
            ds_produto : 'Arroz',
            vl_produto : 10.50,
        },
        {
            ds_codigo_produto : '2',
            ds_produto : 'Feijão',
            vl_produto : 5.50,
        },
        {
            ds_codigo_produto : '3',
            ds_produto : 'Macarrão',
            vl_produto : 4.00,
        }
    ];

    //Realizar o filtro na lista de produtos
    $scope.realizarFiltro = function(){
        /*$http.post(
            '../ajax/inicio/getUltimasPesquisas.php?id_categoria=' + $scope.id_categoria
        )
        .success(
            function(data){
              $scope.arrProdutos = data;
            }
        );*/
     }

     //Adicionar um novo produto a base
    $scope.adicionarProduto = function(){
        /*$http.post(
            '../ajax/inicio/getUltimasPesquisas.php?id_categoria=' + $scope.id_categoria
        )
        .success(
            function(data){
              $scope.arrProdutos = data;
            }
        );*/
     }
}