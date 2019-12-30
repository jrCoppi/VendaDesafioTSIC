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

    $scope.snProdutoInserido = false;
    $scope.snFiltroValido = null
    $scope.snAtualizandoProduto = false;

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
        $scope.snFiltroValido = null;

        if($scope.snAtualizandoProduto){
            return false;
        }
        $scope.snAtualizandoProduto = true;

        $http.post(
            'produto/set',
            $scope.arrNovoProduto
        )
        .success(
            function(data){
                $scope.snProdutoInserido = data.sucesso;
                //se deu certo atualiza a listagem, mostra mensagem
                if(data.sucesso == true){
                    setTimeout(
                        function() {
                            
                            //limpa a modal de produto
                            botaoCancelar.click();
                            $novoProduto = $scope.arrNovoProduto.ds_codigo_produto;
                            $scope.novoProduto();

                            //fecha a modal e recarrega o filtro
                            $scope.filtroproduto = $novoProduto
                            $scope.realizarFiltro();
                        }, 1000
                    );

                    return false;
                }

                $scope.snFiltroValido = false;
                $scope.snAtualizandoProduto = false;
            }
        );
     }


     $scope.novoProduto = function(){
        //Dados da modal de novo produto
        $scope.arrNovoProduto = {
            ds_codigo_produto : '',
            ds_produto : '',
            vl_produto : 0.00,   
        };

        $scope.snProdutoInserido = false;
        $scope.snFiltroValido = null
        $scope.snAtualizandoProduto = false;  
    }
}

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
        return false;

    return true;
}