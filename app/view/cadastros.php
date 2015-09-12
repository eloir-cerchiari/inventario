<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Inventário de Ocorrências</title>

        <script src="js/angular-1.4.4/angular.js"></script>
        <script src="js/angular-1.4.4/angular-messages.js"></script>
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
                        <li ><a href="#">Ocorrências</a></li>
                        <li class="active"><a href="#about">Cadastros</a></li>
                        <li><a href="#contact">Relatórios</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="row">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#">Área</a></li>
                    <li role="presentation"><a href="#">Equipamento</a></li>
                    <li role="presentation"><a href="#">Usuário</a></li>
                </ul>
            </div>

            <div class="tab-pane row">
                <!-- Área de Cadastro de Áreas -->

                <div class="col-sm-10 col-md-10"  ng-app="areaRegister" ng-controller="areaRegisterCtrl">


                    <!-- panel de listagem de áreas -->
                    <div class="col-sm-5 col-md-5" ng-hide="selectedAreaEdit.editando">
                        <div class="panel panel-default panel-info">


                            <div class="panel-heading">
                                <h3 class="panel-title">Áreas</h3>
                            </div>

                            <div class="panel-body">
                                <!-- filtro de equipamentos -->
                                <div class="row margin-bottom-15">
                                    <div class="col-sm-12 col-md-12">
                                        <input alt="Filtro" placeholder="Filtro" class="form-control" id="filtro-equipamentos"  />
                                    </div>
                                </div>
                                <!-- fim do filtro de equipamentos -->

                                <!-- Listagem de Áreas -->
                                <div class="row">

                                    <div class="col-sm-12 col-md-12 ">

                                        <div class="list-group">

                                            <a href="#" 
                                               class="list-group-item" 
                                               ng-repeat="area in areas" 
                                               ng-class="{active: area == selectedArea}" 
                                               ng-click="setSelected(area)">

                                                {{area.name}}

                                            </a>

                                        </div>

                                        <div class="form-group">
                                            <input type="button" 
                                                   class="btn btn-info form-control" 
                                                   value="Alterar" 
                                                   ng-click="editButtonClick()" 
                                                   ng-disabled="selectedAreaEdit.editando" />
                                        </div>

                                    </div>
                                </div>
                                <!-- fim da Listagem de Áreas -->

                            </div>
                        </div>
                    </div>

                    <!-- fim do panel de listagem de áreas -->


                    <div class="col-sm-5 col-md-5 " ng-show="selectedAreaEdit.editando">
                        <div class="panel panel-default panel-warning" >
                            <div class="panel-heading">
                                <h3 class="panel-title">Alterando Área </h3>
                            </div>
                            <div class="panel-body">
                                <h4>Área a ser alterada: {{selectedArea.name}}</h4>
                                <div class="form-group" >
                                    <label for="area">Área</label>
                                    <input alt="Área" placeholder="Área" ng-model="selectedAreaEdit.area.name" class="form-control" id="area"  />
                                </div>
                                <div class="btn-group">
                                    <input type="button" 
                                           class="btn btn-danger " 
                                           value="Cancelar" 
                                           ng-click="editCancelButtonClick()" 
                                           />

                                    <input type="button" 
                                           class="btn btn-default" 
                                           value="Salvar"
                                           ng-click="editSaveButtonClick()" 
                                           />
                                </div>
                            </div>
                            <div class="panel-footer">
                                
                                <div class="alert alert-success" ng-show="selectedAreaEdit.sucess">
                                    {{selectedAreaEdit.message}}
                                </div>
                                <div class="alert alert-warning" ng-show="selectedAreaEdit.fail">
                                    {{selectedAreaEdit.message}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fim da Área de Cadastro de Áreas -->

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
        <link href="css/default.css" rel="stylesheet">

        <!-- jscript -->
        <script src="js/inventariong.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>

    </body>
</html>