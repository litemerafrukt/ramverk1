<?php

namespace litemerafrukt\Book\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \litemerafrukt\Book\Book;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Skapa ny bok",
            ],
            [
                "title" => [
                    "label" => "Titel",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "author" => [
                    "label" => "Författare",
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skapa",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $book = new Book();
        $book->setDb($this->di->get("db"));
        $book->title  = $this->form->value("title");
        $book->author = $this->form->value("author");
        $book->save();
        $this->di->get("response")->redirect("book");
    }
}
