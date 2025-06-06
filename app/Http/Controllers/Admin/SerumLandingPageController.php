<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SerumLandingPage;
use App\Models\SerumReviewImage;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SerumLandingPageController extends Controller
{
    use ImageUploadTraits;
    
    // public $user;
    // public function __construct()
    // {
    //     $this->user = Auth::guard('admin')->user();
    //     if (!$this->user) {
    //         abort(403, 'Unauthorized access');
    //     }
    // }
    /**
     * Display a listing of the resource.
     */
    public function serum_demo()
    {
        return view('landing_page.pages.beauty_item.serum_product.demo');
    }

    public function index()
    {
        return view('landing_page.pages.beauty_item.serum_product.index');
    }

    public function getData()
    {
        // get all data
        $serums = SerumLandingPage::leftJoin('products', 'products.id', 'serum_landing_pages.first_product_id')
                ->select('serum_landing_pages.*', 'products.name as product_name', 'products.thumb_image as product_image', 'serum_landing_pages.slug as slugs')
                ->get();

        return DataTables::of($serums)
            ->addIndexColumn()
            ->addColumn('product_image', function ($serum) {
                return '<a href="'.asset( $serum->product_image ).'" target="__blank">
                     <img src="'.asset( $serum->product_image ).'" width="50px" height="50px">
                </a>';
            })
            ->addColumn('fb_link', function ($serum) {
                return '<a href="'. $serum->facebook_link .'" target="__blank">
                '. $serum->facebook_link .'</a>';
            })
            ->addColumn('status', function ($serum) {
                // if(auth("admin")->user()->can("status.brand"))
                    if ($serum->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$serum->id.'" data-status="'.$serum->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$serum->id.'" data-status="'.$serum->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                // else{
                //     return '<span class="badge bg-info">N/A</span>'; 
                // }
            })
            ->addColumn('action', function ($serum) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            @if( $serum->status == 1 )
                                <a class="dropdown-item text-info" target="_blank" href="'. route('serum.view', $serum->slugs) .'" >
                                    <i class="fas fa-eye"></i> View
                                </a>
                            @endif

                            <a class="dropdown-item text-success" href="'. route('admin.serum.edit', $serum->id) .'">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$serum->id.'" id="deleteBtn">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                ', ['serum' => $serum]);
                return $actionHtml;
            })
            ->rawColumns(['product_image', 'fb_link', 'status', 'action'])
            ->make(true);
    }


    public function changeSerumStatus(Request $request)
    {
        // if (!$this->user || !$this->user->can('status.brand')) {
        //     throw UnauthorizedException::forPermissions(['status.brand']);
        // }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = SerumLandingPage::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view('landing_page.pages.beauty_item.serum_product.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'slug'               => 'required|string|max:255',
            'header_title'       => 'required|string|max:255',
            'first_product_id'   => 'required|exists:products,id',
            'second_product_id'  => 'required|exists:products,id',
            'useful_list_name'   => 'required|array',
            'why_list_name'      => 'required|array',
            'video_link'         => 'nullable|string',
            'facebook_link'      => 'required|url',
            'phone_number'       => 'required|string|max:20',
            'images'             => 'nullable|array',
            'images.*'           => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        DB::beginTransaction();
        try {
            $serumLandingPage = new SerumLandingPage();

            $serumLandingPage->slug                = $request->slug;
            $serumLandingPage->header_title        = $request->header_title;
            $serumLandingPage->first_product_id    = $request->first_product_id;
            $serumLandingPage->second_product_id   = $request->second_product_id;
            $serumLandingPage->useful_list_name    = json_encode($request->useful_list_name);
            $serumLandingPage->why_list_name       = json_encode($request->why_list_name);
            $serumLandingPage->video_link          = $request->video_link;
            $serumLandingPage->facebook_link       = $request->facebook_link;
            $serumLandingPage->phone_number        = $request->phone_number;
            $serumLandingPage->status              = 1;
             
            // dd($serumLandingPage);
            $serumLandingPage->save();


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) { 
                    // Generate unique image name
                    $serumReviewImage = new SerumReviewImage();
                    $serumReviewImage->serum_lp_id = $serumLandingPage->id;

                    $imageName = $request->slug . rand(1, 99999999) . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'public/landing_page/images/';
                    $image->move($imagePath, $imageName);
                    $serumReviewImage->images   =  $imagePath . $imageName;

                    $serumReviewImage->save();
                }
            }
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        Toastr::success('Landing Page Create successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.serum.index');
    }

    /**
     * Display the specified resource.
     */
    public function viewProduct($slug)
    {
        // dd($slug);
        $landingPage = SerumLandingPage::where('slug', $slug)->first();
        $serumReviewImages = SerumReviewImage::where('serum_lp_id', $landingPage->id)->get();
        if( $landingPage->status == 0 ){
            abort(404);
        }
        return view('landing_page.pages.beauty_item.serum_product.view', compact('landingPage', 'serumReviewImages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $landingPage         = SerumLandingPage::findOrFail($id);
        $products            = Product::where('status', 1)->get();
        $serumReviewImages   = SerumReviewImage::where('serum_lp_id', $landingPage->id)->get();

        return view('landing_page.pages.beauty_item.serum_product.edit', compact('landingPage', 'products', 'serumReviewImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'slug'               => 'required|string|max:255',
            'header_title'       => 'required|string|max:255',
            'first_product_id'   => 'required|exists:products,id',
            'second_product_id'  => 'required|exists:products,id',
            'useful_list_name'   => 'required|array',
            'why_list_name'      => 'required|array',
            'video_link'         => 'nullable|string',
            'facebook_link'      => 'required|url',
            'phone_number'       => 'required|string|max:20',
            'images'             => 'nullable|array',
            'images.*'           => 'mimes:jpg,jpeg,png,webp|max:4096',
        ]);

           $serumLandingPage                      = SerumLandingPage::findOrFail($id);

            $existingSerumReviewImage  = SerumReviewImage::where('serum_lp_id', $serumLandingPage->id)->get();

            if( $existingSerumReviewImage->count() == 0 ){
                if (!$request->hasFile('images') || count($request->file('images')) == 0) {
                    Toastr::error('At least one image must be shown', 'Error', ["positionClass" => "toast-top-right"]);
                    return redirect()->back()->withInput();
                }
            }

        DB::beginTransaction();
        try {


            $serumLandingPage->slug                = $request->slug;
            $serumLandingPage->header_title        = $request->header_title;
            $serumLandingPage->first_product_id    = $request->first_product_id;
            $serumLandingPage->second_product_id   = $request->second_product_id;
            $serumLandingPage->useful_list_name    = json_encode(array_filter($request->useful_list_name));
            $serumLandingPage->why_list_name       = json_encode(array_filter($request->why_list_name));
            $serumLandingPage->video_link          = $request->video_link;
            $serumLandingPage->facebook_link       = $request->facebook_link;
            $serumLandingPage->phone_number        = $request->phone_number;
            $serumLandingPage->status              = 1;
             
            // dd($serumLandingPage);
            $serumLandingPage->save();


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) { 
                    // Generate unique image name
                    $serumReviewImage = new SerumReviewImage();
                    $serumReviewImage->serum_lp_id = $serumLandingPage->id;

                    $imageName = $request->slug . rand(1, 99999999) . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'public/landing_page/images/';
                    $image->move($imagePath, $imageName);
                    $serumReviewImage->images   =  $imagePath . $imageName;

                    $serumReviewImage->save();
                }
            }
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        Toastr::success('Landing Page Create successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.serum.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serumLandingPage = SerumLandingPage::findOrFail($id);

        // dd($serumLandingPage);
        $serumReviewImages = SerumReviewImage::where('serum_lp_id', $serumLandingPage->id)->get();

        // dd($serumReviewImages);
        if ($serumReviewImages->isNotEmpty()) {
            foreach ($serumReviewImages as $row) {
                if ($row->images && file_exists($row->images)) {
                    unlink($row->images);
                }

                $row->delete();
            }
        }

        $serumLandingPage->delete();

        // Toastr::success('Landing Page Delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        // return redirect()->back();
        return response()->json(['message' => 'Landing Page has been deleted.'], 200);
    }

    public function delete_review_serum_image($id)
    {
        // dd($id);
        try {
            $serumReviewImage = SerumReviewImage::findOrFail($id);
            if( !is_null( $serumReviewImage ) ){
                if( file_exists( $serumReviewImage->images )){
                    unlink($serumReviewImage->images);
                }
                $serumReviewImage->delete();
            }

            Toastr::success('Image Delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } 
        catch (\Exception $e) {
            Toastr::error('There is something wrong', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
