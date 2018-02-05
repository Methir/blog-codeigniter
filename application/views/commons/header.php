<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alika Project</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url('assets/css/blog-home.css')?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if($this->session->userdata('logged')): ?>
                <a class="navbar-brand" href="<?=base_url('home')?>"><?= $this->session->userdata('nome'); ?></a>
            <?php else: ?>
                <a class="navbar-brand" href="<?=base_url('home')?>">Alika</a>
            <?php endif; ?> 
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?=base_url('home')?>">Home</a>
                    </li>

                        <?php if($this->session->userdata('logged')): ?>
                            <li>
                                <a href="<?=base_url('perfil'); ?>">Perfil</a>
                            </li>                             
                                <?php if($this->session->userdata('autoridade') >= 1): ?>
                                    <li>
                                        <a href="<?=base_url('new-post'); ?>">Novo Post</a>
                                    </li>
                                <?php endif; ?>

                                <?php if($this->session->userdata('autoridade') >= 2): ?>
                                    <li>
                                        <a href="<?=base_url('control-painel');?>">Control Painel</a>
                                    </li>
                                <?php endif; ?>
                            <li>
                                <a href="<?=base_url('fale-conosco');?>">Fale Conosco</a>
                            </li> 
                            <li>
                                <a href="<?=base_url('logout');?>">Sair</a>
                            </li> 
                        <?php else: ?>
                    <li>
                        <a href="<?=base_url('login')?>">Login</a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
