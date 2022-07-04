<?php namespace Unittests\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class AppBaseTestCase extends TestCase
{
    use TestCaseTrait;

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $database = 'calendar_test';
        $user = 'root';
        $password = 'root';
        $host = '127.0.0.1';
        $port = '8889';
        
        $pdo = new \PDO('mysql:host='.$host.'; port=8889; dbname='.$database,$user,$password);

        return $this->createDefaultDBConnection($pdo);
    }

    public function testcalendar_test()
    {
        $dataSet = $this->getConnection()->createDataSet();
        // ...
    }
}
?>