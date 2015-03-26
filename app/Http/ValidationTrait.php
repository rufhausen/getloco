<?php namespace App\Http;
/**
 * Created by PhpStorm.
 * User: gtaylor
 * Date: 3/2/15
 * Time: 6:30 PM
 */


trait ValidationTrait {

    protected $errors;

    public function validator($input, $rules, $messages = [])
    {
        $validation = \Validator::make($input, $rules, $messages);

        if ($validation->fails())
        {
            $this->errors = $validation->messages();
        }

        return $validation;
    }
}
