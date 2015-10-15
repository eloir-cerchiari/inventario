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
                    $scope.formEditArea.message = 'Erro: ' + response.data.error.message;
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
            $scope.formAddArea.message = 'Erro: ' + response.data.error.message;
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
            $scope.formDelArea.message = 'Erro: ' + response.data.error.message;
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
            sucess: false,
            fail: false,
            equipment: {},
            active: function () {
                if (this.newEquipment || this.editEquipment || this.delEquipment) {
                    return true;
                }
                return false;
            },
            reset: function () {
                this.newEquipment = false;
                this.editEquipment = false;
                this.delEquipment = false;
                this.sucess = false;
                this.fail = false;
                this.message = '';
                this.equipment = {};
            },
            cancelButtonClick: function () {
                this.reset();
            },
            addEquipmentSaveButtonClick: function () {
                this.fail = false;
                this.sucess = false;
                this.equipment.area_id = $scope.selectedArea.area.id;
                $http.post('api/v1/equipments', $scope.formEquipment.formEditEquipment.equipment).then(function (response) {
                    $scope.formEquipment.formEditEquipment.message = response.status;
                    $scope.formEquipment.formEditEquipment.sucess = true;
                    $scope.formEquipment.formEditEquipment.message = 'Novo equipamento adicionado com Sucesso!';
                    $scope.formEquipment.loadEquipments();
                }, function (response) {
                    $scope.formEquipment.formEditEquipment.message = 'Erro: ' + response.data.error.message;
                    $scope.formEquipment.formEditEquipment.fail = true;
                    $scope.formEquipment.loadEquipments();
                });
            },
            editEquipmentSaveButtonClick: function () {


                this.fail = false;
                this.sucess = false;
                $http.put('api/v1/equipments', $scope.formEquipment.formEditEquipment.equipment).then(function (response) {
                    $scope.formEquipment.formEditEquipment.message = response.status;
                    $scope.formEquipment.formEditEquipment.sucess = true;
                    $scope.formEquipment.formEditEquipment.message = 'Equipamento alterado com Sucesso!';
                    $scope.formEquipment.loadEquipments();
                }, function (response) {
                    $scope.formEquipment.formEditEquipment.message = 'Erro: ' + esponse.data.error.message;
                    $scope.formEquipment.formEditEquipment.fail = true;
                    $scope.formEquipment.loadEquipments();
                });
            },
            delEquipmentSaveButtonClick: function () {


                this.fail = false;
                this.sucess = false;
                $http.delete('api/v1/equipments/' + this.equipment.equipment_id, $scope.formEquipment.formEditEquipment.equipment).then(function (response) {
                    $scope.formEquipment.formEditEquipment.message = response.status;
                    $scope.formEquipment.formEditEquipment.sucess = true;
                    $scope.formEquipment.formEditEquipment.message = 'Equipamento alterado com Sucesso!';
                    $scope.formEquipment.loadEquipments();
                }, function (response) {
                    $scope.formEquipment.formEditEquipment.message = 'Erro: ' + esponse.data.error.message;
                    $scope.formEquipment.formEditEquipment.fail = true;
                    $scope.formEquipment.loadEquipments();
                });
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
        addEquipmentButtonClick: function () {
            this.formEditEquipment.newEquipment = true;
        },
        editEquipmentButtonClick: function () {
            this.formEditEquipment.editEquipment = true;
            angular.copy(this.selectedEquipment.equipment, this.formEditEquipment.equipment);
        },
        delEquipmentButtonClick: function () {
            this.formEditEquipment.delEquipment = true;
            angular.copy(this.selectedEquipment.equipment, this.formEditEquipment.equipment);
        }

    }


    $scope.loadAreas();
});



