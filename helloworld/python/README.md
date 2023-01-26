# Hello World in Python

## Interpreting instructions for Debian based distributions

Install [Python](https://www.python.org):

```bash
$ sudo apt update
$ sudo apt install -y python3
```

Run from source code:

```bash
python3 helloworld.py
```

## Running from a Docker container

### Steps to run:

1. Installl [Docker](https://www.docker.com)
2. Run `sudo docker build .`
3. Create a tag using `sudo docker image tag [IMAGE ID] python:helloworld`

> Where do I get the IMAGE ID? At the bottom of `sudo docker build` output you can see the IMAGE ID. if you have lost this output, use `sudo docker image ls` to list the images.

4. Create a container: `sudo docker container create python:helloworld`
5. Run container with `sudo docker run python:helloworld &`
6. To access the container console: `sudo docker exec -it [CONTAINER ID] /bin/bash`. You can identify the container from the column IMAGE.
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

3m7,519s

[Go back](../README.md)