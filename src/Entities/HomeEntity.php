<?php

namespace Web\Entities;

class HomeEntity
{

    private $id;
    private $title;
    private $category;
    private $address;
    private $price;
    private $meter;
    private $image;
    private $description;
    private $yearofconstruction;

    public function __construct($array)
    {
        $this->id = $array['id'];
        $this->title = $array['title'];
        $this->category = $array['category'];
        $this->address = $array['address'];
        $this->price = $array['price'];
        $this->meter = $array['meter'];
        $this->image = $array['image'];
        $this->description = $array['description'];
        $this->yearofconstruction = $array['yearofconstruction'];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'address' => $this->address,
            'price' => $this->price,
            'meter' => $this->meter,
            'image' => $this->image,
            'description' => $this->description,
            'yearofconstruction' => $this->yearofconstruction
        ];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setMeter($meter)
    {
        $this->meter = $meter;
    }

    public function getMeter()
    {
        return $this->meter;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getExcerpt($count = 100)
    {
        return substr($this->description, 0, $count) . '...';
    }

    public function setYearofConstruction($yearofconstruction)
    {
        $this->yearofconstruction = $yearofconstruction;
    }

    public function getYearofConstruction()
    {
        return $this->yearofconstruction;
    }
}
