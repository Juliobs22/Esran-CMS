<?php
class DbManager {
    private string $host = 'localhost';
    private string $username = 'root';
    private string $password = 'NodicianH23';
    private string $database = 'esrandb';
    protected PDO $pdo;
    /**
     * Response Messahe
     * CODE: 0 -> succes | 1 -> error | 2 -> warning
     * MESSAGE: status deecription
     * CONTENT: Query result | NUUL
     */
    protected MessageAgt $resMessage;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->pdo = null;
        }
    }
    public function close() {
        $this->pdo = null;
    }
}