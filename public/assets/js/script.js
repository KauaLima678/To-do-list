document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.checkbox');
    const btnEdit = document.querySelectorAll('.edit-btn');
    const form = document.querySelectorAll('addTaskList');

        btnEdit.forEach(button => {
        button.addEventListener('click', (event) => {
            // 1. Previne o redirecionamento padrão do <a>
            event.preventDefault(); 
            
            // 2. Pega o ID da tarefa que será editada
            const taskId = event.currentTarget.dataset.id;
            
            // 3. Encontra a div da tarefa original e o formulário de edição
            const taskDiv = document.querySelector(`.task[data-id="${taskId}"]`);
            const editForm = document.querySelector(`#edit-form-${taskId}`);
            
            if (taskDiv && editForm) {
                // 4. APLICA AS REGRAS DE DISPLAY
                
                // Esconde a tarefa original
                taskDiv.style.display = 'none'; 
                
                // Mostra o formulário de edição (display: flex)
                editForm.style.display = 'flex'; 
                
                const originalTitle = taskDiv.dataset.title;
                const originalDesc = taskDiv.dataset.desc;
                
                // Encontra os inputs dentro do formulário de edição e preenche
                editForm.querySelector('input[name="taskTitle"]').value = originalTitle;
                editForm.querySelector('input[name="task"]').value = originalDesc;

                // Lógica de Display: Esconde/Mostra
                taskDiv.style.display = 'none'; 
                editForm.style.display = 'flex'; // Aplica 'display: flex'
                
                // Focar no primeiro input
                editForm.querySelector('input[name="taskTitle"]').focus();
                
            }
        });
    });

    checkboxes.forEach(checkbox => {
        
        // 1. Aplica o estado inicial ao carregar a página
        handleTaskState(checkbox); 

        // 2. Adiciona o ouvinte de evento para quando o estado mudar
        checkbox.addEventListener('change', (event) => {
            // Chama a função toda vez que o checkbox é clicado
            handleTaskState(event.target);

            const taskId = event.target.dataset.id;
    if (taskId) {
        toggleTask(taskId); // CHAMADA DA FUNÇÃO AQUI!
    }
            
            // [PRÓXIMO PASSO] AQUI DEVE ENTRAR O CÓDIGO PARA ATUALIZAR O BANCO DE DADOS!
        });
    });

    // Função centralizada para lidar com a lógica de classes
    function handleTaskState(checkbox) {
        // Encontra o elemento mais próximo com a classe '.task'
        const taskDiv = checkbox.closest('.task');
        
        // Se a div da tarefa foi encontrada
        if (taskDiv) {
            // Se o checkbox está marcado, adiciona a classe .taskDone
            if (checkbox.checked) {
                taskDiv.classList.add("taskDone");
                
                // Mantenha a lógica da linha riscada (lineGap) aqui, se desejar
                const lineGap = taskDiv.querySelector('.lineGap');
                if (lineGap) lineGap.classList.add("lineGapIn");

            } else {
                // Se desmarcado, remove a classe .taskDone
                taskDiv.classList.remove("taskDone");
                
                // Remove a lógica da linha riscada
                const lineGap = taskDiv.querySelector('.lineGap');
                if (lineGap) lineGap.classList.remove("lineGapIn");
            }
        }
    }

    function toggleTask(taskId) {
    // Usamos 'fetch' para fazer uma requisição silenciosa (AJAX)
    // Apontamos para o seu arquivo de ação e passamos o ID como parâmetro GET
    fetch(`index.php?route=toggle&id=${taskId}`)
        .then(response => {
            // Se a resposta for OK (sucesso), não faz nada. 
            // A lógica visual já foi aplicada pelo JS.
            if (!response.ok) {
                console.error('Erro ao alternar o estado da tarefa no servidor.');
            }
        })
        .catch(error => {
            console.error('Erro de rede:', error);
        });
}
});