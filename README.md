#Agradecimentos

Obrigado por se interessar no meu projeto! Scope é um site sobre informações de filmes bastante fácil de usar e com um design minimalista.

# Instruções de Instalação
Este projeto requer o XAMPP e o phpMyAdmin para funcionar corretamente. Siga os passos abaixo para configurar o ambiente local e importar a base de dados.

Passo 1: Colocar os ficheiros na pasta htdocs do XAMPP
Instale o XAMPP: Se ainda não tiver o XAMPP instalado, pode fazer o download em https://www.apachefriends.org/pt_br/index.html.
Inicie o XAMPP: Abra o XAMPP e inicie os serviços do Apache e MySQL.
Coloque os ficheiros na pasta htdocs:
Localize a pasta onde o XAMPP foi instalado (geralmente C:\xampp).
Navegue até a pasta htdocs dentro da pasta XAMPP.
Copie todos os ficheiros do projeto para dentro da pasta htdocs.
Exemplo: C:\xampp\htdocs\nome_do_projeto.
Passo 2: Importar o ficheiro SQL para o phpMyAdmin
Aceda ao phpMyAdmin:
Abra o seu navegador e aceda a http://localhost/phpmyadmin.
No phpMyAdmin, clique na aba Databases (Base de Dados).
Criar uma nova base de dados:
No campo "Create database" (Criar base de dados), escreva o nome da sua base de dados (por exemplo, scope).
Clique no botão Create (Criar).
Importar o ficheiro SQL:
Depois de criar a base de dados, clique nela no painel esquerdo.
Vá até a aba Import (Importar).
No campo File to Import (Ficheiro para Importar), clique em Choose File (Escolher Ficheiro) e selecione o ficheiro SQL que acompanha este projeto.
Clique no botão Go (Ir) para importar o ficheiro SQL para a base de dados.
Isso irá criar todas as tabelas e dados necessários para o funcionamento do seu sistema.
Passo 3: Configuração Final
Verificar a conexão com a base de dados:
Abra o seu navegador e aceda a http://localhost/nome_do_projeto.
Verifique se o sistema está a funcionar corretamente.
Se tudo correr bem, deverá ver a página inicial do seu projeto. Caso tenha algum erro relacionado com a base de dados, verifique se as configurações de conexão no seu código (nome da base de dados, utilizador e senha) estão corretas.
