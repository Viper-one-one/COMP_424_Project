#!/bin/bash
#script to initialize ubuntu AMI (EC2)
#Skip restart prompt when executing upgrade
echo -e "Installing necessary server tools..."
#Get latest packages and install
sudo apt update
sudo apt upgrade -y
#Install Apache
sudo apt-get install apache2 apache2-doc apache2-mpm-prefork apache2-utils libexpat1 ssl-cert -y
#Install mysql
sudo apt-get install mysql-server mysql-client -y
#Install Php and dependendency
sudo apt-get install libapache2-mod-php php-mysql -y
#Set Permissions
sudo chown -R www-data:www-data /var/www
#Allow writing modules 
sudo a2enmod rewrite
sudo phpenmod mcrypt
#IpTables installed by default
sudo apt upgrade iptables
#Get Snort tool and skip dialog s
sudo apt-get install snort -y

#libraries for other project requirements
#library for easy mail options
sudo apt-get install libphp-phpmailer
#Use composer - like gradle/maven
sudo apt-get install composer
composer require phpmailer/phpmailer
#SSL certificate 
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get install python3-certbot-apache
#sed installed by default
sudo apt upgrade sed
echo -e "Finished installing necessary server tools"
echo -e "Please run implementation.sh to continue"