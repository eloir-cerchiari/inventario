angular.module("areaRegister", []);


angular.module("areaRegister").controller("areaRegisterCtrl", function ($scope, $http) {
    $scope.app = "Area Register";
    $scope.selectedArea = {};
    $scope.formEditArea = {
        editando: false,
        area: {},
        message: '',
        sucess: false,
        fail: false,
        waiting: false,
        reset: function(){
            this.editando = false;
            this.area = {};
            this.message = '';
            this.sucess = false;
            this.fail = false;
            whit.waiting = false;
        }
    };
    $scope.formAddArea = {
        selected: false,
        area: {},
        message: '',
        sucess: false,
        fail: false,
        waiting: false,
        reset: function(){
            this.editando = false;
            this.area = {};
            this.message = '';
            this.sucess = false;
            this.fail = false;
            this.waiting = false;
        }
    };


    $scope.loadAreas = function () {
        $http.get('api/v1/areas').then(function (response) {
            $scope.areas = response.data.data;

        }, function (data) {
            $scope.message = "Erro ao buscar dados: " + data;
        });

    }

    $scope.loadAreas();


    $scope.setSelected = function (area) {
        if ($scope.formEditArea.editando == false) {
            $scope.selectedArea = area;

        }
    }

    $scope.editButtonClick = function () {
        if ($scope.formEditArea.editando == false) {
            angular.copy($scope.selectedArea, $scope.formEditArea.area);
            $scope.formEditArea.editando = true;
        }
    }

    $scope.editCancelButtonClick = function () {
        if ($scope.formEditArea.editando == true) {
            $scope.formEditArea.reset();
        }
    }

    $scope.editSaveButtonClick = function () {
        $scope.formEditArea.fail = false;
        $scope.formEditArea.sucess = false;
        $http.put(
                'api/v1/areas/' + $scope.formEditArea.area.id,
                $scope.formEditArea.area
                )
                .then(function (response) {
                    $scope.message = response.status;

                    $scope.formEditArea.sucess = true;
                    $scope.formEditArea.message = 'Área alterada com Sucesso!';
                    $scope.loadAreas();
                }, function (response) {
                    $scope.formEditArea.message = response.data.error.message;
                    $scope.formEditArea.fail = true;
                    $scope.loadAreas();
                });
    }


    $scope.addAreaButtonClick = function () {
        if ($scope.formAddArea.selected == false) {
            $scope.formAddArea.selected = true;
        }
    }

    $scope.addAreaCancelButtonClick = function () {
        if ($scope.formAddArea.selected == true) {
            $scope.formAddArea.reset();
        }
    }

    $scope.addAreaSaveButtonClick = function () {
        $scope.formAddArea.fail = false;
        $scope.formAddArea.sucess = false;
        $http.post('api/v1/areas', $scope.formAddArea.area).then(function (response) {
            $scope.message = response.status;

            $scope.formAddArea.sucess = true;
            $scope.formAddArea.message = 'Nova área adicionada com Sucesso!';
            $scope.loadAreas();
        }, function (response) {
            $scope.formAddArea.message = response.data.error.message;
            $scope.formAddArea.fail = true;
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