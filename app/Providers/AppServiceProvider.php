<?php

namespace App\Providers;

use App\Models\Admin\Account;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Food;
use App\Models\Admin\News;
use App\Models\Admin\Product;
use App\Models\Admin\Game;
use App\Models\Admin\Logo;
use App\Models\Admin\SpecialDish;
use App\Models\Admin\Story;
use App\Models\Admin\Team;
use App\Models\Admin\Testimonial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Logo::count() == 0 ) {
            Logo::create([
                'image' => 'logo',
            ]);
        }

       $testimonials = Testimonial::Orderby('id', 'desc')->get();
          $logo = Logo::first();
        View::share(compact('logo','testimonials'));
    }
}
