#!/bin/bash
if [ "$USER" != 'root' ]; then
	echo "Sorry, you need to run this as root"
	exit
fi

if [ ! -e /dev/net/tun ]; then
	echo "TUN/TAP is not available"
	exit
fi

random-string()
{
    cat /dev/urandom | tr -dc "a-zA-Z0-9@#$%^&*()_+?><~\`;'" | fold -w ${1:-32} | head -n 1
}

mysql_root_pass=$( random-string 10 )

sed -i "s/mysql_root_pass=''/mysql_root_pass='$mysql_root_pass'/" "config.txt"

wget -O - https://swupdate.openvpn.net/repos/repo-public.gpg | apt-key add -
echo "deb http://build.openvpn.net/debian/openvpn/release/2.4  xenial main" > /etc/apt/sources.list.d/openvpn-aptrepo.list
apt-get update
apt-get upgrade -y
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password $mysql_root_pass'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password $mysql_root_pass'
apt-get install -y openvpn iptables nano unzip apache2 php-mysql mysql-server php-zip php nodejs unzip git wget sed npm curl
npm install -g bower
ln -s /usr/bin/nodejs /usr/bin/node

sed -ie 's|LimitNPROC=10|#LimitNPROC=10|' /lib/systemd/system/openvpn@.service
systemctl daemon-reload

mkdir git
cd ~/git
git clone https://github.com/aramistm/OpenVPN-Admin openvpn-admin
cd openvpn-admin
chmod +x install.sh

echo -e ""
echo -e "Start main install"

./install.sh /var/www www-data www-data $mysql_root_pass

echo -e ""
echo -e "The script finished install. Now your server will reboot."
echo -e "Please reboot your system"
read -p "Want you that your system will reboot [y/N]: " -e -i y REBOOT

if [[ "$REBOOT" = 'y' || "$REBOOT" = 'Y' ]]; then
	shutdown -r now
fi

