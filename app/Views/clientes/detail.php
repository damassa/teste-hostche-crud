<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Detalhes do Cliente: <?= esc($cliente['nome'] ?? 'Cliente') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="max-w-4xl mx-auto mt-10 p-6 sm:p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#F36C21]">Detalhes do Cliente</h1>
            
            <a 
                href="<?= site_url('clientes') ?>" 
                class="text-gray-600 hover:text-[#F36C21] transition duration-300 flex items-center"
            >
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Voltar para a Lista
            </a>
        </div>
        
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            
            <div class="p-6 bg-[#F36C21] text-white">
                <h2 class="text-2xl font-bold"><?= esc(($cliente['nome'] ?? '') . ' ' . ($cliente['sobrenome'] ?? 'Cliente Indisponível')) ?></h2>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="md:col-span-1 flex flex-col items-center">
                        <?php 
                        $imagePath = ($cliente['imagem'] ?? false) ? base_url($cliente['imagem']) : base_url('img/default_client.png');
                        ?>
                        <div class="w-48 h-48 border-4 border-gray-200 rounded-full overflow-hidden shadow-lg mb-4">
                            <img 
                                src="<?= esc($imagePath) ?>" 
                                alt="Imagem de <?= esc($cliente['nome'] ?? 'Cliente') ?>" 
                                class="w-full h-full object-cover"
                            >
                            
                        </div>
                        <span class="text-sm font-semibold text-gray-500">ID: <?= esc($cliente['id'] ?? 'N/A') ?></span>
                    </div>
                    
                    <div class="md:col-span-2 space-y-4">
                        <h3 class="text-xl font-semibold border-b pb-2 text-gray-700">Informações Básicas</h3>
                        
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-sm font-medium text-gray-500">Nome Completo:</span>
                            <span class="text-base font-semibold text-gray-800"><?= esc(($cliente['nome'] ?? 'N/A') . ' ' . ($cliente['sobrenome'] ?? '')) ?></span>
                        </div>

                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-sm font-medium text-gray-500">Data de Criação:</span>
                            <span class="text-base text-gray-800">
                                <?php 
                                if (isset($cliente['created_at']) && $cliente['created_at']) {
                                    echo date('d/m/Y H:i', strtotime(esc($cliente['created_at'])));
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </span>
                        </div>
                        
                        </div>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 flex justify-end space-x-3 border-t">
                
                <form action="<?= site_url('clientes/' . ($cliente['id'] ?? 0)) ?>" method="post" class="inline form-delete-cliente">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" 
                        class="bg-red-600 text-white font-semibold px-4 py-2 rounded shadow hover:bg-red-700 transition duration-300"
                    >
                        <i class="fas fa-trash-alt"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
        
    </div>
<?= $this->endSection() ?>