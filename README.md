# Inventário de Computadores

Sistema web simples para cadastro, edição e controle de computadores em estoque.  
Ideal para pequenas empresas, escolas ou uso pessoal.

## 🚀 Funcionalidades

- Cadastro de computadores (patrimônio, usuário, setor, marca, modelo)
- Edição e exclusão de registros
- Busca e listagem em tabela responsiva
- Modal (pop-up) para cadastro e edição
- Visual limpo e responsivo para desktop e mobile

## 🖥️ Tecnologias

- **PHP** (procedural)
- **MySQL** (banco de dados)
- **HTML5 & CSS3**
- **JavaScript** (para modais)
- Sem frameworks, fácil de adaptar!

## 📦 Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/foxdieone/controle_pc.git
   ```

2. **Configure o banco de dados:**
   - Crie um banco MySQL e importe a tabela `computadores` (veja exemplo abaixo).
   - Ajuste as credenciais em `conexao.php`:
     ```php
     $servidor = 'localhost';
     $usuario_db = 'SEU_USUARIO';
     $senha_db = 'SUA_SENHA';
     $banco_de_dados = 'SEU_BANCO';
     ```

3. **Suba os arquivos para seu servidor ou use localmente com WAMP/XAMPP.**

## 🗄️ Exemplo de tabela MySQL

```sql
CREATE TABLE `computadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patrimonio` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `setor` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT CURRENT_DATE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## 📱 Responsividade

O sistema é responsivo e funciona bem em celulares e tablets.

## 💡 Personalização

- Para mudar as cores, edite o arquivo `style.css`.
- Para adicionar novos campos, ajuste o banco e os formulários.

## 🛡️ Segurança

- Uso de `htmlspecialchars` para evitar XSS.
- Prepared statements para evitar SQL Injection.

## 📝 Licença

Este projeto é livre para uso e modificação.  
Se usar, deixe uma estrela ⭐ e contribua!

---

Feito com 💻 por [Marcos](https://github.com/FoxDieOne)
