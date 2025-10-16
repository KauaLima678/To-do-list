document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.checkbox');

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