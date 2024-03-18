<?php 
namespace App\Models\Auth;

use App\Models\Groups;
use App\Models\SaleInvoice;
use App\Models\PurchaseInvoice;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['admin_id','group_id','role_id', 'first_name', 'last_name','phone', 'email', 'email_verified_at','password','address','city','country'];

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