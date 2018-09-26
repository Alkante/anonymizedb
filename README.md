Anonymizedb
===========

Tool for anonymize fields in your development database.  
You can generate random name, firstname, date, string, ...  
It works with all databases supported by PDO.


Example of what you can do
--------------------------

Before :  

| id | name       | firstname  | mail                               | login       | pwd                                                          |
|----|------------|------------|------------------------------------|-------------|--------------------------------------------------------------|
| 1  | admin      | admin      | admin@exemple.com                  | admin       | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 2  | Vidal      | Stanislas  | stanislas.vidal@exemple2.com       | svidal      | $2y$10$MJqgEaabRg7E0u0ijfN89uxYCj7A8yl55jO6Ln4TXDRDY0lLhzJ.O |
| 3  | Bailly     | Ernest     | ernest.bailly@exemple3.com         | ebailly     | $2y$10$JRxko3xIdSbrSDUdX6bTgeE/l4bhPbpDtSGZ6.rEXmkJfaz4zXHty |
| 4  | Boulanger  | Brunehaut  | brunehaut.boulanger@exemple42.com  | bboulanger  | $2y$10$4NpShLrWcc3feINtfqC2F.30oJ/yT3w9S98sgDP7jGlJEBSX54u.2 |
  
After :  

| id | name       | firstname   | mail                                 | login    | pwd                                                          |
|----|------------|-------------|--------------------------------------|----------|--------------------------------------------------------------|
| 1  | admin      | admin       | admin@exemple.com                    | admin    | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 2  | Lacroix    | Aurore      | test+aurore.lacroix@exemple.com      | alacroix | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 3  | Fleury     | Mélissandre | test+mélissandre.fleury@exemple.com	 | mfleury  | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 4  | Olivier    | Estelle     | test+estelle.olivier@exemple.com     | eolivier | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |


You need
--------

* PHP7 cli


Setup
-----

Copy config.php.dist to config.php.  
Copy ./json/schema.json to ./json/<YOUR_DB_NAME>.json.  
Edit these files for your needs.  
See [README.md](./json/README.md)  
  
You can add php files in ./functions/ with your own functions.  
See [README.md](./functions/README.md)


Help
----
```
$ php anonymizedb.php help
```


Run
---

To anonymize the data in your database :  
```
$ php anonymizedb.php ./json/databases/<YOUR_DB_NAME>.json ./json/tables/<YOUR_TABLE_NAME>.json
```


Authors
-------

* [Alkante](https://www.alkante.com/)
