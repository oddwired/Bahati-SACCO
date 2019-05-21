<?php
/**
 * Created by PhpStorm.
 * User: kshem
 * Date: 5/20/19
 * Time: 11:15 AM
 */

namespace BahatiSACCO;


class MailModel
{
    public $name;
    public $email;
    public $subject;
    public $body;

    public function __construct($name, $email, $subject, $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
    }
}