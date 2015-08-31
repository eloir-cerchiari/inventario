angular.module("areaRegister", []);
angular.module("areaRegister").controller("areaRegisterCtrl", function ($scope) {
    $scope.app = "Area Register";
    $scope.areas = [
        {"id": 1, "name": "A"},
        {"id": 2, "name": "B"}
    ]
});