<?php

namespace litemerafrukt\Book;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \litemerafrukt\Book\HTMLForm\CreateForm;
use \litemerafrukt\Book\HTMLForm\EditForm;
use \litemerafrukt\Book\HTMLForm\DeleteForm;
use \litemerafrukt\Book\HTMLForm\UpdateForm;

/**
 * A controller class.
 */
class BookController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Show all items.
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "Böcker";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $book = new Book();
        $book->setDb($this->di->get("db"));

        $data = [
            "items" => $book->findAll(),
        ];

        $view->add("book/crud/view-all", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to create a new item.
     *
     * @return void
     */
    public function getPostCreateItem()
    {
        $title      = "Lägg till bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to delete an item.
     *
     * @return void
     */
    public function getPostDeleteItem()
    {
        $title      = "Ta bort bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new DeleteForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to update an item.
     *
     * @return void
     */
    public function getPostUpdateItem($id)
    {
        $title      = "Uppdatera bok";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UpdateForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];

        $view->add("book/crud/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
