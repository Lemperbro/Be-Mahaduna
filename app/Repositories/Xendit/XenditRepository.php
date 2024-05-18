<?php
namespace App\Repositories\Xendit;

use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Repositories\Xendit\XenditInterface;

class XenditRepository implements XenditInterface
{
    private $apiKey, $invoiceUrl, $callbackToken, $santriModel;

    public function __construct()
    {
        $this->apiKey = config('xendit.apiKey');
        $this->invoiceUrl = config('xendit.apiUrl.invoice');
        $this->callbackToken = config('xendit.x-callback-token');
        $this->santriModel = new Santri;
    }

    /**
     * untuk membuat invoice ke api xendit 
     * @param mixed $data data dari tagihan
     * 
     * @return [type]
     */
    public function createInvoice($data)
    {
        $waliData = $this->santriModel->with('waliRelasi.wali')->where('santri_id', $data->santri_id)->first();
        $external_id = Str::uuid();
    
        $body = [
            'external_id' => $external_id,
            'amount' => $data->price,
            'description' => $data->label,
        ];
    
        if ($waliData->waliRelasi !== null && $waliData->waliRelasi->wali !== null) {
            $wali = $waliData->waliRelasi->wali;
            $body['customer'] = [
                'email' => $wali->email,
                'mobile_number' => $wali->telp,
            ];
        }
    
        $create = Http::withHeaders([
            'Authorization' => $this->apiKey
        ])->post($this->invoiceUrl, $body);
    
        $response = $create->object();
        return $response;
    }
    

    /**
     * untuk memverifikasi callback token dari webhooks xendit
     * @param mixed $callbackToken
     * 
     * @return [type]
     */
    public function verifyCallbackToken($callbackToken)
    {
        if ($this->callbackToken !== $callbackToken) {
            return false;
        }
        return true;
    }

}