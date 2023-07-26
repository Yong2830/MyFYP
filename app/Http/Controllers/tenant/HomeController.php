<?php

namespace App\Http\Controllers\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyListing;
use App\Models\Advertiser;

class HomeController extends Controller
{
    public function showHome(Request $request)
    {
        $searchResult = $request->search;

        $properties = PropertyListing::where('property_name', 'like', "%" . $searchResult . "%")
        ->orWhere('property_feature', 'like', "%" . $searchResult . "%")
        ->orWhere('property_price', 'like', "%" . $searchResult . "%")
        ->orWhere('property_address', 'like', "%" . $searchResult . "%")
        ->paginate(5);

        return view('tenant.tenantHome',['properties'=>$properties]);
    }

    public function showProperty($propertyId)
    {
        $property = PropertyListing::findOrFail($propertyId);

        $advertiserId = $property->advertiser_id;
        
        $advertiser = Advertiser::findOrFail($advertiserId);

        return view('tenant.tenantShowProperty', ['property' => $property, 'advertiser'=>$advertiser]);
    }
}
