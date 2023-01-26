# From a Debian machine, install a .NET compiler, load source code, and compile it
FROM debian

RUN apt update
RUN apt install -y dirmngr gnupg apt-transport-https ca-certificates
RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys 3FA7E0328081BFF6A14DA29AA6A19B38D3D831EF
RUN sh -c 'echo "deb https://download.mono-project.com/repo/debian stable-buster main" > /etc/apt/sources.list.d/mono-official-stable.list'
RUN apt update
RUN apt install -y mono-complete 

COPY HelloWorld.cs .

RUN csc HelloWorld.cs
RUN mono HelloWorld.exe

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
