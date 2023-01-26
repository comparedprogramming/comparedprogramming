# From a Debian machine, install a Python interpreter, load source code and interprete it
FROM debian

RUN apt update
RUN apt install -y python3

COPY helloworld.py .

RUN python3 helloworld.py

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
