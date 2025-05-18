<?php

return [

    'order_status' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending',
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'processed And Ready To Ship',
            'details' => 'Your package has been processed and will be with our delivery partner soon',
        ],
        'dropped_off' => [
            'status' => 'Dropped Off',
            'details' => 'Your package has been dropped off by the seller',
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => 'Your package has arrived at our logistics facilities',
        ],
        'out_for_delivery' => [
            'status' => 'Out For Delivery',
            'details' => 'Our delivery partner will attempt to deliver your product',
        ],
        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered',
        ],
        'cancelled' => [
            'status' => 'Cancelled',
            'details' => 'Cancelled',
        ],
    ]

];