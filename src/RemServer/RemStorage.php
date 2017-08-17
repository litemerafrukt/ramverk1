<?php

namespace litemerafrukt\RemServer;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * REM Server.
 */
class RemStorage implements ConfigureInterface
{
    use ConfigureTrait;



    /**
     * @var array $session inject a reference to the session.
     */
    private $session;



    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "remserver";



    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }



    /**
     * Fill the session with default data that are read from files.
     *
     * @return self
     */
    public function init()
    {
        $files = $this->config["dataset"];

        $datasets = \array_reduce($files, function ($datasets, $file) {
            $content = \json_decode(\file_get_contents($file));
            $key = \pathinfo($file, \PATHINFO_FILENAME);
            return \array_merge($datasets, [$key => $content]);
        }, []);

        $this->session->set(self::KEY, $datasets);
        return $this;
    }



    /**
     * Check if there is a dataset stored.
     *
     * @return boolean tru if dataset exists in session, else false
     */
    public function hasDataset()
    {
        return $this->session->has(self::KEY);
    }



    /**
     * Get (or create) a subset of data.
     *
     * @param string $key for data subset.
     *
     * @return array with the dataset
     */
    public function getDataset($key)
    {
        $data = $this->session->get(self::KEY);
        return $data[$key] ?? [];
    }



    /**
     * Get an item from a dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId for the item to get
     *
     * @return stdClass|null array with item if found, else null
     */
    public function getItem($key, $itemId)
    {
        $dataset = $this->getDataset($key);
        $index = $this->findIndex($dataset, $itemId);
        return $dataset[$index] ?? null;
    }



    /**
     * Add an item to a dataset.
     *
     * @param string $key  for the dataset
     * @param stdClass $item to add
     *
     * @return stdClass as new item inserted
     */
    public function addItem($key, $item)
    {
        $dataset = $this->getDataset($key);

        // Get max value for the id
        $maxId = \array_reduce($dataset, function ($maxId, $item) {
            return $maxId < $item->id ? $item->id : $maxId;
        }, 0);

        $item->id = $maxId + 1;
        $dataset[] = $item;
        $this->saveDataset($key, $dataset);
        return $item;
    }



    /**
     * Upsert/replace an item to a dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId where to store it
     * @param string $entry  to add/replace
     *
     * @return array as item upserted
     */
    public function upsertItem($keyDataset, $itemId, $entry)
    {
        $dataset = $this->getDataset($keyDataset);

        $entry->id = $itemId;

        $index = $this->findIndex($dataset, $itemId);

        if ($index !== null) {
            $dataset[$index] = $entry;
        } else {
            $dataset[] = $entry;
        }

        $this->saveDataset($keyDataset, $dataset);
        return $entry;
    }



    /**
     * Delete an item from the dataset.
     *
     * @param string $key    for the dataset
     * @param string $itemId to delete
     *
     * @return void
     */
    public function deleteItem($keyDataset, $itemId)
    {
        $dataset = $this->getDataset($keyDataset);
        $index = $this->findIndex($dataset, $itemId);
        if ($index !== null) {
            unset($dataset[$index]);
            $this->saveDataset($keyDataset, $dataset);
        }
    }



    /**
     * Save (the modified) dataset.
     *
     * @param string $key     for data subset.
     * @param string $dataset the data to save.
     *
     * @return self
     */
    private function saveDataset($key, $dataset)
    {
        $data = $this->session->get(self::KEY);
        $data[$key] = $dataset;
        $this->session->set(self::KEY, $data);
        return $this;
    }

    /**
     * Find index for item in dataset
     *
     * @param array     $dataset datasubset
     * @param integer   $id      id of item
     *
     * @return integer|null the item
     */
    private function findIndex($dataset, $id)
    {
        foreach ($dataset as $index => $item) {
            if ($item->id === $id) {
                return $index;
            }
        }
        return null;
    }
}
