<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    public function toArray($request)
    {
        //   $logouri = "https://1cointokens,com/assets/" . $this->network->chainid . "/" .
        //      $this->contract_address . "/logo.png";
        return [
            "chainId" => $this->network->chainid,
            "address" => $this->contract_address,
            "symbol" => $this->symbol,
            "name" => $this->name,
            "decimals" => ($this->decimals) ? $this->decimals : 18,
            "logoURI" => 'https://raw.githubusercontent.com/compound-finance/token-list/master/assets/ctoken_usdc.svg'
            //      "logoURI" => ($this->logoURI) ?                $this->logoURI
            //          : $logouri
        ];
    }
}
