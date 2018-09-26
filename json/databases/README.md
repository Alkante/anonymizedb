Describe your DB.  
Copy [schema.json](schema.json) and change fields for your needs.  
  
# Database
  
Config in anonymizedb/json/databases/<YOUR_FILE>.json.  
  
## PostgreSQL
  
```json
{
  "type":"pgsql",
  "host":"<HOST>",
  "port":"5432",
  "path":"",
  "dbname":"<DB_NAME>",
  "user":"<USER>",
  "password":"<PASSWORD>"
}
```
  
## Mysql or MariaDB

```json
{
  "type":"mysql",
  "host":"<HOST>",
  "port":"",
  "path":"",
  "dbname":"<DB_NAME>",
  "user":"<USER>",
  "password":"<PASSWORD>"
}
```

## Oracle

```json
{
  "type":"oci",
  "host":"",
  "port":"",
  "path":"",
  "dbname":"<DB_NAME>",
  "user":"<USER>",
  "password":"<PASSWORD>"
}
```

## Sqlite

```json
{
  "type":"sqlite",
  "host":"",
  "port":"",
  "path":"<PATH>",
  "dbname":"",
  "user":"",
  "password":""
}
```
  
  
TIP : You can add in "database" all parameters supported by PDO.  

