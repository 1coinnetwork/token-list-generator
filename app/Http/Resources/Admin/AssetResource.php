<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    public function toArray($request)
    {
        $logouri = "https://1cointokens,com/assets/" . $this->network->chainid . "/" .
            $this->contract_address . "/logo.png";
        return [
            "name" => $this->name,
            "chainId" => $this->network->chainid,
            "symbol" => $this->symbol,
            "decimals" => ($this->decimals) ? $this->decimals : 18,
            "address" => $this->contract_address,
            "logoURI" => ($this->logoURI) ?                $this->logoURI
                : $logouri
        ];
    }
}
