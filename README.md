#DISCLAIMER
O projeto foi construido utilizando as seguintes tecnologias e conceitos:
* Arquitetura em Camadas
* Desacoplamento
* Testes unitários
* PHP 7.3
* Laravel Framework
* Docker
* Docker-compose


# CONFIGURAÇÕES
## AMBIENTE
Para rodar o projeto é bem simples e fácil, basta rodar os dois seguintes comandos:
```
docker-compose build
docker-compose up
```
Estes comandos irão criar a imagem do php-fpm que é a única que eu tive necessidade de personalizar e será também usada pelo container *artisan* para importar a *migration* com o schema que eu criei para armazenar os xmls, e irá rodar os containers de modo que fique anexado ao terminal para analisar possíveis logs.

O arquivo *.env.sample* na raiz do projeto contem as configurações padrões para o projeto, basta renomear para *.env* para que o o docker-compose defina as variáveis de ambiente para os containers.

## APLICAÇÃO
Ainda na raiz do projeto, no arquivo *.env*, deve-se preencher os campos *API_KEY* e *API_ID* para ter acesso a API da Arquivei.

## PROJETO
O projeto foi desenvolvido de tal forma que isola-se a camada de domínio do usuário, evitando assim que acesse diretamente o domínio. As informações de domínio apenas são acessas através de serviços.

Sendo assim foram criados dois *endpoints* para interagir com aplicação e serviço da Arquivei, são eles:
```
GET /api/nfe/{accessKey}
POST /api/nfe/feed
```

### GET /api/nfe/{accessKey}
Endpoint responsável por retornar o XML armazenado no banco de dados local tendo como parâmetro a chave de acesso do XML.

### POST /api/nfe/feed
Endpoint responsável por enviar a requisição para o serviço da Arquivei e então assim alimentar o banco de dados com as informações.

# Testes unitários
Para rodar os testes faz-se necessário possuir o *PHP* instalado na máquina para rodar o *PHPUnit* que vem com o Laravel.
```
php vendor/bin/phpunit
```

O comando acima irá rodar a suite de testes e caso seja do agrado poderá também interagir com o *artisan* para fazer coisas além do que meu container foi projetado.