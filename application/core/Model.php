<?php 

	namespace application\core;
	use \PDO;

	class Model extends PDO
    {
        public $pdo;

        public function __construct()
        {
            $dsn = "mysql:host=" . HOST . ";dbname=" . DB . ";charset=" . CHARSET;

            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, USER, PASS, $opt);
            $this->pdo = $pdo;
        }

        protected function createRecord($table, $columns = [], $values = [])
        {

            $sql = 'INSERT INTO ' . $table . '(' . implode(",", $columns) . ') VALUES  ( "' . implode('","', $values) . '")';
            $query = $this->pdo->prepare($sql);
            $query->execute();

            return $this->pdo->lastInsertId();
        }

        protected function getAll($table, $columns = [], $condition = '')
        {
            if(!empty($condition)) {
                $query = $this->pdo->query( 'SELECT '. implode(",", $columns) . ' FROM ' . $table . ' WHERE topic_id=' . $condition );
            }
            else {
                $query = $this->pdo->query( 'SELECT '. implode(",", $columns) . ' FROM ' . $table );
            }
            $result = $query->fetchAll();
            return $result;
        }

        public function getOne($table, $id)
        {
            $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE id = ' . $id);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }

        public function getLogin($table, $login)
        {
            $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE login ="' . $login . '"');
            $query->execute();
            $result = $query->fetch();
            return $result;
        }


        public function getEmail($table, $email)
        {
            $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE email ="' . $email . '"');
            $query->execute();
            $result = $query->fetch();
            return $result;
        }

        public function getPassword($table, $pass)
        {
            $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE password ="' . $pass . '"');
            $query->execute();
            $result = $query->fetch();
            return $result;
        }

	}