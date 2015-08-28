<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Inventário de Ocorrências</title>

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

                <div class="col-sm-6 col-md-6">
                    
                    
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


                            <div class="row">

                                <div class="col-sm-12 col-md-12 ">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item">A</a>
                                        <a href="#" class="list-group-item">B</a>
                                        <a href="#" class="list-group-item">C</a>
                                        <a href="#" class="list-group-item">D</a>
                                        <a href="#" class="list-group-item">E</a>
                                    </div>
                                </div>
                            </div>
<!-- fim do filtro de equipamentos -->
                        </div>
                    </div>
                </div>

                <!-- Fim da Área de Cadastro de Áreas -->
            </div>





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

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/ie10-viewport-bug-workaround.js"></script>


    </body>
</html>