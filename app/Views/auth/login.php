<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-2xl">
            <h1 class="text-3xl font-extrabold text-[#F36C21] text-center mb-8">Área do admin</h1>

            <form id="form-login">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" placeholder="Digite seu e-mail" name="email" id="email" required autocomplete="email"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#F36C21] focus:border-[#F36C21]"
                    >
                    <p id="error-email" class="text-red-500 text-sm mt-1 hidden"></p> 
                </div>

                <div class="mb-6">
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" placeholder="Digite sua senha" name="senha" id="senha" required autocomplete="current-password"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#F36C21] focus:border-[#F36C21]"
                    >
                    <p id="error-senha" class="text-red-500 text-sm mt-1 hidden"></p>
                </div>

                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#F36C21] hover:bg-[#D85E1A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F36C21]">
                    Entrar
                </button>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    
    //Funções de Validação
    const validationError = (field, message) => { //Erros de validação
        const errorElement = $(`#error-` + field);
        errorElement.text(message);
        if (message) {
            errorElement.removeClass('hidden');
        } else {
            errorElement.addClass('hidden');
        }
    }
    
    const isValidEmail = (email) => { //Validação de e-mail
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    const validateForm = () => {
        let isValid = true;
        const email = $('#email').val().trim();
        const senha = $('#senha').val().trim();

        validationError('email', '');
        validationError('senha', '');

        if (!email) {
            validationError('email', 'Por favor, insira um e-mail.');
            isValid = false;
        } else if (!isValidEmail(email)) {
            validationError('email', 'Por favor, insira um e-mail válido.');
            isValid = false;
        }

        if (!senha) {
            validationError('senha', 'Por favor, insira uma senha.');
            isValid = false;
        } else if (senha.length < 5) {
            validationError('senha', 'A senha deve ter pelo menos 5 caracteres.');
            isValid = false;
        }

        return isValid;
    }
    
    //Lógica de login/logout

    <?php if (session()->getFlashdata('logout_message')): ?>
        Swal.fire({
            icon: 'info',
            title: 'Sessão Encerrada',
            text: '<?= session()->getFlashdata('logout_message') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php endif; ?>

    $('#form-login').on('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault(); //Impede o envio AJAX
            return;
        }

        //Se a validação passou, continua com o AJAX
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action') || '<?= site_url('login') ?>';
        
        //Limpa erros visuais antes de enviar
        validationError('email', '');
        validationError('senha', '');

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: `Bem vindo, Administrador`,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '<?= site_url('clientes') ?>'; // Redireciona
                    });
                } else {
                    //Trata erros de validação do servidor ou erro genérico
                    if (response.errors) {
                        for (const field in response.errors) {
                           validationError(field, response.errors[field]);
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: response.error || 'Erro ao tentar fazer login. Verifique suas credenciais.',
                        });
                    }
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de Conexão!',
                    text: 'Não foi possível conectar ao servidor. Tente novamente.',
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>