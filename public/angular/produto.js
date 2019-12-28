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