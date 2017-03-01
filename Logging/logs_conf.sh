if [ -f /etc/lsb-release ]; then
        os=$(lsb_release -s -d)
elif [ -f /etc/redhat-release ]; then
        os=`cat /etc/redhat-release`
else
        os="$(uname -s) $(uname -r)"
fi
RED='\033[0;31m';
GR='\033[0;32m';
NC='\033[0m';
os=`echo $os | cut -f 1 -d " "`;
#echo $os;
echo -e "${GR} Running ... ${NC}" 
case $os in
Ubuntu)
touch /etc/rsyslog.d/10-phpm.conf
true > /etc/rsyslog.d/10-phpm.conf
cat << EOT >> /etc/rsyslog.d/10-phpm.conf
#/etc/rsyslog.d/10-phpm.conf
local2.err     /var/log/phpm/err.log
local2.debug    /var/log/phpm/debug.log
local3.warn     /var/log/phpm/warn.log
local3.debug    /var/log/phpm/debug.log
local4.info     /var/log/phpm/info.log
local4.debug    /var/log/phpm/debug.log
EOT
mkdir /var/log/phpm
cd /var/log/phpm/
touch err.log info.log debug.log warn.log
#cd - 2&> /dev/null
chown -R www-data:adm /var/log/phpm
chown syslog:adm /var/log/phpm/*
echo -e "${GR} Testing ... ${NC}"
systemctl restart rsyslog.service
systemctl restart apache2 
if [ -d /var/log/phpm ] && [ -f /etc/rsyslog.d/10-phpm.conf ] && [ -f /var/log/phpm/err.log ] && [ -f /var/log/phpm/debug.log ] && [ -f /var/log/phpm/warn.log ] && [ -f /var/log/phpm/info.log ] ; then
echo -e "Application logging system Configuration ${GR} Successfully ${NC} Done in ${GR} '$os'${NC} ";
echo -e "Regards ${GR} Logging Team ${NC} ";
else
echo -e "${RED} Failed ${NC} To Configure Application Logging System in ${RED} '$os'${NC} ";
echo -e "${RED} Contact Logging Team ${NC} ";
fi
;;
CentOS)
touch /etc/rsyslog.d/phpm.conf
true > /etc/rsyslog.d/phpm.conf
cat << EOT >> /etc/rsyslog.d/phpm.conf
#/etc/rsyslog.d/phpm.conf
local2.err     /var/log/phpm/err.log
local2.debug    /var/log/phpm/debug.log
local3.warn     /var/log/phpm/warn.log
local3.debug    /var/log/phpm/debug.log
local4.info     /var/log/phpm/info.log
local4.debug    /var/log/phpm/debug.log
EOT
mkdir /var/log/phpm
cd /var/log/phpm/
touch err.log info.log debug.log warn.log
#cd - 2&> /dev/null
chown -R apache:apache /var/log/phpm
echo -e "${GR} Testing ... ${NC}"
systemctl restart rsyslog.service
systemctl restart httpd.service
if [ -d /var/log/phpm ] && [ -f /etc/rsyslog.d/phpm.conf ] && [ -f /var/log/phpm/err.log ] && [ -f /var/log/phpm/debug.log ] && [ -f /var/log/phpm/warn.log ] && [ -f /var/log/phpm/info.log ] ; then
echo -e "Application logging system Configuration ${GR} Successfully ${NC} Done in ${GR} '$os'${NC} ";
echo -e "Regards ${GR} Logging Team ${NC} ";
else
echo -e "${RED} Failed ${NC} To Configure Application Logging System in ${RED} '$os'${NC} ";
echo -e "${RED} Contact Logging Team ${NC} ";
fi
;;
esac

