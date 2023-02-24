# Sistema de Pedidos em Code Igniter 3
## Sistema capaz de realizar cadastro de colaboradores, fornecedores, produtos e pedidos

### Requisitos
O sistema foi desenvolvido utilizando XAMPP. Segue os requisitos para funcionamento:

1. PHP 7.2 ou PHP 7.3
2. Servidor local (Apache, por exemplo)
3. MariaDB 

### Configuração

1. Em **_application/sql_** há um arquivo SQL referente ao banco de dados que o sistema usa, com tabelas e registros padrões. Rode o script SQL no MariaDB.
2. Ao importar o SQL e rodar o servidor local, o sistema já está funcionando no link http://localhost/ci3-sistema/

### Usuários
1. O usuário padrão está definido como **usuario: admin** e **senha: admin**.
2. Na criação de usuários é permitido adicionar um colaborador com usuário e senha e o mesmo terá acesso ao sistema e também fazer requisições na API(ws).
3. Ainda na parte de Login, caso o usuário erre 3 vezes a mesma senha, o sistema é bloqueado por 10 minutos.

### Colaboradores
1. Foi implementado o sistema básico de permissão de tela, nos menus, onde o usuário que está cadastrando colaboradores pode definir se o colaborador terá ou não acesso aos respectivos menus: Colaboradores, Produtos e Pedidos.

### API
1. O WS com retorno de todos os pedidos finalizados e respectivos itens, pode ser consumido em: http://localhost/ci3-sistema/api/pedidos_finalizados, sendo necessário uma autenticação Basic com usuário e senha que está cadastrado no sistema.

### Logs
1. Os logs do sistema estão sendo armazenados na tabela _logs_, no banco do projeto.

### Observações
1. Não foi utilizada nenhuma biblioteca externa, portanto não há necessidade de rodar composer.
2. Configurar o arquivo **config.php**, em **_application/config_** caso o diretório de instalação não seja a raíz do servidor local, a variável _base url_.