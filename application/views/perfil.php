<?php $this->load->view('commons/header')?>

    <!-- Page Content -->
<!-- Começo do conteiner -->
<div class="container">
    <div class="row">
        <div class="col-sm-4">    
            <div class="page-header">
                <h1>Perfil</h1>
            </div>
        </div>
        <div class="col-sm-8">    
            <?php $this->load->view('commons/alertBox')?>
        </div>
    </div>
<!-- Começo da Row-->
<div class="row">
<!-- Começo da col-md-4 -->
    <div class="col-sm-4">
        <div class="col-sm-12">
        <h2>Alterar Senha</h2>
            <form action="<?=base_url('perfil')?>" method="POST">
                <input type="hidden" name="id_user" value="<?=$this->session->userdata('id');?>"/>
                <div class="form-group">
                    <label class="text-muted">Nova Senha: </label> 
                    <input type="password" class="form-control" placeholder="Nova Senha"  name="senha_user" required/>
                </div>
                <div class="form-group">
                    <label class="text-muted">Confirmar Senha:</label>
                    <input type="password" class="form-control" placeholder="Confirmar Senha"  name="senha_check" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Alterar"/>
                </div>
            </form>
        </div>
    <!-- fim do col-sm-12 -->
    </div>
<!-- fim do col-sm-4 -->
<!-- Grid para separar o conteudo -->
    <div class="col-sm-4">
        <div class="col-sm-12">
            <h2>Alterar Email</h2>
            <form action="<?=base_url('perfil2')?>" method="POST">
                <div class="form-group">
                    <label class="text-muted">Email: </label> 
                    <input type="text" class="form-control" value="<?= $this->session->userdata('email');?>" name="email_user" required/>
                </div>
                <div class="form-group">
                    <label class="text-muted">Senha: </label>
                    <input type="password" class="form-control" placeholder="Senha"  name="senha_user" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Alterar"/>
                </div>
            </form>

            <!--
            <h2>Minha Descrição</h2>
                <div class="well">
                    <?= $this->session->userdata('descricao');?>
                </div>
            -->    
        </div>
    </div>

<?php $this->load->view('commons/perfilbar')?>
<?php $this->load->view('commons/footer')?>

</body>
</html>