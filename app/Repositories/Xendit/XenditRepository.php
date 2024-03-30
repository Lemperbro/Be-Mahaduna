<?php
namespace App\Repositories\Xendit;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Repositories\Xendit\XenditInterface;

class XenditRepository implements XenditInterface
{
    private $apiKey, $invoiceUrl, $callbackToken;

    public function __construct()
    {
        $this->apiKey = config('xendit.apiKey');
        $this->invoiceUrl = config('xendit.apiUrl.invoice');
        $this->callbackToken = config('xendit.x-callback-token');
    }

    /**
     * untuk membuat invoice ke api xendit 
     * @param mixed $data data dari tagihan
     * 
     * @return [type]
     */
    public function createInvoice($data)
    {
        $external_id = Str::uuid();
        $create = Http::withHeaders([
            'Authorization' => $this->apiKey
        ])->post($this->invoiceUrl, [
                    'external_id' => $external_id,
                    'amount' => $data->price,
                    'description' => $data->label
                ]);
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