<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ClienteModel;

class Clientes extends ResourceController
{
    protected $modelName = ClienteModel::class;
    protected $format = 'html';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index() //Retorna todos os clientes
    {
        $data['clientes'] = $this->model->findAll(); //Pega todos os clientes
        return view('clientes/index', $data); //Joga para uma view e mostra os clientes
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $cliente = $this->model->find($id);

        if (!$cliente) {
            return redirect()->to(site_url('clientes'))->with('error', 'Cliente não encontrado');
        }

        return view('clientes/detail', ['cliente' => $cliente]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new() //Cria um novo cliente (Formulário)
    {
        return view('clientes/new');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create() //Salva o cliente
    {
        $data = $this->request->getPost(); //Pega os dados do formulário

        if ($this->model->insert($data)){ //Tenta inserir o cliente, entra nas validações
            $imagem = $this->request->getFile('imagem'); //Upload da imagem

            if ($imagem->isValid() && !$imagem->hasMoved()) {
                $id = $this->model->getInsertID(); //Pega o id do cliente

                $novoNome = $imagem->getRandomName(); //Nome aleatório para imagem
                $imagem->move(ROOTPATH . 'public/uploads/clientes', $novoNome); //Move para a pasta de uploads

                $this->model->update($id, ['imagem' => 'uploads/clientes/' . $novoNome]); //Atualiza a imagem do cliente
            }
            return redirect()->to(site_url('clientes'))->with('message', 'Cliente criado com sucesso!'); //Redireciona para lista de clientes
        } else {
            return redirect()->back()->withInput()->with('errors', $this->model->errors());
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null) //Via modal
    {
        $cliente = $this->model->find($id);

        if (!$cliente) { //Verifica se o cliente existe
            return $this->failNotFound('Cliente não encontrado');
        }

        return view('clientes/edit', ['cliente' => $cliente]);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null) //Lógica de atualização
    {
        $data = $this->request->getPost(); //Pega os dados do formulário

        if ($this->model->update($id, $data)) {
            $imagem = $this->request->getFile('imagem');

            if ($imagem->isValid() && !$imagem->hasMoved()) {
                $novoNome = $imagem->getRandomName();
                $imagem->move(ROOTPATH . 'public/uploads/clientes', $novoNome);

                $this->model->update($id, ['imagem' => 'uploads/clientes/' . $novoNome]);
            }
            return $this->respond(['message' => 'Cliente editado com sucesso!'], 200);
        } else {
            return $this->failValidationError($this->model->errors());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null) //Deleta um cliente
    {
        if ($this->model->delete($id)) {
            return redirect()->to(site_url('clientes'))->with('message', 'Cliente excluído com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Erro ao excluir o cliente.');
        }
    }
}
