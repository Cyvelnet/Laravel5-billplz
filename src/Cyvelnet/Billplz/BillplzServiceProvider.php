<?php namespace Cyvelnet\Billplz;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class BillplzServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Billplz', 'Cyvelnet\Billplz\Facades\Billplz');


        $source_config = __DIR__ . '/../../config/billplz.php';

        $this->publishes([$source_config => config_path('billplz.php')], 'config');

        $this->mergeConfigFrom($source_config, 'billplz');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerValidator($this->app);

        $this->registerBillplz($this->app);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['billplz'];
    }

    private function registerBillplz($app)
    {
        $app->singleton('billplz', function ($app) {

            $apiKey = $app['config']->get('billplz.api_key');
            $collectionId = $app['config']->get('billplz.collection_id');
            $callbackUrl = $app['config']->get('billplz.callback_url');

            $transport = $app->make('Cyvelnet\Billplz\Transporters\Transport');

            $bill = new BillBody();

            // set default bill collection and callback url
            $bill->collection($collectionId)->callback($callbackUrl);


            return new Billplz($transport, $bill);

        });
    }

    private function registerValidator($app)
    {
        $app->bind('Cyvelnet\Billplz\Contracts\BillValidator', 'Cyvelnet\Billplz\Validators\BillValidator');
    }

}
