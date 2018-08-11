Describe your DB.  
Copy schema.json and change fields for your needs.  

Database
========

Config in ./json/<YOUR_FILE>.json.  

PostgreSQL :  
```json
{
	"database":{
		"type":"pgsql",
		"host":"<HOST>",
		"port":"5432",
		"dbname":"<DB_NAME>",
		"user":"<USER>",
		"password":"<PASSWORD>"
	}
}
```
  
Mysql or MariaDB :  
```json
{
	"database":{
		"type":"mysql",
		"host":"<HOST>",
		"dbname":"<DB_NAME>",
		"user":"<USER>",
		"password":"<PASSWORD>"
	}
}
```
  
Oracle :  
```json
{
	"database":{
		"type":"oci",
		"dbname":"<DB_NAME>",
		"user":"<USER>",
		"password":"<PASSWORD>"
	}
}
```
  
Sqlite :  
```json
{
	"database":{
		"type":"sqlite",
		"path":"<PATH>"
	}
}
```
  
TIP
===

You can add in "database" all parameters supported by PDO.  
