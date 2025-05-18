<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\HomeSetting;
use App\Models\Subcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories             = Category::where('status', 1)->get();
        $popularCategorySection = HomeSetting::where('key', 'popular_category_Section')->first();
        $productSliderSectionOne = HomeSetting::where('key', 'product_slider_section_one')->first();
        $productSliderSectionTwo = HomeSetting::where('key', 'product_slider_section_two')->first();
        $productSliderSectionThree = HomeSetting::where('key', 'product_slider_section_three')->first();
        return view('backend.pages.homePageSetting.index', [
            'categories'                 => $categories,
            'popularCategorySection'     => $popularCategorySection,
            'productSliderSectionOne'    => $productSliderSectionOne,
            'productSliderSectionTwo'    => $productSliderSectionTwo,
            'productSliderSectionThree'  => $productSliderSectionThree,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function updatePopularCategorySection(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cat_one'   => ['required'],
            'cat_two'   => ['required'],
            'cat_three' => ['required'],
            'cat_four'  => ['required'],
        ]);

        $data = [
            [
                'category'        => $request->cat_one,
                'sub_category'    => $request->subCat_one,
                'child_category'  => $request->childCat_one,
            ],
            [
                'category'        => $request->cat_two,
                'sub_category'    => $request->subCat_two,
                'child_category'  => $request->childCat_two,
            ],
            [
                'category'        => $request->cat_three,
                'sub_category'    => $request->subCat_three,
                'child_category'  => $request->childCat_three,
            ],
            [
                'category'        => $request->cat_four,
                'sub_category'    => $request->subCat_four,
                'child_category'  => $request->childCat_four,
            ],
        ];

        HomeSetting::updateOrCreate(
            [
                'key' => 'popular_category_Section',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateProductSliderSectionOne(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cat_one'   => ['required'],
        ]);

        $data = [
                'category'        => $request->cat_one,
                'sub_category'    => $request->subCat_one,
                'child_category'  => $request->childCat_one,
            ];

        HomeSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_one',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateProductSliderSectionTwo(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cat_one'   => ['required'],
        ]);

        $data = [
                'category'        => $request->cat_one,
                'sub_category'    => $request->subCat_one,
                'child_category'  => $request->childCat_one,
            ];

        HomeSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_two',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateProductSliderSectionThree(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cat_one'   => ['required'],
        ]);

        $data = [
                'category'        => $request->cat_one,
                'sub_category'    => $request->subCat_one,
                'child_category'  => $request->childCat_one,
            ];

        HomeSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_three',
            ],
            [
                'value' => json_encode($data)
            ],
        );

        Toastr::success('Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function get_subCategory_data(Request $request)
    {
        $subCategories = Subcategory::where('category_id', $request->id)->where('status', 1)->get();

        // 'subcategory_img' is the column name where image filename is stored
        foreach ($subCategories as $subCategory) {
            $subCategory->image_url = asset($subCategory->subcategory_img); 
        }

        return response()->json(['status' => true, 'data' => $subCategories]);
    }

    public function get_childCategory_data(Request $request)
    {
        $childCategories = ChildCategory::where('subCategory_id', $request->id)->where('status', 1)->get();

        foreach ($childCategories as $childCategory) {
            $childCategory->image_url = asset($childCategory->img); 
        }

        return response()->json(['status' => true, 'data' => $childCategories]);
    }

}
