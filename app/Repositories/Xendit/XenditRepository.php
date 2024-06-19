<?php
namespace App\Repositories\Xendit;

use App\Models\Santri;
use App\Repositories\HandleError\ResponseErrorRepository;
use App\Repositories\Xendit\XenditInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class XenditRepository implements XenditInterface
{
    private $apiKey, $invoiceUrl, $callbackToken, $santriModel;
    private $handleResponseError;


    public function __construct()
    {
        $this->apiKey = config('xendit.apiKey');
        $this->invoiceUrl = config('xendit.apiUrl.invoice');
        $this->callbackToken = config('xendit.x-callback-token');
        $this->santriModel = new Santri;
        $this->handleResponseError = new ResponseErrorRepository;

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
        
        if ($create->successful()) {
            return $create->object(); 
        } else {
            $this->handleResponseError->ResponseException('Failed to create invoice', $create->status());
        }
    }
    

    /**
     * untuk memverifikasi callback token dari webhooks xendit
     * @param mixed $callbackToken
     * 
     * @return [type]
     */
    public function verifyCallbackToken($callbackToken)
    {
        //jika token sama maka return true, kalau tidak maka return false
        return $this->callbackToken === $callbackToken;
    }

}