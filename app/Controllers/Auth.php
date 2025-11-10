<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLogged')) {
            return redirect()->to(site_url('/clientes'));
        }
        return view('auth.login');
    }

    public function login() {
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $model = new UsuarioModel();
        $usuario = $model->where('email', $email)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            //Cria sessão
            $sessionData = [
                'id'        => $usuario['id'],
                'email'     => $usuario['email'],
                'isLogged'=> TRUE
            ];
            session()->set($sessionData);

            //Retorna sucesso para o AJAX
            return $this->response->setJSON(['success' => true]);
        } else {
            //Retorna erro para o AJAX
            return $this->response->setJSON(['success' => false, 'error' => 'Email ou senha inválidos.']);
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
