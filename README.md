Plataforma de Emissão de Certificados Acadêmicos
Descrição
Esta aplicação permite a emissão de certificados acadêmicos e gerenciamento de usuários, funções (roles) e permissões utilizando Laravel e Laratrust.

Pré-requisitos
* PHP >= 8.1
* Composer
* MySQL ou outro banco compatível
* Node.js e npm (opcional, se houver front-end)

Instalação
1. Clonar o repositório
git clone <URL_DO_REPOSITORIO>
cd <NOME_DA_PASTA>
1. Instalar dependências do PHP
composer install
1. Criar e configurar o arquivo .env
cp .env.example .env
Edite o .env com as configurações do seu banco de dados, como DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME e DB_PASSWORD.
1. Gerar chave da aplicação
php artisan key:generate
1. Rodar migrations e seeders
php artisan migrate:fresh --seed
Este comando cria todas as tabelas e popula roles, permissões e usuários padrão.
1. Limpar caches (opcional)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
1. Rodar o servidor local
php artisan serve
Acesse em http://127.0.0.1:8000.

Roles e Usuários Padrão
O seeder do Laratrust cria automaticamente roles, permissões e usuários de exemplo:
Role	Usuário	Senha
Administrator	administrator@app.com	password
Director	director@app.com	password
Office	office@app.com	password
OfficeTitular	officeTitular@app.com	password
Professor	professor@app.com	password
Funcionario	funcionario@app.com	password
Estes usuários podem ser usados para login e testes iniciais.

Observações
* As permissões são configuradas de acordo com a estrutura definida em config/laratrust_seeder.php.
* A aplicação utiliza Laratrust para gerenciamento de roles e permissões.
* Alterações no .env requerem limpar o cache de configuração:
php artisan config:cache

Comandos Úteis
* Rodar migrations e seeders: php artisan migrate:fresh --seed
* Limpar caches: php artisan optimize:clear
* Rodar servidor local: php artisan serve

Contribuição
1. Crie uma branch para sua feature:
git checkout -b minha-feature
1. Faça commits claros:
git commit -m "Descrição da feature"
1. Envie para o repositório remoto:
git push origin minha-feature
1. Abra um Pull Request.

Licença
MIT License
