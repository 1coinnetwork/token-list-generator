<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AssetLogoController extends Controller
{

    public function __invoke($network_id, $address)
    {

        if ($asset = Asset::where('contract_address', $address)->with('network')->first()) {
            ($this->getLogo($asset->logo)) ? $this->getLogo($asset->logo) : abort(404);
        } else {
            abort(404);
        }

        //  $asset->('chainid', $network_id)
        //   ->where('network_id', (int)$network_id)
        //       ->first();


    }

    private function getLogo(Media $mediaItem)
    {
        return $mediaItem('logo');
    }
}
