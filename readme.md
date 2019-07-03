
# Ghibli

Este projeto foi desenvolvido entre 01 e 03 de julho de 2019 como um teste técnico para a [GBLIX](http://gblix.net/). O projeto, desenvolvido com o framework Laravel, consistem em uma API que fornece dados a respeito dos personagens do mundialmente conhecido Estúdio Ghibli. Os dados são providos pela API https://ghibliapi.herokuapp.com/.

## Instalação

Como um projeto desenvolvido em Laravel 5.8 é necessário que o ambiente de testes atenda aos [requisitos](https://laravel.com/docs/5.8/installation) do framework. Feito isso, configure o arquivo `.env` na raiz do projeto com as informações a respeito da conexão com o seu banco de dados.  
O banco de dados desse sistema também possui requisitos para que o sistema possa operar. Certifique-se  de criar o banco `ghibli`, para que o sistema possa armazenas as tabelas. Se você está usando MySQL, use o comando `php artisan mysql:createDB` para criar o banco automaticamente.  
Execute o comando `php artisan migrate` para criar as tabelas necessárias para o funcionamento do sistema. Você pode preencher as tabelas recém criadas com dados randômicos usando o comando: `php artisan db:seed`, ou, pode preencher com os dados reais, para isso invoque o Crawler. Você pode fazer isso através do comando: `php artisan api:crawl`.

## API

Para usar a API desse sistema acesse `http://localhost/pessoas?fmt=html`. Serão exibidos os dados devidamente extraídos e formatados em uma tabela HTML. Alterando o parâmetro fmt para *json* ou *csv* os dados serão exibidos em JSon e CSV respectivamente ao invés do HTML.  
Use o parâmetro **sort** para ordenar a tabela mostrada de acordo com uma das colunas. Os valores válidos são:  
* *name*. Nome do personagem.
* *age*. Idade do personagem.
* *movieName*. Nome do filme.
* *movieYear*. Ano de lançamento do filme.
* *rtScore*. Pontuação no Rotten Tomatoes.

Combinando o parâmetro **sort** com **order=asc** ou **order=desc** você poderá alternar entre crescente e decrescente respectivamente.  
Exemplo: `http://localhost/pessoas?fmt=html&sort=movieYear&order=asc`.

Também é possível filtrar uma coluna por um valor especifico, para isso use o parâmetro **filter** da seguinte forma: **filter=chave:valor**.  
Por exemplo: `http://localhost/pessoas?fmt=html&filter=movieYear:2002`.

## O Crawler

TODO