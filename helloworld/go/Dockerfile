# From a Debian machine, install a Go compiler, load source code, and compile it
FROM debian

RUN apt update
RUN apt install -y curl
RUN curl -O https://dl.google.com/go/go1.12.7.linux-amd64.tar.gz
RUN tar xvf go1.12.7.linux-amd64.tar.gz
RUN chown -R root:root ./go
RUN mv go /usr/local
RUN chmod +x /usr/local/go/bin/go
ENV GOPATH=$HOME/work
ENV PATH=$PATH:/usr/local/go/bin:$GOPATH/bin
RUN echo $PATH

COPY helloworld.go .

RUN go run .

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
