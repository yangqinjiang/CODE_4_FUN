<?php
class XMLDataSetTest extends Generic_Tests_DatabaseTestCase 
{


    /**
    //数据集DataSet（数据集）和 DataTable（数据表）是围绕着数据库表、行、列的抽象层
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()

    {
        return $this->createXMLDataSet(dirname(__FILE__).'/_files/guestbook-seed-xml-dataset.xml');
    }
    public function testIndex()
    {
        // $r = $this->getConnection()->exec('TRUNCATE test');

        $this->assertTrue(true);
    }
}
?>