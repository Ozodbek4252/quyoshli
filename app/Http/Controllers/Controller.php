<?php

namespace App\Http\Controllers;

//use App\Helpers\Sms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//use LaravelSmpp\SmppService;
//use LaravelSmpp\SmppServiceInterface;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    public function send(SmppServiceInterface $smpp)
//    {
//        dd($smpp->sendOne(998946404476, 'test sherali kachok'));
//    }

    protected function info(string $text)
    {
        $this->sendAlert('info', $text);
    }

    protected function success(string $text)
    {
        $this->sendAlert('success', $text);
    }

    protected function error(string $text)
    {
        $this->sendAlert('error', $text);
    }

    private function sendAlert(string $type, string $text)
    {
        request()->session()->flash($type, $text);
    }
}
