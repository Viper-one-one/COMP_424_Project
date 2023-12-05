#!/bin/bash
# Start Apache and MySQL services
# Profile opens port 443 (TLS/SSL encrypted traffic) & port 80 (unencrypted traffic) which we need
sudo ufw allow 'Apache Full'

# restart apache2/web service system
sudo systemctl reload apache2 
#sudo systemctl start apache2

#Start mysql
sudo systemctl start mysql

# Enable Apache and MySQL to start on boot
sudo systemctl enable apache2
sudo systemctl enable mysql

#Configure iptables rules
sudo iptables -L -v
#alllows ssh port(22) and http port (80) and 443 (SSL) and denies incoming traffic 
sudo iptables -A
# enable traffic to localhost
sudo iptables -A INPUT -i lo -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 22 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT
sudo /sbin/iptables-save

# Download Community Rules
sudo mkdir /etc/snort/rules
sudo wget https://www.snort.org/downloads/community/community-rules.tar.gz -O /tmp/snortrules.tar.gz
sudo tar -xzvf /tmp/snortrules.tar.gz -C /etc/snort/rules
sudo rm /tmp/snortrules.tar.gz

# Configure Snort
#add some logic here to get dynamic ip if one can
sed -i -e 's/ipvar HOME_NET.*/ipvar HOME_NET 172.31.18.125\/20/g' /etc/snort/snort.conf
sudo ip link set eth0 promisc on
sudo snort -d -l /var/log/snort/ -h 172.31.18.125/20 -A console -c /etc/snort/snort.conf

#Configuring Virtual Host (For testing we are 424GroupFive)
sudo touch /etc/apache2/sites-available/424GroupFive.com.conf

#Write to conf file, can we do this better? 
#sudo vim /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  ServerName 424GroupFive.com" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  ServerAlias www.424GroupFive.com" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  ServerAdmin sergio.ramirez.754@my.csun.edu" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  DocumentRoot /var/www/424GroupFive.com" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "  CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/424GroupFive.com.conf
sudo echo "</VirtualHost>" >> /etc/apache2/sites-available/424GroupFive.com.conf

# used a2ensite tool to enable the site
sudo a2ensite 424GroupFive.com.conf
# disable default site
sudo a2dissite 000-default.conf
# restarted Apache2
sudo systemctl restart apache2
# An unexpected error occurred:
# There were too many requests of a given type :: Error creating new order :: too many failed authorizations recently: see https://letsencrypt.org/docs/failed-validation-limit/
#----------Configuring SSL Certificate to site----------#
sudo certbot --apache -d 424GroupFive.com
# set Alias for subdomains to work with certificate
sudo certbot --apache -d 424GroupFive.com -d www.424GroupFive.com