<?php

namespace Web\Model;

use Exception;
use Web\Classes\Database;
use Web\Exceptions\DoesNotExistsException;

class Model
{
    protected $database;
    protected $FileName;
    protected $entityClass;

    public function __construct()
    {
        $this->database = new Database($this->FileName, $this->entityClass);
    }

    public function getAllData()
    {
        return $this->database->getData();
    }

    public function getDataById($id)
    {
        $data = $this->database->getData();
        $array = array_filter($data, function ($item) use ($id) {
            return $item->getId() == $id;
        });

        $array = array_values($array);
        if (count($array)) {
            return $array[0];

            throw new DoesNotExistsException("Does Not Exists Any Data {$this->entityClass}");
        }
    }

    public function getLastData()
    {
        $data = $this->database->getData();

        uasort($data, function ($first, $second) {
            return $first->getId() > $second->getId() ? -1 : 1;
        });

        $data = array_values($data);
        if (count($data)) {
            return $data[0];

            throw new Exception("Does Not Exists Any Data {$this->entityClass}");
        }
    }

    public function addNewId()
    {
        $data = $this->database->getData();
        uasort($data, function ($first, $second) {
            return $first->getId() + 1 > $second->getId() + 1 ? -1 : 1;
        });

        $data = array_values($data);

        if (count($data))
            return $data;

        throw new Exception("Does Not Exists Any Data {$this->entityClass}");
    }

    public function getFirstData()
    {
        $data = $this->database->getData();

        uasort($data, function ($first, $second) {
            return $first->getId() < $second->getId() ? -1 : 1;
        });

        $data = array_values($data);

        if (count($data)) {
            return $data[0];

            throw new DoesNotExistsException("Does Not Exists Any Data {$this->entityClass}");
        }
    }

    public function sortData($callback)
    {
        $data = $this->database->getData();

        uasort($data, $callback);
        $data = array_values($data);

        if (count($data)) {
            return $data;

            throw new DoesNotExistsException("Does Not Exists Any Data {$this->entityClass}");
        }
    }

    public function filterData($callback)
    {
        $data = $this->database->getData();

        $data = array_filter($data, $callback);
        $data = array_values($data);

        if (count($data)) {
            return $data;

            throw new DoesNotExistsException("Does Not Exists Any Data {$this->entityClass}");
        }
    }

    public function createData($news)
    {
        $data = $this->database->getData();

        $data[] = $news;
        $this->database->setData($data);
        return true;
    }

    public function deleteData($id)
    {
        $data = $this->database->getData();
        $newData = array_filter($data, function ($item) use ($id) {
            return $item->getId() == $id ? true : false;
        });

        $newData = array_values($newData);
        $this->database->setData($newData);
        return true;
    }

    public function editData($news)
    {
        $data = $this->database->getData();
        $newData = array_map(function ($item) use ($news) {
            return $item->getId() == $news->getId() ? $news : $item;
        }, $data);

        $newData = array_values($newData);
        $this->database->setData($newData);
        return true;
    }
}
