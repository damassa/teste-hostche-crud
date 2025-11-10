<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ? $this->renderSection('title') . ' | ' : '' ?>Teste Hostche - CRUD</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?> 
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen">
    
    <main class="container mx-auto p-6 md:p-10">
        
        <!-- HEADER CONDICIONAL (Só aparece se estiver logado) -->
        <?php if (session()->get('isLogged')): ?>
            <header class="flex justify-between items-center mb-6 py-3 px-6 bg-white shadow rounded-lg border-t-4 border-t-[#F36C21]">
                
                <h1 class="text-2xl font-extrabold text-[#F36C21]">
                    CRUD de Clientes
                </h1>

                <div class="flex items-center space-x-3">
                    <!-- Nome do Usuário Logado -->
                    <span class="text-gray-600 text-sm hidden sm:inline">
                        Olá, <?= esc(session()->get('email')) ?>
                    </span>
                    
                    <!-- Botão de Logout -->
                    <a href="<?= site_url('logout') ?>" 
                       class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 shadow transition duration-150 ease-in-out"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h6a1 1 0 110 2H4v12h12V9a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V4a1 1 0 011-1zm10.707 3.293a1 1 0 01-1.414 1.414L14.586 10H8a1 1 0 110-2h6.586l-2.293-2.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 12H8a1 1 0 110-2h6.586l-2.293-2.293z" clip-rule="evenodd" />
                        </svg>
                        Logout
                    </a>
                </div>
            </header>
        <?php endif; ?>
        <!-- Fim do Header Condicional -->

        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->renderSection('scripts') ?> 

    <div id="modal-edicao" class="hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-75 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-2xl max-w-lg w-full m-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
        <div id="modal-body" class="p-6">
            <p class="text-center text-gray-500">Carregando formulário...</p>
        </div>
    </div>
</div>
</body>
</html>