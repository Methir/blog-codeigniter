<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model{

  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

//--------------------------------------Funções para upload de imagens na postagem ------------------------
public function uploadPostFile($inputFileName){
  $this->load->library('upload');
  $this->load->library('image_lib');
//Configura o upload da imagem
  $path = './img/post';
    $config['upload_path'] = $path;
      $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 4096;
      $config['max_width'] =  4096;
    $config['max_height'] =  2048;
  $config['file_name'] = random_string('alnum', 6); 
//verifica se o arquivo existe
    if(!is_dir($path))
      mkdir($path, 0777, $recursive = true);
//Inicializa a configuração
        $this->upload->initialize($config);
//Verifica o Upload
        if (!$this->upload->do_upload($inputFileName)) {
//Se tiver problemas seta error como verdadeiro e adiciona mensagem de erro
          $data['error'] = true;
          $data['message'] = $this->upload->display_errors();
        }else{
//Se não seta erro como falso e configura o redimencionamento
          $data['error'] = false;
            $data['fileData'] = $this->upload->data();
              $configResize['source_image'] = $data['fileData']['full_path'];
                $configResize['new_image'] = './img/post';
              $configResize['width'] = 900;
            $configResize['height'] = 300; 
//Passa as configurações para a função de redicimencionamento
          $resize = $this->genResize($configResize);       
//Verifica o status de retorno do redimencionamento
        if(!$resize['status']){
//Se estiver incorreto seta error como verdadeiro e adiciona mensagem de erro
          $data['error'] = true;
            $data['message'] = "Não foi possivel gerar o redimencionamento da imagem pois: ";
          $data['message'] .= $resize['message'];
        }
      }
//Retorna das informações em data
  return $data;
}

public function uploadUserFile($inputFileName){
  $this->load->library('upload');
    $this->load->library('image_lib');
      $path = './img/user/';
    $nomeImg = $this->session->userdata('imagem');

      if($nomeImg != "default.png"){
        if(!unlink($path . $nomeImg) or !unlink($path . "com/" . $nomeImg)){        
          $data['statusDefault'] = false;
          $data['fileData']['file_name'] = "default.png"; 
        }else{
          $data['statusDefault'] = true;
        } 
      }else{
        $data['statusDefault'] = true;
      }

    if(!$data['statusDefault']){
      $data['error'] = true;
      $data['message'] = "Achei a mensagem anterior tão bonita que nem consegui apagar, me deixe admira-la mais um pouco e tente novamente mais tarde!";
    }else{
      $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = 4096;
              $config['max_width'] =  4096;
            $config['max_height'] =  2048;
          $config['file_name'] = random_string('alnum', 6);

        if(!is_dir($path))
          mkdir($path, 0777, $recursive = true);

            $this->upload->initialize($config);

              if(!$this->upload->do_upload($inputFileName)){
                $data['error'] = true;
                  $data['message'] = $this->upload->display_errors();
                $data['fileData']['file_name'] = "default.png"; 
              }else{
                $data['error'] = false;
                  $data['fileData'] = $this->upload->data();
                    $configResize['source_image'] = $data['fileData']['full_path'];
                      $configResize['new_image'] = './img/user/com/';
                    $configResize['width'] = 120;
                  $configResize['height'] = 120; 
                $resizeCom = $this->genResize($configResize);       

                  if(!$resizeCom['status']){
                    $data['error'] = true;
                        $data['message'] = "Não foi possivel gerar o redimencionamento da imagem para os comentário pois: ";
                      $data['message'] .= $resizeCom['message'];
                    $data['fileData']['file_name'] = "default.png";
                  }else{
                    $configResize['new_image'] = './img/user/';
                      $configResize['width'] = 140;
                        $configResize['height'] = 140; 
                      $resizeUser = $this->genResize($configResize);       

                    if(!$resizeUser['status']){
                      $data['error'] = true;
                        $data['message'] = "Não foi possivel gerar o redimencionamento da imagem para o perfil pois: ";
                          $data['message'] .= $resizeUser['message'];
                        $data['fileData']['file_name'] = "default.png";
                    }else{
                      $data['error']=false;
                    }
                  }
              }
    }
  return $data;
}

private function genResize($config){
//Acrescenta o restante das configurações
  $config['maintain_ratio'] = false;
    $config['image_library'] = 'gd2';
      $config['create_thumb'] = false;
//Inicializa as configurações de redimencionamento
        $this->image_lib->initialize($config);
//Redimenciona e verifica o status 
      if (!$this->image_lib->resize()) {
//Se tiver error status vai ser false e setar mensagens de erro
        $data['status'] = false;
        $data['message'] = $this->image_lib->display_errors();
      }else{
//Se estiver tudo ok, status vai ser true e mensagem vai ser null
        $data['status'] = true;
        $data['message'] =  NULL;
      }
//Limba a imagem do cache !Importante sempre fazer depois de um processo de redimencionamento
    $this->image_lib->clear();
//Retorna as informações em data
  return $data;
}


}
