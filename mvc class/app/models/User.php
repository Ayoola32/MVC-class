<?php

class User{
    use Model;

    protected $table = 'users';
    protected $allowColumns = [
        'username',
        'pwd',
        'email'

    ];

    public function validate($data){
		$this->errors = [];

		if(empty($data['email'])){
			$this->errors['email'] = "Email is required";
		}else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
			$this->errors['email'] = "Email is not valid";
		}
		
		if(empty($data['username'])){
			$this->errors['username'] = "Username is required";
		}
		
		if(empty($data['pwd'])){
			$this->errors['password'] = "Password is required";
		}
		
		if(empty($data['terms'])){
			$this->errors['terms'] = "Please accept the terms and conditions";
		}

		if(empty($this->errors)){
			return true;
		}

		return false;
	}
}