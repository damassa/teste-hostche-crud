<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Adicionar Novo Cliente
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-2xl">
        <h1 class="text-2xl font-bold mb-6 text-[#F36C21]">Adicionar Novo Cliente</h1>
        
        <form action="<?= site_url('clientes') ?>" method="post" enctype="multipart/form-data">
            
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome <span class="text-red-500">*</span></label>
                <input type="text" name="nome" id="nome" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#F36C21] focus:border-[#F36C21] sm:text-sm"
                       value="<?= old('nome') ?>"
                >
            </div>

            <div class="mb-4">
                <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome <span class="text-red-500">*</span></label>
                <input type="text" name="sobrenome" id="sobrenome" required 
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#F36C21] focus:border-[#F36C21] sm:text-sm"
                       value="<?= old('sobrenome') ?>"
                >
            </div>

            <div class="mb-6">
                <label for="imagem" class="block text-sm font-medium text-gray-700">Imagem do Cliente (Opcional)</label>
                <input type="file" name="imagem" id="imagem" 
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#F36C21]/10 file:text-[#F36C21] hover:file:bg-[#F36C21]/20"
                >
            </div>

            <div class="flex justify-between">
                <a href="<?= site_url('clientes') ?>" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                    Voltar
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#F36C21] hover:bg-[#D85E1A] transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F36C21]">
                    Salvar Cliente
                </button>
            </div>
            
            <?php if (session()->has('errors')): ?>
                <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <?php foreach (session('errors') as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </form>
    </div>

<?= $this->endSection() ?>