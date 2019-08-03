<?php

namespace App;

use App\Facades\Presenter;
use App\Facades\Calculator;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getPriceInDollarsAttribute()
    {
        return Calculator::divide($this->price_in_cents, 100);
    }

    public function getPricePresentedInDollarsAttribute()
    {
        return Presenter::withCurrency($this->price_in_dollars);
    }
}
