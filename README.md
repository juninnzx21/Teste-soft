Projeto de Gerenciamento de Tarefas
Este projeto é uma aplicação web que permite o gerenciamento de tarefas e categorias utilizando o framework Laravel. A aplicação possui funcionalidades como criação de categorias, criação de tarefas, filtragem de tarefas e edição/exclusão de tarefas existentes. A interface utiliza o framework Bootstrap para estilização das páginas.

Funcionalidades
1. Criação de Categoria
O usuário pode criar uma nova categoria para organizar as tarefas. Ao preencher o nome da categoria, ele é armazenado no banco de dados e fica disponível para ser associado às tarefas.

2. Criação de Tarefa
O usuário pode criar tarefas, preenchendo informações como:

Título : Nome da tarefa.
Descrição : Detalhes sobre a tarefa.
Categoria : Associação da tarefa a uma categoria previamente criada.
Status : Indica o status da tarefa (Pendente, Em Progresso, Concluída).
Disponibilidade : Indica o progresso da tarefa (Aguardando, Em Progresso, Pausada, Terminada).
3. Filtragem de Tarefas
Os usuários podem filtrar as tarefas com base em:

Categoria : Filtro por categoria de tarefas.
Data de Criação : Ordena as tarefas pela data de criação (ascendente ou descendente).
Disponibilidade : Filtra tarefas com base no status de disponibilidade (Aguardando, Em Progresso, Pausada, Terminada).
4. Edição de Tarefa
O usuário pode editar uma tarefa existente, alterando informações como título, descrição, categoria, status e disponibilidade.

5. Exclusão de Tarefa
O usuário pode excluir tarefas que não sejam mais possíveis.

6. Exposição das Tarefas
Uma lista de tarefas é exibida em formato de lista com informações fornecidas, como:

Nome da tarefa
Categoria
Dados de criação
Status e Disponibilidade Além disso, o usuário pode editar ou excluir uma tarefa diretamente da lista.
Estrutura do Projeto
O projeto foi desenvolvido utilizando o Laravel e faz uso do Bootstrap 4 para estilização. A estrutura do projeto inclui:

Criação de Categorias e Tarefas : Formulários para criação de categorias e tarefas, com validação de campos obrigatórios.
Filtragem de Tarefas : Um formulário para filtrar as tarefas com base na categoria, dados e disponibilidade.
Modais de Edição de Tarefas : Interface modal para editar tarefas.
SweetAlert : Notificações em tempo real para alertar o usuário sobre o sucesso ou falha nas operações.

Instalar as dependências:
composer install
Configure o arquivo .envcom as credenciais do banco de dados.

Executar as migrações:
php artisan migrate

Iniciar ou servidor:
php artisan serve


Tecnologias Utilizadas
Laravel : Framework PHP utilizado para o desenvolvimento da aplicação.
Bootstrap : Framework CSS para estilização da interface.
SweetAlert2 : Biblioteca JavaScript para exibição de notificações.
Contribuindo
Faça o fork deste repositório.
Crie um branch para seu feature ( git checkout -b feature/nome-da-feature).
Faça commit de suas alterações ( git commit -am 'Adiciona nova feature').
Envie para o repositório remoto ( git push origin feature/nome-da-feature).
Abra um Pull Request.

