# Jellyfish E-commerce

Plataforma de e-commerce desenvolvida em Laravel com processamento de pedidos via mensageria (RabbitMQ).

## 🚀 Configuração Rápida do Ambiente

### Pré-requisitos

- Docker e Docker Compose instalados
- Git
- Token do GitHub (necessário para instalar dependências)

### Serviços

- **Laravel 12** (PHP 8.5)
- **MySQL 8.4**
- **RabbitMQ 3.13** com painel de gerenciamento

### Instalação

1. **Clone o repositório**:
```bash
git clone <seu-repositorio>
cd jellyfish-ecommerce
```

2. **Crie um token do GitHub**:
   - Acesse: https://github.com/settings/tokens
   - Clique em "Generate new token (classic)"
   - Não precisa marcar nenhuma permissão/escopo
   - Copie o token gerado

3. **Copie o arquivo de ambiente**:
```bash
cp .env.example .env
```

4. **Configure as variáveis de ambiente no .env**:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=jellyfish
DB_USERNAME=sail
DB_PASSWORD=password

RABBITMQ_HOST=rabbitmq
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASSWORD=guest
```

5. **Instale as dependências com Docker** (substitua `SEU_TOKEN_AQUI` pelo token do GitHub):

**Linux/Mac:**
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -v "$HOME/.composer:/tmp/composer" \
    -e COMPOSER_HOME=/tmp/composer \
    -e COMPOSER_AUTH='{"github-oauth":{"github.com":"SEU_TOKEN_AQUI"}}' \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

**Windows (PowerShell):**
```powershell
docker run --rm -v ${PWD}:/var/www/html -e COMPOSER_AUTH='{\"github-oauth\":{\"github.com\":\"SEU_TOKEN_AQUI\"}}' -w /var/www/html laravelsail/php84-composer:latest composer install --ignore-platform-reqs
```

6. **Suba os containers com Sail**:
```bash
./vendor/bin/sail up -d
```

7. **Gere a chave da aplicação**:
```bash
./vendor/bin/sail artisan key:generate
```

8. **Execute as migrations**:
```bash
./vendor/bin/sail artisan migrate
```

9. **Instale dependências do NPM**:
```bash
./vendor/bin/sail npm install
```

10. **Compile os assets** (opcional):
```bash
./vendor/bin/sail npm run dev
```

### URLs de Acesso

- **Aplicação**: http://localhost
- **RabbitMQ Management**: http://localhost:15672 (usuário: guest, senha: guest)

## 📋 Comandos Úteis

### Gerenciamento de Containers

```bash
# Iniciar containers
./vendor/bin/sail up -d

# Parar containers
./vendor/bin/sail down

# Ver logs
./vendor/bin/sail logs

# Reconstruir containers
./vendor/bin/sail build --no-cache
```

### Laravel Artisan

```bash
# Executar comandos artisan
./vendor/bin/sail artisan <comando>

# Exemplos:
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan tinker
./vendor/bin/sail artisan cache:clear
./vendor/bin/sail artisan config:clear
```

### Composer

```bash
# Instalar dependências
./vendor/bin/sail composer install

# Atualizar dependências
./vendor/bin/sail composer update

# Adicionar novo pacote
./vendor/bin/sail composer require <pacote>
```

### NPM

```bash
# Instalar dependências
./vendor/bin/sail npm install

# Modo desenvolvimento (watch)
./vendor/bin/sail npm run dev

# Build para produção
./vendor/bin/sail npm run build
```

### Testes

```bash
# Executar todos os testes
./vendor/bin/sail artisan test

# Executar testes com cobertura
./vendor/bin/sail artisan test --coverage
```

### Banco de Dados

```bash
# Acessar o MySQL
./vendor/bin/sail mysql

# Executar migrations
./vendor/bin/sail artisan migrate

# Resetar banco de dados
./vendor/bin/sail artisan migrate:fresh

# Resetar e popular
./vendor/bin/sail artisan migrate:fresh --seed
```

## 🛠️ Atalhos (Opcional)

Para facilitar, você pode criar alias no seu terminal:

```bash
# Adicione ao seu ~/.bashrc ou ~/.zshrc
alias sail='./vendor/bin/sail'
alias jellyapi='docker exec -it jelly-api'
alias jellydb='docker exec -it jelly-mysql mysql -usail -ppassword'
alias jellyrabbit='docker exec -it jelly-rabbitmq'
```

Depois é só usar:
```bash
sail up -d
sail artisan migrate
```

## 🔧 Solução de Problemas

### Porta 80 já está em uso
Se a porta 80 estiver ocupada, edite o arquivo [.env](.env) e altere:
```
APP_PORT=8000
```
A aplicação ficará disponível em http://localhost:8000

### Permissões de arquivo
Se houver problemas com permissões:
```bash
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

### Containers não sobem
```bash
./vendor/bin/sail down
docker system prune -a
./vendor/bin/sail up -d
```

### Erro 504 ao instalar dependências
Certifique-se de que você substituiu `SEU_TOKEN_AQUI` pelo token real do GitHub no comando de instalação.

## 📚 Documentação

- [Laravel](https://laravel.com/docs)
- [Laravel Sail](https://laravel.com/docs/sail)
- [Docker](https://docs.docker.com/)

## 📄 Licença

Este projeto é open-source licenciado sob a [MIT license](https://opensource.org/licenses/MIT).