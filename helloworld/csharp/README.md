# Hello World in C#

## Compiling instructions for Debian based distributions

Install [Mono](https://www.mono-project.com):

```bash
$ sudo apt update
$ sudo apt install -y dirmngr gnupg apt-transport-https ca-certificates
$ sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys 3FA7E0328081BFF6A14DA29AA6A19B38D3D831EF
$ sudo sh -c 'echo "deb https://download.mono-project.com/repo/debian stable-buster main" > /etc/apt/sources.list.d/mono-official-stable.list'
$ sudo apt update
$ sudo apt install -y mono-complete
```

Compile:

```bash
csc HelloWorld.cs
```

Run:

```bash
mono HelloWorld.exe
```

## Running from a Docker container

### Steps to run:

1. Installl [Docker](https://www.docker.com)
2. Run `sudo docker build .`
3. Create a tag using `sudo docker image tag [IMAGE ID] csharp:helloworld`

> Where do I get the IMAGE ID? At the bottom of `sudo docker build` output you can see the IMAGE ID. if you have lost this output, use `sudo docker image ls` to list the images.

4. Create a container: `sudo docker container create csharp:helloworld`
5. Run container with `sudo docker run csharp:helloworld &`
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

18m16,241s

[Go back](../README.md)