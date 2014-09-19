Files that need to merged with git history when auto created

model.php. model/form.php ModelQuery.php
column.php column/form.php 
user.php

To recreate a list of models
1./ run the script after re-creating the database in order to make ucwords function available
2./ SELECT REPLACE(bookaspot.UCWORDS(REPLACE(table_name, 'tbl_', '')), '_', '') FROM information_schema.tables WHERE `TABLE_SCHEMA` = 'bookaspot';