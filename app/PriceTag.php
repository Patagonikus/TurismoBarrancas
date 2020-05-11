<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class priceTag extends Model
{
    public function presentMinTagPrice()
    {
        return '$ '.$this->min / 100;
    }

    public function presentMaxTagPrice()
    {
        return '$ '.$this->max / 100;
    }
}
