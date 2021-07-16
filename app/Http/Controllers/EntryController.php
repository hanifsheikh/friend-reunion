<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Image;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000',
            'nid' => 'required|unique:entries|string|min:9|max:17',
            'contact_no' => 'required|unique:entries|digits_between:9,11',
            'alternative_contact_no' => 'nullable|digits_between:9,11',
            'mailing_address' => 'required',
            'email_address' => 'required',
            'date_of_birth' => 'required',
            'marital_status' => 'required',
            'educational_qualification' => 'required',
            'professional_status' => 'required',
            'religion' => 'required',
            'presence_of_upcoming_event' => 'required|boolean'
        ],
         [
        'contact_no.digits_between' => 'Contact no. should be valid',
        'alternative_contact_no.digits_between' => 'Alternative Contact no. should be valid',
        'nid.unique' => 'NID/Passport already registered',
        'nid.max' => 'NID/Passport No. can not greater than 17 characters',
        'nid.min' => 'NID/Passport No. can not less than 9 characters',
        'photo.max' => 'Photo can not be larger than 10 MB',
         ]
    );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $photo = $this->storeImage($request);
        $entry = new Entry;
        $entry->name = $request->name;
        $entry->photo = $photo;
        $entry->nid = $request->nid;
        $entry->contact_no = $request->contact_no;
        $entry->mailing_address = $request->mailing_address;
        $entry->email_address = $request->email_address;
        $entry->date_of_birth = $request->date_of_birth;
        $entry->marital_status = $request->marital_status;
        $entry->educational_qualification = $request->educational_qualification;
        $entry->professional_status = $request->professional_status;
        $entry->religion = $request->religion;
        $entry->presence_of_upcoming_event = $request->presence_of_upcoming_event;
        $entry->alternative_contact_no = $request->alternative_contact_no;
        $entry->marriage_anniversary = $request->marriage_anniversary;
        $entry->spouse_name = $request->spouse_name;
        $entry->no_of_children = $request->no_of_children;
        $entry->save();
        return response()->json($entry);
    }
 
    public function storeImage($request)
    {
        // Get file from request
        $file = $request->file('photo');  
        // Create unique file name
        $fileNameToStore = str_replace(" ","",$request->nid) . '_'. $request->contact_no . '.' . 'webp';
        // Refer image to method resizeImage
        $save = $this->resizeImage($file, $fileNameToStore);
        if ($save) {
            return $fileNameToStore;
        }
        return false;
    }

    public function resizeImage($file, $fileNameToStore)
    {
        // Resize image
        $resize = Image::make($file)->orientate()->resize(1024, null, function($constraint){ 
            $constraint->upsize();
            $constraint->aspectRatio();  
        })->encode('webp'); 
        // Put image to storage
        $save = Storage::put("public/images/{$fileNameToStore}", $resize->__toString());

        if ($save) {
            return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
