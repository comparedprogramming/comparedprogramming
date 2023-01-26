# Hello World in Go

## Compiling instructions for Debian based distributions

Install [Go](https://go.dev). Update the version number according to the package availability.

```bash
$ sudo apt update
$ sudo apt install -y curl
$ sudo curl -O https://dl.google.com/go/go1.12.7.linux-amd64.tar.gz
$ sudo tar xvf go1.12.7.linux-amd64.tar.gz
$ sudo chown -R root:root ./go
$ sudo mv go /usr/local
$ sudo echo "export GOPATH=$HOME/work" >> ~/.profile
$ sudo echo "export PATH=$PATH:/usr/local/go/bin:$GOPATH/bin" >> ~/.profile
$ sudo source ~/.profile```
```

Compile and run:

```bash
go run .
```

## Running from a Docker container

### Steps to run:

1. Installl [Docker](https://www.docker.com)
2. Run `sudo docker build .`
3. Create a tag using `sudo docker image tag [IMAGE ID] go:helloworld`

> Where do I get the IMAGE ID? At the bottom of `sudo docker build` output you can see the IMAGE ID. if you have lost this output, use `sudo docker image ls` to list the images.

4. Create a container: `sudo docker container create go:helloworld`
5. Run container with `sudo docker run go:helloworld &`
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

43m21,936s

[Go back](../README.md)