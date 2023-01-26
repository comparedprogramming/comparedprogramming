# From a Debian machine, install a JDK, load source code, and compile it
FROM debian

RUN apt update
RUN apt install -y default-jdk

COPY HelloWorld.java .

RUN javac HelloWorld.java
RUN java HelloWorld

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
