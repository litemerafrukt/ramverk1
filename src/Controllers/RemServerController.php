<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\RemServer\RemStorage;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

/**
 * A controller for the REM Server.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class RemServerController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $rem;

    public function __construct($remStorage)
    {
        $this->rem = $remStorage;
    }

    /**
     * Start the session and initiate the REM Server.
     *
     * @return void
     */
    public function prepare()
    {
        $this->rem->hasDataset() ?: $this->rem->init();
    }



    /**
     * Init or re-init the REM Server.
     *
     * @return void
     */
    public function init()
    {
        $this->rem->init();
        $this->di->get('response')->sendJson(["message" => "The session is initiated with the default dataset."]);
        exit;
    }



    /**
     * Destroy the session.
     *
     * @return void
     */
    public function destroy()
    {
        $this->di->get('session')->destroy();
        $this->di->get('response')->sendJson(["message" => "The session was destroyed."]);
        exit;
    }



    /**
     * Get the dataset or parts of it.
     *
     * @param string $key for the dataset
     *
     * @return void
     */
    public function getDataset($key)
    {
        $dataset = $this->rem->getDataset($key);
        $offset = $this->di->get('request')->getGet("offset", 0);
        $limit = $this->di->get('request')->getGet("limit", 25);
        $res = [
            "data" => array_slice($dataset, $offset, $limit),
            "offset" => $offset,
            "limit" => $limit,
            "total" => count($dataset)
        ];

        $this->di->get('response')->sendJson($res);
        exit;
    }



    /**
     * Get one item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to get
     *
     * @return void
     */
    public function getItem($key, $itemId)
    {
        $item = $this->rem->getItem($key, $itemId) ??
            ["message" => "The item is not found."];

        $this->di->get('response')->sendJson($item);
        exit;
    }



    /**
     * Create a new item by getting the entry from the request body and add
     * to the dataset.
     *
     * @param string $key    for the dataset
     *
     * @return void
     */
    public function postItem($key)
    {
        $entry = $this->di->get('request')->getBody();
        $entry = \json_decode($entry);

        $item = $this->rem->addItem($key, $entry);
        $this->di->get('response')->sendJson($item);
        exit;
    }


    /**
     * Upsert/replace an item in the dataset, entry is taken from request body.
     *
     * @param string $key    for the dataset
     * @param string $itemId where to save the entry
     *
     * @return void
     */
    public function putItem($key, $itemId)
    {
        $entry = $this->di->get('request')->getBody();
        $entry = json_decode($entry);

        $item = $this->rem->upsertItem($key, $itemId, $entry);
        $this->di->get('response')->sendJson($item);
        exit;
    }



    /**
     * Delete an item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to delete
     *
     * @return void
     */
    public function deleteItem($key, $itemId)
    {
        $this->rem->deleteItem($key, $itemId);
        $this->di->get('response')->sendJson(null);
        exit;
    }



    /**
     * Show a message that the route is unsupported, a local 404.
     *
     * @return void
     */
    public function anyUnsupported()
    {
        $this->di->get('response')->sendJson(["message" => "404. The api/ does not support that."], 404);
        exit;
    }
}
