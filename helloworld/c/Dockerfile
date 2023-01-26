# From a Debian machine, install a C compiler, load source code and compile it
FROM debian

RUN apt update
RUN apt install build-essential -y

COPY helloworld.c .

RUN gcc helloworld.c -o helloworld

RUN ./helloworld

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
