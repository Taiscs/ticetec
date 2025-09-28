# Usa imagem PHP com servidor embutido
FROM php:8.2-cli

WORKDIR /var/www

# Copia os arquivos do projeto para dentro do container
COPY . .

# Expõe a porta que a Render usa
EXPOSE 8000

# Inicia o servidor PHP embutido
CMD php -S 0.0.0.0:$PORT -t .
