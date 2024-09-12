<?php

namespace App\Http\Controllers\Dashboard\Orders;

use App\Api\Sms;
use App\Exports\OrdersExport;
use App\Models\Branch;
use App\Models\Currency;
use App\Models\OrdersComment;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Http\Controllers\Controller as ExController;

use App\Jobs\Dashboard\Order\Update as UpdateJob;
use App\Jobs\Dashboard\Order\Products as ProductsUpdateJob;

use App\Http\Requests\Dashboard\Order\Update as UpdateRequest;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Apelsin\Controller as ApelsinController;
use Spatie\Activitylog\Models\Activity;

class Controller extends ExController
{
    protected $orders;
    protected $order_products;
    protected $products;
    protected $currency;
    protected $sms;
    protected $apelsin;

    /**
     * Controller constructor.
     * @param Order $order
     * @param OrderProducts $order_products
     * @param Product $product
     * @param Currency $currency
     */
    public function __construct(Order $order, OrderProducts $order_products, Product $product, Currency $currency)
    {
        $this->orders = $order;
        $this->products = $product;
        $this->order_products = $order_products;
        $this->sms = new Sms();
        $this->currency = $currency->latest('id', 'desc')->limit(1)->first();
        $this->apelsin = new ApelsinController();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', 'orders');
        $orders = $this->orders->latest('id')->archived(false);

        $statuses = [];

        if (!empty(auth()->user()->role->permissions['order_status']['processing']) || !empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
            $statuses[] = 'processing';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
            $statuses[] = 'collected';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
            $statuses[] = 'waiting_buyer';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
            $statuses[] = 'in_way';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled']) || !empty(auth()->user()->role->permissions['order_status']['replacement']) ) {
            $statuses[] = 'closed';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
            $statuses[] = 'cancelled';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['replacement'])) {
            $statuses[] = 'replacement';
        }

        if (!empty(auth()->user()->role->permissions['order_status']['completed'])) {
            $statuses[] = 'completed';
        }

