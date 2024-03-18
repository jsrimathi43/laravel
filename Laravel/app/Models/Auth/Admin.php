<?php 
namespace App\Models\Auth;

use App\Models\Groups;
use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    public function group()
    {
    	return $this->belongsTo(Groups::class);
    }

    public function sales()
    {
    	return $this->hasMany(SaleInvoice::class);
    }


    public function purchases()
    {
    	return $this->hasMany(PurchaseInvoice::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

}