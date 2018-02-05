<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  function __construct(){
    parent::__construct();
        $this->load->model('User_model');
          $this->load->helper('string');
        $this->load->library('form_validation');
      $this->load->library('user_agent');
    if($this->agent->is_robot()){
      redirect();
    }
  }
//----------------------------------------------login------------------------------------------------------
  public function login(){
  //Seta regras de validação
    $this->form_validation->set_rules('login_user','Usuario','required|min_length[3]|max_length[10]|trim');
      $this->form_validation->set_rules('senha_user','Senha','required|min_length[6]|max_length[12]|trim');
  //Valida as entradas do formulario
        if($this->form_validation->run() == FALSE){
  //Se estiverem erradas, seta mensagem de erro e encerra o código
          $data['formErrors'] = validation_errors();
        }else{
  //Se não, captura dados do formulario e da o login
          $dataLogin = $this->input->post();
            $dataLogin = $this->security->xss_clean($dataLogin);
            $dataLogin = html_escape($dataLogin);
          $res = $this->User_model->login($dataLogin);
  //Verifica se o resultado da busca existe 
            if($res){
  //Se existir verifica a senha da pessoa
              foreach($res as $result){
                if (password_verify($dataLogin['senha_user'], $result->senha_user)){
  //Se a senha estiver correta, seta as informações dela e manda para a pagina principal
                  $data['formErrors'] = null;
                    $this->session->set_userdata('logged',true);
                      $this->session->set_userdata('nome',$result->nome_user);
                        $this->session->set_userdata('id',$result->id_user);
                          $this->session->set_userdata('autoridade',$result->autoridade_user);
                        $this->session->set_userdata('imagem',$result->img_user);
                      $this->session->set_userdata('descricao', $result->descricao_user);
                    $this->session->set_userdata('email', $result->email_user);
                  redirect();
                }else{
  //Se a senha estiver errada, seta mensagem de erro como senha incorreta
                 $data['formErrors'] = "Senha incorreta.";
                }
              }
            }else{
  //Se não existir seta a mensagem de erro como usuario não cadastrado
              $data['formErrors'] = "Usuário não cadastrado.";
            }
        }
    $this->load->view('login',$data);
  }
//----------------------------------------------register---------------------------------------------------
  public function register(){
    $this->form_validation->set_rules('email_user','Email','required|trim|valid_email');
    $this->form_validation->set_rules('nome_user','Nome','required|min_length[3]|trim');
      $this->form_validation->set_rules('login_user','Usuario','required|min_length[3]|max_length[10]|trim');
        $this->form_validation->set_rules('senha_user','Senha','required|min_length[6]|max_length[12]|trim');
          if($this->form_validation->run() == FALSE)
          {
            $data['formErrors'] = validation_errors();
          }else{
            $info = $this->input->post();
              $info = $this->security->xss_clean($info);
              $info = html_escape($info);
            $res = $this->User_model->saveUser($info);

              if($res['error']){
                $data['formErrors'] = $res['info'];   
              }else{
                $data['formErrors'] = null;
              }
          }

      if($data['formErrors']){
        $this->load->view('login',$data);
      }else{
        $this->session->set_userdata('logged',true);
          $this->session->set_userdata('nome',$res['info']->nome_user);
              $this->session->set_userdata('id',$res['info']->id_user);
            $this->session->set_userdata('autoridade',$res['info']->autoridade_user);
          $this->session->set_userdata('imagem',$res['info']->img_user);
        redirect();
      }
  }
//----------------------------------------------updatePass-------------------------------------------------
  public function updatePass(){
    if(!$this->session->userdata('logged'))
      redirect();
      
    $data['formErrors'] = NULL;
      $this->form_validation->set_rules('id_user', 'Usuario', 'required|trim');
      $this->form_validation->set_rules('senha_user', 'Senha', 'required|min_length[6]|max_length[12]|trim');
      $this->form_validation->set_rules('senha_check', 'Confirmar Senha', 'required|min_length[6]|max_length[12]|trim');

        if($this->form_validation->run() == false){
            $data['formErrors'] = validation_errors();
        }else{
          $data = $this->input->post();
              $data = $this->security->xss_clean($data);
              $data = html_escape($data);
          if($data['senha_user'] == $data['senha_check']){
            $this->User_model->UpdatePass($data['senha_user'], $data['id_user']);
              $this->session->set_flashdata('success_msg','Senha trocada com sucesso!');
            $data['formErrors'] = NULL;
          }else{
            $data['formErrors'] = "As senhas digitadas são diferentes.";
          }
        }

    $this->load->view('perfil',$data);
  }
