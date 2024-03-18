<?php

namespace App\Contracts;

interface OrderContract
{
    public function storeOrderDetails($params,$cartDetails);

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function findOrderByNumber($orderNumber);
}