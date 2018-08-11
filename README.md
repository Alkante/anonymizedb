Anonymizedb
===========

Tool for anonymize fields in your development database.  
You can generate random name, firstname, date, string, ...


Need
====

* PHP7 cli


Setup
=====

Copy config.php.dist to config.php.  
Copy ./json/schema.json to ./json/<YOUR_DB_NAME>.json.  
Edit these files for your needs.  
  
You can add php files in ./functions/ with your own functions.  
See ./functions/README.md


Help
===
```
$ php anonymizedb.php help
```


Run
===

To anonymize the data in your database :  
```
$ php anonymizedb.php ./json/<YOUR_DB_NAME>.json
```


TODO
====

- Address  
- City  
- Postal code  
- Phone number  
- More documentation and examples  
