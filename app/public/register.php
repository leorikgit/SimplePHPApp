<?php
include_once __DIR__ .'../../core/ini.php';

if( Input::exist('post') && Input::get('register')){
    if(Token::check(Input::get('token'))){

        $input = $_POST;
        foreach($input as $key =>$alue){
            $input[$key] = sanitaze($alue);
        }
        $validation = new Validation();
        $validation->check($input, array(
            'username'=> array(
                'required' => true,
                'max'      => '30',
                'min'      => '6'
            ),
            'email'=> array(
                'required' => true,
                'email' => true,
                'unique' => 'users'

            ),
            'password'=> array(
                'required' => true,
                'max'      => '50',
                'min'      => '6'
            ),
            'password_again'=> array(
                'required' => true,
                'max'      => '50',
                'min'      => '6',
                'match' =>'password'
            ),
        ));
        if($validation->passed()){
            try {
                $user = new User();
                $user->register(array(
                    'username' => $input['username'],
                    'password' => $input['password'],
                    'email' => $input['email']
                ));
                Session::flash('success', 'success!');

                Redirect::to('index.php');
            }catch (Exception $e){
            die($e->getMessage());
            }
        }else{
            var_dump($validation->getErrors());
        }
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="<?php echo BASE_URL."register.php"?>">
        <p>
            <label for="username">Username: </label>
            <input type="text" value="<?php echo Input::get('username')?>" name="username" id="username" >
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="Email" value="<?php echo Input::get('email')?>" name="email" id="email" >
        </p>
        <p>
            <label for="password">Password: </label>
            <input type="password" value="" name="password" id="password" >
        </p>
        <p>
            <label for="password_again">Password again: </label>
            <input type="password" value="" name="password_again" id="password_again" >
        </p>
        <input type="hidden" name="token" value="<?php echo Token::tokenForm()?>">
        <button type="submit" name="register" value="register">Submit</button>
    </form>
</body>
</html>
