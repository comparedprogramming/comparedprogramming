# From a Debian machine, install a NodeJS interpreter, load source code and interprete it
FROM debian

RUN apt update
RUN apt install -y nodejs

COPY helloworld.js .

RUN nodejs helloworld.js

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
