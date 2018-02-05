<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

  function __construct(){
    parent::__construct();
    $this->load->database();
  }
//-------------------------------------------login---------------------------------------------------------
  public function login($data){
    $this->db->select('*')->from('usuarios')->where('login_user',$data['login_user']);
      $results = $this->db->get()->result();
    return $results;
  }
//-------------------------------------------deleteUser----------------------------------------------------
  public function deleteUser($id){
    $info = $this->db->select('img_user')->from('usuarios')->where('id_user', $id)->get()->result();

    $path = './img/user/';
      if($info[0]->img_user != "default.png"){
        if(!unlink($path . $info[0]->img_user) or !unlink($path . "com/" . $info[0]->img_user)){        
            $data['statusDefault'] = false;
          }else{
            $data['statusDefault'] = true;
          } 
      }else{
          $data['statusDefault'] = true;
      }
    if(!$data['statusDefault']){
      return false;
    }else{
      $this->db->where('id_user', $id); 
        $this->db->delete('comentarios');

            $this->db->select('id_post')->from('postagens')->where('id_user', $id);
              $where_clause = $this->db->get_compiled_select();

                $this->db->where("id_post IN ($where_clause)",NULL, false); 
              $this->db->delete('comentarios');
          

             $this->db->where('id_user', $id);
            $this->db->delete('postagens');

        $this->db->where('id_user', $id); 
      $this->db->delete('usuarios');
    }
    return true;
  }
//-------------------------------------------changeUserNivel-----------------------------------------------
  public function changeUserNivel($info){
    $this->db->where('id_user', $info['id_user']);

      if($info['level'] == 'up'){
        $info['autoridade_user'] = $info['autoridade_user']+1;
          $this->db->update('usuarios', array('autoridade_user' => $info['autoridade_user']));
        $this->session->set_flashdata('success_msg','Após anos de treinamento sobe sua supervisão, seu pupilo está dando o próximo passo. Cuidado para ele não lhe superar!');          
      }elseif($info['level'] == 'down'){
        $info['autoridade_user'] = $info['autoridade_user']-1;
          $this->db->update('usuarios', array('autoridade_user' => $info['autoridade_user'])); 
        $this->session->set_flashdata('success_msg','Um pupilo indisciplinado deve ser punido!');
      }else{
        return false;
      }
    return true;
  }
//-------------------------------------------saveUser------------------------------------------------------
  public function saveUser($data){
    $data['senha_user'] = password_hash($data['senha_user'], PASSWORD_DEFAULT);
    $this->db->where('nome_user',$data['nome_user']);
      $this->db->or_where('login_user', $data['login_user']);
      $this->db->or_where('email_user', $data['email_user']);
    $have = $this->db->get('usuarios')->result();

      if(!$have){
        $this->db->insert('usuarios',$data);
        $userID = $this->db->insert_id();
              
          if($userID){
            $data['error'] = false;
              $data['info'] = $this->getUser($userID);
            return $data;
          }else{
            $data['error'] = true;
              $data['info'] = "Não foi possivel cadastrar o usuário!";
            return $data;
          }
          }

        $data['error'] = true;
      $data['info'] = "Nome, Login ou Email já cadastrados!";
    return $data;
  }
//-------------------------------------------getUser-------------------------------------------------------
  public function getUser($id){
    $this->db->select('*')->from('usuarios')->where('id_user',$id);
    $result = $this->db->get()->result();

    if($result){
      return $result[0];
    }else{
      return false;
    }
  }
//-------------------------------------------saveImg-------------------------------------------------------
  public function saveImg($formData, $errorConfirm){
    $data['formErrors'] = $errorConfirm;
      $this->db->where('id_user', $this->session->userdata('id'));
        $checkImgUser = $this->db->update('usuarios',array('img_user' => $formData['img_user']));
          $this->db->where('id_user', $this->session->userdata('id'));
            $checkImgCom = $this->db->update('comentarios',array('img_com' => $formData['img_com']));

        
        if($checkImgUser and $checkImgCom){
          if(!$data['formErrors'])
            $this->session->set_flashdata('success_msg','Imagem trocada com sucesso!');

            $this->session->set_userdata('imagem',$formData['img_user']);
        }else{
          if(!$data['formErrors'])
            $data['formErrors'] = "Desculpe! Não foi possível enviar sua imagem, esse problema tem relação com nosso banco de dados. Tente novamente mais tarde.";
          }
    return $data['formErrors'];
  }
//-------------------------------------------getAllUsers---------------------------------------------------
  public function getAllUsers(){
    $this->db->where('id_user !=',$this->session->userdata('id'));
      $this->db->order_by("nome_user","ASC");
      $data['usuarios'] = $this->db->get('usuarios')->result();
    return $data['usuarios'];
  }
//-------------------------------------------UpdatePass----------------------------------------------------
  public function UpdatePass($data, $id){
    $data = password_hash($data, PASSWORD_DEFAULT);
      $this->db->where('id_user',  $id);
    if($this->db->update('usuarios', array('senha_user' => $data))){
       return true;
     }else{
      return false;
    }
  }
//-------------------------------------------updateEmail---------------------------------------------------
  public function updateEmail($email){
      $this->db->where('id_user',  $this->session->userdata('id'));
    if($this->db->update('usuarios', array('email_user' => $email))){
       return true;
     }else{
      return false;
    }
  }
//-------------------------------------------checkPassword-------------------------------------------------
  public function checkPassword($info){
      $have = $this->db->select('*')->from('usuarios')->where('email_user', $info['email_user'])->count_all_results();
      $data = $this->getUser($this->session->userdata('id'));
    if(!password_verify($info['senha_user'], $data->senha_user)){
      return "Senha não confere!";
    }elseif($have){
      return "Email já existente!";
    }else{
      return false;
    }
  }
//-------------------------------------------updateDescricao-----------------------------------------------
  public function updateDescricao($data){
    $this->db->where('id_user', $data['id_user']);
      if($this->db->update('usuarios', array('descricao_user' => $data['descricao_user']))){
         return true;
       }else{
        return false;
      }
  }
//-------------------------------------------pegarSenha----------------------------------------------------
  public function pegarSenha($email){
    $have = $this->db->select('*')->from('usuarios')->where('email_user', $email)->count_all_results();
      if(!$have){
        $data['error'] = true;
          $data['info'] = "Email não cadastrado"; 
        return $data;     
      }else{
        $this->db->select('*')->from('usuarios')->where('email_user',$email);
          $senha = $this->db->get()->result();
            $data['error'] = false;
          $data['info'] = $senha[0];
        return $data;
      }

  }
//-------------------------------------------checkInvasion-------------------------------------------------
  public function checkInvasion($id, $nome){
    $data = $this->getUser($id);
      if($nome == $data->login_user){
        return true;
      }else{
        return false;
      }
  }

}