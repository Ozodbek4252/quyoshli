<?php

namespace App\Http\Controllers\Apelsin;

use App\Api\Sms;
use App\Models\Billing;
use App\Models\CommentBank;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller as ExController;

class Controller extends ExController
{
    public function paymentOrder(Billing $billing)
    {
        return view('apelsin', compact('billing'));
    }

    public function payment(Request $request)
    {
        Log::info($request->all());
        if ($request->post('orderId')) {
            $billing = Billing::find($request->post('orderId'));

            if ($billing->status != 'payed') {
                if (!empty($billing)) {
                    $amount = (int) $request->post('amount');
                    $amount = $amount / 100;

                    if ($amount == $billing->amount) {
                        $order = Order::find($billing->order->id);

                        $order->update([
                            'payment_status' => 'payed'
                        ]);

                        $billing->update([
                            'status' => 'payed',
                            'payment_system' => 'apelsin',
                            'transaction_id' => $request->post('transactionId')
                        ]);

                        $sms = new Sms();
                        $message = "Alistore vash zakaz: {$order->id} uspeshno oplachen!";
                        $sms->send($order->user->phone, $message);

                        return response()->json([
                            'status' => true
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'status' => false
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $sign_key = md5($request->order_number . '7Yyh5weu7zhYEbNr');

        if ($sign_key == $request->sign_key) {
            //            Activity::create([
            //                'log_name' => 'orders',
            //                'description'
            //            ]);
            $order = Order::find($request->order_number);

            if (!empty($order)) {
                $order->update([
                    'payment_status' => 'review'
                ]);
            }

            return response()->json([
                'status' => true,
                'back_url' => env('APP_URL') . '?order=credit'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error Sign Key'
            ], 403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $sign_key = md5($request->order_number . '7Yyh5weu7zhYEbNr');

        if ($sign_key === $request->sign_key) {
            $order = Order::find($request->order_number);

            if (!empty($order)) {
                if ($request->result) {
                    if ($order->status == 'cancelled') {
                        $order->update([
                            'payment_status' => 'payed',
                            'status' => 'processing',
                            'archived' => false,
                        ]);
                    } else {
                        $order->update([
                            'payment_status' => 'payed',
                        ]);
                    }
                } else {

                    $order->update([
                        'apelsin_data' => [
                            'status' => false,
                            'body' => $request->all()
                        ],
                        'status' => 'cancelled',
                        'payment_status' => 'cancelled'
                    ]);
                }
            }

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error Sign Key'
            ], 403);
        }
    }


    /**
     * @param $id
     * @return array
     */
    public function delivered($id)
    {
        try {
            $response = Http::withBasicAuth('AVtO_L0aN_8f234_Ssmeiq', '&*sk92jf8.1521aydd3810bx742n54kiygh2')
                ->post('https://alistoreback.apelsin.uz/api/loan-application/external/verdict', [
                    'order_number' => $id,
                    'status' => true
                ]);
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'body' => $exception
            ];
        }

        $body = json_decode($response->body(), true);

        if ($body['errorMessage']) {
            return [
                'status' => false,
                'body' => $body
            ];
        }

        return [
            'status' => true,
            'body' => $body
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request)
    {
        $sign_key = md5($request->order_number . '7Yyh5weu7zhYEbNr');

        if ($sign_key == $request->sign_key) {
            $order = Order::find($request->order_number);

            if (!empty($order) && $order->payment_type == 'credit') {
                $comment = $request->comment;
                CommentBank::create([
                    'order_id' => $order->id,
                    'comment' => $comment
                ]);
            }

            return response()->json([
                'status' => true,
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Error Sign Key'
        ], 403);
    }
}
