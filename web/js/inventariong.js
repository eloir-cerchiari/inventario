angular.module("areaRegister", []);


angular.module("areaRegister").controller("areaRegisterCtrl", function ($scope, $http) {
    $scope.app = "Area Register";
    $scope.selectedArea = {};
    $scope.selectedAreaEdit = {editando: false, area: {}, message: '', sucess: false, fail: false};


    $scope.loadAreas = function (){
        $http.get('api/v1/areas').then(function (response) {
            $scope.areas = response.data.data;

        }, function (data) {
            $scope.message = "Erro ao buscar dados: " + data;
        });

    }

    $scope.loadAreas();


    $scope.setSelected = function (area) {
        if ($scope.selectedAreaEdit.editando == false) {
            $scope.selectedArea = area;

        }
    }

    $scope.editButtonClick = function () {
        if ($scope.selectedAreaEdit.editando == false) {
            angular.copy($scope.selectedArea, $scope.selectedAreaEdit.area);
            $scope.selectedAreaEdit.editando = true;
        }
    }

    $scope.editCancelButtonClick = function () {
        if ($scope.selectedAreaEdit.editando == true) {
            $scope.selectedAreaEdit.area = {};
            $scope.selectedAreaEdit.editando = false;
        }
    }

    $scope.editSaveButtonClick = function () {
        $scope.selectedAreaEdit.fail = false;
        $scope.selectedAreaEdit.sucess = false;
        $http.put('api/v1/areas/' + $scope.selectedAreaEdit.area.id, $scope.selectedAreaEdit.area).then(function (response) {
            $scope.message = response.status;

            $scope.selectedAreaEdit.sucess = true;
            $scope.selectedAreaEdit.message = 'Área alterada com Sucesso!';
            $scope.loadAreas();
        }, function (response) {
            $scope.selectedAreaEdit.message = response.data.error.message;
            $scope.selectedAreaEdit.fail = true;
            $scope.loadAreas();
        });
    }
    /**
     
     $http.post('api/v1/areas', $scope.testAreas)
     
     .then(function (response) {
     
     console.log(response.status);
     
     }, function (response) {
     $scope.message = response.statusText;
     
     });
     */
});