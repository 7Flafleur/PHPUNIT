<?php


class User
{


    public $first_name;

    public $surname;

    public $email;

    protected $mailer;

    // // Constructor for dependency injection
    // public function __construct(Mailer $mailer)
    // {
    //     $this->mailer = $mailer;
    // }

    //setter for dependency injection
    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function getFullName():string
    {
        return trim("$this->first_name $this->surname");
    }

    public function notify($message): bool
    {

        return $this->mailer->sendMessage($this->email, $message);
    }
}
