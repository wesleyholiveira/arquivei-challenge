# DISCLAIMER
O projeto foi construido utilizando as seguintes tecnologias e conceitos:
* Arquitetura em Camadas
* Desacoplamento
* Testes unitários
* PHP 7.3
* Laravel Framework
* Docker
* Docker-compose


# CONFIGURAÇÕES
### AMBIENTE
Para rodar o projeto é bem simples e fácil, basta rodar os dois seguintes comandos:
```
docker-compose build
docker-compose up
```
Estes comandos irão criar a imagem do php-fpm que é a única que eu tive necessidade de personalizar e será também usada pelo container **artisan** para importar a **migration** com o schema que eu criei para armazenar os xmls, e irá rodar os containers de modo que fique anexado ao terminal para analisar possíveis logs.

O arquivo **.env.sample** na raiz do projeto contem as configurações padrões para o projeto, basta renomear para **.env** para que o o docker-compose defina as variáveis de ambiente para os containers.

## APLICAÇÃO
Ainda na raiz do projeto, no arquivo **.env**, deve-se preencher os campos **API_KEY** e **API_ID** para ter acesso a API da Arquivei.

Adicionei também a possibilidade de se configurar a URL do serviço da Arquivei e os parâmetros da requisição, basta acessar o seguinte caminho: **arquivei-challenge/arquivei/config/app.php**, onde na linha *59* até a linha *67* é a seção reservada para tal configuração.

## PROJETO
O projeto foi desenvolvido de tal forma que isola-se a camada de domínio do usuário, evitando assim que acesse diretamente o domínio. As informações de domínio apenas são acessas através de serviços.

Sendo assim foram criados dois **endpoints** para interagir com aplicação e serviço da Arquivei, são eles:
```
GET /api/nfe/{accessKey}
POST /api/nfe/feed
```

Ainda sobre a estrutura do projeto, dentro de **arquivei** fica o web app com **Laravel** propriamente dito, enquanto dentro de **infrastructure** ficam os arquivos de configuração para o nginx dentro do container.
A pasta **data** será criada como volume para armazenar os arquivos do **MySQL**.

## ENDPOINTS
### GET /api/nfe/{accessKey}
Endpoint responsável por retornar o XML armazenado no banco de dados local tendo como parâmetro a chave de acesso do XML.

### POST /api/nfe/feed
Endpoint responsável por enviar a requisição para o serviço da Arquivei e então assim alimentar o banco de dados com as informações.

# Testes unitários
Para rodar os testes basta executar o script criado em **arquivei-challenge/infrastructure/tests.sh** passando como parâmetro os dados de conexão com o banco de dados, segue um exemplo abaixo:
```
./infrastructure/scripts/tests.sh arquivei root 123mudar
```