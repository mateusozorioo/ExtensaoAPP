# EXTENSÃO APP

## Vision

**Data:** `06/03/2025`

## EXTENSÃO APP

# Visão

---

## Introdução
  Este documento apresenta a Visão Informal do sistema de automação para verificação e anulação da matéria de Projeto Interdisciplinar (PI) com base na participação dos alunos em Hackathons. O sistema permitirá cadastros de alunos e professores, inscrições, validação de participação, soma de participações, controle de pontuação e um sistema de QR Code para visualização de perfis.
### Posicionamento

#### Instrução do Problema

- **O problema de**  
  Atestar a participação e validação dos alunos em Hackathons para que possam anular a matéria Projeto Interdisciplinar (PI), atualmente realizado de forma manual e burocrática.

- **Afeta**  
  Os alunos, professores e administração acadêmica que necessitam de um processo mais ágil e eficiente.

- **O impacto do qual é**  
  Demora na validação da anulação da matéria, riscos de erro no processo manual e falta de transparência na gestão das participações.

- **Uma solução bem-sucedida seria**  
  Um sistema automatizado que permita o registro, validação e acompanhamento dos alunos e seus respectivos Hackathons, garantindo mais agilidade, segurança e transparência.

#### Instrução sobre a Posição do Produto

- **Para**  
  Alunos e professores universitários, assim como coordenadores e gestores de curso

- **Que**  
  Precisam de um meio eficiente e confiável para registrar, validar e acompanhar a participação dos alunos em Hackathons

- **O (nome do produto)**  
  EXTENSÃO APP é um sistema web integrado

- **Que**  
  Facilita e acelera o processo de verificação e anulação da matéria PI.

- **A menos que**  
  Utilizem o método tradicional manual, sujeito a erros e demoras.

- **Nosso produto**  
  Oferece uma interface intuitiva, segura e automatizada para cadastros, registros e validações, reduzindo a carga burocrática para alunos e professores

---

## Descrições do Envolvido

### Resumo do Envolvido

| Nome  | Descrição | Responsabilidades |
|-------|-----------|------------------|
| Aluno | Usuário final que participa dos Hackathons e busca anular a matéria PI. | Realizar cadastro, inscrever-se em Hackathons, submeter evidências de participação e solicitar exclusão de matéria. |
| Professor | Responsável por validar a participação dos alunos em Hackathons e verificar aqueles que não irão fazer sua matéria. | Avaliar as inscrições, as participações e validar os alunos que anularam sua matéria de PI. |
| Administração Acadêmica | Gerencia o sistema e acompanha os processos. | Garantir a correta implementação das regras e relatórios acadêmicos. |

## Ambiente do Usuário

Detalhe o ambiente de trabalho do usuário alvo. Algumas sugestões:

- O sistema será acessado por alunos, professores e administradores acadêmicos via web.
- O acesso poderá ser feito por desktop e dispositivos móveis.
- A integração com QR Code permitirá uma verificação rápida dos perfis dos alunos.

---

## Visão Geral do Produto

### Perspectiva do Produto

O sistema será uma plataforma web independente, com possibilidade de integração futura com sistemas acadêmicos existentes da universidade.

### Premissas e Dependências

- O sistema necessitará de conexão com a base de dados da universidade para autenticação de alunos e professores.

- QR Codes devem ser gerados e acessíveis em dispositivos móveis.

---

## Necessidades e Recursos

| Necessidade | Prioridade | Recursos | Liberação Planejada |
|------------|-----------|---------|-------------------|
| Cadastro de Alunos e Professores | Alta | Banco de Dados, Interface Web | Segundo semestre |
| Inscrições em Hackathons | Alta | Formulário interativo | Segundo semestre |
| Verificação da anulação dos alunos de PI | Alta | Planilhas, Interface Web | Segundo semestre |
| Integração com QR Code | Média | Gerador e leitor de QR Code | Segundo semestre |

---

## Alternativas e Competição

- Manutenção do método manual atual, que é lento e propenso a erros.
- Desenvolvimento de uma solução interna dentro do portal acadêmico, exigindo recursos adicionais.
- Uso de softwares externos para registro de eventos e participações, sem personalização para a necessidade acadêmica.

---

## Outros Requisitos do Produto

> **Em um alto nível**, liste os padrões aplicáveis, requisitos de hardware ou plataforma, requisitos de desempenho e ambientais.

Defina as **faixas de qualidade** para:

- O sistema deverá seguir padrões de acessibilidade e usabilidade. **Estabilidade**
- Deverá suportar múltiplos dispositivos (desktop e móveis). **Suportabilidade**
- O desempenho deverá garantir um tempo de resposta adequado. **Estabilidade**
- Deverá garantir a segurança e privacidade dos dados dos alunos e professores. **Segurança**

---

## Confidencial

© `<Company Name>`, 2006
