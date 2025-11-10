<div class="p-4">
    <h2 class="text-2xl font-bold mb-6 text-[#F36C21]">Editar Cliente: <?= esc($cliente['nome']) ?></h2>
    
    <form id="form-edicao-cliente" data-id="<?= esc($cliente['id']) ?>" enctype="multipart/form-data">
        
        <?= csrf_field() ?>
        
        <input type="hidden" name="_method" value="PUT">

        <div class="mb-4">
            <label for="edit_nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="nome" id="edit_nome" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                   value="<?= esc($cliente['nome']) ?>"
            >
            <p id="error-nome" class="text-red-500 text-xs mt-1 hidden"></p>
        </div>

        <div class="mb-4">
            <label for="edit_sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
            <input type="text" name="sobrenome" id="edit_sobrenome" required 
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                   value="<?= esc($cliente['sobrenome']) ?>"
            >
            <p id="error-sobrenome" class="text-red-500 text-xs mt-1 hidden"></p>
        </div>

        <?php if (!empty($cliente['imagem'])): ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Imagem Atual</label>
                <img src="<?= base_url($cliente['imagem']) ?>" alt="Imagem do Cliente" class="w-20 h-20 object-cover rounded mt-1">
                <p class="text-xs text-gray-500 mt-1">Envie um novo arquivo para substituir.</p>
            </div>
        <?php endif; ?>

        <div class="mb-6">
            <label for="edit_imagem" class="block text-sm font-medium text-gray-700">Nova Imagem</label>
            <input type="file" name="imagem" id="edit_imagem" 
                   class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#F36C21]/10 file:text-[#F36C21] hover:file:bg-[#F36C21]/20"
            >
        </div>

        <div class="flex justify-end space-x-3">
            <button type="button" class="btn-fechar-modal inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Cancelar
            </button>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>