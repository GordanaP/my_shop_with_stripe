<?php

namespace App;

use App\Facades\Price;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getPriceInDollarsAttribute()
    {
        return Price::getFormatted($this->price_in_cents/100);
    }
}
