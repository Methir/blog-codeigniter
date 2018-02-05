            <!-- Blog Sidebar Widgets Column -->
            <div class="col-sm-4 hidden-xs">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Busca</h4>
                    <form class="form-inline" method="GET" action="<?=base_url('busca');?>">
                        <div class="input-group">
                            <input name="busca" type="text" class="form-control" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"> <span class="glyphicon glyphicon-search"></span> </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categorias do Blog</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled">
                                <li><a href="<?=base_url('categoria/registro')?>"> Registro de Campanha </a>
                                </li>
                                <li><a href="<?=base_url('categoria/personagens')?>"> Sobre os Personagens </a>
                                </li>
                                <li><a href="<?=base_url('categoria/projeto')?>"> Sobre o Projeto </a>
                                </li>
                                <li><a href="<?=base_url('categoria/extras')?>"> Cenas Extras </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-sm-6">
                            <ul class="list-unstyled">
                                <li><a href="<?=base_url('categoria/especiais')?>"> Especiais </a>
                                </li>
                                <li><a href="<?=base_url('categoria/nenhuma')?>"> Nenhuma </a>
                                </li>
                                <li><a href="#"> - </a>
                                </li>
                                <li><a href="#"> - </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Sobre</h4>
                    <p>
                    Alika é um novo mundo de fantasia, perigos e desafios baseado nas mesas de RPG: 
                    Alika The Philosofal Stone, Alika Kingslayer e Alika The New World.
                    </p>
                    <p>
                    Cada personagem principal é um de nossos jogadores. 
                    Os jogadores criaram suas próprias historias que foram integradas ao mesmo tempo a trama principal, ajudando assim 
                    a expandir o mundo de Alika.
                    </p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>