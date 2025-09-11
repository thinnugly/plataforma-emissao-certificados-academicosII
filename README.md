# Academic Certificates Issuing Platform

## Description

This application allows the issuance of academic certificates and the management of users, roles, and permissions using Laravel and Laratrust.

---

## Prerequisites

* PHP >= 8.1
* Composer
* MySQL or another compatible database
* Node.js and npm

---

## Installation

1. **Clone the repository**

```bash
git clone https://github.com/thinnugly/plataforma-emissao-certificados-academicosII.git
cd plataforma-emissao-certificados-academicosII
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Create and configure the `.env` file**

```bash
cp .env.example .env
```

Edit the `.env` file with your database settings, such as `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Run migrations and seeders**

```bash
php artisan migrate:fresh --seed
```

> This command will create all tables and populate roles, permissions, and default users.

6. **Clear caches (optional)**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

7. **Install NPM dependencies (Frontend)**

```bash
npm install
```

8. **Run the local development server**

```bash
php artisan serve
```

Access the application at `http://127.0.0.1:8000`.

---

## Default Roles and Users

The Laratrust seeder automatically creates roles, permissions, and example users:

| Role          | Usuário                                               | Senha    |
| ------------- | ----------------------------------------------------- | -------- |
| Administrator | [administrator@app.com](mailto:administrator@app.com) | password |
| Director      | [director@app.com](mailto:director@app.com)           | password |
| Office        | [office@app.com](mailto:office@app.com)               | password |
| OfficeTitular | [officeTitular@app.com](mailto:officeTitular@app.com) | password |
| Professor     | [professor@app.com](mailto:professor@app.com)         | password |
| Funcionario   | [funcionario@app.com](mailto:funcionario@app.com)     | password |

> You can use these users to log in and perform initial tests.

---

## Notes

* Permissions are configured according to the structure defined in `config/laratrust_seeder.php`.
* The application uses Laratrust for role and permission management.
* Changes in the `.env` file require clearing the configuration cache:

```bash
php artisan config:cache
```

---

## Useful Commands

* Run migrations and seeders: `php artisan migrate:fresh --seed`
* Clear all caches: `php artisan optimize:clear`
* Start local development server: `php artisan serve`

---

## Contribution

1. Create a branch for your feature:

```bash
git checkout -b my-feature
```

2. Make clear commits:

```bash
git commit -m "Feature description"
```

3. Push to the remote repository:

```bash
git push origin my-feature
```

4. Open a Pull Request.

---

## License

MIT License

