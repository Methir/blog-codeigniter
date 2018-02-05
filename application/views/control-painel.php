<?php $this->load->view('commons/header')?>
    <!-- Arquivo CSS do plugin dataTable que é específico desta viewer -->
      <link href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <!-- Page Content -->

<div class="container">
    <!-- Inicio ROW 1-->  
<div class="row">
    <!-- Inicio col-md-4 col-sm-4 -->
  <div class="col-md-4 col-sm-4"> 
        <h1> Controle de usuários </h1>
  </div>
    <!-- Fim col-md-4 col-sm-4 -->
    <!-- Inicio col-md-8 col-sm-8 -->
  <div class="col-md-8 col-sm-8">
    <?php $this->load->view('commons/alertBox')?>
    <!-- Fim col-md-8 col-sm-8 -->
  </div>
    <!-- Fim ROW 1 --> 
</div>
<hr>
    <!-- Inicio ROW 2 -->
<div class="row">
    <!-- Inicio col-md-12 col-md-12 -->
    <div class="col-md-12 col-sm-12">
        <table id="datatable" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Nível</th>
              <th style="width: 300px;">Ação</th>
            </tr>
          </thead>
          <tbody>
              <?php foreach ($usuarios as $user): ?>
                <tr>
                  <th><?= $user->nome_user; ?></th>
                  <th>Nível: <?= $nivel = array('aprendiz', 'mestre', 'archmago', 'merlin')[$user->autoridade_user]; ?></th>
                  <th>
                    <button type="button" class="btn btn-info buttonPerfil" data-toggle="modal" data-target="#perfilModal" data-id="<?=$user->id_user?>">Perfil</button>
                      <?php if($this->session->userdata('autoridade') > $user->autoridade_user and $this->session->userdata('autoridade') > 1): ?>
                    <button type="button" class="btn btn-warning buttonNivel" data-toggle="modal" data-target="#nivelControlModal" data-id="<?=$user->id_user?>">Controle de Nível</button>
                      <?php endif; ?>
                      <?php if($this->session->userdata('autoridade') > $user->autoridade_user and $this->session->userdata('autoridade') > 1): ?>
                    <button type="button" class="btn btn-danger buttonFire" data-toggle="modal" data-target="#fireBallModal" data-id="<?=$user->id_user?>">Fire Ball</button>
                      <?php endif; ?>    
                  </th>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>

    <!-- Fim col-md-12 col-sm-12 -->
    </div>
    <!-- Fim da ROW  -->
</div>

<?php $this->load->view('modals/modalFireUser')?>
<?php $this->load->view('modals/modalNivelUser')?>
<?php $this->load->view('modals/modalPerfilUser')?>
<?php $this->load->view('commons/footer')?>


<!-- Scripts especificos da página -->
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/dataTables.bootstrap4.min.js');?>"></script>
<script>
$(function(){
  $('#datatable').DataTable({
      "order": [],
    //Seta as propriedades de inicialização das colunas.
      "columnDefs": [
        {
          "targets": [-1], //a última coluna
          "orderable": false, //não será ordenável
        },
      ],
  });

  $('.buttonPerfil').on('click', function(e){
    var id = $(this).data('id');
      var mana = ['aprendiz', 'mestre', 'archmago', 'merlin'];

      $.ajax({
        url: "<?= site_url('User/ajax_getUser/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data){
          var nivel = $('<small>').text(" Nível: " + mana[data.autoridade_user]);
          var nome = $('<h3>').attr('class', 'media-heading').text(data.nome_user).append(nivel);
          $('#perfilInfo').text(data.descricao_user).prepend(nome);  
          $('#perfilImagem').attr('src', "<?=base_url('img/user/com/')?>" + data.img_user);
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Erro ao recuperar dados por ajax');
        }
      });
  });

  $('.buttonNivel').on('click', function(e){
    var id = $(this).data('id');
      $.ajax({
        url: "<?= site_url('User/ajax_getUser/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data){
          $('#titleModalNivel').text('Selecione se ' + data.nome_user + ' irá subir ou descer de nível');
            $('#inputNivel').val(data.id_user);
          $('#inputNivelAutoridade').val(data.autoridade_user);
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Erro ao recuperar dados por ajax');
        }
      });
  });

  $('.buttonFire').on('click', function(e){
   var id = $(this).data('id');
      $.ajax({
        url: "<?= site_url('User/ajax_getUser/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data){
          $('#titleModalFire').text('Tem certeza que quer lançar uma Fire Ball em ' + data.nome_user + '? Isso pode ter consequencias!!!');
          $('#inputFire').val(data.id_user);
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Erro ao recuperar dados por ajax');
        }
      });
  });

});
</script>

</body>
</html>