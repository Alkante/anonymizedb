Anonymizedb
===========

Tool for anonymize fields in your development database.  
You can generate random name, firstname, date, string, ...

Need
====

* PHP7 cli

Help
===
```
$ php anonymizedb.php help
```
Run
===

Copy ./json/schema.json to ./json/<YOUR_DB_NAME>.json.  
Edit this file for your needs.  
Now you can update your database with :  
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
