document.addEventListener('DOMContentLoaded', () => {
    
    // --- FUNÇÃO PARA EXIBIR MENSAGENS (TOAST) ---
    const showMessage = (message, isError = false) => {
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-msg');
        const toastIcon = document.getElementById('toast-icon');
        const toastContainer = toast.querySelector('div');

        // Configura as cores e ícones baseados no tipo (Erro ou Sucesso)
        if (isError) {
            toastContainer.classList.replace('border-[#CAFF00]', 'border-red-500');
            toastIcon.className = 'fas fa-exclamation-triangle text-red-500 text-sm';
            toastMsg.classList.replace('text-white', 'text-red-500');
        } else {
            toastContainer.classList.replace('border-red-500', 'border-[#CAFF00]');
            toastIcon.className = 'fas fa-check text-[#CAFF00] text-sm';
            toastMsg.classList.replace('text-red-500', 'text-white');
        }

        toastMsg.innerText = message.toUpperCase();
        
        // Animação de entrada
        toast.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
        toast.classList.add('opacity-100', 'translate-y-0');

        // Auto-hide após 4 segundos
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
            toast.classList.remove('opacity-100', 'translate-y-0');
        }, 4000);
    };

    // --- LÓGICA DE ENVIO DE FORMULÁRIOS (AJAX) ---
    const handleAjaxForm = (formId, successMessage) => {
        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerText;
            
            // Loading state
            submitBtn.disabled = true;
            submitBtn.innerText = 'PROCESSANDO...';

            try {
                const response = await fetch(form.action, {
                    method: 'POST', // Laravel usa POST com _method PUT/DELETE
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: new FormData(form)
                });

                const data = await response.json();

                if (response.ok) {
                    showMessage(successMessage);
                    // Opcional: Recarregar a página após sucesso para atualizar os nomes na tela
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    // TRATAMENTO UNIVERSAL DE ERROS
                    if (data.errors) {
                        // Pega a primeira mensagem de erro de validação (ex: "Senha muito curta")
                        const firstKey = Object.keys(data.errors)[0];
                        showMessage(data.errors[firstKey][0], true);
                    } else {
                        // Erros gerais (ex: "Senha atual incorreta")
                        showMessage(data.message || 'Erro ao processar solicitação', true);
                    }
                }
            } catch (error) {
                showMessage('Falha na conexão com o servidor', true);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = originalText;
            }
        });
    };

    // Inicializa os formulários
    handleAjaxForm('info-form', 'Dados atualizados com sucesso!');
    handleAjaxForm('password-form', 'Senha alterada com sucesso!');

    // --- CONTROLES DE INTERFACE (BOTÕES EDITAR/CANCELAR) ---
    
    // Dados da Conta
    document.getElementById('btn-edit-info')?.addEventListener('click', () => {
        document.getElementById('info-view').classList.add('hidden');
        document.getElementById('info-form').classList.remove('hidden');
    });
    document.getElementById('btn-cancel-info')?.addEventListener('click', () => {
        document.getElementById('info-form').classList.add('hidden');
        document.getElementById('info-view').classList.remove('hidden');
    });

    // Segurança
    document.getElementById('btn-edit-password')?.addEventListener('click', () => {
        document.getElementById('password-view').classList.add('hidden');
        document.getElementById('password-form').classList.remove('hidden');
    });
    document.getElementById('btn-cancel-password')?.addEventListener('click', () => {
        document.getElementById('password-form').classList.add('hidden');
        document.getElementById('password-view').classList.remove('hidden');
    });

    // --- MODAL DE EXCLUSÃO ---
    const deleteOverlay = document.getElementById('delete-account-overlay');
    document.getElementById('btn-delete-account')?.addEventListener('click', () => {
        deleteOverlay.classList.replace('hidden', 'flex');
    });
    document.getElementById('btn-cancel-delete-account')?.addEventListener('click', () => {
        deleteOverlay.classList.replace('flex', 'hidden');
    });
});