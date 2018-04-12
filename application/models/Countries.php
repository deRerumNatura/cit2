<?php 
	namespace application\models;
	use application\core\Model;

	class Countries extends Model 
	{
		public $table = 'countries';

		public function __construct()
		{
			parent::__construct();
		}

		public function get () {

			return $this->getAll($this->table, ['*']);
	
		}

		public function getOneCountry ($id) {
			return $this->getOne($this->table, $id);
		}
	} 