my_library
A Symfony project created on June 6, 2019, 4:22 pm.

project-library application to classify these books / manga / comics, so maybe something else like these wargam figurines (warhammer 40k for example) and others (Symfony then an Android version)

Procedure de déploiement: a faire. techno:Symfony 4

```bash
compose install

php bin/console doctine:database:create
php bin/console doctine:schema:create

php bin/console doctrine:fixtures:load
```
Install ES
- [Windows](https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.6.2-windows-x86_64.zip)
  - unzip and `.\bin\elasticsearch.bat`
- [Other platform](https://www.elastic.co/guide/en/elasticsearch/reference/current/install-elasticsearch.html)

```bash
php bin/console elastic:index-builder editor
php bin/console elastic:index-builder book
php bin/console elastic:index-builder author

php bin/console elastic:index-book YYYY-MM-DD
```