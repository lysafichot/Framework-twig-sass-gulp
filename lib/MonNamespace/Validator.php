<?php
namespace MonNamespace;

class Validator {

	private $data;
	private $errors = [];

	public function __construct($data) {
		$this->data = $data;
	}

	private function getField($field) {
		if (!isset($this->data[$field])) {
			return null;
		}
		return $this->data[$field];
	}

	public function isAlpha($field, $errorMsg) {
		var_dump($this->getField($field));
		if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->getField($field))) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isUniq($field, $errorMsg) {
		$table = explode('_', $field); // value input id ='table_field'
			$query = new \app\models\UserTable();
			$record = $query->select()->where($table[1], '= ?')->exec(array($this->getField($field)));
			if ($record) {
				$this->errors[$field] = $errorMsg;
				return false;
			}
			return true;
	}

	public function isEmail($field, $errorMsg) {
		if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isConfirmed($field, $errorMsg) {
		$value = $this->getField($field);
		if (empty($value) || $value != $this->getField($field . '_confirm')) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isDate($field, $errorMsg) {

		$tab = explode('/', $this->getField($field));
		$ok = false;
		if(strlen($this->getField($field)) == 10 && count($tab) == 3 && is_numeric($tab[0]) && is_numeric($tab[1]) && is_numeric($tab[2])) {
			$ok = checkdate($tab[1], $tab[2], $tab[0]);
		}
		if(!$ok) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isExtension($field, $errorMsg) {
		$extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG', '.GIF', '.JPG', '.JPEG');
		$extension = strrchr($_FILES[$field]['name'], '.');
		if(!in_array($extension, $extensions)) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isSize($field, $errorMsg) {
		$taille_maxi = 5000000;
		$taille = filesize($_FILES[$field]['tmp_name']);
		if($taille > $taille_maxi) {
			$this->errors[$field] = $errorMsg;
			return false;
		}
		return true;
	}

	public function isValid() {
		return empty($this->errors);
	}

	public function getErrors() {
		return $this->errors;
	}
}
