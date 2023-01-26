# From a Debian machine, install a Ruby interpreter, load source code and interprete it
FROM debian

RUN apt update
RUN apt install -y ruby

COPY helloworld.rb .

RUN irb helloworld.rb

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
