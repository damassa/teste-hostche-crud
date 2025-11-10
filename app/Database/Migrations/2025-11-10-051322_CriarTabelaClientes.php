<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaClientes extends Migration
{
   public function up()
    {
    // 1. Definição da Chave Primária (Método dedicado do CodeIgniter)
    $this->forge->addField('id INT(9) NOT NULL AUTO_INCREMENT'); 
    
    // 2. Definição dos Outros Campos
    $this->forge->addField([
        'nome' => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
        ],
        'sobrenome' => [
            'type'       => 'VARCHAR',
            'constraint' => '100',
            'null'       => true,
        ],
        'imagem' => [
            'type'       => 'VARCHAR',
            'constraint' => '255',
            'null'       => true,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);
    
    // 3. Adicionar Chave Primária e Criar Tabela
    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('clientes');
}

    public function down()
    {
        //Dropa a tabela
        $this->forge->dropTable('clientes');
    }
}
