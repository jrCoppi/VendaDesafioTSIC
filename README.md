# Sistema de Vendas TSIC

- Requisitos: 
    Apache HTTP server
    PHP v.5.6 or later 
    MySQL v.5.6 or later
    Composer

## Setup

# Arquivos
- Baixar os arquivos do projeto para um caminho conhecido pelo seu servidor.
- Para acessar o sistema após a instalação deve ser apontado para o caminho dos arquivos + '/public' para chegar a home page da aplicação.

# Composer/Zend

- Após baixar os arquivos, na pasta dos arquivos executar o composer com o comando abaixo:

```
php composer.phar install
composer install (alternativa)
```

# Base de Dados
- Criar o banco de dados, rodando o arquivo Script.sql da raiz do projeto
- Criar o arquivo de conexão do Doctrine com a base, dentro da pasta config/autoload criar um arquivo chamado doctrine_orm.local.php com o seguinte conteudo (e suas configurações)

```
<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => '',
                    'port'     => '',
                    'user'     => '',
                    'password' => '',
                    'dbname'   => 'vendatsic',
                )
            )
        )
    ),
);
```

Após realizar este processo você pode visualizar o sistema no diretorio_do_servidor/caminho_do_arquivo/public