#!/bin/bash
sudo apt-get update -y
sudo apt-get install apache2 mysql-server mysql-client php php-mysql libapache2-mod-php -y 
# Destination directory
DEST_DIR="/var/www/html/mompopcafe"

# Check if the destination directory exists
if [ ! -d "$DEST_DIR" ]; then
    # If the directory doesn't exist, create it
    sudo mkdir -p "$DEST_DIR"
    
    # Copy files only if the destination directory was created
    if [ $? -eq 0 ]; then
        sudo cp -rf ../../mompopcafe/* "$DEST_DIR/"
        echo "Files copied to $DEST_DIR."
    else
        echo "Failed to create directory $DEST_DIR."
    fi
else
    echo "Directory $DEST_DIR already exists. Skipping copy."
fi
#echo "DocumentRoot /var/www/html/bookalbum" | sudo tee -a  /etc/apache2/sites-available/000-default.conf
#sudo sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/bookalbum|' /etc/apache2/sites-available/000-default.conf
sudo sed -E -i 's|DocumentRoot[[:space:]]+/var/www/html/[^[:space:]]*|DocumentRoot /var/www/html/mompopcafe|' /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
