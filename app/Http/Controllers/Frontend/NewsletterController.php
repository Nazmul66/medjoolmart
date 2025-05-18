<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SubscriptionEvent;
use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function newsletter_request(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => ['email', 'max:200']
        ]);

        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if( !empty($existSubscriber) ){
            if($existSubscriber->is_verified == 0){
                $existSubscriber->verified_token  = Str::random(25);
                $existSubscriber->save();

                // set mail config
                MailHelper::setMailConfig();

                // send email
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));
                
                return response(['status' => 'success', 'message' => 'A verification link send to your email please check.']);
            }
            elseif($existSubscriber->is_verified == 1){
                return response(['status' => 'error', 'message' => 'you already subscribed with this email.']);
            }
        }
        else{
            $subscriber = new NewsletterSubscriber();
            $subscriber->email           = $request->email;
            $subscriber->verified_token  = Str::random(25);
            $subscriber->is_verified     = 0;
            $subscriber->save();

            // set mail config
            MailHelper::setMailConfig();

            // send email
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

            //Event
            broadcast(new SubscriptionEvent('New User Subscription', $subscriber));

            return response(['status' => 'success', 'message' => 'A verification link send to your email please check.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function newsletterEmailVerify($token)
    {
        $verify = NewsletterSubscriber::where('verified_token', $token)->first();
        if( $verify ){
            $verify->verified_token  = 'verify';
            $verify->is_verified     = 1;
            $verify->save();

            Toastr::success('Email verification successfully.', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('home');
        }
        else{
            Toastr::error('Invalid token', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->route('home');
        }
    }

}
