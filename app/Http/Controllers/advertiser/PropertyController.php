<?php

namespace App\Http\Controllers\advertiser;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\RestrictWord;
use Illuminate\Http\Request;
use App\Rules\RestrictedWord;
use App\Models\PropertyListing;
use App\Rules\ImageDetectorRule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Rules\GoogleAddressValidator;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Intervention\Image\ImageManagerStatic as Image;



class PropertyController extends Controller
{
    private function savePhoto($file)
    {
        $name = Str::ulid() . '.jpg';

        Image::make($file)->fit(200, 200)->save(public_path("images/$name"));

        return $name;
    }

    private function deletePhoto($name)
    {
        File::delete(public_path("/images/$name"));
    }

    // -------------------------------------------------------

    public function index()
    {
        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;
        $properties = PropertyListing::where('advertiser_id', $advertiserId)->paginate(5);
        return view('advertiser.property.index', ['properties' => $properties]);
    }

    public function create()
    {
        return view('advertiser.property.create');
    }

    public function checkRestrictedWords($name)
    {
        $restrictedWords = RestrictWord::pluck('word_name')->toArray();

        foreach ($restrictedWords as $restrictedWord) {
            if (stripos($name, $restrictedWord) !== false) {
                // Name contains a restricted word
                return true;
            }
        }

        // Name is valid (does not contain any restricted words)
        return false;
    }

    public function store(Request $request)
    {

        $request->validate([
            'property_name'             => ['required', 'max:50', new RestrictedWord],
            'property_address'          => ['required', 'max:500', new GoogleAddressValidator, new RestrictedWord],
            'property_address_state'    => 'required',
            'property_postal'           => 'required',
            'property_description'      => ['required', 'max:600', new RestrictedWord],
            'property_image1'           => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048', new ImageDetectorRule],
            // 'property_image2'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image3'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image4'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image5'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'property_housing_type'     => 'required',
            'property_type'             => 'required',
            'property_number_room'      => 'required|numeric',
            'property_room_type'        => 'required',
            'property_price'            => 'required',
            'property_feature'          => ['required', 'max:500', new RestrictedWord],
        ]);

        $latestProperty = PropertyListing::latest('property_id')->first();
        $lastPropertyId = $latestProperty ? $latestProperty->property_id : 'P0000';
        $propertyId = 'P' . str_pad((int) substr($lastPropertyId, 1) + 1, 4, '0', STR_PAD_LEFT);

        $advertiserId = auth()->guard('advertiser')->user()->advertiser_id;

        PropertyListing::create([
            'property_id'               => $propertyId,
            'property_name'             => $request->property_name,
            'property_address'          => $request->property_address,
            'property_address_state'    => $request->property_address_state,
            'property_postal'           => $request->property_postal,
            'property_description'      => $request->property_description,
            'property_housing_type'     => $request->property_housing_type,
            'property_image1'           => $this->savePhoto($request->property_image1),
            // 'property_image2'           => $this->savePhoto($request->property_image2),
            // 'property_image3'           => $this->savePhoto($request->property_image3),
            // 'property_image4'           => $this->savePhoto($request->property_image4),
            // 'property_image5'           => $this->savePhoto($request->property_image5),
            'property_type'             => $request->property_type,
            'property_room_type'        => $request->property_room_type,
            'property_number_room'      => $request->property_number_room,
            'property_rental_status'    => 'Vacant',
            'property_posting_status'   => 'Pending',
            'property_post_date'        => Carbon::now(),
            'property_price'            => $request->property_price,
            'property_feature'          => $request->property_feature,
            'advertiser_id'             => $advertiserId
        ]);

        return redirect()->route('property.index')->with('info', 'Done adding a new property listing!');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $property = PropertyListing::findOrFail($id);
        return view('advertiser.property.show', ['property' => $property]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $property = PropertyListing::findOrFail($id);
        return view('advertiser.property.edit', ['property' => $property]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'property_name'             => ['required', 'max:50', new RestrictedWord],
            'property_address'          => ['required', 'max:500', new RestrictedWord],
            'property_address_state'    => 'required',
            'property_postal'           => 'required',
            'property_description'      => ['required', 'max:600', new RestrictedWord],
            'property_image1'           => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048', new ImageDetectorRule],
            // 'property_image2'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image3'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image4'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'property_image5'           => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'property_housing_type'     => 'required',
            'property_type'             => 'required',
            'property_number_room'      => 'required|numeric',
            'property_room_type'        => 'required',
            'property_price'            => 'required',
            'property_feature'          => ['required', 'max:500', new RestrictedWord],
        ]);

        $property = PropertyListing::findOrFail($id);

        if ($request->property_image1) {
            $this->deletePhoto($property->property_image1);
            $photoStore1 = $this->savePhoto($request->property_image1);
        }

        // if($request->property_image2){
        //     $this->deletePhoto($property->property_image2);
        //     $photoStore2 = $this->savePhoto($request->property_image2);
        // }

        // if($request->property_image3){
        //     $this->deletePhoto($property->property_image3);
        //     $photoStore3 = $this->savePhoto($request->property_image3);
        // }

        // if($request->property_image4){
        //     $this->deletePhoto($property->property_image4);
        //     $photoStore4 = $this->savePhoto($request->property_image4);
        // }

        // if($request->property_image5){
        //     $this->deletePhoto($property->property_image5);
        //     $photoStore5 = $this->savePhoto($request->property_image5);
        // }

        $property->update([
            'property_name'             => $request->property_name,
            'property_address'          => $request->property_address,
            'property_address_state'    => $request->property_address_state,
            'property_postal'           => $request->property_postal,
            'property_description'      => $request->property_description,
            'property_housing_type'     => $request->property_housing_type,
            'property_image1'           => $photoStore1,
            // 'property_image2'           => $photoStore2,
            // 'property_image3'           => $photoStore3,
            // 'property_image4'           => $photoStore4,
            // 'property_image5'           => $photoStore5,
            'property_type'             => $request->property_type,
            'property_number_room'      => $request->property_number_room,
            'property_rental_status'    => $request->property_rental_status,
            'property_updated_date'     => Carbon::now(),
            'property_feature'          => $request->property_feature,
            'property_price'            => $request->property_price,
        ]);

        return redirect()->route('property.index')->with('info', 'Done updateing the property listing!');
    }

    public function destroy(string $id)
    {
        $property = PropertyListing::findOrFail($id);
        $property->delete();
        return redirect()->route('property.index')->with('info', 'The selected property listing deleted successfully.');
    }
}
