# Clear Task - Gerenciador de Tarefas

Um aplicativo web para gerenciamento de tarefas pessoais desenvolvido com PHP, MySQL e JavaScript.

## 🚀 Funcionalidades

- ✅ Autenticação de usuários (Login/Registro)
- 📝 Criar, editar e excluir tarefas
- ✨ Marcar tarefas como concluídas
- 🔄 Visualizar tarefas em andamento e concluídas
- 🎯 Interface responsiva e amigável
- 🔒 Sistema de sessão seguro
- 📱 Menu lateral retrátil

## 🛠️ Tecnologias Utilizadas

- PHP 8.x
- MySQL
- JavaScript
- HTML5
- CSS3
- PDO (PHP Data Objects)
- Font Awesome Icons

## 🖥️ Preview

![Clear Task Preview](./assets/imgs/Clear%20Task%20Preview.png)

## ⚙️ Instalação

1. Clone o repositório:
```bash
git clone https://github.com/KauaLima678/To-do-list.git
```

2. Configure seu servidor web (Apache/NGINX) apontando para o diretório `public`

3. Importe o banco de dados MySQL:
```sql
CREATE DATABASE todolist;
USE todolist;

CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    title VARCHAR(255) NOT NULL,
    task TEXT NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
```

4. Configure a conexão com o banco de dados em `app/db/conn.php`:
```php
$host = 'localhost';
$db = 'todolist';
$user = 'seu_usuario';
$password = 'sua_senha';
```

## 🔧 Requisitos

- PHP 8.x
- MySQL 5.7+
- Servidor Web (Apache/NGINX)
- PDO PHP Extension
- MySQL PHP Extension

## 🚦 Estrutura do Projeto

```
todolist/
├── app/
│   ├── actions/      # Controladores de ações
│   ├── components/   # Componentes reutilizáveis
│   ├── config/       # Configurações
│   └── db/          # Conexão com banco de dados
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── imgs/
│   │   └── js/
│   └── index.php    # Ponto de entrada
```

## 🔐 Features de Segurança

- Senhas criptografadas com `password_hash()`
- Proteção contra SQL Injection usando PDO
- Validação de sessão
- Sanitização de inputs

## ⚠️ Limitações e Observações

- Interface não responsiva (melhor visualização em desktop)
- Botões de login com redes sociais são apenas visuais (não funcionais)
- Funcionalidades "Lembre de mim" e "Esqueci minha senha" são apenas visuais
- Projeto desenvolvido para fins de estudo e demonstração

## 📝 Licença

Este projeto é para fins educacionais e pessoais. Sinta-se livre para usar e modificar.

## 👤 Autor

Desenvolvido por KauaLima678 - [@KauaLima678](https://github.com/KauaLima678)

---

⭐️ Se este projeto te ajudou, considere dar uma estrela!