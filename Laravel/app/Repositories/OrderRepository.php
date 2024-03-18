<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use Illuminate\Support\Facades\Auth;


class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params, $cartDetails = [])
    {
        // echo"<pre>";print_r($params['address_id']);die;
        $order = Order::create([
            'order_number'      =>  'ORD-' . strtoupper(uniqid()),
            'user_id'           =>   Auth::id(),
            'status'            =>   1,
            'grand_total'       =>   $params['sub_total'],
            'item_count'        =>   $params['quantity'],
            'payment_status'    =>  0,
            'payment_method'    =>  $params['payment_method'],
            // 'first_name'        =>  $params['first_name'],
            // 'last_name'         =>  $params['last_name'],
            // 'address'           =>  $params['address'],
            // 'city'              =>  $params['city'],
            // 'country'           =>  $params['country'],
            // 'post_code'         =>  $params['post_code'],
            // 'phone_number'      =>  $params['phone'],
            'notes'             =>  $params['notes'],
            'address_id'        =>  $params['address_id']
        ]);

        if ($order) {
            if (!empty($cartDetails)) {
                foreach ($cartDetails['cartDetails'] as $item) {
                    // A better way will be to bring the product id with the cart items
                    // you can explore the package documentation to send product id with the cart
                    $product = Product::where('title', $item['title'])->first();
                    if (!empty($product)) {
                        $orderItem = new OrderItem([
                            'product_id'    =>  $product->id,
                            'quantity'      =>  $item['quantity'],
                            'price'         =>  $item['price']
                        ]);

                        $order->items()->save($orderItem);
                    }
                }
            }
        }

        return $order;
    }

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }
}