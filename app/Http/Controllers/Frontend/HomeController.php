<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SubscriptionEvent;
use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Contact;
use App\Models\CustomPage;
use App\Models\EmailConfiguration;
use App\Models\Faq;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomeSetting;
use App\Models\Marquee;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\ProductReview;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $data['sliders']              = Slider::where('status', 1)->orderBy('id', 'desc')->get();
        $data['categories']           = Category::where('status', 1)->orderBy('id', "desc")->limit(5)->get();
        $data['brands']               = Brand::where('status', 1)->get();
        $data['flashSaleDate']        = FlashSale::first();
        $data['flashSaleItems']       = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $data['products']             = Product::where('is_approved', 1)->where('status', 1)->get();
        $data['collections']          = Collection::where('status', 1)->get();
        $data['featured_products']    = Product::where('is_featured', 1)->where('is_approved', 1)->where('status', 1)->get();
        $data['best_products']        = Product::where('is_best', 1)->where('is_approved', 1)->where('status', 1)->get();
        $data['top_products']         = Product::where('is_top', 1)->where('is_approved', 1)->where('status', 1)->get();
        $data['view_products']        = Product::orderBy('product_view', 'desc')->where('is_approved', 1)->where('status', 1)->limit(3)->get();
        $data['random_products']      = Product::inRandomOrder()->where('is_approved', 1)->where('status', 1)->limit(3)->get();
        $data['new_products']         = Product::where('created_at', '>=', Carbon::now()->subMonths(2))->where('is_approved', 1)->where('status', 1)->limit(3)->get();
        $data['catSliderSectionOne']  = HomeSetting::where('key', 'product_slider_section_one')->first();
        $data['catSliderSectionTwo']  = HomeSetting::where('key', 'product_slider_section_two')->first();
        $data['catSliderSectionThree']  = HomeSetting::where('key', 'product_slider_section_three')->first();
        $data['website_rules']        = HomeSetting::where('key', 'website_rules')->first();
        $data['marquee']              = Marquee::where('status', 1)->get();
        $data['productReviews']       = ProductReview::
                                leftJoin('users', 'users.id', 'product_reviews.user_id')->leftJoin('products', 'products.id', 'product_reviews.product_id')
                                ->select('product_reviews.*', 'users.name as user_name', 'users.image as user_img', 'products.name as product_name', 'products.id as product_id')
                                ->where('product_reviews.status', 1)->get();

        return view('frontend.pages.home', $data);
    }

    public function about_us()
    {
        $data['title']       = 'About us'; 
        $data['description'] = ''; 
        return view('frontend.pages.frontend_pages.about_us', $data);
    }

    public function contact_us()
    {
        $data['title']         = 'Contact us'; 
        $data['description']   = ''; 
        $data['time_schedule'] = HomeSetting::where('key', 'time_schedule_section')->first();
        return view('frontend.pages.frontend_pages.contact_us', $data);
    }

    public function handleContactForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'    => ['required','max:256'],
            'phone'   => ['required', 'max:256'],
            'email'   => ['required', 'email', 'max:256'],
            'subject' => ['required', 'max:256'],
            'message' => ['required'],
        ]);

        $contact              = new Contact();
        $contact->name        = $request->name;
        $contact->phone       = $request->phone;
        $contact->email       = $request->email;
        $contact->subject     = $request->subject;
        $contact->message     = $request->message;
        $contact->status      = 1;
        $contact->save();

        $setting = EmailConfiguration::first();

        // send email
        Mail::to($setting->email)->send(new ContactMail($contact));

        return response(['status' => 'success', 'message' => 'Thank you for contacting us. We will respond you soon.']);
    }
    

    public function faq_page()
    {
        $data = Faq::where('status', 1)->get();
        return view('frontend.pages.frontend_pages.faq', compact("data"));
    }

    public function team_page()
    {
        return view('frontend.pages.frontend_pages.team');
    }

    public function privacy_policy()
    {
        $data = CustomPage::where('slug', 'privacy-policy')->first();
        return view('frontend.pages.frontend_pages.privacy_policy', compact('data'));
    }

    public function terms_condition()
    {
        $data = CustomPage::where('slug', 'terms-condition')->first();
        return view('frontend.pages.frontend_pages.terms_condition', compact('data'));
    }

    public function return_refund()
    {
        $data = CustomPage::where('slug', 'return-refund')->first();
        return view('frontend.pages.frontend_pages.return_refund', compact('data'));
    }

    public function shipping()
    {
        $data = CustomPage::where('slug', 'shipping')->first();
        return view('frontend.pages.frontend_pages.shipping', compact('data'));
    }

    public function customer_feedback()
    {
        $data['title']           = 'Customer Feedback'; 
        $data['description']     = ''; 
        $data['productReviews']  = ProductReview::
                    leftJoin('users', 'users.id', 'product_reviews.user_id')->leftJoin('products', 'products.id', 'product_reviews.product_id')
                    ->select('product_reviews.*', 'users.name as user_name', 'users.image as user_img', 'products.name as product_name', 'products.id as product_id')
                    ->where('product_reviews.status', 1)->get();
                            
        return view('frontend.pages.frontend_pages.customer_feedback', $data);
    }

    public function blogs()
    {
        return view('frontend.pages.frontend_pages.blogs');
    }

    public function blogs_details()
    {
        return view('frontend.pages.frontend_pages.blogs_details');
    }

    public function product_collection(string $slug)
    {
        $collection = Collection::where('slug', $slug)->first();
        $productCollections = ProductCollection::
                            leftJoin('products', 'products.id', 'product_collections.product_id')
                            ->select('products.*', 'product_collections.collect_id')
                            ->where('product_collections.collect_id', $collection->id)
                            ->get();
        return view('frontend.pages.product_pages.product-collection', [
            'productCollections' => $productCollections,
            'collection'         => $collection,
        ]);
    }

    public function track_order(Request $request)
    {
        $request->validate([
            'tracker' => ['nullable', 'numeric']
        ]);

        if( $request->has('tracker') ){
            $order = Order::where('order_id', $request->tracker)->first();
            // dd($order);
            return view('frontend.pages.frontend_pages.track_order', compact('order'));
        }
        else{
            return view('frontend.pages.frontend_pages.track_order');
        }
    }


    public function register_login()
    {
        return view('frontend.pages.auth.login_register');
    }



    /**
    *   Authentication template
    */

    public function changePassword()
    {
        return view('frontend.pages.auth.changePassword');
    }

    public function forgetPassword()
    {
        return view('frontend.pages.auth.forgetPassword');
    }
    
    public function compare_view()
    {
        return view('frontend.pages.product_pages.compare');
    }


}
