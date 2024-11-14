# Programming Contest

This is a website made for programming contests held by the Technology Club at
Plymouth State University.

## Apache config

Copy/paste the below into your Apache config. `/var/www/localhost` should
contain this repository, it can be a symlink.

```
<IfDefine DEFAULT_VHOST> # see bug #178966 why this is in here

Listen 80

<VirtualHost *:80>
	ServerName localhost
	ServerAdmin root@localhost
	
	DocumentRoot "/var/www/localhost/"
	
	<Directory "/var/www/localhost/">
        	   Require all granted
	</Directory>
	
	# Hide private directory
	<Directory "/var/www/localhost/private">
	           Require all denied
	</Directory>
	
	# Hide solutions and input generators for all puzzles
	<Directory "/var/www/localhost/puzzles/*/impl/">
		   Require all denied
	</Directory>
	
	<IfModule mpm_peruser_module>
		  ServerEnvironment apache apache
	</IfModule>
</VirtualHost>
</IfDefine>
```
