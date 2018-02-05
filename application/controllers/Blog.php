<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

  function __construct(){
    parent::__construct();
    	$this->load->model('Blog_model');
    		$this->load->helper('string');
    	$this->load->library('form_validation');
    	$this->load->library('user_agent');
    if($this->agent->is_robot()){
      redirect();
    }
  }
//-------------------------------------------------Index---------------------------------------------------
	public function Index(){
		$this->load->library('pagination');
			$this->load->helper('blog');
				$config['base_url'] = base_url('home');
						$config['total_rows'] = $this->db->select('*')->from('postagens')->count_all_results();
							$config['uri_segment'] = 2;
									$config = paginationConfig($config); 
								$this->pagination->initialize($config);
						$limit = $config['per_page'];

					if($this->uri->segment(2))
						$offset	= ($this->uri->segment(2) - 1) * $limit;
					else
						$offset	= 0;

				$data['postagens'] = $this->Blog_model->getAllPost($limit, $offset);
			$data['pagination'] = $this->pagination->create_links();
	    $this->load->view('home', $data);
	}
//-------------------------------------------------post_autor----------------------------------------------
	public function post_autor(){
		if(!$this->uri->segment(2)){
		 	redirect();
		}else{	
		 	$autor=$this->uri->segment(2);
				  	$this->load->library('pagination');
						$this->load->helper('blog');
		  			
							$config['base_url'] = base_url('autor/') . $autor;
								$autor = str_replace("-", " ", $autor);
									$autor = $this->security->xss_clean($autor);
										$autor = html_escape($autor);
											$config['total_rows'] = $this->db->select('*')->from('postagens')->where('autor_post', $autor)->count_all_results();
										$config['uri_segment'] = 3;
									$config = paginationConfig($config); 
								$this->pagination->initialize($config);
							$limit = $config['per_page'];

					if($this->uri->segment(3))
						$offset	= ($this->uri->segment(3) - 1) * $limit;
					else
						$offset	= 0;

		  	$data['postagens'] = $this->Blog_model->getPostByAutor($autor, $limit, $offset);
		}
			if(!$data['postagens'])
				redirect();

			$data['pagination'] = $this->pagination->create_links();

		$this->load->view('home', $data);
	}
//-------------------------------------------------post_categoria------------------------------------------
	public function post_categoria(){
			if(!$this->uri->segment(2)){
				redirect();
			}else{
				$categoria = $this->uri->segment(2);
				$categoria = $this->security->xss_clean($categoria);
				$categoria = html_escape($categoria);
					$this->load->library('pagination');
						$this->load->helper('blog');
							$config['base_url'] = base_url('categoria/') . $categoria;
						$config['total_rows'] = $this->db->select('*')->from('postagens')->where('categoria_post', $categoria)->count_all_results();
					$config['uri_segment'] = 3;
				$config = paginationConfig($config);
					$this->pagination->initialize($config);
						$limit = $config['per_page'];
				
					if($this->uri->segment(3))
						$offset = ($this->uri->segment(3) - 1) * $limit;
					else
						$offset = 0;

				$data['postagens'] = $this->Blog_model->getPostByCategoria($categoria, $limit, $offset);			
			}
				if(!$data['postagens'])
					redirect();

			$data['pagination'] = $this->pagination->create_links();
		$this->load->view('home', $data);
	}	
//-------------------------------------------------post_busca----------------------------------------------
	public function post_busca(){
		if($this->input->get('busca')){
			$busca = $this->input->get('busca');
		}elseif($this->uri->segment(2)){
			$busca = $this->uri->segment(2);
		}
			
			if(!$busca){
				redirect();
			}else{
				$busca = $this->security->xss_clean($busca);
					$busca = html_escape($busca);
						$this->load->library('pagination');
							$this->load->helper('blog');
								$config['base_url'] = base_url('busca/') . $busca;
									$config['total_rows'] = $this->db->select('*')->from('postagens')->like('titulo_post', $busca)->or_like('autor_post', $busca)->count_all_results();
								$config['uri_segment'] = 3;
							$config = paginationConfig($config);
						$this->pagination->initialize($config);
					$limit = $config['per_page'];		
					
					if($this->uri->segment(3))
						$offset = ($this->uri->segment(3) - 1) * $limit;
					else
						$offset = 0;

				$data['postagens'] = $this->Blog_model->getPostByBusca($busca, $limit, $offset);
			}

			//if(!$data['postagens'])
			//	redirect();
			$data['pagination'] = $this->pagination->create_links();
		$this->load->view('home', $data);
	}
