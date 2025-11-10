<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Lista de Clientes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-[#F36C21]">Lista de Clientes</h1>
        
        <a 
            href="<?= site_url('clientes/new') ?>" 
            class="bg-[#F36C21] text-white font-semibold px-6 py-2 rounded shadow-md hover:bg-[#D85E1A] transition duration-300"
        >
            ➕ Novo Cliente
        </a>
    </div>
    
    <?php if (! empty($clientes) && is_array($clientes)): ?>
        <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome Completo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Criação</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($cliente['id']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= esc($cliente['nome'] . ' ' . $cliente['sobrenome']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc(date('d/m/Y H:i', strtotime($cliente['created_at']))) ?></td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-2">
                                    <a href="<?= site_url('clientes/' . $cliente['id']) ?>" 
                                        class="text-blue-600 hover:text-blue-900 font-semibold"
                                    >
                                        Ver
                                    </a>
                                    
                                    <a href="<?= site_url('clientes/' . $cliente['id'] . '/edit') ?>" 
                                        class="text-indigo-600 hover:text-indigo-900 font-semibold btn-edit-cliente"
                                    >
                                        Editar
                                    </a>
                                    
                                    <form action="<?= site_url('clientes/' . $cliente['id']) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');" class="inline form-delete-cliente">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" 
                                            class="text-red-600 hover:text-red-900 font-semibold focus:outline-none"
                                        >
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md">
            <p class="font-bold">Nenhum cliente</p>
            <p>Nenhum cliente cadastrado ainda. Clique em "Novo Cliente" para começar!</p>
        </div>
    <?php endif ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    //Mensagem de sucesso
    <?php if (session()->getFlashdata('message')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '<?= session()->getFlashdata('message') ?>',
            timer: 3000,
            showConfirmButton: false
        });
    <?php endif; ?>

    //Mensagens de Erro
    <?php if (session()->getFlashData('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Opa! Deu erro!',
            text: '<?= session()->getFlashdata('error') ?>',
        });
    <?php endif; ?>    
    //Modal de Edição e AJAX

    const modal = $('#modal-edicao');
    const modalContent = $('#modal-content');
    const modalBody = $('#modal-body');

    //Fechar o modal
    function closeModal() {
        modalContent.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        modal.addClass('hidden').removeClass('opacity-100');
        modalBody.html('<p class="text-center text-gray-500">Carregando formulário...</p>'); // Limpa o conteúdo
    }

    //Abrir Modal e Carregar Formulário
    $('.btn-edit-cliente').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        
        modal.removeClass('hidden').addClass('opacity-100');
        modalContent.removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');

        // Carrega via AJAX
        $.get(url, function(data) {
            modalBody.html(data);
        }).fail(function() {
            modalBody.html('<p class="text-red-600 text-center">Erro ao carregar o formulário.</p>');
        });
    });

    //Fechar Modal
    $(document).on('click', '.btn-fechar-modal', function() {
        closeModal();
    });
    
    //Fechar Modal (clique fora)
    modal.on('click', function(e) {
        if ($(e.target).is(modal)) {
            closeModal();
        }
    });


    //Submissão do Formulário de Edição (AJAX)
    $(document).on('submit', '#form-edicao-cliente', function(e) {
        e.preventDefault();
        const form = $(this);
        const id = form.data('id');
        const url = '<?= site_url('clientes/') ?>' + id;
        
        //Limpa erros anteriores
        $('.text-red-500.text-xs').addClass('hidden').text('');
        
        //FormData para enviar arquivos (imagem) e dados
        const formData = new FormData(this);
        
        //Token CSRF no corpo da requisição
        const csrfToken = $('input[name="<?= csrf_token() ?>"]').val();
        formData.append('<?= csrf_token() ?>', csrfToken);
        
        $.ajax({
            url: url,
            type: 'POST', //O hidden '_method=PUT' faz o CI interpretar como PUT/UPDATE
            data: formData,
            processData: false, //Necessário para FormData
            contentType: false, //Necessário para FormData
            dataType: 'json',
            success: function(response) {
                closeModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Atualizado!',
                    text: response.message,
                }).then(() => {
                    //Recarrega a página
                    window.location.reload();
                });
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (response && response.errors) {
                    //Exibe erros de validação
                    for (const field in response.errors) {
                        $('#error-' + field).removeClass('hidden').text(response.errors[field]);
                    }
                } else {
                    Swal.fire('Erro!', 'Ocorreu um erro ao processar sua requisição.', 'error');
                }
            }
        });
    });

//Excluir cliente
    $(document).on('submit', '.form-delete-cliente', function(e) {
        e.preventDefault(); //Impede a submissão padrão do formulário
        
        const form = $(this);
        
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter esta ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                //Se o usuário confirmar, submete o formulário via PHP/POST
                form.off('submit').submit();
            }
        });
    });
</script>
<?= $this->endSection() ?>