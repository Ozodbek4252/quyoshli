<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Helpers\DashboardStatic;

use App\Http\Controllers\Controller as ExController;

class Controller extends ExController
{
    public function index()
    {
        $users = User::count();
        $orders = Order::where('payment_type', '!=', 'credit')->count();
        $credit = Order::where('payment_type', 'credit')->count();
        $products = Product::where('child_id', null)->count();
        $billing = Billing::where('status', 'payed')->count();

        $statics = [
            'labels' => $this->getLabels(),
            'orders_count' => $this->getStatics(),
            'new_users' => $this->getUserStatics(),
            'transactions' => $this->getCountTransactions(),
            'credits' => $this->getCountCredit(),
            'sum' => $this->getAllSumStatic(),
        ];

        //        return $this->getUserStatics();

        return view('dashboard.index', compact('users', 'orders', 'credit', 'products', 'billing', 'statics'));
    }

    private function getLabels()
    {
        $start = now()->subDays(30);
        $days = [];
        for ($i = 0; $i <= 30; $i++) {
            $days[] = $start->copy()->addDays($i)->format('d.m');
        }
        return $days;
    }

    private function getUserStatics()
    {
        $users = DashboardStatic::getUserStatics();

        return [
            'data' => [
                [
                    'name' => 'Пользователи',
                    'values' => $users
                ]
            ]
        ];
    }

    private function getStatics()
    {
        $processing = DashboardStatic::getCountProcessing();
        $collect = DashboardStatic::getCountCollected();
        $waiting = DashboardStatic::getCountInWay();
        $closed = DashboardStatic::getCountClosed();
        $cancelled = DashboardStatic::getCountCancelled();
        $replacement = DashboardStatic::getCountReplacement();
        $archived = DashboardStatic::getCountArchived();

        return [
            'data' => [
                [
                    'name' => 'В обработке',
                    'values' => $processing
                ],

                [
                    'name' => 'Собран',
                    'values' => $collect
                ],

                [
                    'name' => 'Ожидает',
                    'values' => $waiting
                ],

                [
                    'name' => 'Закрыт',
                    'values' => $closed
                ],

                [
                    'name' => 'Отменен',
                    'values' => $cancelled
                ],

                [
                    'name' => 'Замена',
                    'values' => $replacement
                ],

                [
                    'name' => 'Архиве',
                    'values' => $archived
                ],
            ]
        ];
    }

    private function getCountTransactions()
    {
        $payed = DashboardStatic::getSuccessTransactions();
        $waiting = DashboardStatic::getWaitingTransactions();
        $refused = DashboardStatic::getRefusedTransactions();

        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => $payed
                ],
                [
                    'name' => 'В ожидания',
                    'values' => $waiting
                ],

                [
                    'name' => 'Отказано',
                    'values' => $refused
                ],
            ]
        ];
    }

    private function getCountCredit()
    {
        $payed = DashboardStatic::getCreditPayed();
        $cancelled = DashboardStatic::getCancelledCredit();
        $review = DashboardStatic::getReviewCredit();
        $waiting = DashboardStatic::getWaitingCredit();

        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => $payed
                ],
                [
                    'name' => 'Отказано',
                    'values' => $cancelled
                ],
                [
                    'name' => 'Рассмотрение',
                    'values' => $review
                ],
                [
                    'name' => 'В ожидание',
                    'values' => $waiting
                ]
            ]
        ];
    }

    private function getAllSumStatic()
    {
        return [
            'data' => [
                [
                    'name' => 'Оплачено',
                    'values' => []
                ],
                [
                    'name' => 'Не оплачено',
                    'values' => []
                ],

                [
                    'name' => 'Отказано',
                    'values' => []
                ],
            ]
        ];
    }
}
