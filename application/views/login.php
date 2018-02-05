<?php $this->load->view('commons/header')?>

<div class="container">
<div class="row">
  
 <?php $this->load->view('commons/alertBox');?>
  
  <div class="col-sm-4 col-sm-offset-1">
    <div class="col-sm-12">
    <h2>Login</h2>
    <hr>
      <form class="form-horizontal" action="<?=base_url('login')?>" method="POST">
        <div class="form-group">
          <label class="text-muted">Usuário:</label>
          <input type="text" class="form-control" placeholder="Usuário" name="login_user" required/>
        </div>
            <div class="form-group">
              <label class="text-muted">Senha:</label>
              <input type="password" class="form-control" placeholder="Senha" name="senha_user" required/>
              <span><a data-toggle="modal" data-target="#esqueceuSenhaModal">Esqueceu sua senha?</a></span>
            </div>
        <div class="form-group">  
          <input type="submit" class="btn btn-success" value="Entrar"/>
        </div>   
      </form>
    </div>
  </div>

  <div class="col-sm-4 col-sm-offset-2">
    <div class="col-sm-12">
    <h2>Cadastre-se</h2>
    <hr>  
      <form class="form-horizontal" action="<?=base_url('register')?>" method="POST">
        <div class="form-group">
          <label class="text-muted">Email:</label>
          <input type="text" class="form-control" placeholder="Email" name="email_user" required/>
        </div>       
        <div class="form-group">
          <label class="text-muted">Nome:</label>
          <input type="text" class="form-control" placeholder="Nome" name="nome_user" required/>
        </div>
        <div class="form-group">
          <label class="text-muted">Usuário:</label>
          <input type="text" class="form-control" placeholder="Usuário" name="login_user" required/>
        </div>
        <div class="form-group">
          <label class="text-muted">Senha:</label>
          <input type="password" class="form-control" placeholder="Senha" name="senha_user" required/>
        </div>
        <div class="form-group"> 
          <input type="submit" class="btn btn-success" value="Cadastrar"/>
        </div>
      </form>
    </div>
  </div>

</div>

<?php $this->load->view('modals/modalEmailSenha')?>
<?php $this->load->view('commons/footer')?>
</body>
</html>