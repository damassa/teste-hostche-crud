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