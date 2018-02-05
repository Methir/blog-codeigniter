<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model{

  function __construct(){
    parent::__construct();
    $this->load->database();
  }
//--------------------------------------getAllPost---------------------------------------------------------
  public function getAllPost($limit, $offset){
      $this->db->order_by("data_post","desc");
        $this->db->limit($limit,$offset);
      $data['postagens'] = $this->db->get('postagens')->result();
    return $data['postagens'];
  }
//--------------------------------------getPostByAutor-----------------------------------------------------
  public function getPostByAutor($autor, $limit, $offset){
    $this->db->where('autor_post',$autor);
      $this->db->order_by("data_post","desc");
        $this->db->limit($limit,$offset);
      $data['postagens'] = $this->db->get('postagens')->result();
    return $data['postagens'];
  }
//--------------------------------------getPostByCategoria-------------------------------------------------
  public function getPostByCategoria($categoria, $limit, $offset){
    $this->db->where('categoria_post',$categoria);
      $this->db->order_by("data_post","desc");
        $this->db->limit($limit,$offset);
      $data['postagens'] = $this->db->get('postagens')->result();
    return $data['postagens'];
  } 
//--------------------------------------getPostByBusca-----------------------------------------------------
  public function getPostByBusca($busca, $limit, $offset){
      $this->db->like('titulo_post', $busca);
        $this->db->or_like('autor_post', $busca);
          $this->db->order_by('data_post', 'desc');
        $this->db->limit($limit,$offset);
      $data['postagens'] = $this->db->get('postagens')->result();
    return $data['postagens'];
  }
//--------------------------------------saveComment--------------------------------------------------------
  public function saveComment($formData){
    if($this->db->insert('comentarios',$formData)){
      $this->session->set_flashdata('success_msg','Postagem realizada com sucesso!');
      $data['formErrors'] = NULL;
    }else{
      $data['formErrors'] = "Desculpe! Não foi possível enviar sua postagem. Tente novamente mais tarde.";
    }
  return $data['formErrors'];
}
//--------------------------------------getPost------------------------------------------------------------
  public function getPost($id){
    $this->db->where('id_post',$id);
      $data['postagem'] = $this->db->get('postagens')->result();
    return $data['postagem'];
  }
//--------------------------------------getComment---------------------------------------------------------
  public function getComment($id){
    $this->db->where('id_post',$id);
        $this->db->order_by("data_com","desc");
      $data['comentarios'] = $this->db->get('comentarios')->result();
    return $data['comentarios'];
  }
//--------------------------------------editarPost---------------------------------------------------------
  public function editarPost($id,$texto){
    $this->db->where('id_post', $id); 
     $this->db->update('postagens', array('texto_post' => $texto));
    return true;
  }
//--------------------------------------deletePost---------------------------------------------------------
  public function deletePost($id, $nomeImg){
     $path = './img/post/';
    if(!unlink($path . $nomeImg)){
      return false;
    }else{
    $this->db->where('id_post', $id); 
     $this->db->delete('comentarios');
      $this->db->where('id_post', $id);
    $this->db->delete('postagens');
    return true;
    }
  }
//--------------------------------------addPost------------------------------------------------------------
  public function addPost($formData){
    if($this->db->insert('postagens',$formData)){
      return true;
    }else{
      return false;
    }
  }  
//--------------------------------------Funções para upload de imagens na postagem ------------------------
public function uploadFile($inputFileName){
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
