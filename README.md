# ⚡&nbsp; Sulu Symfony template project

[Sulu](https://sulu.io/) is a highly extensible open-source **PHP content management system based** on the [Symfony](https://symfony.com/) framework. Sulu is developed to deliver robust **multi-lingual and multi-portal websites** while providing an **intuitive and extensible administration interface** to manage the full content lifecycle.

This repository provides the recommended **project template for starting a new icapps PHP project based on the Sulu content management system**.
The project template follows the best-practices of the [Symfony](https://symfony.com/) framework and builds upon tho official [symfony/skeleton](https://github.com/symfony/skeleton) template. In addition, it requires and configures the Sulu content management system core framework [sulu/sulu](https://github.com/sulu/sulu).

## 🚀&nbsp; Installation and Documentation

This project is set-up using [Symfony Local Webserver](https://symfony.com/doc/current/setup/symfony_server.html):

```bash
docker-compose up -d --build
symfony proxy:start
symfony server:start --dir=symfony
```

For initial set-up, run:
```bash
bin/adminconsole sulu:build dev --destroy
```

## icapps ❤️ PHP

For further questions, ask the icapps PHP team.

## ✅&nbsp; Requirements

This project requires a **PHP version higher or equal to 7.2** and is compatible with every **Symfony version starting from 4.3**.


## 📘&nbsp; License
Symfony + Sulu is released under the under terms of the [MIT License](LICENSE).
