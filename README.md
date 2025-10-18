# 🧩 Teste Vox

Clone o repositório:
```bash
git clone https://github.com/Jenifferhinckel/teste-vox.git
cd teste-vox
```

Instale as dependências do Laravel:
```bash
composer install
```

Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

Configure o banco de dados no arquivo `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=root
```

Execute as migrações e o seeder:
```bash
php artisan migrate
php artisan db:seed
```

Inicie o servidor local:
```bash
php artisan serve
```

Acesse o sistema no navegador:
[http://localhost:8000](http://localhost:8000)

Login de teste:
```text
E-mail: teste@teste.com
Senha: 10203040
```
