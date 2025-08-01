# Sistema de Email BellaCrosta

## Instalação Automática

O sistema agora inicia automaticamente quando você acessa o formulário de email através do PHP.

## Instalação Manual (se necessário)

1. Instale as dependências:
```bash
pip install flask
```

2. Ou execute o verificador de dependências:
```bash
python gmail/check_dependencies.py
```

## Como Usar

1. Acesse o sistema através do menu principal do PHP
2. Clique em "Formulário de Email"
3. O servidor Flask será iniciado automaticamente
4. Preencha o formulário e envie o email

## Solução de Problemas

Se o sistema não iniciar automaticamente:

1. Verifique se o Python está instalado
2. Execute manualmente: `python gmail/app.py`
3. Verifique as dependências: `python gmail/check_dependencies.py`

## Configuração do Gmail

O sistema usa uma conta Gmail configurada. Para usar sua própria conta:

1. Edite o arquivo `Gmail.py`
2. Altere `email_sender` e `senha_sender`
3. Use uma senha de app do Gmail (não a senha normal)
