## Para quem é este projeto?

Este projeto é voltado para o ensino do framework [Laravel](https://laravel.com/) na disciplina de Tópicos Especiais no curso [Técnico de Informática](https://ifrs.edu.br/ibiruba/cursos/tecnico-integrado-ao-ensino-medio/tecnico-em-informatica/) Integrado ao Ensino Médio no Instituto Federal do Rio Grande do Sul - [IFRS](https://ifrs.edu.br/) - Campus Ibirubá.


## O que é este projeto?

Este projeto é para o desenvolvimento de uma rede social simples em que um usuário poderá se registrar, fazer login, criar post, visualizar lista de usuários, visualizar o perfil de um usuário, visualizar a lista de posts de um usuário, seguir usuário, curtir e comentar um post.


## Quais são as funcionalidades que precisam ser desenvolvidas?

01 - Criar usuário (Auth do Laravel);

02 - Fazer Login (Auth do Laravel);

03 - Visualizar perfil (Auth do Laravel);

04 - Editar perfil (Auth do Laravel);

05 - Deletar conta (Auth do Laravel);

06 - Recuperar senha (Auth do Laravel);

07 - Fazer logoff (Auth do Laravel);

08 - Exibir dashboard (Auth do Laravel);

09 - Visualizar a lista de seus posts (list);

10 - Criar um post (create/store);

11 - Visualizar lista de usuários (list);

12 - Visualizar os detalhes do perfil de um usuário (show);

13 - Visualizar lista de post de um usuário (list);

14 - Visualizar os detalhes de um post (show);

15 - Visualizar a lista de comentários de um post (list);

16 - criar um comentário em um post (create/store);

17 - seguir usuário (attach);

18 - curtir um post (attach);

19 - deixar de seguir usuário (detach);

20 - deixar de curtir um post (detach);

21 - Anexar foto(s) ao post (upload de fotos);

22 - editar comentário (edit/update);

23 - excluir comentário (delete/destroy).


## Quais os conhecimentos mínimos necessários para a realização deste projeto?

01 - Noções de MVC e ciclo de vida de uma requisição (route->controller->model->view);

02 - Configuração de conexão com banco de dados no Laravel;

03 - Migration;

04 - Seed;

04 - Factory;

05 - Route;

06 - Model;

07 - Controller;

08 - Request;

08 - Validation;

09 - View;

10 - Blade templates;

11 - listar itens (list);

12 - exibir detalhes de um item (show);

13 - criar um item (create/store);

14 - editar um item (edit/update);

15 - deletar um item (delete/destroy).


## Quais os itens a serem estudados com o desenvolvimento deste projeto?

01 - Instalação do [Bootstrap](https://laravel.com/docs/6.x/frontend) no projeto;

02 - [Authentication](https://laravel.com/docs/10.x/authentication)) do Laravel;

03 - [Relacionamentos](https://laravel.com/docs/10.x/eloquent-relationships) entre tabelas/models;

04 - [Livewire](https://laravel-livewire.com/) - Para criação de componentes que são sincronizados entre o front-end e o back-end.;

05 - [Paginação](https://laravel.com/docs/10.x/eloquent-resources#pagination) no Laravel;

06 - [Paginação](https://laravel-livewire.com/docs/2.x/pagination) com Livewire.


## Como colocar a funcionar o projeto?

01 - pelo terminal, acesse a pasta onde você deseja salvar o projeto


02 - clone o projeto para a sua  máquina

>    git clone 

03 - acesse a pasta do projeto

>    cd rede-social-laravel

04 - crie o arquivo .env

>    cp .env.example .env

05 - gere a chave do projeto

>    php artisan key:generate

06 - crie um arquivo vazio para armazenar o banco de dados

>    touch database/database.sqlite

07 - execute o comando para criar as tabelas e inserir dados dos seed e factory

>    php artisan migrate:fresh --seed

08 - coloque o projeto para rodar

>    php artisan serve
