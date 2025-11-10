<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-sm bg-white p-8 rounded-xl shadow-2xl">
            <h1 class="text-3xl font-extrabold text-[#F36C21] text-center mb-8">Acesso Restrito</h1>

            <form id="form-login">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required autocomplete="email"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#F36C21] focus:border-[#F36C21]"
                    >
                </div>

                <div class="mb-6">
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" name="senha" id="senha" required autocomplete="current-password"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#F36C21] focus:border-[#F36C21]"
                    >
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
    $('#form-login').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action') || '<?= site_url('login') ?>';
        
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
                        text: 'Login efetuado com sucesso.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '<?= site_url('clientes') ?>'; // Redireciona para clientes
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: response.error || 'Erro ao tentar fazer login.',
                    });
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