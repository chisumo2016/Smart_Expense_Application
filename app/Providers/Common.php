<?php
namespace App\Providers;

//use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class Common extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static  function colors()
    {
        return [
            'blue','yellow','red','magenta','green','violet','gray','brown','purple','orange'
        ];
    }

    public static function  formatDate($date)
    {
        return date('F ,d, Y', strtotime($date));
    }
}
