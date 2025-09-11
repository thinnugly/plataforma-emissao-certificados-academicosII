# Plataforma de Emissão de Certificados Acadêmicos

## Descrição

Esta aplicação permite a emissão de certificados acadêmicos e gerenciamento de usuários, funções (roles) e permissões utilizando Laravel e Laratrust.

---

## Pré-requisitos

* PHP >= 8.1
* Composer
* MySQL ou outro banco compatível
* Node.js e npm (opcional, se houver front-end)

---

## Instalação

1. **Clonar o repositório**

```bash
git clone <URL_DO_REPOSITORIO>
cd <NOME_DA_PASTA>
```

2. **Instalar dependências do PHP**

```bash
composer install
```

3. **Criar e configurar o arquivo `.env`**

```bash
cp .env.example .env
```

Edite o `.env` com as configurações do seu banco de dados, como `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD`.

4. **Gerar chave da aplicação**

```bash
php artisan key:generate
```

5. **Rodar migrations e seeders**

```bash
php artisan migrate:fresh --seed
```

> Este comando cria todas as tabelas e popula roles, permissões e usuários padrão.

6. **Limpar caches (opcional)**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

7. **Rodar o servidor local**

```bash
php artisan serve
```

Acesse em `http://127.0.0.1:8000`.

---

## Roles e Usuários Padrão

O seeder do Laratrust cria automaticamente roles, permissões e usuários de exemplo:

| Role          | Usuário                                               | Senha    |
| ------------- | ----------------------------------------------------- | -------- |
| Administrator | [administrator@app.com](mailto:administrator@app.com) | password |
| Director      | [director@app.com](mailto:director@app.com)           | password |
| Office        | [office@app.com](mailto:office@app.com)               | password |
| OfficeTitular | [officeTitular@app.com](mailto:officeTitular@app.com) | password |
| Professor     | [professor@app.com](mailto:professor@app.com)         | password |
| Funcionario   | [funcionario@app.com](mailto:funcionario@app.com)     | password |

> Estes usuários podem ser usados para login e testes iniciais.

---

## Observações

* As permissões são configuradas de acordo com a estrutura definida em `config/laratrust_seeder.php`.
* A aplicação utiliza Laratrust para gerenciamento de roles e permissões.
* Alterações no `.env` requerem limpar o cache de configuração:

```bash
php artisan config:cache
```

---

## Comandos Úteis

* Rodar migrations e seeders: `php artisan migrate:fresh --seed`
* Limpar caches: `php artisan optimize:clear`
* Rodar servidor local: `php artisan serve`

---

## Contribuição

1. Crie uma branch para sua feature:

```bash
git checkout -b minha-feature
```

2. Faça commits claros:

```bash
git commit -m "Descrição da feature"
```

3. Envie para o repositório remoto:

```bash
git push origin minha-feature
```

4. Abra um Pull Request.

---

## Licença

MIT License
