# Étape 1 : Utiliser une image officielle de PHP avec Apache (version slim pour réduire la taille)
FROM php:8.2-apache

# Étape 2 : Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Étape 3 : Installer Composer depuis une image officielle Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Étape 4 : Créer un utilisateur non-root pour exécuter l'application
RUN useradd -m laraveluser

# Étape 5 : Configurer les permissions pour Laravel
WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R laraveluser:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Étape 6 : Activer le module Apache mod_rewrite
RUN a2enmod rewrite

# Étape 7 : Copier la configuration Apache personnalisée
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Étape 8 : Exposer le port 80 (à ajuster si nécessaire)
EXPOSE 80

# Étape 9 : Passer à l'utilisateur non-root
USER laraveluser

# Étape 10 : Commande de démarrage
CMD ["apache2-foreground"]