//----------------------------------------------updateEmail------------------------------------------------
  public function updateEmail(){
    if(!$this->session->userdata('logged'))
      redirect();   
         
      $data['formErrors'] = NULL;

      $this->form_validation->set_rules('email_user', 'Email', 'required|valid_email|trim');
      $this->form_validation->set_rules('senha_user', 'Senha', 'required|min_length[6]|max_length[12]|trim');

      if($this->form_validation->run() == false){
            $data['formErrors'] = validation_errors();
        }else{
          $data = $this->input->post();
            if($mensagem = $this->User_model->checkPassword($data)){
              $data['formErrors'] = $mensagem;
            }else{
              $this->User_model->updateEmail($data['email_user']);
                $this->session->set_flashdata('success_msg','Email trocada com sucesso!');
                  $this->session->set_userdata('email', $data['email_user']);
              $data['formErrors'] = NULL;
            }
        }

    $this->load->view('perfil', $data);
  }
//----------------------------------------------imgPerfil--------------------------------------------------
  public function imgPerfil(){
    if(!$this->session->userdata('logged'))
      redirect();

      $this->load->model('Image_model');
    $data['formErrors'] = NULL;
      $uploadImg = $this->Image_model->uploadUserFile('imagem');

        if($uploadImg['error']){
          $data['formErrors'] = $uploadImg['message'];
        }
          $formData['img_user'] = $uploadImg['fileData']['file_name'];
            $formData['img_com'] = $uploadImg['fileData']['file_name'];

          $data['formErrors'] = $this->User_model->saveImg($formData,$data['formErrors']);
    $this->load->view('perfil', $data);
  }
//----------------------------------------------user_descricao---------------------------------------------
  public function user_descricao(){
    if(!$this->session->userdata('logged'))
      redirect();

        $data['formErrors'] = NULL;
          $this->form_validation->set_rules('id_user','Usuario','required|trim');
          $this->form_validation->set_rules('descricao_user','Descrição','required|max_length[250]|trim');
            if($this->form_validation->run() == FALSE){
              $data['formErrors'] = validation_errors();
            }else{
              $data = $this->input->post();
                $data = $this->security->xss_clean($data);
                  $data = html_escape($data);
                    $this->User_model->updateDescricao($data);
                  $this->session->set_flashdata('success_msg','Descrição trocada com sucesso!');
                $this->session->set_userdata('descricao', $data['descricao_user']);
              $data['formErrors'] = NULL;     
            }

    $this->load->view('perfil', $data);
  } 
//----------------------------------------------control----------------------------------------------------
  public function control(){
    if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 2)
      redirect();

        $data['formErrors'] = Null;
      $data['usuarios'] = $this->User_model->getAllUsers();
    $this->load->view('control-painel', $data);
  }
//----------------------------------------------fireball---------------------------------------------------
  public function fireball(){
    if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 2)
      redirect();

      $data['formErrors'] = Null;
         $this->form_validation->set_rules('id_user','User','required|trim');

            if($this->form_validation->run() == FALSE){
              $data['formErrors'] = validation_errors();
            }else{
              $info = $this->input->post();
              if($this->User_model->deleteUser($info['id_user'])){
              	$this->session->set_flashdata('success_msg','Sua Fire Ball foi 100% eficiente! Melhor assim para não deixar inimigos');
              }else{
              	$data['formErrors'] = "Não foi possivel apagar esse usuário por algum problema em sua imagem de perfil!";
              }		
            }

          $data['usuarios'] = $this->User_model->getAllUsers();
        $this->load->view('control-painel', $data);   
  }
//----------------------------------------------nivelControl-----------------------------------------------
  public function nivelControl(){
    if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 2)
      redirect();

      $data['formErrors'] = Null;
         $this->form_validation->set_rules('id_user','User','required|trim');
          $this->form_validation->set_rules('level','level','required|trim');
            $this->form_validation->set_rules('autoridade_user','Nivel de acesso','required|trim');

          if($this->form_validation->run() == FALSE){
            $data['formErrors'] = validation_errors();
          }else{
            $info = $this->input->post();  

              if($info['autoridade_user'] == 0 and $info['level'] == 'down'){
                  $data['formErrors'] = "Você não pode afundar, quem já está no fundo do poço";
              }elseif($info['autoridade_user'] == 2 and $info['level'] == 'up') {
                $data['formErrors'] = "Só pode haver um grande mestre, é você ou ele!";
              }else{
                $this->User_model->changeUserNivel($info);
              } 
          }          
        $data['usuarios'] = $this->User_model->getAllUsers();
      $this->load->view('control-painel', $data);   
  }
