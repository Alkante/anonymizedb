Describe your DB.  
Copy [schema.json](schema.json) and change fields for your needs.  

Parameters
==========

Database
--------

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

TIP : You can add in "database" all parameters supported by PDO.  


"tables"."<TABLE_NAME>"."id"
----------------------------

Examples :  

For :  

| id | name | ... |
|----|------|-----|
| 1  | toto | ... |

```
{
  "tables":{
    "users":{
      "id":[
      "id"
      ]
    }
  }
}
```

For :  

| id_users | id_roles | ... |
|----------|----------|-----|
| 1        | 42       | ... |

```
{
  "tables":{
    "user_roles":{
      "id":[
      "id_users",
      "id_roles",
      ]
    }
  }
}
```

Example
=======

Your database :  

| id | name       | firstname  | mail                               | login       | pwd                                                          |
|----|------------|------------|------------------------------------|-------------|--------------------------------------------------------------|
| 1  | admin      | admin      | admin@exemple.com                  | admin       | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 2  | Vidal      | Stanislas  | stanislas.vidal@exemple2.com       | svidal      | $2y$10$MJqgEaabRg7E0u0ijfN89uxYCj7A8yl55jO6Ln4TXDRDY0lLhzJ.O |
| 3  | Bailly     | Ernest     | ernest.bailly@exemple3.com         | ebailly     | $2y$10$JRxko3xIdSbrSDUdX6bTgeE/l4bhPbpDtSGZ6.rEXmkJfaz4zXHty |
| 4  | Boulanger  | Brunehaut  | brunehaut.boulanger@exemple42.com  | bboulanger  | $2y$10$4NpShLrWcc3feINtfqC2F.30oJ/yT3w9S98sgDP7jGlJEBSX54u.2 |


File .json/demo.json  
```json

{
  "database":{
    "type":"sqlite",
    "path":"anonymizedbTest.sqlite"
  },
  "tables":{
    "users":{
      "schema":"",
      "id":[
        "id"
      ],
      "skipline":{
        "id":[
          "1"
        ]
      },
      "fields":{
        "name":{
          "function":"name",
          "param":{}
        },
        "fname":{
          "function":"firstname",
          "param":{}
        },
        "mail":{
          "function":"email",
          "param":{
            "name":"name",
            "firstname":"fname",
            "prefix":"test+",
            "domain":"exemple.com"
          }
        },
        "login":{
          "function":"login",
          "param":{
            "name":"name",
            "firstname":"fname"
          }
        },
        "pwd":{
          "setValue":"$2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw."
        }
      }
    }
  }
}
```

And run :  
```
$ php anonymizedb.php .json/demo.json
```

After you have :  

| id | name       | firstname   | mail                                 | login    | pwd                                                          |
|----|------------|-------------|--------------------------------------|----------|--------------------------------------------------------------|
| 1  | admin      | admin       | admin@exemple.com                    | admin    | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 2  | Lacroix    | Aurore      | test+aurore.lacroix@exemple.com      | alacroix | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 3  | Fleury     | Mélissandre | test+mélissandre.fleury@exemple.com   | mfleury  | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |
| 4  | Olivier    | Estelle     | test+estelle.olivier@exemple.com     | eolivier | $2y$10$TIbP5QZSRwG4qgIIPM2Id.xXMppaVA9NS.1l8l1tNmOXcrsPc0tw. |

