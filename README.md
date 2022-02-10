# Projeto Escola

## Preparação de ambiente

- Primeiramente, crie um banco de dados chamado "projeto_escola" e rode as migrations com o comando "php artisan migrate".
- Para cadastrar dois usuários, um de cada tipo (Administrador e Aluno), use o comando "php artisan db:seed --class=UserSeeder".
- Para testá-los, utilize o e-mail "admin@gmail.com" com a senha "admin123" para o Administrador. E "aluno@gmail.com" com a senha "aluno123" para o aluno.
- Considere mudar os e-mails para algum que você use, para testar a funcionalidade "esqueci minha senha".

- Sugestão: dentro de storage/app/public/categoryimage já existem 4 imagens que usei para criar as categorias de estudo, sendo elas: Exatas, Humanas, Biológicas e Linguísticas. Todas nomeadas para caso queira usar.

## Sobre

- Existem 4 tabelas principais de dados: Usuários(tendo dois tipos de níveis de acesso, Administrador e Aluno), Categorias(usado para definir o seguimento de uma matéria), Matérias(conteúdo das aulas) e Matrículas(aulas em que um aluno pode se inscrever).
- Na área de login você pode: se cadastrar, fazer login e alterar sua senha com base em um e-mail recebido.
- Sobre o e-mail recebido no "esqueci minha senha": você deverá utilizar um token recebido no e-mail, junto do link que te leva para a página com o formulário. Utilizando o token ele fará uma autenticação para poder alterar a senha.

## Funções do Administrador

Como Administrador você poderá: 

- Cadastrar, Alterar e Excluir Categorias de estudo.
- Cadastrar, Alterar e Excluir Matérias.
- Cadastrar, Alterar(com exceções de alguns dados) e Desativar Usuários.

## Funções como Aluno

Como Aluno você poderá: 

- Cadastrar(se matricular em alguma matéria), Alterar(trocar de matéria) e Excluir(trancar matrícula na matéria) Matrículas.
- Alterar dados do seu perfil.