angular.module("areaRegister", []);


angular.module("areaRegister").controller("areaRegisterCtrl", function ($scope, $http) {
    $scope.app = "Area Register";
    $scope.selectedArea = {};
    $scope.selectedAreaEdit = {editando: false, area: {}, message: '', sucess: false, fail: false};
    $scope.addArea = {selected: false, area: {}, message: '', sucess: false, fail: false};


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
    
    
    $scope.addAreaButtonClick = function () {
        if ($scope.addArea.selected == false) {
            $scope.addArea.selected = true;
        }
    }

    $scope.addAreaCancelButtonClick = function () {
        if ($scope.addArea.selected == true) {
            $scope.addArea.area = {};
            $scope.addArea.selected = false;
        }
    }

    $scope.addAreaSaveButtonClick = function () {
        $scope.addArea.fail = false;
        $scope.addArea.sucess = false;
        $http.post('api/v1/areas',  $scope.addArea.area).then(function (response) {
            $scope.message = response.status;

            $scope.addArea.sucess = true;
            $scope.addArea.message = 'Nova área adicionada com Sucesso!';
            $scope.loadAreas();
        }, function (response) {
            $scope.addArea.message = response.data.error.message;
            $scope.addArea.fail = true;
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