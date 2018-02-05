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

}