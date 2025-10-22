document.addEventListener("DOMContentLoaded", () => {
  const checkboxes = document.querySelectorAll(".checkbox");
  const btnEdit = document.querySelectorAll(".edit-btn");
  const form = document.querySelectorAll("addTaskList");

  btnEdit.forEach((button) => {
    button.addEventListener("click", (event) => {
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
        taskDiv.style.display = "none";

        // Mostra o formulário de edição (display: flex)
        editForm.style.display = "flex";

        const originalTitle = taskDiv.dataset.title;
        const originalDesc = taskDiv.dataset.desc;

        // Encontra os inputs dentro do formulário de edição e preenche
        editForm.querySelector('input[name="taskTitle"]').value = originalTitle;
        editForm.querySelector('input[name="task"]').value = originalDesc;

        // Lógica de Display: Esconde/Mostra
        taskDiv.style.display = "none";
        editForm.style.display = "flex"; // Aplica 'display: flex'

        // Focar no primeiro input
        editForm.querySelector('input[name="taskTitle"]').focus();
      }
    });
  });

  checkboxes.forEach((checkbox) => {
    // 1. Aplica o estado inicial ao carregar a página
    handleTaskState(checkbox);

    // 2. Adiciona o ouvinte de evento para quando o estado mudar
    checkbox.addEventListener("change", (event) => {
      // Chama a função toda vez que o checkbox é clicado
      handleTaskState(event.target);

      const taskId = event.target.dataset.id;
      if (taskId) {
        toggleTask(taskId); // CHAMADA DA FUNÇÃO AQUI!
      }

      // [PRÓXIMO PASSO] AQUI DEVE ENTRAR O CÓDIGO PARA ATUALIZAR O BANCO DE DADOS!
    });
  });

  // ...
// Função centralizada para lidar com a lógica de classes
function handleTaskState(checkbox) {
    const taskDiv = checkbox.closest(".task");
    
    // 1. OBTÉM O NOME DO ARQUIVO ATUAL
    // pathname contém algo como '/todolist/index.php'
    const path = window.location.pathname; 
    
    // Obtém apenas o nome do arquivo (ex: 'index.php')
    const currentPage = path.substring(path.lastIndexOf('/') + 1);

    // Define quais páginas DEVEM remover o item (Home e Em Andamento)
    const pagesToRemoveFrom = ['index.php']; 

    if (taskDiv) {
        if (checkbox.checked) {
            taskDiv.classList.add("taskDone");
            const lineGap = taskDiv.querySelector(".lineGap");
            if (lineGap) lineGap.classList.add("lineGapIn");

            // 2. APLICA A REMOÇÃO CONDICIONAL
            // Verifica se a página atual está na lista de remoção
            if (pagesToRemoveFrom.includes(currentPage)) {
                
                // Remove imediatamente (após um pequeno delay para a animação visual)
                setTimeout(() => {
                    taskDiv.style.display = 'none'; // Não ocupa mais espaço
                }, 1000); 
            }
            
        } else {
            // Se desmarcado (a tarefa volta a ser "Em Andamento")
            taskDiv.classList.remove("taskDone");
            const lineGap = taskDiv.querySelector(".lineGap");
            if (lineGap) lineGap.classList.remove("lineGapIn");
            
            // Se estiver na página de concluídas e desmarcar, ela DEVE sumir:
            if (currentPage === 'ending.php') {
                setTimeout(() => {
                    taskDiv.style.display = 'none'; // Remove de Concluídas
                }, 900);
            }
            
            // Se estiver na Home ou Em Andamento e desmarcar, ela deve reaparecer:
            else {
                taskDiv.style.display = 'flex'; 
            }
        }
    }
}

  function toggleTask(taskId) {
    // Usamos 'fetch' para fazer uma requisição silenciosa (AJAX)
    // Apontamos para o seu arquivo de ação e passamos o ID como parâmetro GET
    fetch(`index.php?route=toggle&id=${taskId}`)
      .then((response) => {
        // Se a resposta for OK (sucesso), não faz nada.
        // A lógica visual já foi aplicada pelo JS.
        if (!response.ok) {
          console.error("Erro ao alternar o estado da tarefa no servidor.");
        }
      })
      .catch((error) => {
        console.error("Erro de rede:", error);
      });
  }
});
