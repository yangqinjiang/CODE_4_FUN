<?php
class MySQLXmlDataSetTest extends Generic_Tests_DatabaseTestCase 
{
//

    /**
    //数据集DataSet（数据集）和 DataTable（数据表）是围绕着数据库表、行、列的抽象层
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        //MySQL XML DataSet （MySQL XML 数据集）
        //mysqldump --xml -t -u [username] --password=[password] [database] > /path/to/file.xml
        return $this->createMySQLXMLDataSet(dirname(__FILE__).'/_files/MySQLXmlDataSet.xml');
    }
    public function testIndex()
    {
        // $r = $this->getConnection()->exec('TRUNCATE test');
        $queryTable = $this->getConnection()->createQueryTable('test','SELECT * FROM test');
        // var_dump($queryTable);
        $expectedTable = $this->getDataSet()->getTable('test');
        $this->assertTablesEqual($expectedTable,$queryTable);
        $this->assertTrue(true);
    }
}
?>