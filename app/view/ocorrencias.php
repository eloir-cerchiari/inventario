<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Inventário de Ocorrências</title>

        <script src="<?php echo $baseUrl; ?>js/angular-1.4.4/angular.js"></script>
        <script src="<?php echo $baseUrl; ?>js/angular-1.4.4/angular-messages.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Ocorrências</a></li>
                        <li><a href="#about">Cadastros</a></li>
                        <li><a href="#contact">Relatórios</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container" ng-app="ocorrenciasApp" ng-controller="ocorrenciasCtrl">


            <!-- Área de seleção de Áreas -->
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Área</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div 
                                    class="col-sm-4 col-md-4 margin-bottom-15"
                                    ng-repeat="area in listAreas.areas" > 


                                    <button 
                                        type="button" 
                                        class="btn btn-default btn-block"
                                        ng-class="{active: area == listAreas.selectedArea}"
                                        ng-bind="area.name"
                                        ng-click="listAreas.onSelectArea(area)"
                                        >

                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim da Área de seleção de Áreas -->


            <!-- Área de seleção de Equipamentos -->

            <div class="col-sm-6 col-md-2">
                <div class="panel panel-default panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Equipamento</h3>
                    </div>
                    <div class="panel-body">

                        <div class="row margin-bottom-15">
                            <div class="col-sm-12 col-md-12">
                                <input alt="Filtro" placeholder="Filtro" class="form-control" id="filtro-equipamentos" ng-model="equipmentsFilter"  />
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-12 ">
                                <div class="list-group">
                                    <a href="#" class="list-group-item"
                                       ng-class="{active: equipment == listEquipments.selectedEquipment}"
                                       ng-repeat="equipment in listEquipments.equipments | filter: {name:equipmentsFilter}"
                                       ng-click="listEquipments.onSelectedEquipment(equipment)"
                                       >{{equipment.name}}</a >
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Fim da Área de seleção de Equipamentos -->

            <!-- Área do Histórico de Ocorrências -->

            <div class="col-sm-12 col-md-7">
                <div class="panel panel-warning">

                    <div class="panel-heading">
                        <h3 class="panel-title">Histórico</h3>
                    </div>

                    <div class="panel-body">

                        <!-- Histórico Buttons -->
                        <div class="row margin-bottom-15">

                            <div class="col-sm-3 col-md-3">
                                <input alt="Filtro por Data" placeholder="Filtro por Data" class="form-control" id="filtro-ocorrencias-data"  />
                            </div>

                            <div class="col-sm-5 col-md-5">
                                <div class="input-group">

                                    <input alt="Filtro" placeholder="Filtro" class="form-control" id="filtro-ocorrencias-data"  />

                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden=true" /></button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign" /> Nova Ocorrência</button>
                            </div>
                        </div>

                        <!-- Fim do Histórico Buttons -->


                        <div class="row">

                            <div class="col-sm-12 col-md-12 ">
                                <table class="table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Usuário</th>
                                            <th>Ocorrência</th>
                                            <th>Tipo</th>
                                            <th>Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                             ng-repeat="event in listEvents.events "
                                            >
                                            <td>{{event.create_timestamp | date:'dd/MM/yy HH:mm'}}</td>
                                            <td>{{event.user.data.name}}</td>
                                            <td>{{event.description}}</td>
                                            <td>{{event.type}}</td>
                                            <td>{{event.time}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Fim da  Área do Histórico de Ocorrências -->

        </div><!-- /.container -->












        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        -->

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Bootstrap 
        <link href="css/bootstrap.min.css" rel="stylesheet">
        -->

        <!-- Custom styles for this template -->
        <link href="<?php echo $baseUrl; ?>css/default.css" rel="stylesheet">

        <!-- jscript -->
        <script src="<?php echo $baseUrl; ?>js/inventariong.js"></script>

        <!-- Custom styles for this template 
        <link href="css/default.css" rel="stylesheet">
        -->
        <!-- Latest compiled and minified JavaScript -->
<!--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>


    </body>
</html>