//-------------------------------------------------post_id-------------------------------------------------	
	public function post_id($id){
		$data['formErrors']	= null;

			$this->form_validation->set_rules('autor_com','Autor','trim|required|max_length[30]');
				$this->form_validation->set_rules('texto_com','Texto','trim|required|min_length[6]');
					$this->form_validation->set_rules('id_post','Post','trim|required');
						$this->form_validation->set_rules('id_user','User','trim|required');
							$this->form_validation->set_rules('img_com','Imagem','trim|required');

							if($this->form_validation->run() == FALSE){
								$data['formErrors']	= validation_errors();
							}else{
								$formData =	$this->input->post(null, true);	
									$formData = $this->security->xss_clean($formData);
									$formData = html_escape($formData);
								$data['formErrors']	= $this->Blog_model->saveComment($formData);	
							}
						$data['postagem'] = $this->Blog_model->getPost($id);
	 				$data['comentarios'] = $this->Blog_model->getComment($id);
				if(!$data['postagem'])
					redirect();

		$this->load->view('post', $data);
	}
//-------------------------------------------------add_post------------------------------------------------
	public function add_post(){
		if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 1)
	        redirect();

	    	$this->load->model('Image_model');
				$data['formErrors']	= null;
					$this->form_validation->set_rules('titulo_post','Titulo','trim|required|min_length[5]');
				$this->form_validation->set_rules('autor_post','Autor','trim|required|max_length[30]');
			$this->form_validation->set_rules('texto_post','Texto','trim|required|min_length[30]');

		if($this->form_validation->run() == FALSE){
			$data['formErrors']	= validation_errors();
		}else{	
			$uploadImg = $this->Image_model->uploadPostFile('imagem');

			if($uploadImg['error']){
				$data['formErrors'] = $uploadImg['message'];
			}else{
				$formData =	$this->input->post();	
				$formData['img_post'] = $uploadImg['fileData']['file_name'];
				$formData['id_user'] = $this->session->userdata('id');
					$status = $this->Blog_model->addPost($formData);

					if($status){
						$this->session->set_flashdata('success_msg','Postagem realizada com sucesso!');
					}else{
						$data['formErrors']	= "Desculpe! Não foi possível enviar sua postagem. Tente novamente mais tarde.";
					}
			}
		}
		$this->load->view('new-post', $data);
	}
//-------------------------------------------------editar_post---------------------------------------------
	public function editar_post(){
		if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 1){
			redirect();
		}
		$data['formErrors'] = Null;
			$info = $this->input->post();
				$this->form_validation->set_rules('id_post','Postagem','required|trim');
					$this->form_validation->set_rules('texto_post','Texto','trim|required|min_length[30]');
						if($this->form_validation->run() == FALSE){
						   	$data['formErrors'] = validation_errors();
						}else{
						    $this->Blog_model->editarPost($info['id_post'],$info['texto_post']);
							$this->session->set_flashdata('success_msg','Postagem editada com sucesso!');
						}	
					$data['postagem'] = $this->Blog_model->getPost($info['id_post']);
	 			$data['comentarios'] = $this->Blog_model->getComment($info['id_post']);
			if(!$data['postagem'])
				redirect();

		$this->load->view('post', $data);
	}
//-------------------------------------------------delete_post---------------------------------------------
	public function delete_post(){
		if(!$this->session->userdata('logged') or $this->session->userdata('autoridade') < 1){
			redirect();
		}
	    $this->form_validation->set_rules('id_post','Postagem','required|trim');
		$this->form_validation->set_rules('img_post','Imagem','required|trim');
	       	if($this->form_validation->run() == FALSE){
	           	$this->session->set_flashdata('fail_msg', validation_errors());
          	}else{
            	$info = $this->input->post();
	            
	            if($this->Blog_model->deletePost($info['id_post'],$info['img_post'])){
	            	$this->session->set_flashdata('success_msg','Sua Fire Ball foi 100% eficiente! Melhor assim para não deixar inimigos');
	            }else{
	            	$this->session->set_flashdata('fail_msg','Não foi possivel apagar a imagem da sua postagem no servidor');
	            }
	        }
	    redirect();  
	}

}