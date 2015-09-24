angular.module("areaRegister", []);

angular.module("areaRegister").controller("areaRegisterCtrl", function ($scope, $http) {
    $scope.app = "Area Register";
    $scope.selectedArea = {area: {}, selected: false};
    $scope.formEditArea = {
        selected: false,
        area: {},
        message: '',
        sucess: false,
        fail: false,
        waiting: false,
        reset: function () {
            this.selected = false;
            this.area = {};
            this.message = '';
            this.sucess = false;
            this.fail = false;
            this.waiting = false;
        }
    };
    $scope.formAddArea = {
        selected: false,
        area: {},
        message: '',
        sucess: false,
        fail: false,
        waiting: false,
        reset: function () {
            this.selected = false;
            this.area = {};
            this.message = '';
            this.sucess = false;
            this.fail = false;
            this.waiting = false;
        }
    };

    $scope.formDelArea = {
        selected: false,
        area: {},
        message: '',
        sucess: false,
        fail: false,
        waiting: false,
        reset: function () {
            this.selected = false;
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
        if ($scope.formEditArea.selected == false && $scope.formAddArea.selected == false) {
            $scope.selectedArea.area = area;
            $scope.selectedArea.selected = true;
        }
    }

    $scope.editButtonClick = function () {
        if ($scope.formEditArea.selected == false) {
            angular.copy($scope.selectedArea.area, $scope.formEditArea.area);
            $scope.formEditArea.selected = true;
        }
    }

    $scope.editCancelButtonClick = function () {
        if ($scope.formEditArea.selected == true) {
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

    $scope.delAreaButtonClick = function () {

        if ($scope.formDelArea.selected === false) {

            angular.copy($scope.selectedArea.area, $scope.formDelArea.area);
            $scope.formDelArea.selected = true;
        }

    }

    $scope.delAreaCancelButtonClick = function () {

        if ($scope.formDelArea.selected) {
            $scope.formDelArea.reset();
        }

    }

    $scope.delAreaYesButtonClick = function () {
        $scope.formDelArea.fail = false;
        $scope.formDelArea.sucess = false;
        $http.delete('api/v1/areas/' + $scope.formDelArea.area.id,
                $scope.formDelArea.area).then(function (response) {
            $scope.message = response.status;
            $scope.formDelArea.sucess = true;
            $scope.formDelArea.message = 'Área removida!';
            $scope.loadAreas();
        }, function (response) {
            $scope.formDelArea.message = response.data.error.message;
            $scope.formDelArea.fail = true;
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



angular.module("equipmentRegister", []);

angular.module("equipmentRegister").controller("equipmentRegisterCtrl", function ($scope, $http) {

    $scope.app = "Equipment Register";


    $scope.loadAreas = function () {

        $http.get('api/v1/areas').then(function (response) {
            $scope.areas = response.data.data;

        }, function (data) {
            $scope.message = "Erro ao buscar dados: " + data;
        });
    }


    $scope.selectedArea = {
        area: {},
        selected: false,
        set: function (area) {

            if (area == this.area)
                return;

            this.area = area;
            this.selected = true;
            $scope.formEquipment.loadEquipments();
        }
    };

    $scope.formEquipment = {
        equipments: [],
        
        formEditEquipment: {
            newEquipment: false,
            editEquipment: false,
            delEquipment: false,
            message: '',
            active: function(){
              if(this.newEquipment || this.editEquipment || this.delEquipment){
                  return true;
              }  
              return false;
            },
            equipment: {},
            cancelButtonClick: function(){
                this.newEquipment = false;
                this.editEquipment = false;
                this.delEquipment = false;
                this.equipment = {};
            },
            addEquipmentSaveButtonClick : function(){
              this.message = 'vai adicionar';
              
            },
            editEquipmentSaveButtonClick:function(){
              this.message = 'vai alterar';  
            },
            delEquipmentSaveButtonClick : function(){
                this.message = 'vai remover';
            }
        },
        
        
        setEquipments: function (data) {
            this.equipments = data;
        },
        resetEquipments: function () {
            this.equipments = [];
            this.selectedEquipment.reset();
        },
        selectedEquipment: {
            equipment: {},
            selected: false,
            set: function (equipment) {
                this.equipment = equipment;
                this.selected = true;
            },
            reset: function () {
                this.equipment = {};
                this.selected = false;
            }
        },
        
        loadEquipments: function () {

            this.resetEquipments();

            $http.get('api/v1/equipments/area/' + $scope.selectedArea.area.id).then(function (response) {
                $scope.formEquipment.setEquipments(response.data.data);

            }, function (data) {

                $scope.message = "Erro ao buscar dados: " + data;

            });

        },
        
        addEquipmentButtonClick: function(){
            this.formEditEquipment.newEquipment = true;
        },
        
        editEquipmentButtonClick: function(){
            this.formEditEquipment.editEquipment = true;
        },
        
        delEquipmentButtonClick: function(){
            this.formEditEquipment.delEquipment = true;
            angular.copy(this.selectedEquipment.equipment, this.formEditEquipment.equipment);
        }

    }


    $scope.loadAreas();


});

