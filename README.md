# Trabalho Final de Projeto e Gerência de Banco de Dados
Disciplina de Projeto e Gerência de Banco de Dados | 5° semestre do curso de Sistemas de Informação UFSM
####Grupo: Anthony Tailer, Lucas Lima (http://github.com/lucaslioli)

# Descrição

### O trabalho é dividido em 4 etapas:

#### Criação do Banco de Dados

* Escolher uma planilha com **dados abertos** disponibilizados na Web.
	- **Planilha escolhida:** Reclamações do consumidor.gov.br
	- **Disponível em:** https://goo.gl/ai0KCR  
* Criar um banco de dados normalizado que suporte os dados da planilha.
* Criação de uma ferramenta de visualização de dados.
	- Podendo ser desenvolvida usando:
		+ Qualquer linguagem de programação
		+ Qualquer framework de desenvolvimento
		+ Qualquer tipo de arquitetura/padrão de desenvolvimento
		+ Qualquer plataforma de acesso (web, Desktop, Mobile..)
			
#### Importação dos dados a partir de uma fonte de dados

- A aplicação deve ter um recurso que permita a **importação de dados** a partir de uma fonte de dados.
	+ Podendo ser uma planilha ou arquivo texto gerado a partir da planilha.
	+ Os dados devem ser importados no banco de dados da aplicação.

#### Acesso aos dados a partir de formulários de consulta

- A aplicação deve ter formulários que permitam navegar pelos registros de cada uma das tabelas existentes.
- Para tabelas que possuem chaves estrangeiras, deve-se exibir:
	+ As colunas da respectiva chave primária, **NÃO** o valor da chave estrangeira

#### Acesso aos dados a partir de relatórios gráficos

- A aplicação deve gerar relatórios gráficos acessando estatísticas a partir das tabelas existentes.
- Pelo menos 3 relatórios devem ser gerados
	+ Pelo menos um dos relatórios deve ser de distribuição espacial
	+ Para isso, é importante que os dados possuam algum tipo de referência geográfica
- Os relatórios devem permitir filtros
	+ Deve ser possível que o gráfico condense apenas os registros que satisfaçam alguma condição de filtro

