# From a Debian machine, install a PHP interpreter, load source code and interprete it
FROM debian

RUN apt update
RUN apt -y upgrade
RUN apt install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
RUN apt install -y wget
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
RUN apt update 
RUN apt install -y php8.1

COPY helloworld.php .

RUN php helloworld.php

# Keep container running after creation, so you can access it
CMD tail -f /dev/null