//----------------------------------------------faleConosco------------------------------------------------  
  public function faleConosco(){
    if(!$this->session->userdata('logged'))
      redirect();

    $data['formErrors'] = Null;
      $this->form_validation->set_rules('assunto_email','Assunto','required|trim|min_length[5]');
        $this->form_validation->set_rules('texto_email','Texto','required|trim|max_length[500]');
          $this->form_validation->set_rules('nome_email','Autor','required|trim|max_length[30]');
            $this->form_validation->set_rules('endereco_email','Autor','required|trim|valid_email');
            
            if($this->form_validation->run() == FALSE){
              $data['formErrors'] = validation_errors();
            }else{
              $data = $this->input->post();
                $data = $this->security->xss_clean($data);
                $data = html_escape($data);
              $emailStatus = $this->SendEmailToAdmin($data['endereco_email'],$data['nome_email'],"gabriel.nascimento@sipam.gov.br","Gabriel", 
                $data['assunto_email'], $data['texto_email'],$data['endereco_email'],$data['nome_email']);
                if($emailStatus){
                  $this->session->set_flashdata('success_msg','Email recebido com sucesso!');
                  $data['formErrors'] = Null;
                }else{
                  $data['formErrors'] = "Desculpe! Não foi possível enviar o seu email.";
                }
            }  
    $this->load->view('fale-conosco', $data);
  }
//----------------------------------------------ajax_getUser----------------------------------------------- 
  public function ajax_getUser($id){
      $data = $this->User_model->getUser($id);
    echo json_encode($data);
  }  
//----------------------------------------------logout-----------------------------------------------------
  public function logout(){
    $this->session->unset_userdata('logged');
      $this->session->unset_userdata('nome');
          $this->session->unset_userdata('id');
        $this->session->unset_userdata('autoridade');
      $this->session->unset_userdata('imagem');
    redirect();
  }
//----------------------------------------------SendEmailToAdmin-------------------------------------------
  private function SendEmailToAdmin($from, $fromName, $to, $toName,
    $subject, $message, $reply, $replyName){
    
    $this->load->library('email');

      $config['charset'] = 'utf-8';
      $config['wordwrap'] = TRUE;
      $config['mailtype'] = 'html';
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'smtp.sipam.gov.br';
      $config['smtp_user'] = 'gabriel.nascimento';
      $config['smtp_pass'] = '@Sp101701c';
      $config['newline'] = '\r\n';

    $this->email->initialize($config);
    $this->email->from($from, $fromName); 
    $this->email->to($to, $toName);
    $this->email->cc($from);
    $this->email->reply_to($reply, $replyName);
    

    $this->email->subject($subject);
    $this->email->message($message);

      if($this->email->send()){
        return true;
      }else{
        return false;
      }
  }
//----------------------------------------------esqueceu_senha---------------------------------------------
  public function esqueceu_senha(){
    $data['formErrors'] = Null;
      $this->form_validation->set_rules('email_user','Email','required|trim|valid_email');
        if($this->form_validation->run() == FALSE){
          $data['formErrors'] = validation_errors();
        }else{
          $data = $this->input->post();
            $data = $this->security->xss_clean($data);
            $data = html_escape($data);
          $res = $this->User_model->pegarSenha($data['email_user']);

          if($res['error']){
            $data['formErrors'] = $res['info'];
          }else{
            $data['formErrors'] = Null;
              $emailStatus = $this->SendEmailToAdmin("gabriel.nascimento@sipam.gov.br","Gabriel",$data['email_user'],"Usuário", 
              "Esqueci minha senha", 'Troque sua senha clicando <a href="' . base_url('change-senha/') . $res['info']->id_user .'/'.  
              $res['info']->login_user .'"> aqui </a>', $data['email_user'], "Usuário");

            if($emailStatus){
              $this->session->set_flashdata('success_msg','Email recebido com sucesso!');
              $data['formErrors'] = Null;
            }else{
              $data['formErrors'] = "Desculpe! Não foi possível enviar o seu email.";
            }
          }
        }

    $this->load->view('login',$data);
  }
//----------------------------------------------change_senha-----------------------------------------------
  public function change_senha(){
        $data['formErrors'] = Null;
          $data['id'] = $this->uri->segment(2);
            $data['nome'] = $this->uri->segment(3);
              $this->form_validation->set_rules('id_user', 'Usuario', 'required|trim');
            $this->form_validation->set_rules('senha_user', 'Senha', 'required|min_length[6]|max_length[12]|trim');
          $this->form_validation->set_rules('senha_check', 'Confirmar Senha', 'required|min_length[6]|max_length[12]|trim');

        if($this->form_validation->run() == false){
            $data['formErrors'] = validation_errors();
        }else{
          $data = $this->input->post();
            $data['formErrors'] = Null;
              $data['id'] = $this->uri->segment(2);
                $data['nome'] = $this->uri->segment(3);
              $data = $this->security->xss_clean($data);
            $data = html_escape($data);
          if(!$this->User_model->checkInvasion($data['id'], $data['nome'])){
            $data['formErrors'] = "Aviso de tentativa de troca de senha maliciosa!";

          }else{

            if($data['senha_user'] == $data['senha_check']){
              $this->User_model->UpdatePass($data['senha_user'], $data['id_user']);
                $this->session->set_flashdata('success_msg','Senha trocada com sucesso!');
              $data['formErrors'] = NULL;
            }else{
            $data['formErrors'] = "As senhas digitadas são diferentes.";
            }
          }
        }

    $this->load->view('modals/changeSenha', $data);
  }

}