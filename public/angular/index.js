var AppIndex = angular.module('AppIndex',[]);

AppIndex.controller(
    'IndexController',
    [ '$scope', '$http', createController ]
);

/**
 * Constroller da página de Index
 */
function createController( $scope, $http ) {
    $scope.valorTotalVenda = 0.00;
    $scope.snValorTotalRecuperado = false;

    //Realizar o filtro na lista de produtos
    $scope.buscaValorTotalVendas = function(){

        $http.post(
            'admin/get'
        )
        .success(
            function(data){
              $scope.valorTotalVenda = data.dados[0].vl_total_venda;
              $scope.snValorTotalRecuperado = true;
            }
        );
    }

    angular.element(document).ready(function () {
        $scope.buscaValorTotalVendas();
    });
}