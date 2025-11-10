<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioAdminSeeder extends Seeder //Popula o banco com um usuário admin padrão
{
    public function run()
    {
        $data = [
            'email' => 'admin@admin.com',
            'senha' => password_hash('admin', PASSWORD_DEFAULT),
        ];

        $this->db->table('usuarios')->insert($data);
    }
}
