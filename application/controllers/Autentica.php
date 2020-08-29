<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentica extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //carrega model
        $this->load->model('model_usuario', true);
        //carrega url com helper
        $this->load->helper('url');
    }

    function index()
    {
        //carregar biblioteca
        $this->load->library('form_validation');
        //verificar se os campos obrigatórios estão preenchidos
        $this->form_validation->set_message('required', "Campo %s obrigatório");

        //validação dos campos (trim = reetira espaços em branco, callback_check_database = retorna verificação bd)
        $this->form_validation->set_rules('email', "E-mail", 'trim|required');
        $this->form_validation->set_rules('password', "Senha", 'trim|required|callback_check_database');

        //verifica se a validação deu certo se sim redireciona para o controller da home função dashboard
        if ($this->form_validation->run() == false) {
            $this->load->view('view_login');
        } else {
            redirect('home/dashboard', 'refresh');
        }
    }

    function check_database($senha)
    {

        $login = $this->input->post('email');
        //var_dump($login);
        //var_dump($senha);
        //carrega a model
        $this->load->model('Model_usuario');
        //faz a consulta no bd através da model
        $result = $this->Model_usuario->login($login, $senha);
        $usuarioid = "";
        $usuarionome = "";

        if ($result) {
            foreach ($result as $linha) {
                $dados['usuarioid'] = $linha->idUsuarios;
                $dados['usuarionome'] = $linha->nome;
            }
        }
    }
}
