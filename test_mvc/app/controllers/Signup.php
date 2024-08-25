<?php

class Signup{
    use Controller;
    
    public function index(){
        $user = new User();
        if ($user->validate($_POST)) {
            $user->create($_POST);
            redirect('home');
        }

        $data['errors'] = $user->errors;
        $this->view('signup', $data);
    }



    
}
