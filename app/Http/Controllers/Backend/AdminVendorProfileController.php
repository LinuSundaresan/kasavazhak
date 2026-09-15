<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminVendorProfileRequest;
use App\Interfaces\AdminVendorProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageUploadTrait;

class AdminVendorProfileController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = app(AdminVendorProfileRepositoryInterface::class)->getByUserId(Auth::user()->id);
        return view('admin.vendor-profile.index', compact(
            'vendor'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminVendorProfileRequest $request)
    {
        $data = $request->validated();
        $path = $this->updateImage($request, 'banner', 'uploads/vendor_profile');
        if($path){
            $data = array_merge($data, ['banner' => $path]);
        }
        app(AdminVendorProfileRepositoryInterface::class)->update($data , Auth::user()->id);

        toastr()->success('Vendor Profile Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
