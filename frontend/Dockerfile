FROM php:8.3-apache
# Instala extensões do PostgreSQL e utilitários
RUN apt-get update && apt-get install -y

# Copia os arquivos do projeto para o container
COPY . /var/www/html

# Permissões e habilita o mod_rewrite (se usar Laravel, por exemplo)
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

WORKDIR /var/www/html