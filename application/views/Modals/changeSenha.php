<?php $this->load->view('commons/header')?>

    <!-- Page Content -->
<!-- Começo do conteiner -->
<div class="container">
    <div class="row">
        <div class="col-sm-4">    
            <div class="page-header">
                <h1>Esqueceu sua senha?</h1>
            </div>
        </div>
        <div class="col-sm-8">
            <?php $this->load->view('commons/alertBox')?>    
        </div>
    </div>
<!-- Começo da Row-->
<div class="row">
<!-- Começo da col-md-4 -->
    <div class="col-sm-4 col-sm-offset-4">
        <div class="col-sm-12">
        <h2>Alterar Senha</h2>
            <form action="<?=base_url('change-senha/') . $id . "/" . $nome ?>" method="POST">
                <input type="hidden" name="id_user" value="<?= $id ?>" required/>
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
</div>    

<?php $this->load->view('commons/footer')?>

</body>
</html>