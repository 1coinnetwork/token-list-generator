<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Admin\AssetResource;
use Carbon\Carbon;

class TokenManifestCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => "1COIN Token List",
            "version" => [
                "major" => 1,
                "minor" => 0,
                "patch" => 1,
            ],
            "logoURI" => 'https://raw.githubusercontent.com/compound-finance/token-list/master/assets/ctoken_usdc.svg',
            "timestamp" => Carbon::now(),
            "keywords" => [
                "tokens",
                "trusted"
            ],
            "tokens" => AssetResource::collection($this->collection)
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
