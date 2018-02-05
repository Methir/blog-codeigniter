<?php $this->load->view('commons/header')?>

<!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- Blog Post -->
                <!-- Title -->
                <h1><?= $postagem[0]->titulo_post; ?></h1>
                <!-- Author -->
                <p class="lead">
                    by <a href="<?=base_url('autor/') . url_title($postagem[0]->autor_post); ?>"><?= $postagem[0]->autor_post; ?></a>
                </p>
                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $postagem[0]->data_post; ?></p>
<?php if($this->session->userdata('id') == $postagem[0]->id_user or $this->session->userdata('autoridade') > 1): ?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#textEditModal">Editar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#fireBallModal")>Fire Ball</button>
<?php endif;?>
                <hr>
                <!-- Preview Image -->
                <img class="img-responsive" src="<?=base_url('img/post/') . $postagem[0]->img_post; ?>" alt="">
                <hr>
                <!-- Post Content -->
                <p class="lead"><?= nl2br($postagem[0]->texto_post); ?></p>


                <hr id="aviso">
                <hr>
                <!-- Blog Comments -->
                <?php if($formErrors): ?>
                   <div class="alert alert-danger">
                        <?= $formErrors ?>
                 </div>
                <?php else:
                if($this->session->flashdata('success_msg')) : ?>
                    <div class="alert alert-success">
                        <?=$this->session->flashdata('success_msg')?>
                    </div>

                <?php endif; endif; ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="POST" action="<?= base_url('post/') . $postagem[0]->id_post; ?>">
                        <input type="hidden" name="img_com" value="<?= $this->session->userdata('imagem'); ?>">
                            <input type="hidden" name="autor_com" value="<?= $this->session->userdata('nome'); ?>">
                                <input type="hidden" name="id_post" value="<?= $postagem[0]->id_post; ?>">
                            <input type="hidden" name="id_user" value="<?=$this->session->userdata('id'); ?>">

                        <div class="form-group">
                            <textarea class="form-control" name="texto_com" rows="3"></textarea>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-primary" <?= ($this->session->userdata('logged')) ? NULL : "disabled" ?> />
                        <a href="<?= base_url('login') ?>"><?= ($this->session->userdata('logged')) ? NULL : "Precisa estar logado para comentar" ?></a>
                    </form>
                </div>
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div style="max-height: 600px; overflow-y: scroll;">
                <?php foreach($comentarios as $comentario): ?>
                    <div class="media">
                        <a class="pull-left buttonPerfil" data-toggle="modal" data-target="#perfilModal" data-id="<?=$comentario->id_user?>">
                            <img class="media-object" src="<?=base_url('img/user/com/') . $comentario->img_com ?>" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"> 
                                <a class="buttonPerfil" data-toggle="modal" data-target="#perfilModal" data-id="<?=$comentario->id_user?>"><?=$comentario->autor_com;?></a>
                                <small><?=$comentario->data_com;?></small>
                            </h4>
                            <?= $comentario->texto_com; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
                <!-- End Comment -->
            </div>
<?php $this->load->view('modals/modalPerfilUser')?>
<?php $this->load->view('modals/modalFirePost')?>
<?php $this->load->view('modals/modalEditPost')?>
<?php $this->load->view('commons/sidebar')?>
<?php $this->load->view('commons/footer')?>

<!-- Scripts extras da pagina -->
<?php if($formErrors or $this->session->flashdata('success_msg')): ?>
    <script>
        window.location.href='#aviso';
    </script>
<?php endif; ?>
<script>
$(function(){
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
});
</script>

</body>
</html>