angular.module("userRegister", []);
angular.module("userRegister").controller('userRegisterCtrl', function ($scope, $http) {
    $scope.app = "User Register";


    $scope.listUsers = {
        users: {},
        userSelected: {},
        isUserSelected: false,
        active: true,
        select: function (user) {

            if (this.userSelected == user) {
                this.userSelected = {};
                this.isUserSelected = false;
            } else {
                this.userSelected = user;
                this.isUserSelected = true;
            }
        },
        loadUsers: function () {

            $http.get('api/v1/users').then(function (response) {
                $scope.listUsers.users = response.data.data;
            }, function (data) {
                $scope.message = "Erro ao buscar dados: " + data;
            });
        },
        addButtonClick: function () {
            this.active = false;
            $scope.formUsers.create = true;
            $scope.formUsers.resetUser();
            $scope.formUsers.open();
            $scope.formUsers.new();


        },
        editButtonClick: function () {
            this.active = false;
            $scope.formUsers.edit = true;
            $scope.formUsers.resetUser();
            $scope.formUsers.setUser();
            $scope.formUsers.open();
        },
        delButtonClick: function () {
            this.active = false;
            $scope.formUsers.del = true;
            $scope.formUsers.resetUser();
            $scope.formUsers.setUser();
            $scope.formUsers.open();
        },
    };

    $scope.formUsers = {
        del: false,
        edit: false,
        create: false,
        user: {},
        groups: [
            {id: 'user', name: 'Usuário'},
            {id: 'admin', name: 'Administrador'}
        ],
        message: '',
        sucess: false,
        fail: false,
        isOpen: false,
        reset: function () {
            this.del = false;
            this.edit = false;
            this.create = false;
            this.sucess = false;
            this.fail = false;
            this.user = {};
            this.message = '';
            this.isOpen = false;
        },
        new : function () {
            this.user.group = this.groups[0].id;
        },
        setUser: function () {
            angular.copy($scope.listUsers.userSelected, this.user);
        },
        resetUser: function () {
            this.user = {};
        },
        open: function () {
            this.isOpen = true;
        },
        CancellButtonClick: function () {
            this.reset();
            $scope.listUsers.active = true;
        },
        addSaveButtonClick: function () {
            this.fail = false;
            this.sucess = false;
            $http.post('api/v1/users', $scope.formUsers.user).then(function (response) {
                $scope.formUsers.sucess = true;
                $scope.formUsers.message = 'Novo usuário adicionado com Sucesso!';
                $scope.listUsers.loadUsers();
            }, function (response) {
                $scope.formUsers.message = 'Erro: ' + response.data.error.message;
                $scope.formUsers.fail = true;
                $scope.listUsers.loadUsers();
            });
        },
        editSaveButtonClick: function () {
            this.fail = false;
            this.sucess = false;
            $http.put('api/v1/users', $scope.formUsers.user).then(function (response) {
                $scope.formUsers.sucess = true;
                $scope.formUsers.message = 'Usuário alterado com Sucesso!';
                $scope.listUsers.loadUsers();
            }, function (response) {
                $scope.formUsers.message = 'Erro: ' + response.data.error.message;
                $scope.formUsers.fail = true;
                $scope.listUsers.loadUsers();
            });
        },
        delButtonClick: function () {
            this.fail = false;
            this.sucess = false;
            $http.delete('api/v1/users/' + $scope.formUsers.user.id, $scope.formUsers.user).then(function (response) {
                $scope.formUsers.sucess = true;
                $scope.formUsers.message = 'Usuário removido com Sucesso!';
                $scope.listUsers.loadUsers();
            }, function (response) {
                $scope.formUsers.message = 'Erro: ' + response.data.error.message;
                $scope.formUsers.fail = true;
                $scope.listUsers.loadUsers();
            });
        }
    }

    //run load userrs;
    $scope.listUsers.loadUsers();
});


angular.module("ocorrenciasApp", []);
angular.module("ocorrenciasApp").controller('ocorrenciasCtrl', function ($scope, $http) {
    $scope.app = 'Listagem de Ocorrências';
    
    $scope.listAreas = {
        areas: {},
        selectedArea: {},
        loadAreas: function () {

            $http.get('api/v1/areas').then(function (response) {
                $scope.listAreas.areas = response.data.data;
            }, function (data) {
                $scope.message = "Erro ao buscar dados: " + data;
            });
        },
        onSelectArea: function (area) {
            this.selectedArea = area;
            $scope.listEquipments.loadEquipments(this.selectedArea);
        }

    }

    $scope.listEquipments = {
        equipments: null,
        selectedEquipment: {},
        reset: function () {
            this.equipments = [{}];
            this.selectedEquipment = {};
        },
        loadEquipments: function (area) {
            this.reset();
            $http.get('api/v1/equipments/area/' + area.id).then(function (response) {
                $scope.listEquipments.equipments = response.data.data;
            }, function (data) {
                $scope.message = "Erro ao buscar dados: " + data;
            });
        },
        onSelectedEquipment: function (equipment) {
            if (this.selectedEquipment === equipment) {
                this.selectedEquipment = {};
            } else {
                this.selectedEquipment = equipment;
                $scope.listEvents.loadEvents(equipment);
            }
        },
        onFilter:function(){
            
        }
    }
    
    $scope.listEvents = {
        events: null,
        selectedEvent: {},
        reset:function(){
            this.events = null;
            this.selectedEvent = {};
        },
        loadEvents: function(equipment){
            this.reset();
            $http.get('api/v1/equipments/'+equipment.equipment_id+'/events').then(function (response) {
                $scope.listEvents.events= response.data.data;
            }, function (data) {
                $scope.message = "Erro ao buscar dados: " + data;
            });
        }
    }


    $scope.listAreas.loadAreas();
});