        $orders = $orders->whereIn('status', $statuses)->paginate(20);

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function view(Order $order)
    {
        $this->authorize('view', 'orders');
        $products = $this->order_products->where('order_id', $order->id)->get();
        //total = $this->order_products->getTotalPrice($order->id);
//        $comments = OrdersComment::
        $logs = Activity::orderBy('id', 'asc')->where('subject_type', 'App\Models\Order')->where('subject_id', $order->id)->get();

        $setting = Setting::find(1);
        return view('dashboard.orders.view', compact('order', 'products', 'setting', 'logs'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoice_print(Order $order)
    {
        return view('invoice', compact('order'));
//        $path = public_path().'/pdf';
//        $pdf = PDF::loadView('invoice');
//        return $pdf->download('medium.pdf');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $orders = $this->orders->latest('id')->where('id', $request->get('id'))->paginate(20);
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     *
     */
    public function archive()
    {
        $orders = $this->orders->latest('id')->archived(true)->paginate(20);
        return view('dashboard.orders.archive', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mass_archived(Request $request)
    {
        switch ($request->input('action')) {
            case "unarchive":
                Order::whereIn('id', $request->order_id)->update([
                    'archived' => false
                ]);
                break;
            case "archived":
                Order::whereIn('id', $request->order_id)->update([
                    'archived' => true
                ]);
                break;
        }

        $this->info('Успешно перенесен в архив');
        return redirect()->back();
    }


    /**
     * @param Order $order
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Order $order, UpdateRequest $request)
    {
        $branches = Branch::all();
        if ($request->isMethod('get')) {
            $this->authorize('update', 'orders');
            $order->loadMissing([
                'address.city.region',
                'products' => function ($product) {
                    return $product->select('order_id', 'product_id', 'count', 'color_id', 'size', 'discount')->with([
                        'product' => function ($product) {
                            return $product->select('id', 'name', 'price', 'price_discount', 'poster_thumb', 'color_id', 'currency');
                        },
                        'color' => function ($color) {
                            return $color->select('id',  'sizes', 'color_id')->with([
                                'color'
                            ]);
                        }
                    ]);
                },
                'branch:id,name'
            ]);


            foreach($order->products as $product) {
                $product->product->price = $product->product->getPrice();
                $product->price_discount = $product->product->price_discount == null ? null : $product->product->getDiscountPrice();
            }

            return view('dashboard.orders.update', compact('order', 'branches'));
        }

        //$address = Address::find($order->address_id);

        $this->dispatchSync(UpdateJob::fromRequest($order, $request));
        //$this->dispatchSync(AddressUpdateJob::fromRequest($address, $request));
        $this->dispatchSync(new ProductsUpdateJob($order, $request));

        $this->info(trans('admin.messages.updated'));

        return response()->json([
            'status' => true
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function product(Product $product)
    {
        $product->loadMissing([
            'childrens' => function ($child) {
                return $child->select('id', 'child_id', 'color_id', 'sizes')->with([
                    'color'
                ]);
            }
        ]);

        $product->makeHidden([
            'body', 'name', 'brand_id', 'child_id', 'slug', 'published', 'updated_at', 'created_at', 'deleted_at',
            'poster', 'poster_thumb', 'price', 'price_discount'
        ]);

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search_update(Request $request)
    {
        $query = $request->name;

        $product = $this->products->where('name->ru', 'like', '%'.$query . '%')->isAvailable()->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'poster' => '/' . $product->poster,
                'name' => $product->name['ru']
            ];
        });

        return response()->json([
            'status' => true,
            'products' => $product
        ]);
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function product_info(Product $product)
    {
        $this->authorize('view', 'orders');
//        if ($product->currency == 'dollar') {
//            $product->price = round($product->price * $this->currency->dollar, -3);
//            $product->price_discount = $product->price_discount == null ? null : round($product->price_discount * $this->currency->dollar, -3);
//        } else {
//            $product->price = round($product->price * $this->currency->euro, -3);
//            $product->price_discount = $product->price_discount == null ? null : round($product->price_discount * $this->currency->euro, -3);
//        }

        $product->price = $product->getPrice();
        $product->price_discount = $product->price_discount == null ? null : $product->getDiscountPrice();

        $product->loadMissing('childrens');

        return response()->json([
            'status' => true,
            'product' => $product
        ]);
    }

    /**
     * @param Order $order
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_status(Order $order, $status)
    {
        switch ($status) {
            case 'processing':
                if (!empty(auth()->user()->role->permissions['order_status']['processing']) || !empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "Alistore vash zakaz: {$order->id} podtverjden!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'collected':
                if (!empty(auth()->user()->role->permissions['order_status']['collected']) || !empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "Alistore vash zakaz: {$order->id} prinyat!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'waiting_buyer':
                if (!empty(auth()->user()->role->permissions['order_status']['waiting_buyer']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "Alistore vash zakaz: {$order->id} mi vas jdem!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'in_way':
                if (!empty(auth()->user()->role->permissions['order_status']['in_way']) || !empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = $status;
                    $message = "Alistore vash zakaz: {$order->id} otpravlen!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'cancelled':
//                if (!empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
//                    $order->status = $status;
//                    $message = "Alistore vash zakaz: {$order->id} otmenen!";
//                } else {
//                    return abort(403, 'Мы от тебя не ждали :(');
//                }
                break;
            case 'replacement':
//                if (!empty(auth()->user()->role->permissions['order_status']['replacement'])) {
//                    $order->status = $status;
//                } else {
//                    return abort(403, 'Мы от тебя не ждали :(');
//                }
                break;

        }

        $this->sms->send($order->user->phone, $message);
        $order->save();

        $this->info(trans('admin.messages.updated'));

        return redirect()->back();
    }

    public function filter(Request $request)
    {
        $id = empty($request->get('id')) ? null : $request->get('id');
        $type_delivery = empty($request->get('delivery_type')) ? null : $request->get('delivery_type');
        $status = empty($request->get('delivery_status')) ? null : $request->get('delivery_status');
        $pay_status = empty($request->get('pay_status')) ? null : $request->get('pay_status');
        $from = empty($request->get('from')) ? Carbon::parse('2000-01-01')->format('Y-m-d') : Carbon::parse($request->get('from'))->format('Y-m-d');
        $to = empty($request->get('to')) ? Carbon::parse('2040-01-01')->format('Y-m-d') : Carbon::parse($request->get('to'))->format('Y-m-d');
        $user = empty($request->get('user')) ? null : $request->get('user');
//        return $request->all();

        $orders = $this->orders->latest('id')
            ->when($id ?? null, function ($query, $id) {
                $query->where('id', $id);
            })->when($type_delivery ?? null, function ($query, $type_delivery) {
                 $query->where('type_delivery', $type_delivery);
            })->when($status ?? null, function ($query, $status) {
                 $query->where('status', $status);
            });

            if ($pay_status == 2) {
                $orders = $orders->when($pay_status ?? null, function ($query, $pay_status) {
                    $query->where('status', 4);
                });
            } else {
                $orders = $orders->when($pay_status ?? null, function ($query, $pay_status) {
                    $query->where('payment_status', $pay_status);
                });
            }

            $orders = $orders->whereHas('user', function ($query) use ($user) {
                $query->when($user ?? null, function ($query, $user) {
                     $phone = str_replace(['(', ')', ' ', '+'], '', $user);
                     $query->where('phone', $phone);
                });
            });

            $orders = $orders->whereBetween('created_at', [$from, $to])
            ->paginate(20);

        return view('dashboard.orders.index', compact('orders'));
    }

    public function comments(Request $request)
    {
        $order = Order::find($request->order_id);

        switch($request->type) {
            case 'cancelled':
                if (!empty(auth()->user()->role->permissions['order_status']['cancelled'])) {
                    $order->status = 'cancelled';
                    foreach ($order->products as $row) {
                        $product = Product::find($row->product_id);
                        if (!empty($product)) {
                            $product->count = $product->count + $row->count;
                            $product->save();
                        }
                    }
                    $message = "Alistore vash zakaz: {$order->id} otmenen!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;

            case 'replacement':
                if (!empty(auth()->user()->role->permissions['order_status']['replacement'])) {
                    $order->status = 'replacement';
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'closed':
                if (!empty(auth()->user()->role->permissions['order_status']['closed']) || !empty(auth()->user()->role->permissions['order_status']['cancelled']) || !empty(auth()->user()->role->permissions['order_status']['replacement']) ) {
                    $order->status = 'closed';

                    if ($order->payment_type == 'credit') {
                        $apelsin = $this->apelsin->delivered($order->id);

                        $order->update([
                            'apelsin_data' => $apelsin
                        ]);
                    }


                    $message = "Alistore vash zakaz: {$order->id} zavershen!";
                } else {
                    return abort(403, 'Мы от тебя не ждали :(');
                }
                break;
            case 'completed':
                if (!empty(auth()->user()->role->permissions['order_status']['completed'])) {
                    $order->status = 'completed';

                    if ($order->payment_type == 'credit') {
                        $apelsin = $this->apelsin->delivered($order->id);

                        $order->update([
                            'apelsin_data' => $apelsin
                        ]);
                    }


                    $message = "Alistore vash zakaz: {$order->id} zavershen!";
                } else {
                    abort(403, 'Мы от тебя не ждали :(');
                }
                break;
        }

        if (!empty($message)) {
            $this->sms->send($order->user->phone, $message);
        }

        if($request->type != 'default')
            $order->save();

        OrdersComment::create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
            'order_id' => $request->order_id,
            'type' => $request->type
        ]);

        if ($order->payment_type == 'credit' && ($request->type == 'closed' || $request->type == 'completed')) {
            if ($apelsin['status']) {
                $this->info(trans('admin.messages.updated'));
            } else {
                $this->error('Произошла ошибка в Apelsin Credit');
            }
        } else {
            $this->info(trans('admin.messages.updated'));
        }
        return redirect()->back();
    }

    public function export()
    {
        $orders = Order::all();
        return Excel::download(new OrdersExport, 'reports.xlsx');
    }
}
