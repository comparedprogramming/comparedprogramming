# Hello World in PHP

## Interpreting instructions for Debian based distributions

Install [PHP](https://www.php.net)(PHP Hypertext Preprocessor):

```bash
$ sudo apt update
$ sudo apt install php-dev
```

If installed version is 7, remove it and install 8 following these instructions:

```bash
$ sudo apt update
$ sudo apt -y upgrade
$ sudo apt install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2
$ sudo echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
$ sudo apt install -y wget
$ sudo wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
$ sudo apt update 
$ sudo apt install -y php8.1
```

Run from source code:

```bash
php helloworld.php
```

## Running from a Docker container (PHP 8)

### Steps to run:

1. Installl [Docker](https://www.docker.com)
2. Run `sudo docker build .`
3. Create a tag using `sudo docker image tag [IMAGE ID] php:helloworld`

> Where do I get the IMAGE ID? At the bottom of `sudo docker build` output you can see the IMAGE ID. if you have lost this output, use `sudo docker image ls` to list the images.

4. Create a container: `sudo docker container create php:helloworld`
5. Run container with `sudo docker run php:helloworld &`
6. To access the container console: `sudo docker exec -it [CONTAINER ID] /bin/bash`. You can identify the container Você pode identificar o container pela coluna IMAGE.
7. To stop the container: `sudo docker container stop [CONTAINER ID]`

> Where do I get the CONTAINER ID? Use the command `sudo docker container ls` 

### Image update

1. Remove the stopped containers:

```bash
sudo docker container prune
```

2. Remove the current image:

```bash
sudo docker image rm [IMAGE ID]
```

3. Follow the steps to run

### Time reference for running

**Complete time to run container since Debian image creation**

12m22,873s

[Go back](../README.md)
