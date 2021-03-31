# Teste dos caras lá pay 

## Avisos antes de começar

- Crie um repositório no seu GitHub **sem citar nada relacionado a empresa dos cara lá**. (CHECK)
- Faça seus commits no seu repositório. (CHECK)
- Envie o link do seu repositório para o email **talentos_php@empresalápay.com**. (X)
- Você poderá consultar o Google, Stackoverflow ou algum projeto particular na sua máquina. (CHECK)
- Dê uma olhada nos [Materiais úteis](#materiais-úteis). (CHECK)
- Fique à vontade para perguntar qualquer dúvida aos recrutadores. (X)
- Fique tranquilo, respire, assim como você, também já passamos por essa etapa. Boa sorte! :) (X)

*Corpo do Email com o link do repositório do desafio*

>Seu Nome
>
>Nome do recrutador
>
>Link do repositório
>
>Link do Linkedin

## Setup do projeto

- Framework: Lumen Framework
- Ambiente: Local  ¯\\_(ツ)_/¯

## Para o dia da entrevista técnica
Na data marcada pelo recrutador tenha sua aplicação rodando na sua máquina local para execução dos testes e para nos mostrar os pontos desenvolvidos e possíveis questionamentos.

## Objetivo - Teste dos cara lá Simplificado

Temos 2 tipos de usuários, os comuns e lojistas, ambos têm carteira com dinheiro e realizam transferências entre eles. Vamos nos atentar **somente** ao fluxo de transferência entre dois usuários.

Requisitos:

- Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail.

- Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários.

- Lojistas **só recebem** transferências, não enviam dinheiro para ninguém.

- Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo, use este mock para simular (https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6).

- A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia.

- No recebimento de pagamento, o usuário ou lojista precisa receber notificação enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável. Use este mock para simular o envio (https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04).

- Este serviço deve ser RESTFul.

### Payload

Voce pode trazer uma proposta de payload, mas trazemos um exemplo aqui:

POST /transaction

```json
{
    "value" : 100.00,
    "payer" : 4,
    "payee" : 15
}
```


# Avaliação

Apresente sua solução utilizando o framework que você desejar, justificando a escolha.
Atente-se a cumprir a maioria dos requisitos, pois você pode cumprir-los parcialmente e durante a avaliação vamos bater um papo a respeito do que faltou.

Teremos 2 partes da avaliação:

A correção objetiva será realizada através da utilização de um script de correção automatizada.

A correção qualitativa será durante a entrevista e levará em conta os seguintes critérios:

## O que será avaliado e valorizamos :heart:
- Documentação
- Se for para vaga sênior, foque bastante no **desenho de arquitetura**
- Código limpo e organizado (nomenclatura, etc)
- Conhecimento de padrões (PSRs, design patterns, SOLID)
- Ser consistente e saber argumentar suas escolhas
- Apresentar soluções que domina
- Modelagem de Dados
- Manutenibilidade do Código
- Tratamento de erros
- Cuidado com itens de segurança
- Arquitetura (estruturar o pensamento antes de escrever)
- Carinho em desacoplar componentes (outras camadas, service, repository)

De acordo com os critérios acima, iremos avaliar seu teste para avançarmos para a entrevista técnica.
Caso não tenha atingido aceitavelmente o que estamos propondo acima, não iremos prosseguir com o processo.

## O que NÃO será avaliado :warning:
- Fluxo de cadastro de usuários e lojistas
- Frontend (só avaliaremos a API Restful)

## O que será um diferencial
- Uso de Docker
- Testes de [integração](https://www.atlassian.com/continuous-delivery/software-testing/types-of-software-testing)
- Testes [unitários](https://www.atlassian.com/continuous-delivery/software-testing/types-of-software-testing)
- Uso de Design Patterns
- Documentação
- Proposta de melhoria na arquitetura


## Materiais úteis
- https://hub.packtpub.com/why-we-need-design-patterns/
- http://br.phptherightway.com/
- https://www.php-fig.org/psr/psr-12/
- https://www.atlassian.com/continuous-delivery/software-testing/types-of-software-testing
- https://github.com/exakat/php-static-analysis-tools
- https://martinfowler.com/articles/microservices.htm

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
