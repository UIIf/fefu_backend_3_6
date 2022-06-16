<?php
namespace App\Http\Filters;


class ProductFilterOption
{

    public $value;
    public bool $isSelected;
    public int $productCount;

    public function __construct($value, $isSelected, $productCount)
    {
        $this->value = $value;
        $this->isSelected = $isSelected;
        $this->productCount = $productCount;
    }

}