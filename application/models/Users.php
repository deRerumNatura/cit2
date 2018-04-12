<?php 
	namespace application\models;
	use application\core\Model;

	class Users extends Model 
	{
		public $table = 'users';

		public function __construct()
		{
			parent::__construct();
		}

		public function addUser ($columns, $values) {

			return $this->createRecord($this->table, $columns, $values);
		}

		public function getLoginUser ($login) {
			
			return $this->getLogin($this->table, $login);
		}

		public function getEmailUser ($email) {
	
			return $this->getEmail($this->table, $email);
		}

        public function getPasswordUser ($pass) {

            return $this->getPassword($this->table, $pass);
        }

		

	} 