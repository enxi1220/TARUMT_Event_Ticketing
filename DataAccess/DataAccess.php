<?php

#  Author: Lim En Xi
// database transaction

class DataAccess
{

    //     $dbh = new PDO('odbc:SAMPLE', 'db2inst1', 'ibmdb2', 
    //       array(PDO::ATTR_PERSISTENT => true));
    //   echo "Connected\n";
    // } catch (Exception $e) {
    //   die("Unable to connect: " . $e->getMessage());
    // }

    // try {  
    //   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //   $dbh->beginTransaction();
    //   $dbh->exec("insert into staff (id, first, last) values (23, 'Joe', 'Bloggs')");
    //   $dbh->exec("insert into salarychange (id, amount, changedate) 
    //       values (23, 50000, NOW())");
    //   $dbh->commit();

    // } catch (Exception $e) {
    //   $dbh->rollBack();
    //   echo "Failed: " . $e->getMessage();
    // }

}
