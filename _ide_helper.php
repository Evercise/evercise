<?php
/**
 * An helper file for Laravel 4, to provide autocomplete information to your IDE
 * Generated for Laravel 4.1.30 on 2014-08-27.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

namespace {
    exit("This file should not be included, only analyzed by your IDE");

    class App extends \Illuminate\Support\Facades\App{
        
        /**
         * Bind the installation paths to the application.
         *
         * @param array $paths
         * @return void 
         * @static 
         */
        public static function bindInstallPaths($paths){
            \Illuminate\Foundation\Application::bindInstallPaths($paths);
        }
        
        /**
         * Get the application bootstrap file.
         *
         * @return string 
         * @static 
         */
        public static function getBootstrapFile(){
            return \Illuminate\Foundation\Application::getBootstrapFile();
        }
        
        /**
         * Start the exception handling for the request.
         *
         * @return void 
         * @static 
         */
        public static function startExceptionHandling(){
            \Illuminate\Foundation\Application::startExceptionHandling();
        }
        
        /**
         * Get or check the current application environment.
         *
         * @param mixed
         * @return string 
         * @static 
         */
        public static function environment(){
            return \Illuminate\Foundation\Application::environment();
        }
        
        /**
         * Determine if application is in local environment.
         *
         * @return bool 
         * @static 
         */
        public static function isLocal(){
            return \Illuminate\Foundation\Application::isLocal();
        }
        
        /**
         * Detect the application's current environment.
         *
         * @param array|string $envs
         * @return string 
         * @static 
         */
        public static function detectEnvironment($envs){
            return \Illuminate\Foundation\Application::detectEnvironment($envs);
        }
        
        /**
         * Determine if we are running in the console.
         *
         * @return bool 
         * @static 
         */
        public static function runningInConsole(){
            return \Illuminate\Foundation\Application::runningInConsole();
        }
        
        /**
         * Determine if we are running unit tests.
         *
         * @return bool 
         * @static 
         */
        public static function runningUnitTests(){
            return \Illuminate\Foundation\Application::runningUnitTests();
        }
        
        /**
         * Force register a service provider with the application.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @param array $options
         * @return \Illuminate\Support\ServiceProvider 
         * @static 
         */
        public static function forgeRegister($provider, $options = array()){
            return \Illuminate\Foundation\Application::forgeRegister($provider, $options);
        }
        
        /**
         * Register a service provider with the application.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @param array $options
         * @param bool $force
         * @return \Illuminate\Support\ServiceProvider 
         * @static 
         */
        public static function register($provider, $options = array(), $force = false){
            return \Illuminate\Foundation\Application::register($provider, $options, $force);
        }
        
        /**
         * Get the registered service provider instance if it exists.
         *
         * @param \Illuminate\Support\ServiceProvider|string $provider
         * @return \Illuminate\Support\ServiceProvider|null 
         * @static 
         */
        public static function getRegistered($provider){
            return \Illuminate\Foundation\Application::getRegistered($provider);
        }
        
        /**
         * Resolve a service provider instance from the class name.
         *
         * @param string $provider
         * @return \Illuminate\Support\ServiceProvider 
         * @static 
         */
        public static function resolveProviderClass($provider){
            return \Illuminate\Foundation\Application::resolveProviderClass($provider);
        }
        
        /**
         * Load and boot all of the remaining deferred providers.
         *
         * @return void 
         * @static 
         */
        public static function loadDeferredProviders(){
            \Illuminate\Foundation\Application::loadDeferredProviders();
        }
        
        /**
         * Register a deferred provider and service.
         *
         * @param string $provider
         * @param string $service
         * @return void 
         * @static 
         */
        public static function registerDeferredProvider($provider, $service = null){
            \Illuminate\Foundation\Application::registerDeferredProvider($provider, $service);
        }
        
        /**
         * Resolve the given type from the container.
         * 
         * (Overriding Container::make)
         *
         * @param string $abstract
         * @param array $parameters
         * @return mixed 
         * @static 
         */
        public static function make($abstract, $parameters = array()){
            return \Illuminate\Foundation\Application::make($abstract, $parameters);
        }
        
        /**
         * Register a "before" application filter.
         *
         * @param \Closure|string $callback
         * @return void 
         * @static 
         */
        public static function before($callback){
            \Illuminate\Foundation\Application::before($callback);
        }
        
        /**
         * Register an "after" application filter.
         *
         * @param \Closure|string $callback
         * @return void 
         * @static 
         */
        public static function after($callback){
            \Illuminate\Foundation\Application::after($callback);
        }
        
        /**
         * Register a "finish" application filter.
         *
         * @param \Closure|string $callback
         * @return void 
         * @static 
         */
        public static function finish($callback){
            \Illuminate\Foundation\Application::finish($callback);
        }
        
        /**
         * Register a "shutdown" callback.
         *
         * @param callable $callback
         * @return void 
         * @static 
         */
        public static function shutdown($callback = null){
            \Illuminate\Foundation\Application::shutdown($callback);
        }
        
        /**
         * Register a function for determining when to use array sessions.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function useArraySessions($callback){
            \Illuminate\Foundation\Application::useArraySessions($callback);
        }
        
        /**
         * Determine if the application has booted.
         *
         * @return bool 
         * @static 
         */
        public static function isBooted(){
            return \Illuminate\Foundation\Application::isBooted();
        }
        
        /**
         * Boot the application's service providers.
         *
         * @return void 
         * @static 
         */
        public static function boot(){
            \Illuminate\Foundation\Application::boot();
        }
        
        /**
         * Register a new boot listener.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function booting($callback){
            \Illuminate\Foundation\Application::booting($callback);
        }
        
        /**
         * Register a new "booted" listener.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function booted($callback){
            \Illuminate\Foundation\Application::booted($callback);
        }
        
        /**
         * Run the application and send the response.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return void 
         * @static 
         */
        public static function run($request = null){
            \Illuminate\Foundation\Application::run($request);
        }
        
        /**
         * Add a HttpKernel middleware onto the stack.
         *
         * @param string $class
         * @param array $parameters
         * @return \Illuminate\Foundation\Application 
         * @static 
         */
        public static function middleware($class, $parameters = array()){
            return \Illuminate\Foundation\Application::middleware($class, $parameters);
        }
        
        /**
         * Remove a custom middleware from the application.
         *
         * @param string $class
         * @return void 
         * @static 
         */
        public static function forgetMiddleware($class){
            \Illuminate\Foundation\Application::forgetMiddleware($class);
        }
        
        /**
         * Handle the given request and get the response.
         * 
         * Provides compatibility with BrowserKit functional testing.
         *
         * @implements HttpKernelInterface::handle
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @param int $type
         * @param bool $catch
         * @return \Symfony\Component\HttpFoundation\Response 
         * @static 
         */
        public static function handle($request, $type = 1, $catch = true){
            return \Illuminate\Foundation\Application::handle($request, $type, $catch);
        }
        
        /**
         * Handle the given request and get the response.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Symfony\Component\HttpFoundation\Response 
         * @static 
         */
        public static function dispatch($request){
            return \Illuminate\Foundation\Application::dispatch($request);
        }
        
        /**
         * Terminate the request and send the response to the browser.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @param \Symfony\Component\HttpFoundation\Response $response
         * @return void 
         * @static 
         */
        public static function terminate($request, $response){
            \Illuminate\Foundation\Application::terminate($request, $response);
        }
        
        /**
         * Call the "finish" callbacks assigned to the application.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @param \Symfony\Component\HttpFoundation\Response $response
         * @return void 
         * @static 
         */
        public static function callFinishCallbacks($request, $response){
            \Illuminate\Foundation\Application::callFinishCallbacks($request, $response);
        }
        
        /**
         * Prepare the request by injecting any services.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function prepareRequest($request){
            return \Illuminate\Foundation\Application::prepareRequest($request);
        }
        
        /**
         * Prepare the given value as a Response object.
         *
         * @param mixed $value
         * @return \Symfony\Component\HttpFoundation\Response 
         * @static 
         */
        public static function prepareResponse($value){
            return \Illuminate\Foundation\Application::prepareResponse($value);
        }
        
        /**
         * Determine if the application is ready for responses.
         *
         * @return bool 
         * @static 
         */
        public static function readyForResponses(){
            return \Illuminate\Foundation\Application::readyForResponses();
        }
        
        /**
         * Determine if the application is currently down for maintenance.
         *
         * @return bool 
         * @static 
         */
        public static function isDownForMaintenance(){
            return \Illuminate\Foundation\Application::isDownForMaintenance();
        }
        
        /**
         * Register a maintenance mode event listener.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function down($callback){
            \Illuminate\Foundation\Application::down($callback);
        }
        
        /**
         * Throw an HttpException with the given data.
         *
         * @param int $code
         * @param string $message
         * @param array $headers
         * @return void 
         * @throws \Symfony\Component\HttpKernel\Exception\HttpException
         * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
         * @static 
         */
        public static function abort($code, $message = '', $headers = array()){
            \Illuminate\Foundation\Application::abort($code, $message, $headers);
        }
        
        /**
         * Register a 404 error handler.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function missing($callback){
            \Illuminate\Foundation\Application::missing($callback);
        }
        
        /**
         * Register an application error handler.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function error($callback){
            \Illuminate\Foundation\Application::error($callback);
        }
        
        /**
         * Register an error handler at the bottom of the stack.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function pushError($callback){
            \Illuminate\Foundation\Application::pushError($callback);
        }
        
        /**
         * Register an error handler for fatal errors.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function fatal($callback){
            \Illuminate\Foundation\Application::fatal($callback);
        }
        
        /**
         * Get the configuration loader instance.
         *
         * @return \Illuminate\Config\LoaderInterface 
         * @static 
         */
        public static function getConfigLoader(){
            return \Illuminate\Foundation\Application::getConfigLoader();
        }
        
        /**
         * Get the environment variables loader instance.
         *
         * @return \Illuminate\Config\EnvironmentVariablesLoaderInterface 
         * @static 
         */
        public static function getEnvironmentVariablesLoader(){
            return \Illuminate\Foundation\Application::getEnvironmentVariablesLoader();
        }
        
        /**
         * Get the service provider repository instance.
         *
         * @return \Illuminate\Foundation\ProviderRepository 
         * @static 
         */
        public static function getProviderRepository(){
            return \Illuminate\Foundation\Application::getProviderRepository();
        }
        
        /**
         * Get the service providers that have been loaded.
         *
         * @return array 
         * @static 
         */
        public static function getLoadedProviders(){
            return \Illuminate\Foundation\Application::getLoadedProviders();
        }
        
        /**
         * Set the application's deferred services.
         *
         * @param array $services
         * @return void 
         * @static 
         */
        public static function setDeferredServices($services){
            \Illuminate\Foundation\Application::setDeferredServices($services);
        }
        
        /**
         * Determine if the given service is a deferred service.
         *
         * @param string $service
         * @return bool 
         * @static 
         */
        public static function isDeferredService($service){
            return \Illuminate\Foundation\Application::isDeferredService($service);
        }
        
        /**
         * Get or set the request class for the application.
         *
         * @param string $class
         * @return string 
         * @static 
         */
        public static function requestClass($class = null){
            return \Illuminate\Foundation\Application::requestClass($class);
        }
        
        /**
         * Set the application request for the console environment.
         *
         * @return void 
         * @static 
         */
        public static function setRequestForConsoleEnvironment(){
            \Illuminate\Foundation\Application::setRequestForConsoleEnvironment();
        }
        
        /**
         * Call a method on the default request class.
         *
         * @param string $method
         * @param array $parameters
         * @return mixed 
         * @static 
         */
        public static function onRequest($method, $parameters = array()){
            return \Illuminate\Foundation\Application::onRequest($method, $parameters);
        }
        
        /**
         * Get the current application locale.
         *
         * @return string 
         * @static 
         */
        public static function getLocale(){
            return \Illuminate\Foundation\Application::getLocale();
        }
        
        /**
         * Set the current application locale.
         *
         * @param string $locale
         * @return void 
         * @static 
         */
        public static function setLocale($locale){
            \Illuminate\Foundation\Application::setLocale($locale);
        }
        
        /**
         * Register the core class aliases in the container.
         *
         * @return void 
         * @static 
         */
        public static function registerCoreContainerAliases(){
            \Illuminate\Foundation\Application::registerCoreContainerAliases();
        }
        
        /**
         * Determine if the given abstract type has been bound.
         *
         * @param string $abstract
         * @return bool 
         * @static 
         */
        public static function bound($abstract){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::bound($abstract);
        }
        
        /**
         * Determine if a given string is an alias.
         *
         * @param string $name
         * @return bool 
         * @static 
         */
        public static function isAlias($name){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::isAlias($name);
        }
        
        /**
         * Register a binding with the container.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @param bool $shared
         * @return void 
         * @static 
         */
        public static function bind($abstract, $concrete = null, $shared = false){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::bind($abstract, $concrete, $shared);
        }
        
        /**
         * Register a binding if it hasn't already been registered.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @param bool $shared
         * @return void 
         * @static 
         */
        public static function bindIf($abstract, $concrete = null, $shared = false){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::bindIf($abstract, $concrete, $shared);
        }
        
        /**
         * Register a shared binding in the container.
         *
         * @param string $abstract
         * @param \Closure|string|null $concrete
         * @return void 
         * @static 
         */
        public static function singleton($abstract, $concrete = null){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::singleton($abstract, $concrete);
        }
        
        /**
         * Wrap a Closure such that it is shared.
         *
         * @param \Closure $closure
         * @return \Illuminate\Container\Closure 
         * @static 
         */
        public static function share($closure){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::share($closure);
        }
        
        /**
         * Bind a shared Closure into the container.
         *
         * @param string $abstract
         * @param \Closure $closure
         * @return void 
         * @static 
         */
        public static function bindShared($abstract, $closure){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::bindShared($abstract, $closure);
        }
        
        /**
         * "Extend" an abstract type in the container.
         *
         * @param string $abstract
         * @param \Closure $closure
         * @return void 
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function extend($abstract, $closure){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::extend($abstract, $closure);
        }
        
        /**
         * Register an existing instance as shared in the container.
         *
         * @param string $abstract
         * @param mixed $instance
         * @return void 
         * @static 
         */
        public static function instance($abstract, $instance){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::instance($abstract, $instance);
        }
        
        /**
         * Alias a type to a shorter name.
         *
         * @param string $abstract
         * @param string $alias
         * @return void 
         * @static 
         */
        public static function alias($abstract, $alias){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::alias($abstract, $alias);
        }
        
        /**
         * Bind a new callback to an abstract's rebind event.
         *
         * @param string $abstract
         * @param \Closure $callback
         * @return mixed 
         * @static 
         */
        public static function rebinding($abstract, $callback){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::rebinding($abstract, $callback);
        }
        
        /**
         * Refresh an instance on the given target and method.
         *
         * @param string $abstract
         * @param mixed $target
         * @param string $method
         * @return mixed 
         * @static 
         */
        public static function refresh($abstract, $target, $method){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::refresh($abstract, $target, $method);
        }
        
        /**
         * Instantiate a concrete instance of the given type.
         *
         * @param string $concrete
         * @param array $parameters
         * @return mixed 
         * @throws BindingResolutionException
         * @static 
         */
        public static function build($concrete, $parameters = array()){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::build($concrete, $parameters);
        }
        
        /**
         * Register a new resolving callback.
         *
         * @param string $abstract
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function resolving($abstract, $callback){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::resolving($abstract, $callback);
        }
        
        /**
         * Register a new resolving callback for all types.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function resolvingAny($callback){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::resolvingAny($callback);
        }
        
        /**
         * Determine if a given type is shared.
         *
         * @param string $abstract
         * @return bool 
         * @static 
         */
        public static function isShared($abstract){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::isShared($abstract);
        }
        
        /**
         * Get the container's bindings.
         *
         * @return array 
         * @static 
         */
        public static function getBindings(){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::getBindings();
        }
        
        /**
         * Remove a resolved instance from the instance cache.
         *
         * @param string $abstract
         * @return void 
         * @static 
         */
        public static function forgetInstance($abstract){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::forgetInstance($abstract);
        }
        
        /**
         * Clear all of the instances from the container.
         *
         * @return void 
         * @static 
         */
        public static function forgetInstances(){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::forgetInstances();
        }
        
        /**
         * Determine if a given offset exists.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function offsetExists($key){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::offsetExists($key);
        }
        
        /**
         * Get the value at a given offset.
         *
         * @param string $key
         * @return mixed 
         * @static 
         */
        public static function offsetGet($key){
            //Method inherited from \Illuminate\Container\Container            
            return \Illuminate\Foundation\Application::offsetGet($key);
        }
        
        /**
         * Set the value at a given offset.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function offsetSet($key, $value){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::offsetSet($key, $value);
        }
        
        /**
         * Unset the value at a given offset.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function offsetUnset($key){
            //Method inherited from \Illuminate\Container\Container            
            \Illuminate\Foundation\Application::offsetUnset($key);
        }
        
    }


    class Artisan extends \Illuminate\Support\Facades\Artisan{
        
        /**
         * Create and boot a new Console application.
         *
         * @param \Illuminate\Foundation\Application $app
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function start($app){
            return \Illuminate\Console\Application::start($app);
        }
        
        /**
         * Create a new Console application.
         *
         * @param \Illuminate\Foundation\Application $app
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function make($app){
            return \Illuminate\Console\Application::make($app);
        }
        
        /**
         * Boot the Console application.
         *
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function boot(){
            return \Illuminate\Console\Application::boot();
        }
        
        /**
         * Run an Artisan console command by name.
         *
         * @param string $command
         * @param array $parameters
         * @param \Symfony\Component\Console\Output\OutputInterface $output
         * @return void 
         * @static 
         */
        public static function call($command, $parameters = array(), $output = null){
            \Illuminate\Console\Application::call($command, $parameters, $output);
        }
        
        /**
         * Add a command to the console.
         *
         * @param \Symfony\Component\Console\Command\Command $command
         * @return \Symfony\Component\Console\Command\Command 
         * @static 
         */
        public static function add($command){
            return \Illuminate\Console\Application::add($command);
        }
        
        /**
         * Add a command, resolving through the application.
         *
         * @param string $command
         * @return \Symfony\Component\Console\Command\Command 
         * @static 
         */
        public static function resolve($command){
            return \Illuminate\Console\Application::resolve($command);
        }
        
        /**
         * Resolve an array of commands through the application.
         *
         * @param array|mixed $commands
         * @return void 
         * @static 
         */
        public static function resolveCommands($commands){
            \Illuminate\Console\Application::resolveCommands($commands);
        }
        
        /**
         * Render the given exception.
         *
         * @param \Exception $e
         * @param \Symfony\Component\Console\Output\OutputInterface $output
         * @return void 
         * @static 
         */
        public static function renderException($e, $output){
            \Illuminate\Console\Application::renderException($e, $output);
        }
        
        /**
         * Set the exception handler instance.
         *
         * @param \Illuminate\Exception\Handler $handler
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function setExceptionHandler($handler){
            return \Illuminate\Console\Application::setExceptionHandler($handler);
        }
        
        /**
         * Set the Laravel application instance.
         *
         * @param \Illuminate\Foundation\Application $laravel
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function setLaravel($laravel){
            return \Illuminate\Console\Application::setLaravel($laravel);
        }
        
        /**
         * Set whether the Console app should auto-exit when done.
         *
         * @param bool $boolean
         * @return \Illuminate\Console\Application 
         * @static 
         */
        public static function setAutoExit($boolean){
            return \Illuminate\Console\Application::setAutoExit($boolean);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function setDispatcher($dispatcher){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setDispatcher($dispatcher);
        }
        
        /**
         * Runs the current application.
         *
         * @param \Symfony\Component\Console\InputInterface $input An Input instance
         * @param \Symfony\Component\Console\OutputInterface $output An Output instance
         * @return int 0 if everything went fine, or an error code
         * @throws \Exception When doRun returns Exception
         * @api 
         * @static 
         */
        public static function run($input = null, $output = null){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::run($input, $output);
        }
        
        /**
         * Runs the current application.
         *
         * @param \Symfony\Component\Console\InputInterface $input An Input instance
         * @param \Symfony\Component\Console\OutputInterface $output An Output instance
         * @return int 0 if everything went fine, or an error code
         * @static 
         */
        public static function doRun($input, $output){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::doRun($input, $output);
        }
        
        /**
         * Set a helper set to be used with the command.
         *
         * @param \Symfony\Component\Console\HelperSet $helperSet The helper set
         * @api 
         * @static 
         */
        public static function setHelperSet($helperSet){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setHelperSet($helperSet);
        }
        
        /**
         * Get the helper set associated with the command.
         *
         * @return \Symfony\Component\Console\HelperSet The HelperSet instance associated with this command
         * @api 
         * @static 
         */
        public static function getHelperSet(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getHelperSet();
        }
        
        /**
         * Set an input definition set to be used with this application
         *
         * @param \Symfony\Component\Console\InputDefinition $definition The input definition
         * @api 
         * @static 
         */
        public static function setDefinition($definition){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setDefinition($definition);
        }
        
        /**
         * Gets the InputDefinition related to this Application.
         *
         * @return \Symfony\Component\Console\InputDefinition The InputDefinition instance
         * @static 
         */
        public static function getDefinition(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getDefinition();
        }
        
        /**
         * Gets the help message.
         *
         * @return string A help message.
         * @static 
         */
        public static function getHelp(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getHelp();
        }
        
        /**
         * Sets whether to catch exceptions or not during commands execution.
         *
         * @param bool $boolean Whether to catch exceptions or not during commands execution
         * @api 
         * @static 
         */
        public static function setCatchExceptions($boolean){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setCatchExceptions($boolean);
        }
        
        /**
         * Gets the name of the application.
         *
         * @return string The application name
         * @api 
         * @static 
         */
        public static function getName(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getName();
        }
        
        /**
         * Sets the application name.
         *
         * @param string $name The application name
         * @api 
         * @static 
         */
        public static function setName($name){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setName($name);
        }
        
        /**
         * Gets the application version.
         *
         * @return string The application version
         * @api 
         * @static 
         */
        public static function getVersion(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getVersion();
        }
        
        /**
         * Sets the application version.
         *
         * @param string $version The application version
         * @api 
         * @static 
         */
        public static function setVersion($version){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setVersion($version);
        }
        
        /**
         * Returns the long version of the application.
         *
         * @return string The long application version
         * @api 
         * @static 
         */
        public static function getLongVersion(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getLongVersion();
        }
        
        /**
         * Registers a new command.
         *
         * @param string $name The command name
         * @return \Symfony\Component\Console\Command The newly created command
         * @api 
         * @static 
         */
        public static function register($name){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::register($name);
        }
        
        /**
         * Adds an array of command objects.
         *
         * @param \Symfony\Component\Console\Command[] $commands An array of commands
         * @api 
         * @static 
         */
        public static function addCommands($commands){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::addCommands($commands);
        }
        
        /**
         * Returns a registered command by name or alias.
         *
         * @param string $name The command name or alias
         * @return \Symfony\Component\Console\Command A Command object
         * @throws \InvalidArgumentException When command name given does not exist
         * @api 
         * @static 
         */
        public static function get($name){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::get($name);
        }
        
        /**
         * Returns true if the command exists, false otherwise.
         *
         * @param string $name The command name or alias
         * @return bool true if the command exists, false otherwise
         * @api 
         * @static 
         */
        public static function has($name){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::has($name);
        }
        
        /**
         * Returns an array of all unique namespaces used by currently registered commands.
         * 
         * It does not returns the global namespace which always exists.
         *
         * @return array An array of namespaces
         * @static 
         */
        public static function getNamespaces(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getNamespaces();
        }
        
        /**
         * Finds a registered namespace by a name or an abbreviation.
         *
         * @param string $namespace A namespace or abbreviation to search for
         * @return string A registered namespace
         * @throws \InvalidArgumentException When namespace is incorrect or ambiguous
         * @static 
         */
        public static function findNamespace($namespace){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::findNamespace($namespace);
        }
        
        /**
         * Finds a command by name or alias.
         * 
         * Contrary to get, this command tries to find the best
         * match if you give it an abbreviation of a name or alias.
         *
         * @param string $name A command name or a command alias
         * @return \Symfony\Component\Console\Command A Command instance
         * @throws \InvalidArgumentException When command name is incorrect or ambiguous
         * @api 
         * @static 
         */
        public static function find($name){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::find($name);
        }
        
        /**
         * Gets the commands (registered in the given namespace if provided).
         * 
         * The array keys are the full names and the values the command instances.
         *
         * @param string $namespace A namespace name
         * @return \Symfony\Component\Console\Command[] An array of Command instances
         * @api 
         * @static 
         */
        public static function all($namespace = null){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::all($namespace);
        }
        
        /**
         * Returns an array of possible abbreviations given a set of names.
         *
         * @param array $names An array of names
         * @return array An array of abbreviations
         * @static 
         */
        public static function getAbbreviations($names){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getAbbreviations($names);
        }
        
        /**
         * Returns a text representation of the Application.
         *
         * @param string $namespace An optional namespace name
         * @param bool $raw Whether to return raw command list
         * @return string A string representing the Application
         * @deprecated Deprecated since version 2.3, to be removed in 3.0.
         * @static 
         */
        public static function asText($namespace = null, $raw = false){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::asText($namespace, $raw);
        }
        
        /**
         * Returns an XML representation of the Application.
         *
         * @param string $namespace An optional namespace name
         * @param bool $asDom Whether to return a DOM or an XML string
         * @return string|\DOMDocument An XML string representing the Application
         * @deprecated Deprecated since version 2.3, to be removed in 3.0.
         * @static 
         */
        public static function asXml($namespace = null, $asDom = false){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::asXml($namespace, $asDom);
        }
        
        /**
         * Tries to figure out the terminal dimensions based on the current environment
         *
         * @return array Array containing width and height
         * @static 
         */
        public static function getTerminalDimensions(){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::getTerminalDimensions();
        }
        
        /**
         * Sets terminal dimensions.
         * 
         * Can be useful to force terminal dimensions for functional tests.
         *
         * @param int $width The width
         * @param int $height The height
         * @return \Symfony\Component\Console\Application The current application
         * @static 
         */
        public static function setTerminalDimensions($width, $height){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::setTerminalDimensions($width, $height);
        }
        
        /**
         * Returns the namespace part of the command name.
         * 
         * This method is not part of public API and should not be used directly.
         *
         * @param string $name The full name of the command
         * @param string $limit The maximum number of parts of the namespace
         * @return string The namespace of the command
         * @static 
         */
        public static function extractNamespace($name, $limit = null){
            //Method inherited from \Symfony\Component\Console\Application            
            return \Illuminate\Console\Application::extractNamespace($name, $limit);
        }
        
    }


    class Auth extends \Illuminate\Support\Facades\Auth{
        
        /**
         * Create an instance of the database driver.
         *
         * @return \Illuminate\Auth\Guard 
         * @static 
         */
        public static function createDatabaseDriver(){
            return \Illuminate\Auth\AuthManager::createDatabaseDriver();
        }
        
        /**
         * Create an instance of the Eloquent driver.
         *
         * @return \Illuminate\Auth\Guard 
         * @static 
         */
        public static function createEloquentDriver(){
            return \Illuminate\Auth\AuthManager::createEloquentDriver();
        }
        
        /**
         * Get the default authentication driver name.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultDriver(){
            return \Illuminate\Auth\AuthManager::getDefaultDriver();
        }
        
        /**
         * Set the default authentication driver name.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultDriver($name){
            \Illuminate\Auth\AuthManager::setDefaultDriver($name);
        }
        
        /**
         * Get a driver instance.
         *
         * @param string $driver
         * @return mixed 
         * @static 
         */
        public static function driver($driver = null){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Auth\AuthManager::driver($driver);
        }
        
        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Support\Manager|static 
         * @static 
         */
        public static function extend($driver, $callback){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Auth\AuthManager::extend($driver, $callback);
        }
        
        /**
         * Get all of the created "drivers".
         *
         * @return array 
         * @static 
         */
        public static function getDrivers(){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Auth\AuthManager::getDrivers();
        }
        
        /**
         * Determine if the current user is authenticated.
         *
         * @return bool 
         * @static 
         */
        public static function check(){
            return \Illuminate\Auth\Guard::check();
        }
        
        /**
         * Determine if the current user is a guest.
         *
         * @return bool 
         * @static 
         */
        public static function guest(){
            return \Illuminate\Auth\Guard::guest();
        }
        
        /**
         * Get the currently authenticated user.
         *
         * @return \User|null 
         * @static 
         */
        public static function user(){
            return \Illuminate\Auth\Guard::user();
        }
        
        /**
         * Get the ID for the currently authenticated user.
         *
         * @return int|null 
         * @static 
         */
        public static function id(){
            return \Illuminate\Auth\Guard::id();
        }
        
        /**
         * Log a user into the application without sessions or cookies.
         *
         * @param array $credentials
         * @return bool 
         * @static 
         */
        public static function once($credentials = array()){
            return \Illuminate\Auth\Guard::once($credentials);
        }
        
        /**
         * Validate a user's credentials.
         *
         * @param array $credentials
         * @return bool 
         * @static 
         */
        public static function validate($credentials = array()){
            return \Illuminate\Auth\Guard::validate($credentials);
        }
        
        /**
         * Attempt to authenticate using HTTP Basic Auth.
         *
         * @param string $field
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Symfony\Component\HttpFoundation\Response|null 
         * @static 
         */
        public static function basic($field = 'email', $request = null){
            return \Illuminate\Auth\Guard::basic($field, $request);
        }
        
        /**
         * Perform a stateless HTTP Basic login attempt.
         *
         * @param string $field
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Symfony\Component\HttpFoundation\Response|null 
         * @static 
         */
        public static function onceBasic($field = 'email', $request = null){
            return \Illuminate\Auth\Guard::onceBasic($field, $request);
        }
        
        /**
         * Attempt to authenticate a user using the given credentials.
         *
         * @param array $credentials
         * @param bool $remember
         * @param bool $login
         * @return bool 
         * @static 
         */
        public static function attempt($credentials = array(), $remember = false, $login = true){
            return \Illuminate\Auth\Guard::attempt($credentials, $remember, $login);
        }
        
        /**
         * Register an authentication attempt event listener.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function attempting($callback){
            \Illuminate\Auth\Guard::attempting($callback);
        }
        
        /**
         * Log a user into the application.
         *
         * @param \Illuminate\Auth\UserInterface $user
         * @param bool $remember
         * @return void 
         * @static 
         */
        public static function login($user, $remember = false){
            \Illuminate\Auth\Guard::login($user, $remember);
        }
        
        /**
         * Log the given user ID into the application.
         *
         * @param mixed $id
         * @param bool $remember
         * @return \User 
         * @static 
         */
        public static function loginUsingId($id, $remember = false){
            return \Illuminate\Auth\Guard::loginUsingId($id, $remember);
        }
        
        /**
         * Log the given user ID into the application without sessions or cookies.
         *
         * @param mixed $id
         * @return bool 
         * @static 
         */
        public static function onceUsingId($id){
            return \Illuminate\Auth\Guard::onceUsingId($id);
        }
        
        /**
         * Log the user out of the application.
         *
         * @return void 
         * @static 
         */
        public static function logout(){
            \Illuminate\Auth\Guard::logout();
        }
        
        /**
         * Get the cookie creator instance used by the guard.
         *
         * @return \Illuminate\Cookie\CookieJar 
         * @throws \RuntimeException
         * @static 
         */
        public static function getCookieJar(){
            return \Illuminate\Auth\Guard::getCookieJar();
        }
        
        /**
         * Set the cookie creator instance used by the guard.
         *
         * @param \Illuminate\Cookie\CookieJar $cookie
         * @return void 
         * @static 
         */
        public static function setCookieJar($cookie){
            \Illuminate\Auth\Guard::setCookieJar($cookie);
        }
        
        /**
         * Get the event dispatcher instance.
         *
         * @return \Illuminate\Events\Dispatcher 
         * @static 
         */
        public static function getDispatcher(){
            return \Illuminate\Auth\Guard::getDispatcher();
        }
        
        /**
         * Set the event dispatcher instance.
         *
         * @param \Illuminate\Events\Dispatcher
         * @static 
         */
        public static function setDispatcher($events){
            return \Illuminate\Auth\Guard::setDispatcher($events);
        }
        
        /**
         * Get the session store used by the guard.
         *
         * @return \Illuminate\Session\Store 
         * @static 
         */
        public static function getSession(){
            return \Illuminate\Auth\Guard::getSession();
        }
        
        /**
         * Get the user provider used by the guard.
         *
         * @return \Illuminate\Auth\Guard 
         * @static 
         */
        public static function getProvider(){
            return \Illuminate\Auth\Guard::getProvider();
        }
        
        /**
         * Set the user provider used by the guard.
         *
         * @param \Illuminate\Auth\UserProviderInterface $provider
         * @return void 
         * @static 
         */
        public static function setProvider($provider){
            \Illuminate\Auth\Guard::setProvider($provider);
        }
        
        /**
         * Return the currently cached user of the application.
         *
         * @return \User|null 
         * @static 
         */
        public static function getUser(){
            return \Illuminate\Auth\Guard::getUser();
        }
        
        /**
         * Set the current user of the application.
         *
         * @param \Illuminate\Auth\UserInterface $user
         * @return void 
         * @static 
         */
        public static function setUser($user){
            \Illuminate\Auth\Guard::setUser($user);
        }
        
        /**
         * Get the current request instance.
         *
         * @return \Symfony\Component\HttpFoundation\Request 
         * @static 
         */
        public static function getRequest(){
            return \Illuminate\Auth\Guard::getRequest();
        }
        
        /**
         * Set the current request instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request
         * @return \Illuminate\Auth\Guard 
         * @static 
         */
        public static function setRequest($request){
            return \Illuminate\Auth\Guard::setRequest($request);
        }
        
        /**
         * Get the last user we attempted to authenticate.
         *
         * @return \User 
         * @static 
         */
        public static function getLastAttempted(){
            return \Illuminate\Auth\Guard::getLastAttempted();
        }
        
        /**
         * Get a unique identifier for the auth session value.
         *
         * @return string 
         * @static 
         */
        public static function getName(){
            return \Illuminate\Auth\Guard::getName();
        }
        
        /**
         * Get the name of the cookie used to store the "recaller".
         *
         * @return string 
         * @static 
         */
        public static function getRecallerName(){
            return \Illuminate\Auth\Guard::getRecallerName();
        }
        
        /**
         * Determine if the user was authenticated via "remember me" cookie.
         *
         * @return bool 
         * @static 
         */
        public static function viaRemember(){
            return \Illuminate\Auth\Guard::viaRemember();
        }
        
    }


    class Blade extends \Illuminate\Support\Facades\Blade{
        
        /**
         * Compile the view at the given path.
         *
         * @param string $path
         * @return void 
         * @static 
         */
        public static function compile($path = null){
            \Illuminate\View\Compilers\BladeCompiler::compile($path);
        }
        
        /**
         * Get the path currently being compiled.
         *
         * @return string 
         * @static 
         */
        public static function getPath(){
            return \Illuminate\View\Compilers\BladeCompiler::getPath();
        }
        
        /**
         * Set the path currently being compiled.
         *
         * @param string $path
         * @return void 
         * @static 
         */
        public static function setPath($path){
            \Illuminate\View\Compilers\BladeCompiler::setPath($path);
        }
        
        /**
         * Compile the given Blade template contents.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function compileString($value){
            return \Illuminate\View\Compilers\BladeCompiler::compileString($value);
        }
        
        /**
         * Register a custom Blade compiler.
         *
         * @param \Closure $compiler
         * @return void 
         * @static 
         */
        public static function extend($compiler){
            \Illuminate\View\Compilers\BladeCompiler::extend($compiler);
        }
        
        /**
         * Compile the default values for the echo statement.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function compileEchoDefaults($value){
            return \Illuminate\View\Compilers\BladeCompiler::compileEchoDefaults($value);
        }
        
        /**
         * Get the regular expression for a generic Blade function.
         *
         * @param string $function
         * @return string 
         * @static 
         */
        public static function createMatcher($function){
            return \Illuminate\View\Compilers\BladeCompiler::createMatcher($function);
        }
        
        /**
         * Get the regular expression for a generic Blade function.
         *
         * @param string $function
         * @return string 
         * @static 
         */
        public static function createOpenMatcher($function){
            return \Illuminate\View\Compilers\BladeCompiler::createOpenMatcher($function);
        }
        
        /**
         * Create a plain Blade matcher.
         *
         * @param string $function
         * @return string 
         * @static 
         */
        public static function createPlainMatcher($function){
            return \Illuminate\View\Compilers\BladeCompiler::createPlainMatcher($function);
        }
        
        /**
         * Sets the content tags used for the compiler.
         *
         * @param string $openTag
         * @param string $closeTag
         * @param bool $escaped
         * @return void 
         * @static 
         */
        public static function setContentTags($openTag, $closeTag, $escaped = false){
            \Illuminate\View\Compilers\BladeCompiler::setContentTags($openTag, $closeTag, $escaped);
        }
        
        /**
         * Sets the escaped content tags used for the compiler.
         *
         * @param string $openTag
         * @param string $closeTag
         * @return void 
         * @static 
         */
        public static function setEscapedContentTags($openTag, $closeTag){
            \Illuminate\View\Compilers\BladeCompiler::setEscapedContentTags($openTag, $closeTag);
        }
        
        /**
         * Gets the content tags used for the compiler.
         *
         * @return string 
         * @static 
         */
        public static function getContentTags(){
            return \Illuminate\View\Compilers\BladeCompiler::getContentTags();
        }
        
        /**
         * Gets the escaped content tags used for the compiler.
         *
         * @return string 
         * @static 
         */
        public static function getEscapedContentTags(){
            return \Illuminate\View\Compilers\BladeCompiler::getEscapedContentTags();
        }
        
        /**
         * Get the path to the compiled version of a view.
         *
         * @param string $path
         * @return string 
         * @static 
         */
        public static function getCompiledPath($path){
            //Method inherited from \Illuminate\View\Compilers\Compiler            
            return \Illuminate\View\Compilers\BladeCompiler::getCompiledPath($path);
        }
        
        /**
         * Determine if the view at the given path is expired.
         *
         * @param string $path
         * @return bool 
         * @static 
         */
        public static function isExpired($path){
            //Method inherited from \Illuminate\View\Compilers\Compiler            
            return \Illuminate\View\Compilers\BladeCompiler::isExpired($path);
        }
        
    }


    class Cache extends \Illuminate\Support\Facades\Cache{
        
        /**
         * Get the cache "prefix" value.
         *
         * @return string 
         * @static 
         */
        public static function getPrefix(){
            return \Illuminate\Cache\CacheManager::getPrefix();
        }
        
        /**
         * Set the cache "prefix" value.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setPrefix($name){
            \Illuminate\Cache\CacheManager::setPrefix($name);
        }
        
        /**
         * Get the default cache driver name.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultDriver(){
            return \Illuminate\Cache\CacheManager::getDefaultDriver();
        }
        
        /**
         * Set the default cache driver name.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultDriver($name){
            \Illuminate\Cache\CacheManager::setDefaultDriver($name);
        }
        
        /**
         * Get a driver instance.
         *
         * @param string $driver
         * @return mixed 
         * @static 
         */
        public static function driver($driver = null){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Cache\CacheManager::driver($driver);
        }
        
        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Support\Manager|static 
         * @static 
         */
        public static function extend($driver, $callback){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Cache\CacheManager::extend($driver, $callback);
        }
        
        /**
         * Get all of the created "drivers".
         *
         * @return array 
         * @static 
         */
        public static function getDrivers(){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Cache\CacheManager::getDrivers();
        }
        
        /**
         * Determine if an item exists in the cache.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function has($key){
            return \Illuminate\Cache\Repository::has($key);
        }
        
        /**
         * Retrieve an item from the cache by key.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function get($key, $default = null){
            return \Illuminate\Cache\Repository::get($key, $default);
        }
        
        /**
         * Store an item in the cache.
         *
         * @param string $key
         * @param mixed $value
         * @param \DateTime|int $minutes
         * @return void 
         * @static 
         */
        public static function put($key, $value, $minutes){
            \Illuminate\Cache\Repository::put($key, $value, $minutes);
        }
        
        /**
         * Store an item in the cache if the key does not exist.
         *
         * @param string $key
         * @param mixed $value
         * @param \DateTime|int $minutes
         * @return bool 
         * @static 
         */
        public static function add($key, $value, $minutes){
            return \Illuminate\Cache\Repository::add($key, $value, $minutes);
        }
        
        /**
         * Get an item from the cache, or store the default value.
         *
         * @param string $key
         * @param \DateTime|int $minutes
         * @param \Closure $callback
         * @return mixed 
         * @static 
         */
        public static function remember($key, $minutes, $callback){
            return \Illuminate\Cache\Repository::remember($key, $minutes, $callback);
        }
        
        /**
         * Get an item from the cache, or store the default value forever.
         *
         * @param string $key
         * @param \Closure $callback
         * @return mixed 
         * @static 
         */
        public static function sear($key, $callback){
            return \Illuminate\Cache\Repository::sear($key, $callback);
        }
        
        /**
         * Get an item from the cache, or store the default value forever.
         *
         * @param string $key
         * @param \Closure $callback
         * @return mixed 
         * @static 
         */
        public static function rememberForever($key, $callback){
            return \Illuminate\Cache\Repository::rememberForever($key, $callback);
        }
        
        /**
         * Get the default cache time.
         *
         * @return int 
         * @static 
         */
        public static function getDefaultCacheTime(){
            return \Illuminate\Cache\Repository::getDefaultCacheTime();
        }
        
        /**
         * Set the default cache time in minutes.
         *
         * @param int $minutes
         * @return void 
         * @static 
         */
        public static function setDefaultCacheTime($minutes){
            \Illuminate\Cache\Repository::setDefaultCacheTime($minutes);
        }
        
        /**
         * Get the cache store implementation.
         *
         * @return \Illuminate\Cache\FileStore 
         * @static 
         */
        public static function getStore(){
            return \Illuminate\Cache\Repository::getStore();
        }
        
        /**
         * Determine if a cached value exists.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function offsetExists($key){
            return \Illuminate\Cache\Repository::offsetExists($key);
        }
        
        /**
         * Retrieve an item from the cache by key.
         *
         * @param string $key
         * @return mixed 
         * @static 
         */
        public static function offsetGet($key){
            return \Illuminate\Cache\Repository::offsetGet($key);
        }
        
        /**
         * Store an item in the cache for the default time.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function offsetSet($key, $value){
            \Illuminate\Cache\Repository::offsetSet($key, $value);
        }
        
        /**
         * Remove an item from the cache.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function offsetUnset($key){
            \Illuminate\Cache\Repository::offsetUnset($key);
        }
        
        /**
         * Register a macro with the Cache class.
         *
         * @param string $name
         * @param callable $callback
         * @return void 
         * @static 
         */
        public static function macro($name, $callback){
            \Illuminate\Cache\Repository::macro($name, $callback);
        }
        
        /**
         * Increment the value of an item in the cache.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @throws \LogicException
         * @static 
         */
        public static function increment($key, $value = 1){
            \Illuminate\Cache\FileStore::increment($key, $value);
        }
        
        /**
         * Decrement the value of an item in the cache.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @throws \LogicException
         * @static 
         */
        public static function decrement($key, $value = 1){
            \Illuminate\Cache\FileStore::decrement($key, $value);
        }
        
        /**
         * Store an item in the cache indefinitely.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function forever($key, $value){
            \Illuminate\Cache\FileStore::forever($key, $value);
        }
        
        /**
         * Remove an item from the cache.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function forget($key){
            \Illuminate\Cache\FileStore::forget($key);
        }
        
        /**
         * Remove all items from the cache.
         *
         * @return void 
         * @static 
         */
        public static function flush(){
            \Illuminate\Cache\FileStore::flush();
        }
        
        /**
         * Get the Filesystem instance.
         *
         * @return \Illuminate\Filesystem\Filesystem 
         * @static 
         */
        public static function getFilesystem(){
            return \Illuminate\Cache\FileStore::getFilesystem();
        }
        
        /**
         * Get the working directory of the cache.
         *
         * @return string 
         * @static 
         */
        public static function getDirectory(){
            return \Illuminate\Cache\FileStore::getDirectory();
        }
        
    }


    class ClassLoader extends \Illuminate\Support\ClassLoader{
        
    }


    class Config extends \Illuminate\Support\Facades\Config{
        
        /**
         * Determine if the given configuration value exists.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function has($key){
            return \Illuminate\Config\Repository::has($key);
        }
        
        /**
         * Determine if a configuration group exists.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasGroup($key){
            return \Illuminate\Config\Repository::hasGroup($key);
        }
        
        /**
         * Get the specified configuration value.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function get($key, $default = null){
            return \Illuminate\Config\Repository::get($key, $default);
        }
        
        /**
         * Set a given configuration value.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function set($key, $value){
            \Illuminate\Config\Repository::set($key, $value);
        }
        
        /**
         * Register a package for cascading configuration.
         *
         * @param string $package
         * @param string $hint
         * @param string $namespace
         * @return void 
         * @static 
         */
        public static function package($package, $hint, $namespace = null){
            \Illuminate\Config\Repository::package($package, $hint, $namespace);
        }
        
        /**
         * Register an after load callback for a given namespace.
         *
         * @param string $namespace
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function afterLoading($namespace, $callback){
            \Illuminate\Config\Repository::afterLoading($namespace, $callback);
        }
        
        /**
         * Add a new namespace to the loader.
         *
         * @param string $namespace
         * @param string $hint
         * @return void 
         * @static 
         */
        public static function addNamespace($namespace, $hint){
            \Illuminate\Config\Repository::addNamespace($namespace, $hint);
        }
        
        /**
         * Returns all registered namespaces with the config
         * loader.
         *
         * @return array 
         * @static 
         */
        public static function getNamespaces(){
            return \Illuminate\Config\Repository::getNamespaces();
        }
        
        /**
         * Get the loader implementation.
         *
         * @return \Illuminate\Config\LoaderInterface 
         * @static 
         */
        public static function getLoader(){
            return \Illuminate\Config\Repository::getLoader();
        }
        
        /**
         * Set the loader implementation.
         *
         * @param \Illuminate\Config\LoaderInterface $loader
         * @return void 
         * @static 
         */
        public static function setLoader($loader){
            \Illuminate\Config\Repository::setLoader($loader);
        }
        
        /**
         * Get the current configuration environment.
         *
         * @return string 
         * @static 
         */
        public static function getEnvironment(){
            return \Illuminate\Config\Repository::getEnvironment();
        }
        
        /**
         * Get the after load callback array.
         *
         * @return array 
         * @static 
         */
        public static function getAfterLoadCallbacks(){
            return \Illuminate\Config\Repository::getAfterLoadCallbacks();
        }
        
        /**
         * Get all of the configuration items.
         *
         * @return array 
         * @static 
         */
        public static function getItems(){
            return \Illuminate\Config\Repository::getItems();
        }
        
        /**
         * Determine if the given configuration option exists.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function offsetExists($key){
            return \Illuminate\Config\Repository::offsetExists($key);
        }
        
        /**
         * Get a configuration option.
         *
         * @param string $key
         * @return mixed 
         * @static 
         */
        public static function offsetGet($key){
            return \Illuminate\Config\Repository::offsetGet($key);
        }
        
        /**
         * Set a configuration option.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function offsetSet($key, $value){
            \Illuminate\Config\Repository::offsetSet($key, $value);
        }
        
        /**
         * Unset a configuration option.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function offsetUnset($key){
            \Illuminate\Config\Repository::offsetUnset($key);
        }
        
        /**
         * Parse a key into namespace, group, and item.
         *
         * @param string $key
         * @return array 
         * @static 
         */
        public static function parseKey($key){
            //Method inherited from \Illuminate\Support\NamespacedItemResolver            
            return \Illuminate\Config\Repository::parseKey($key);
        }
        
        /**
         * Set the parsed value of a key.
         *
         * @param string $key
         * @param array $parsed
         * @return void 
         * @static 
         */
        public static function setParsedKey($key, $parsed){
            //Method inherited from \Illuminate\Support\NamespacedItemResolver            
            \Illuminate\Config\Repository::setParsedKey($key, $parsed);
        }
        
    }


    class Controller extends \Illuminate\Routing\Controller{
        
    }


    class Cookie extends \Illuminate\Support\Facades\Cookie{
        
        /**
         * Create a new cookie instance.
         *
         * @param string $name
         * @param string $value
         * @param int $minutes
         * @param string $path
         * @param string $domain
         * @param bool $secure
         * @param bool $httpOnly
         * @return \Symfony\Component\HttpFoundation\Cookie 
         * @static 
         */
        public static function make($name, $value, $minutes = 0, $path = null, $domain = null, $secure = false, $httpOnly = true){
            return \Illuminate\Cookie\CookieJar::make($name, $value, $minutes, $path, $domain, $secure, $httpOnly);
        }
        
        /**
         * Create a cookie that lasts "forever" (five years).
         *
         * @param string $name
         * @param string $value
         * @param string $path
         * @param string $domain
         * @param bool $secure
         * @param bool $httpOnly
         * @return \Symfony\Component\HttpFoundation\Cookie 
         * @static 
         */
        public static function forever($name, $value, $path = null, $domain = null, $secure = false, $httpOnly = true){
            return \Illuminate\Cookie\CookieJar::forever($name, $value, $path, $domain, $secure, $httpOnly);
        }
        
        /**
         * Expire the given cookie.
         *
         * @param string $name
         * @param string $path
         * @param string $domain
         * @return \Symfony\Component\HttpFoundation\Cookie 
         * @static 
         */
        public static function forget($name, $path = null, $domain = null){
            return \Illuminate\Cookie\CookieJar::forget($name, $path, $domain);
        }
        
        /**
         * Determine if a cookie has been queued.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasQueued($key){
            return \Illuminate\Cookie\CookieJar::hasQueued($key);
        }
        
        /**
         * Get a queued cookie instance.
         *
         * @param string $key
         * @param mixed $default
         * @return \Symfony\Component\HttpFoundation\Cookie 
         * @static 
         */
        public static function queued($key, $default = null){
            return \Illuminate\Cookie\CookieJar::queued($key, $default);
        }
        
        /**
         * Queue a cookie to send with the next response.
         *
         * @param mixed
         * @return void 
         * @static 
         */
        public static function queue(){
            \Illuminate\Cookie\CookieJar::queue();
        }
        
        /**
         * Remove a cookie from the queue.
         *
         * @param $cookieName
         * @static 
         */
        public static function unqueue($name){
            return \Illuminate\Cookie\CookieJar::unqueue($name);
        }
        
        /**
         * Set the default path and domain for the jar.
         *
         * @param string $path
         * @param string $domain
         * @return self 
         * @static 
         */
        public static function setDefaultPathAndDomain($path, $domain){
            return \Illuminate\Cookie\CookieJar::setDefaultPathAndDomain($path, $domain);
        }
        
        /**
         * Get the cookies which have been queued for the next request
         *
         * @return array 
         * @static 
         */
        public static function getQueuedCookies(){
            return \Illuminate\Cookie\CookieJar::getQueuedCookies();
        }
        
    }


    class Crypt extends \Illuminate\Support\Facades\Crypt{
        
        /**
         * Encrypt the given value.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function encrypt($value){
            return \Illuminate\Encryption\Encrypter::encrypt($value);
        }
        
        /**
         * Decrypt the given value.
         *
         * @param string $payload
         * @return string 
         * @static 
         */
        public static function decrypt($payload){
            return \Illuminate\Encryption\Encrypter::decrypt($payload);
        }
        
        /**
         * Set the encryption key.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function setKey($key){
            \Illuminate\Encryption\Encrypter::setKey($key);
        }
        
        /**
         * Set the encryption cipher.
         *
         * @param string $cipher
         * @return void 
         * @static 
         */
        public static function setCipher($cipher){
            \Illuminate\Encryption\Encrypter::setCipher($cipher);
        }
        
        /**
         * Set the encryption mode.
         *
         * @param string $mode
         * @return void 
         * @static 
         */
        public static function setMode($mode){
            \Illuminate\Encryption\Encrypter::setMode($mode);
        }
        
    }


    class DB extends \Illuminate\Support\Facades\DB{
        
        /**
         * Get a database connection instance.
         *
         * @param string $name
         * @return \Illuminate\Database\Connection 
         * @static 
         */
        public static function connection($name = null){
            return \Illuminate\Database\DatabaseManager::connection($name);
        }
        
        /**
         * Reconnect to the given database.
         *
         * @param string $name
         * @return \Illuminate\Database\Connection 
         * @static 
         */
        public static function reconnect($name = null){
            return \Illuminate\Database\DatabaseManager::reconnect($name);
        }
        
        /**
         * Disconnect from the given database.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function disconnect($name = null){
            \Illuminate\Database\DatabaseManager::disconnect($name);
        }
        
        /**
         * Get the default connection name.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultConnection(){
            return \Illuminate\Database\DatabaseManager::getDefaultConnection();
        }
        
        /**
         * Set the default connection name.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultConnection($name){
            \Illuminate\Database\DatabaseManager::setDefaultConnection($name);
        }
        
        /**
         * Register an extension connection resolver.
         *
         * @param string $name
         * @param callable $resolver
         * @return void 
         * @static 
         */
        public static function extend($name, $resolver){
            \Illuminate\Database\DatabaseManager::extend($name, $resolver);
        }
        
        /**
         * Return all of the created connections.
         *
         * @return array 
         * @static 
         */
        public static function getConnections(){
            return \Illuminate\Database\DatabaseManager::getConnections();
        }
        
        /**
         * Get a schema builder instance for the connection.
         *
         * @return \Illuminate\Database\Schema\MySqlBuilder 
         * @static 
         */
        public static function getSchemaBuilder(){
            return \Illuminate\Database\MySqlConnection::getSchemaBuilder();
        }
        
        /**
         * Set the query grammar to the default implementation.
         *
         * @return void 
         * @static 
         */
        public static function useDefaultQueryGrammar(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::useDefaultQueryGrammar();
        }
        
        /**
         * Set the schema grammar to the default implementation.
         *
         * @return void 
         * @static 
         */
        public static function useDefaultSchemaGrammar(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::useDefaultSchemaGrammar();
        }
        
        /**
         * Set the query post processor to the default implementation.
         *
         * @return void 
         * @static 
         */
        public static function useDefaultPostProcessor(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::useDefaultPostProcessor();
        }
        
        /**
         * Begin a fluent query against a database table.
         *
         * @param string $table
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function table($table){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::table($table);
        }
        
        /**
         * Get a new raw query expression.
         *
         * @param mixed $value
         * @return \Illuminate\Database\Query\Expression 
         * @static 
         */
        public static function raw($value){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::raw($value);
        }
        
        /**
         * Run a select statement and return a single result.
         *
         * @param string $query
         * @param array $bindings
         * @return mixed 
         * @static 
         */
        public static function selectOne($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::selectOne($query, $bindings);
        }
        
        /**
         * Run a select statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return array 
         * @static 
         */
        public static function select($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::select($query, $bindings);
        }
        
        /**
         * Run an insert statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return bool 
         * @static 
         */
        public static function insert($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::insert($query, $bindings);
        }
        
        /**
         * Run an update statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return int 
         * @static 
         */
        public static function update($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::update($query, $bindings);
        }
        
        /**
         * Run a delete statement against the database.
         *
         * @param string $query
         * @param array $bindings
         * @return int 
         * @static 
         */
        public static function delete($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::delete($query, $bindings);
        }
        
        /**
         * Execute an SQL statement and return the boolean result.
         *
         * @param string $query
         * @param array $bindings
         * @return bool 
         * @static 
         */
        public static function statement($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::statement($query, $bindings);
        }
        
        /**
         * Run an SQL statement and get the number of rows affected.
         *
         * @param string $query
         * @param array $bindings
         * @return int 
         * @static 
         */
        public static function affectingStatement($query, $bindings = array()){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::affectingStatement($query, $bindings);
        }
        
        /**
         * Run a raw, unprepared query against the PDO connection.
         *
         * @param string $query
         * @return bool 
         * @static 
         */
        public static function unprepared($query){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::unprepared($query);
        }
        
        /**
         * Prepare the query bindings for execution.
         *
         * @param array $bindings
         * @return array 
         * @static 
         */
        public static function prepareBindings($bindings){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::prepareBindings($bindings);
        }
        
        /**
         * Execute a Closure within a transaction.
         *
         * @param \Closure $callback
         * @return mixed 
         * @throws \Exception
         * @static 
         */
        public static function transaction($callback){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::transaction($callback);
        }
        
        /**
         * Start a new database transaction.
         *
         * @return void 
         * @static 
         */
        public static function beginTransaction(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::beginTransaction();
        }
        
        /**
         * Commit the active database transaction.
         *
         * @return void 
         * @static 
         */
        public static function commit(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::commit();
        }
        
        /**
         * Rollback the active database transaction.
         *
         * @return void 
         * @static 
         */
        public static function rollBack(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::rollBack();
        }
        
        /**
         * Get the number of active transactions.
         *
         * @return int 
         * @static 
         */
        public static function transactionLevel(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::transactionLevel();
        }
        
        /**
         * Execute the given callback in "dry run" mode.
         *
         * @param \Closure $callback
         * @return array 
         * @static 
         */
        public static function pretend($callback){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::pretend($callback);
        }
        
        /**
         * Log a query in the connection's query log.
         *
         * @param string $query
         * @param array $bindings
         * @param $time
         * @return void 
         * @static 
         */
        public static function logQuery($query, $bindings, $time = null){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::logQuery($query, $bindings, $time);
        }
        
        /**
         * Register a database query listener with the connection.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function listen($callback){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::listen($callback);
        }
        
        /**
         * Get a Doctrine Schema Column instance.
         *
         * @param string $table
         * @param string $column
         * @return \Doctrine\DBAL\Schema\Column 
         * @static 
         */
        public static function getDoctrineColumn($table, $column){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getDoctrineColumn($table, $column);
        }
        
        /**
         * Get the Doctrine DBAL schema manager for the connection.
         *
         * @return \Doctrine\DBAL\Schema\AbstractSchemaManager 
         * @static 
         */
        public static function getDoctrineSchemaManager(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getDoctrineSchemaManager();
        }
        
        /**
         * Get the Doctrine DBAL database connection instance.
         *
         * @return \Doctrine\DBAL\Connection 
         * @static 
         */
        public static function getDoctrineConnection(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getDoctrineConnection();
        }
        
        /**
         * Get the current PDO connection.
         *
         * @return \Illuminate\Database\PDO 
         * @static 
         */
        public static function getPdo(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getPdo();
        }
        
        /**
         * Get the current PDO connection used for reading.
         *
         * @return \Illuminate\Database\PDO 
         * @static 
         */
        public static function getReadPdo(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getReadPdo();
        }
        
        /**
         * Set the PDO connection.
         *
         * @param \Illuminate\Database\PDO $pdo
         * @return \Illuminate\Database\Connection 
         * @static 
         */
        public static function setPdo($pdo){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::setPdo($pdo);
        }
        
        /**
         * Set the PDO connection used for reading.
         *
         * @param \Illuminate\Database\PDO $pdo
         * @return \Illuminate\Database\Connection 
         * @static 
         */
        public static function setReadPdo($pdo){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::setReadPdo($pdo);
        }
        
        /**
         * Get the database connection name.
         *
         * @return string|null 
         * @static 
         */
        public static function getName(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getName();
        }
        
        /**
         * Get an option from the configuration options.
         *
         * @param string $option
         * @return mixed 
         * @static 
         */
        public static function getConfig($option){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getConfig($option);
        }
        
        /**
         * Get the PDO driver name.
         *
         * @return string 
         * @static 
         */
        public static function getDriverName(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getDriverName();
        }
        
        /**
         * Get the query grammar used by the connection.
         *
         * @return \Illuminate\Database\Query\Grammars\Grammar 
         * @static 
         */
        public static function getQueryGrammar(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getQueryGrammar();
        }
        
        /**
         * Set the query grammar used by the connection.
         *
         * @param \Illuminate\Database\Query\Grammars\Grammar
         * @return void 
         * @static 
         */
        public static function setQueryGrammar($grammar){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setQueryGrammar($grammar);
        }
        
        /**
         * Get the schema grammar used by the connection.
         *
         * @return \Illuminate\Database\Query\Grammars\Grammar 
         * @static 
         */
        public static function getSchemaGrammar(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getSchemaGrammar();
        }
        
        /**
         * Set the schema grammar used by the connection.
         *
         * @param \Illuminate\Database\Schema\Grammars\Grammar
         * @return void 
         * @static 
         */
        public static function setSchemaGrammar($grammar){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setSchemaGrammar($grammar);
        }
        
        /**
         * Get the query post processor used by the connection.
         *
         * @return \Illuminate\Database\Query\Processors\Processor 
         * @static 
         */
        public static function getPostProcessor(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getPostProcessor();
        }
        
        /**
         * Set the query post processor used by the connection.
         *
         * @param \Illuminate\Database\Query\Processors\Processor
         * @return void 
         * @static 
         */
        public static function setPostProcessor($processor){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setPostProcessor($processor);
        }
        
        /**
         * Get the event dispatcher used by the connection.
         *
         * @return \Illuminate\Events\Dispatcher 
         * @static 
         */
        public static function getEventDispatcher(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getEventDispatcher();
        }
        
        /**
         * Set the event dispatcher instance on the connection.
         *
         * @param \Illuminate\Events\Dispatcher
         * @return void 
         * @static 
         */
        public static function setEventDispatcher($events){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setEventDispatcher($events);
        }
        
        /**
         * Get the paginator environment instance.
         *
         * @return \Illuminate\Pagination\Environment 
         * @static 
         */
        public static function getPaginator(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getPaginator();
        }
        
        /**
         * Set the pagination environment instance.
         *
         * @param \Illuminate\Pagination\Environment|\Closure $paginator
         * @return void 
         * @static 
         */
        public static function setPaginator($paginator){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setPaginator($paginator);
        }
        
        /**
         * Get the cache manager instance.
         *
         * @return \Illuminate\Cache\CacheManager 
         * @static 
         */
        public static function getCacheManager(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getCacheManager();
        }
        
        /**
         * Set the cache manager instance on the connection.
         *
         * @param \Illuminate\Cache\CacheManager|\Closure $cache
         * @return void 
         * @static 
         */
        public static function setCacheManager($cache){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setCacheManager($cache);
        }
        
        /**
         * Determine if the connection in a "dry run".
         *
         * @return bool 
         * @static 
         */
        public static function pretending(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::pretending();
        }
        
        /**
         * Get the default fetch mode for the connection.
         *
         * @return int 
         * @static 
         */
        public static function getFetchMode(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getFetchMode();
        }
        
        /**
         * Set the default fetch mode for the connection.
         *
         * @param int $fetchMode
         * @return int 
         * @static 
         */
        public static function setFetchMode($fetchMode){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::setFetchMode($fetchMode);
        }
        
        /**
         * Get the connection query log.
         *
         * @return array 
         * @static 
         */
        public static function getQueryLog(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getQueryLog();
        }
        
        /**
         * Clear the query log.
         *
         * @return void 
         * @static 
         */
        public static function flushQueryLog(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::flushQueryLog();
        }
        
        /**
         * Enable the query log on the connection.
         *
         * @return void 
         * @static 
         */
        public static function enableQueryLog(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::enableQueryLog();
        }
        
        /**
         * Disable the query log on the connection.
         *
         * @return void 
         * @static 
         */
        public static function disableQueryLog(){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::disableQueryLog();
        }
        
        /**
         * Determine whether we're logging queries.
         *
         * @return bool 
         * @static 
         */
        public static function logging(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::logging();
        }
        
        /**
         * Get the name of the connected database.
         *
         * @return string 
         * @static 
         */
        public static function getDatabaseName(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getDatabaseName();
        }
        
        /**
         * Set the name of the connected database.
         *
         * @param string $database
         * @return string 
         * @static 
         */
        public static function setDatabaseName($database){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::setDatabaseName($database);
        }
        
        /**
         * Get the table prefix for the connection.
         *
         * @return string 
         * @static 
         */
        public static function getTablePrefix(){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::getTablePrefix();
        }
        
        /**
         * Set the table prefix in use by the connection.
         *
         * @param string $prefix
         * @return void 
         * @static 
         */
        public static function setTablePrefix($prefix){
            //Method inherited from \Illuminate\Database\Connection            
            \Illuminate\Database\MySqlConnection::setTablePrefix($prefix);
        }
        
        /**
         * Set the table prefix and return the grammar.
         *
         * @param \Illuminate\Database\Grammar $grammar
         * @return \Illuminate\Database\Grammar 
         * @static 
         */
        public static function withTablePrefix($grammar){
            //Method inherited from \Illuminate\Database\Connection            
            return \Illuminate\Database\MySqlConnection::withTablePrefix($grammar);
        }
        
    }


    class Eloquent extends \Illuminate\Database\Eloquent\Model{
        
        /**
         * Find a model by its primary key.
         *
         * @param array $id
         * @param array $columns
         * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static 
         * @static 
         */
        public static function findMany($id, $columns = array()){
            return \Illuminate\Database\Eloquent\Builder::findMany($id, $columns);
        }
        
        /**
         * Execute the query and get the first result.
         *
         * @param array $columns
         * @return \Illuminate\Database\Eloquent\Model|static|null 
         * @static 
         */
        public static function first($columns = array()){
            return \Illuminate\Database\Eloquent\Builder::first($columns);
        }
        
        /**
         * Execute the query and get the first result or throw an exception.
         *
         * @param array $columns
         * @return \Illuminate\Database\Eloquent\Model|static 
         * @throws ModelNotFoundException
         * @static 
         */
        public static function firstOrFail($columns = array()){
            return \Illuminate\Database\Eloquent\Builder::firstOrFail($columns);
        }
        
        /**
         * Execute the query as a "select" statement.
         *
         * @param array $columns
         * @return \Illuminate\Database\Eloquent\Collection|static[] 
         * @static 
         */
        public static function get($columns = array()){
            return \Illuminate\Database\Eloquent\Builder::get($columns);
        }
        
        /**
         * Pluck a single column from the database.
         *
         * @param string $column
         * @return mixed 
         * @static 
         */
        public static function pluck($column){
            return \Illuminate\Database\Eloquent\Builder::pluck($column);
        }
        
        /**
         * Chunk the results of the query.
         *
         * @param int $count
         * @param callable $callback
         * @return void 
         * @static 
         */
        public static function chunk($count, $callback){
            \Illuminate\Database\Eloquent\Builder::chunk($count, $callback);
        }
        
        /**
         * Get an array with the values of a given column.
         *
         * @param string $column
         * @param string $key
         * @return array 
         * @static 
         */
        public static function lists($column, $key = null){
            return \Illuminate\Database\Eloquent\Builder::lists($column, $key);
        }
        
        /**
         * Get a paginator for the "select" statement.
         *
         * @param int $perPage
         * @param array $columns
         * @return \Illuminate\Pagination\Paginator 
         * @static 
         */
        public static function paginate($perPage = null, $columns = array()){
            return \Illuminate\Database\Eloquent\Builder::paginate($perPage, $columns);
        }
        
        /**
         * Get the hydrated models without eager loading.
         *
         * @param array $columns
         * @return array|static[] 
         * @static 
         */
        public static function getModels($columns = array()){
            return \Illuminate\Database\Eloquent\Builder::getModels($columns);
        }
        
        /**
         * Eager load the relationships for the models.
         *
         * @param array $models
         * @return array 
         * @static 
         */
        public static function eagerLoadRelations($models){
            return \Illuminate\Database\Eloquent\Builder::eagerLoadRelations($models);
        }
        
        /**
         * Add a basic where clause to the query.
         *
         * @param string $column
         * @param string $operator
         * @param mixed $value
         * @param string $boolean
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function where($column, $operator = null, $value = null, $boolean = 'and'){
            return \Illuminate\Database\Eloquent\Builder::where($column, $operator, $value, $boolean);
        }
        
        /**
         * Add an "or where" clause to the query.
         *
         * @param string $column
         * @param string $operator
         * @param mixed $value
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function orWhere($column, $operator = null, $value = null){
            return \Illuminate\Database\Eloquent\Builder::orWhere($column, $operator, $value);
        }
        
        /**
         * Add a relationship count condition to the query.
         *
         * @param string $relation
         * @param string $operator
         * @param int $count
         * @param string $boolean
         * @param \Closure $callback
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function has($relation, $operator = '>=', $count = 1, $boolean = 'and', $callback = null){
            return \Illuminate\Database\Eloquent\Builder::has($relation, $operator, $count, $boolean, $callback);
        }
        
        /**
         * Add a relationship count condition to the query with where clauses.
         *
         * @param string $relation
         * @param \Closure $callback
         * @param string $operator
         * @param int $count
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function whereHas($relation, $callback, $operator = '>=', $count = 1){
            return \Illuminate\Database\Eloquent\Builder::whereHas($relation, $callback, $operator, $count);
        }
        
        /**
         * Add a relationship count condition to the query with an "or".
         *
         * @param string $relation
         * @param string $operator
         * @param int $count
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function orHas($relation, $operator = '>=', $count = 1){
            return \Illuminate\Database\Eloquent\Builder::orHas($relation, $operator, $count);
        }
        
        /**
         * Add a relationship count condition to the query with where clauses and an "or".
         *
         * @param string $relation
         * @param \Closure $callback
         * @param string $operator
         * @param int $count
         * @return \Illuminate\Database\Eloquent\Builder|static 
         * @static 
         */
        public static function orWhereHas($relation, $callback, $operator = '>=', $count = 1){
            return \Illuminate\Database\Eloquent\Builder::orWhereHas($relation, $callback, $operator, $count);
        }
        
        /**
         * Get the underlying query builder instance.
         *
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function getQuery(){
            return \Illuminate\Database\Eloquent\Builder::getQuery();
        }
        
        /**
         * Set the underlying query builder instance.
         *
         * @param \Illuminate\Database\Query\Builder $query
         * @return void 
         * @static 
         */
        public static function setQuery($query){
            \Illuminate\Database\Eloquent\Builder::setQuery($query);
        }
        
        /**
         * Get the relationships being eagerly loaded.
         *
         * @return array 
         * @static 
         */
        public static function getEagerLoads(){
            return \Illuminate\Database\Eloquent\Builder::getEagerLoads();
        }
        
        /**
         * Set the relationships being eagerly loaded.
         *
         * @param array $eagerLoad
         * @return void 
         * @static 
         */
        public static function setEagerLoads($eagerLoad){
            \Illuminate\Database\Eloquent\Builder::setEagerLoads($eagerLoad);
        }
        
        /**
         * Get the model instance being queried.
         *
         * @return \Illuminate\Database\Eloquent\Model 
         * @static 
         */
        public static function getModel(){
            return \Illuminate\Database\Eloquent\Builder::getModel();
        }
        
        /**
         * Set a model instance for the model being queried.
         *
         * @param \Illuminate\Database\Eloquent\Model $model
         * @return \Illuminate\Database\Eloquent\Builder 
         * @static 
         */
        public static function setModel($model){
            return \Illuminate\Database\Eloquent\Builder::setModel($model);
        }
        
        /**
         * Set the columns to be selected.
         *
         * @param array $columns
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function select($columns = array()){
            return \Illuminate\Database\Query\Builder::select($columns);
        }
        
        /**
         * Add a new "raw" select expression to the query.
         *
         * @param string $expression
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function selectRaw($expression){
            return \Illuminate\Database\Query\Builder::selectRaw($expression);
        }
        
        /**
         * Add a new select column to the query.
         *
         * @param mixed $column
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function addSelect($column){
            return \Illuminate\Database\Query\Builder::addSelect($column);
        }
        
        /**
         * Force the query to only return distinct results.
         *
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function distinct(){
            return \Illuminate\Database\Query\Builder::distinct();
        }
        
        /**
         * Set the table which the query is targeting.
         *
         * @param string $table
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function from($table){
            return \Illuminate\Database\Query\Builder::from($table);
        }
        
        /**
         * Add a join clause to the query.
         *
         * @param string $table
         * @param string $first
         * @param string $operator
         * @param string $two
         * @param string $type
         * @param bool $where
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function join($table, $one, $operator = null, $two = null, $type = 'inner', $where = false){
            return \Illuminate\Database\Query\Builder::join($table, $one, $operator, $two, $type, $where);
        }
        
        /**
         * Add a "join where" clause to the query.
         *
         * @param string $table
         * @param string $first
         * @param string $operator
         * @param string $two
         * @param string $type
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function joinWhere($table, $one, $operator, $two, $type = 'inner'){
            return \Illuminate\Database\Query\Builder::joinWhere($table, $one, $operator, $two, $type);
        }
        
        /**
         * Add a left join to the query.
         *
         * @param string $table
         * @param string $first
         * @param string $operator
         * @param string $second
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function leftJoin($table, $first, $operator = null, $second = null){
            return \Illuminate\Database\Query\Builder::leftJoin($table, $first, $operator, $second);
        }
        
        /**
         * Add a "join where" clause to the query.
         *
         * @param string $table
         * @param string $first
         * @param string $operator
         * @param string $two
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function leftJoinWhere($table, $one, $operator, $two){
            return \Illuminate\Database\Query\Builder::leftJoinWhere($table, $one, $operator, $two);
        }
        
        /**
         * Add a raw where clause to the query.
         *
         * @param string $sql
         * @param array $bindings
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereRaw($sql, $bindings = array(), $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereRaw($sql, $bindings, $boolean);
        }
        
        /**
         * Add a raw or where clause to the query.
         *
         * @param string $sql
         * @param array $bindings
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereRaw($sql, $bindings = array()){
            return \Illuminate\Database\Query\Builder::orWhereRaw($sql, $bindings);
        }
        
        /**
         * Add a where between statement to the query.
         *
         * @param string $column
         * @param array $values
         * @param string $boolean
         * @param bool $not
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereBetween($column, $values, $boolean = 'and', $not = false){
            return \Illuminate\Database\Query\Builder::whereBetween($column, $values, $boolean, $not);
        }
        
        /**
         * Add an or where between statement to the query.
         *
         * @param string $column
         * @param array $values
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereBetween($column, $values){
            return \Illuminate\Database\Query\Builder::orWhereBetween($column, $values);
        }
        
        /**
         * Add a where not between statement to the query.
         *
         * @param string $column
         * @param array $values
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNotBetween($column, $values, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereNotBetween($column, $values, $boolean);
        }
        
        /**
         * Add an or where not between statement to the query.
         *
         * @param string $column
         * @param array $values
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereNotBetween($column, $values){
            return \Illuminate\Database\Query\Builder::orWhereNotBetween($column, $values);
        }
        
        /**
         * Add a nested where statement to the query.
         *
         * @param \Closure $callback
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNested($callback, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereNested($callback, $boolean);
        }
        
        /**
         * Add another query builder as a nested where to the query builder.
         *
         * @param \Illuminate\Database\Query\Builder|static $query
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function addNestedWhereQuery($query, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::addNestedWhereQuery($query, $boolean);
        }
        
        /**
         * Add an exists clause to the query.
         *
         * @param \Closure $callback
         * @param string $boolean
         * @param bool $not
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereExists($callback, $boolean = 'and', $not = false){
            return \Illuminate\Database\Query\Builder::whereExists($callback, $boolean, $not);
        }
        
        /**
         * Add an or exists clause to the query.
         *
         * @param \Closure $callback
         * @param bool $not
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereExists($callback, $not = false){
            return \Illuminate\Database\Query\Builder::orWhereExists($callback, $not);
        }
        
        /**
         * Add a where not exists clause to the query.
         *
         * @param \Closure $callback
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNotExists($callback, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereNotExists($callback, $boolean);
        }
        
        /**
         * Add a where not exists clause to the query.
         *
         * @param \Closure $callback
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereNotExists($callback){
            return \Illuminate\Database\Query\Builder::orWhereNotExists($callback);
        }
        
        /**
         * Add a "where in" clause to the query.
         *
         * @param string $column
         * @param mixed $values
         * @param string $boolean
         * @param bool $not
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereIn($column, $values, $boolean = 'and', $not = false){
            return \Illuminate\Database\Query\Builder::whereIn($column, $values, $boolean, $not);
        }
        
        /**
         * Add an "or where in" clause to the query.
         *
         * @param string $column
         * @param mixed $values
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereIn($column, $values){
            return \Illuminate\Database\Query\Builder::orWhereIn($column, $values);
        }
        
        /**
         * Add a "where not in" clause to the query.
         *
         * @param string $column
         * @param mixed $values
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNotIn($column, $values, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereNotIn($column, $values, $boolean);
        }
        
        /**
         * Add an "or where not in" clause to the query.
         *
         * @param string $column
         * @param mixed $values
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereNotIn($column, $values){
            return \Illuminate\Database\Query\Builder::orWhereNotIn($column, $values);
        }
        
        /**
         * Add a "where null" clause to the query.
         *
         * @param string $column
         * @param string $boolean
         * @param bool $not
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNull($column, $boolean = 'and', $not = false){
            return \Illuminate\Database\Query\Builder::whereNull($column, $boolean, $not);
        }
        
        /**
         * Add an "or where null" clause to the query.
         *
         * @param string $column
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereNull($column){
            return \Illuminate\Database\Query\Builder::orWhereNull($column);
        }
        
        /**
         * Add a "where not null" clause to the query.
         *
         * @param string $column
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereNotNull($column, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereNotNull($column, $boolean);
        }
        
        /**
         * Add an "or where not null" clause to the query.
         *
         * @param string $column
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orWhereNotNull($column){
            return \Illuminate\Database\Query\Builder::orWhereNotNull($column);
        }
        
        /**
         * Add a "where day" statement to the query.
         *
         * @param string $column
         * @param string $operator
         * @param int $value
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereDay($column, $operator, $value, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereDay($column, $operator, $value, $boolean);
        }
        
        /**
         * Add a "where month" statement to the query.
         *
         * @param string $column
         * @param string $operator
         * @param int $value
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereMonth($column, $operator, $value, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereMonth($column, $operator, $value, $boolean);
        }
        
        /**
         * Add a "where year" statement to the query.
         *
         * @param string $column
         * @param string $operator
         * @param int $value
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function whereYear($column, $operator, $value, $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::whereYear($column, $operator, $value, $boolean);
        }
        
        /**
         * Handles dynamic "where" clauses to the query.
         *
         * @param string $method
         * @param string $parameters
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function dynamicWhere($method, $parameters){
            return \Illuminate\Database\Query\Builder::dynamicWhere($method, $parameters);
        }
        
        /**
         * Add a "group by" clause to the query.
         *
         * @param mixed $columns
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function groupBy(){
            return \Illuminate\Database\Query\Builder::groupBy();
        }
        
        /**
         * Add a "having" clause to the query.
         *
         * @param string $column
         * @param string $operator
         * @param string $value
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function having($column, $operator = null, $value = null){
            return \Illuminate\Database\Query\Builder::having($column, $operator, $value);
        }
        
        /**
         * Add a raw having clause to the query.
         *
         * @param string $sql
         * @param array $bindings
         * @param string $boolean
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function havingRaw($sql, $bindings = array(), $boolean = 'and'){
            return \Illuminate\Database\Query\Builder::havingRaw($sql, $bindings, $boolean);
        }
        
        /**
         * Add a raw or having clause to the query.
         *
         * @param string $sql
         * @param array $bindings
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orHavingRaw($sql, $bindings = array()){
            return \Illuminate\Database\Query\Builder::orHavingRaw($sql, $bindings);
        }
        
        /**
         * Add an "order by" clause to the query.
         *
         * @param string $column
         * @param string $direction
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orderBy($column, $direction = 'asc'){
            return \Illuminate\Database\Query\Builder::orderBy($column, $direction);
        }
        
        /**
         * Add an "order by" clause for a timestamp to the query.
         *
         * @param string $column
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function latest($column = 'created_at'){
            return \Illuminate\Database\Query\Builder::latest($column);
        }
        
        /**
         * Add an "order by" clause for a timestamp to the query.
         *
         * @param string $column
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function oldest($column = 'created_at'){
            return \Illuminate\Database\Query\Builder::oldest($column);
        }
        
        /**
         * Add a raw "order by" clause to the query.
         *
         * @param string $sql
         * @param array $bindings
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function orderByRaw($sql, $bindings = array()){
            return \Illuminate\Database\Query\Builder::orderByRaw($sql, $bindings);
        }
        
        /**
         * Set the "offset" value of the query.
         *
         * @param int $value
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function offset($value){
            return \Illuminate\Database\Query\Builder::offset($value);
        }
        
        /**
         * Alias to set the "offset" value of the query.
         *
         * @param int $value
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function skip($value){
            return \Illuminate\Database\Query\Builder::skip($value);
        }
        
        /**
         * Set the "limit" value of the query.
         *
         * @param int $value
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function limit($value){
            return \Illuminate\Database\Query\Builder::limit($value);
        }
        
        /**
         * Alias to set the "limit" value of the query.
         *
         * @param int $value
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function take($value){
            return \Illuminate\Database\Query\Builder::take($value);
        }
        
        /**
         * Set the limit and offset for a given page.
         *
         * @param int $page
         * @param int $perPage
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function forPage($page, $perPage = 15){
            return \Illuminate\Database\Query\Builder::forPage($page, $perPage);
        }
        
        /**
         * Add a union statement to the query.
         *
         * @param \Illuminate\Database\Query\Builder|\Closure $query
         * @param bool $all
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function union($query, $all = false){
            return \Illuminate\Database\Query\Builder::union($query, $all);
        }
        
        /**
         * Add a union all statement to the query.
         *
         * @param \Illuminate\Database\Query\Builder|\Closure $query
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function unionAll($query){
            return \Illuminate\Database\Query\Builder::unionAll($query);
        }
        
        /**
         * Lock the selected rows in the table.
         *
         * @param bool $update
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function lock($value = true){
            return \Illuminate\Database\Query\Builder::lock($value);
        }
        
        /**
         * Lock the selected rows in the table for updating.
         *
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function lockForUpdate(){
            return \Illuminate\Database\Query\Builder::lockForUpdate();
        }
        
        /**
         * Share lock the selected rows in the table.
         *
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function sharedLock(){
            return \Illuminate\Database\Query\Builder::sharedLock();
        }
        
        /**
         * Get the SQL representation of the query.
         *
         * @return string 
         * @static 
         */
        public static function toSql(){
            return \Illuminate\Database\Query\Builder::toSql();
        }
        
        /**
         * Indicate that the query results should be cached.
         *
         * @param \DateTime|int $minutes
         * @param string $key
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function remember($minutes, $key = null){
            return \Illuminate\Database\Query\Builder::remember($minutes, $key);
        }
        
        /**
         * Indicate that the query results should be cached forever.
         *
         * @param string $key
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function rememberForever($key = null){
            return \Illuminate\Database\Query\Builder::rememberForever($key);
        }
        
        /**
         * Indicate that the results, if cached, should use the given cache tags.
         *
         * @param array|mixed $cacheTags
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function cacheTags($cacheTags){
            return \Illuminate\Database\Query\Builder::cacheTags($cacheTags);
        }
        
        /**
         * Indicate that the results, if cached, should use the given cache driver.
         *
         * @param string $cacheDriver
         * @return \Illuminate\Database\Query\Builder|static 
         * @static 
         */
        public static function cacheDriver($cacheDriver){
            return \Illuminate\Database\Query\Builder::cacheDriver($cacheDriver);
        }
        
        /**
         * Execute the query as a fresh "select" statement.
         *
         * @param array $columns
         * @return array|static[] 
         * @static 
         */
        public static function getFresh($columns = array()){
            return \Illuminate\Database\Query\Builder::getFresh($columns);
        }
        
        /**
         * Execute the query as a cached "select" statement.
         *
         * @param array $columns
         * @return array 
         * @static 
         */
        public static function getCached($columns = array()){
            return \Illuminate\Database\Query\Builder::getCached($columns);
        }
        
        /**
         * Get a unique cache key for the complete query.
         *
         * @return string 
         * @static 
         */
        public static function getCacheKey(){
            return \Illuminate\Database\Query\Builder::getCacheKey();
        }
        
        /**
         * Generate the unique cache key for the query.
         *
         * @return string 
         * @static 
         */
        public static function generateCacheKey(){
            return \Illuminate\Database\Query\Builder::generateCacheKey();
        }
        
        /**
         * Concatenate values of a given column as a string.
         *
         * @param string $column
         * @param string $glue
         * @return string 
         * @static 
         */
        public static function implode($column, $glue = null){
            return \Illuminate\Database\Query\Builder::implode($column, $glue);
        }
        
        /**
         * Build a paginator instance from a raw result array.
         *
         * @param \Illuminate\Pagination\Environment $paginator
         * @param array $results
         * @param int $perPage
         * @return \Illuminate\Pagination\Paginator 
         * @static 
         */
        public static function buildRawPaginator($paginator, $results, $perPage){
            return \Illuminate\Database\Query\Builder::buildRawPaginator($paginator, $results, $perPage);
        }
        
        /**
         * Get the count of the total records for pagination.
         *
         * @return int 
         * @static 
         */
        public static function getPaginationCount(){
            return \Illuminate\Database\Query\Builder::getPaginationCount();
        }
        
        /**
         * Determine if any rows exist for the current query.
         *
         * @return bool 
         * @static 
         */
        public static function exists(){
            return \Illuminate\Database\Query\Builder::exists();
        }
        
        /**
         * Retrieve the "count" result of the query.
         *
         * @param string $columns
         * @return int 
         * @static 
         */
        public static function count($columns = '*'){
            return \Illuminate\Database\Query\Builder::count($columns);
        }
        
        /**
         * Retrieve the minimum value of a given column.
         *
         * @param string $column
         * @return mixed 
         * @static 
         */
        public static function min($column){
            return \Illuminate\Database\Query\Builder::min($column);
        }
        
        /**
         * Retrieve the maximum value of a given column.
         *
         * @param string $column
         * @return mixed 
         * @static 
         */
        public static function max($column){
            return \Illuminate\Database\Query\Builder::max($column);
        }
        
        /**
         * Retrieve the sum of the values of a given column.
         *
         * @param string $column
         * @return mixed 
         * @static 
         */
        public static function sum($column){
            return \Illuminate\Database\Query\Builder::sum($column);
        }
        
        /**
         * Retrieve the average of the values of a given column.
         *
         * @param string $column
         * @return mixed 
         * @static 
         */
        public static function avg($column){
            return \Illuminate\Database\Query\Builder::avg($column);
        }
        
        /**
         * Execute an aggregate function on the database.
         *
         * @param string $function
         * @param array $columns
         * @return mixed 
         * @static 
         */
        public static function aggregate($function, $columns = array()){
            return \Illuminate\Database\Query\Builder::aggregate($function, $columns);
        }
        
        /**
         * Insert a new record into the database.
         *
         * @param array $values
         * @return bool 
         * @static 
         */
        public static function insert($values){
            return \Illuminate\Database\Query\Builder::insert($values);
        }
        
        /**
         * Insert a new record and get the value of the primary key.
         *
         * @param array $values
         * @param string $sequence
         * @return int 
         * @static 
         */
        public static function insertGetId($values, $sequence = null){
            return \Illuminate\Database\Query\Builder::insertGetId($values, $sequence);
        }
        
        /**
         * Run a truncate statement on the table.
         *
         * @return void 
         * @static 
         */
        public static function truncate(){
            \Illuminate\Database\Query\Builder::truncate();
        }
        
        /**
         * Merge an array of where clauses and bindings.
         *
         * @param array $wheres
         * @param array $bindings
         * @return void 
         * @static 
         */
        public static function mergeWheres($wheres, $bindings){
            \Illuminate\Database\Query\Builder::mergeWheres($wheres, $bindings);
        }
        
        /**
         * Create a raw database expression.
         *
         * @param mixed $value
         * @return \Illuminate\Database\Query\Expression 
         * @static 
         */
        public static function raw($value){
            return \Illuminate\Database\Query\Builder::raw($value);
        }
        
        /**
         * Get the current query value bindings.
         *
         * @return array 
         * @static 
         */
        public static function getBindings(){
            return \Illuminate\Database\Query\Builder::getBindings();
        }
        
        /**
         * Set the bindings on the query builder.
         *
         * @param array $bindings
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function setBindings($bindings){
            return \Illuminate\Database\Query\Builder::setBindings($bindings);
        }
        
        /**
         * Add a binding to the query.
         *
         * @param mixed $value
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function addBinding($value){
            return \Illuminate\Database\Query\Builder::addBinding($value);
        }
        
        /**
         * Merge an array of bindings into our bindings.
         *
         * @param \Illuminate\Database\Query\Builder $query
         * @return \Illuminate\Database\Query\Builder 
         * @static 
         */
        public static function mergeBindings($query){
            return \Illuminate\Database\Query\Builder::mergeBindings($query);
        }
        
        /**
         * Get the database query processor instance.
         *
         * @return \Illuminate\Database\Query\Processors\Processor 
         * @static 
         */
        public static function getProcessor(){
            return \Illuminate\Database\Query\Builder::getProcessor();
        }
        
        /**
         * Get the query grammar instance.
         *
         * @return \Illuminate\Database\Grammar 
         * @static 
         */
        public static function getGrammar(){
            return \Illuminate\Database\Query\Builder::getGrammar();
        }
        
    }


    class Event extends \Illuminate\Support\Facades\Event{
        
        /**
         * Register an event listener with the dispatcher.
         *
         * @param string|array $event
         * @param mixed $listener
         * @param int $priority
         * @return void 
         * @static 
         */
        public static function listen($events, $listener, $priority = 0){
            \Illuminate\Events\Dispatcher::listen($events, $listener, $priority);
        }
        
        /**
         * Determine if a given event has listeners.
         *
         * @param string $eventName
         * @return bool 
         * @static 
         */
        public static function hasListeners($eventName){
            return \Illuminate\Events\Dispatcher::hasListeners($eventName);
        }
        
        /**
         * Register a queued event and payload.
         *
         * @param string $event
         * @param array $payload
         * @return void 
         * @static 
         */
        public static function queue($event, $payload = array()){
            \Illuminate\Events\Dispatcher::queue($event, $payload);
        }
        
        /**
         * Register an event subscriber with the dispatcher.
         *
         * @param string $subscriber
         * @return void 
         * @static 
         */
        public static function subscribe($subscriber){
            \Illuminate\Events\Dispatcher::subscribe($subscriber);
        }
        
        /**
         * Fire an event until the first non-null response is returned.
         *
         * @param string $event
         * @param array $payload
         * @return mixed 
         * @static 
         */
        public static function until($event, $payload = array()){
            return \Illuminate\Events\Dispatcher::until($event, $payload);
        }
        
        /**
         * Flush a set of queued events.
         *
         * @param string $event
         * @return void 
         * @static 
         */
        public static function flush($event){
            \Illuminate\Events\Dispatcher::flush($event);
        }
        
        /**
         * Get the event that is currently firing.
         *
         * @return string 
         * @static 
         */
        public static function firing(){
            return \Illuminate\Events\Dispatcher::firing();
        }
        
        /**
         * Fire an event and call the listeners.
         *
         * @param string $event
         * @param mixed $payload
         * @param bool $halt
         * @return array|null 
         * @static 
         */
        public static function fire($event, $payload = array(), $halt = false){
            return \Illuminate\Events\Dispatcher::fire($event, $payload, $halt);
        }
        
        /**
         * Get all of the listeners for a given event name.
         *
         * @param string $eventName
         * @return array 
         * @static 
         */
        public static function getListeners($eventName){
            return \Illuminate\Events\Dispatcher::getListeners($eventName);
        }
        
        /**
         * Register an event listener with the dispatcher.
         *
         * @param mixed $listener
         * @return mixed 
         * @static 
         */
        public static function makeListener($listener){
            return \Illuminate\Events\Dispatcher::makeListener($listener);
        }
        
        /**
         * Create a class based listener using the IoC container.
         *
         * @param mixed $listener
         * @return \Closure 
         * @static 
         */
        public static function createClassListener($listener){
            return \Illuminate\Events\Dispatcher::createClassListener($listener);
        }
        
        /**
         * Remove a set of listeners from the dispatcher.
         *
         * @param string $event
         * @return void 
         * @static 
         */
        public static function forget($event){
            \Illuminate\Events\Dispatcher::forget($event);
        }
        
    }


    class File extends \Illuminate\Support\Facades\File{
        
        /**
         * Determine if a file exists.
         *
         * @param string $path
         * @return bool 
         * @static 
         */
        public static function exists($path){
            return \Illuminate\Filesystem\Filesystem::exists($path);
        }
        
        /**
         * Get the contents of a file.
         *
         * @param string $path
         * @return string 
         * @throws FileNotFoundException
         * @static 
         */
        public static function get($path){
            return \Illuminate\Filesystem\Filesystem::get($path);
        }
        
        /**
         * Get the returned value of a file.
         *
         * @param string $path
         * @return mixed 
         * @throws FileNotFoundException
         * @static 
         */
        public static function getRequire($path){
            return \Illuminate\Filesystem\Filesystem::getRequire($path);
        }
        
        /**
         * Require the given file once.
         *
         * @param string $file
         * @return mixed 
         * @static 
         */
        public static function requireOnce($file){
            return \Illuminate\Filesystem\Filesystem::requireOnce($file);
        }
        
        /**
         * Write the contents of a file.
         *
         * @param string $path
         * @param string $contents
         * @return int 
         * @static 
         */
        public static function put($path, $contents){
            return \Illuminate\Filesystem\Filesystem::put($path, $contents);
        }
        
        /**
         * Prepend to a file.
         *
         * @param string $path
         * @param string $data
         * @return int 
         * @static 
         */
        public static function prepend($path, $data){
            return \Illuminate\Filesystem\Filesystem::prepend($path, $data);
        }
        
        /**
         * Append to a file.
         *
         * @param string $path
         * @param string $data
         * @return int 
         * @static 
         */
        public static function append($path, $data){
            return \Illuminate\Filesystem\Filesystem::append($path, $data);
        }
        
        /**
         * Delete the file at a given path.
         *
         * @param string|array $paths
         * @return bool 
         * @static 
         */
        public static function delete($paths){
            return \Illuminate\Filesystem\Filesystem::delete($paths);
        }
        
        /**
         * Move a file to a new location.
         *
         * @param string $path
         * @param string $target
         * @return bool 
         * @static 
         */
        public static function move($path, $target){
            return \Illuminate\Filesystem\Filesystem::move($path, $target);
        }
        
        /**
         * Copy a file to a new location.
         *
         * @param string $path
         * @param string $target
         * @return bool 
         * @static 
         */
        public static function copy($path, $target){
            return \Illuminate\Filesystem\Filesystem::copy($path, $target);
        }
        
        /**
         * Extract the file extension from a file path.
         *
         * @param string $path
         * @return string 
         * @static 
         */
        public static function extension($path){
            return \Illuminate\Filesystem\Filesystem::extension($path);
        }
        
        /**
         * Get the file type of a given file.
         *
         * @param string $path
         * @return string 
         * @static 
         */
        public static function type($path){
            return \Illuminate\Filesystem\Filesystem::type($path);
        }
        
        /**
         * Get the file size of a given file.
         *
         * @param string $path
         * @return int 
         * @static 
         */
        public static function size($path){
            return \Illuminate\Filesystem\Filesystem::size($path);
        }
        
        /**
         * Get the file's last modification time.
         *
         * @param string $path
         * @return int 
         * @static 
         */
        public static function lastModified($path){
            return \Illuminate\Filesystem\Filesystem::lastModified($path);
        }
        
        /**
         * Determine if the given path is a directory.
         *
         * @param string $directory
         * @return bool 
         * @static 
         */
        public static function isDirectory($directory){
            return \Illuminate\Filesystem\Filesystem::isDirectory($directory);
        }
        
        /**
         * Determine if the given path is writable.
         *
         * @param string $path
         * @return bool 
         * @static 
         */
        public static function isWritable($path){
            return \Illuminate\Filesystem\Filesystem::isWritable($path);
        }
        
        /**
         * Determine if the given path is a file.
         *
         * @param string $file
         * @return bool 
         * @static 
         */
        public static function isFile($file){
            return \Illuminate\Filesystem\Filesystem::isFile($file);
        }
        
        /**
         * Find path names matching a given pattern.
         *
         * @param string $pattern
         * @param int $flags
         * @return array 
         * @static 
         */
        public static function glob($pattern, $flags = 0){
            return \Illuminate\Filesystem\Filesystem::glob($pattern, $flags);
        }
        
        /**
         * Get an array of all files in a directory.
         *
         * @param string $directory
         * @return array 
         * @static 
         */
        public static function files($directory){
            return \Illuminate\Filesystem\Filesystem::files($directory);
        }
        
        /**
         * Get all of the files from the given directory (recursive).
         *
         * @param string $directory
         * @return array 
         * @static 
         */
        public static function allFiles($directory){
            return \Illuminate\Filesystem\Filesystem::allFiles($directory);
        }
        
        /**
         * Get all of the directories within a given directory.
         *
         * @param string $directory
         * @return array 
         * @static 
         */
        public static function directories($directory){
            return \Illuminate\Filesystem\Filesystem::directories($directory);
        }
        
        /**
         * Create a directory.
         *
         * @param string $path
         * @param int $mode
         * @param bool $recursive
         * @param bool $force
         * @return bool 
         * @static 
         */
        public static function makeDirectory($path, $mode = 511, $recursive = false, $force = false){
            return \Illuminate\Filesystem\Filesystem::makeDirectory($path, $mode, $recursive, $force);
        }
        
        /**
         * Copy a directory from one location to another.
         *
         * @param string $directory
         * @param string $destination
         * @param int $options
         * @return bool 
         * @static 
         */
        public static function copyDirectory($directory, $destination, $options = null){
            return \Illuminate\Filesystem\Filesystem::copyDirectory($directory, $destination, $options);
        }
        
        /**
         * Recursively delete a directory.
         * 
         * The directory itself may be optionally preserved.
         *
         * @param string $directory
         * @param bool $preserve
         * @return bool 
         * @static 
         */
        public static function deleteDirectory($directory, $preserve = false){
            return \Illuminate\Filesystem\Filesystem::deleteDirectory($directory, $preserve);
        }
        
        /**
         * Empty the specified directory of all files and folders.
         *
         * @param string $directory
         * @return bool 
         * @static 
         */
        public static function cleanDirectory($directory){
            return \Illuminate\Filesystem\Filesystem::cleanDirectory($directory);
        }
        
    }


    class Form extends \Illuminate\Support\Facades\Form{
        
        /**
         * Open up a new HTML form.
         *
         * @param array $options
         * @return string 
         * @static 
         */
        public static function open($options = array()){
            return \Illuminate\Html\FormBuilder::open($options);
        }
        
        /**
         * Create a new model based form builder.
         *
         * @param mixed $model
         * @param array $options
         * @return string 
         * @static 
         */
        public static function model($model, $options = array()){
            return \Illuminate\Html\FormBuilder::model($model, $options);
        }
        
        /**
         * Set the model instance on the form builder.
         *
         * @param mixed $model
         * @return void 
         * @static 
         */
        public static function setModel($model){
            \Illuminate\Html\FormBuilder::setModel($model);
        }
        
        /**
         * Close the current form.
         *
         * @return string 
         * @static 
         */
        public static function close(){
            return \Illuminate\Html\FormBuilder::close();
        }
        
        /**
         * Generate a hidden field with the current CSRF token.
         *
         * @return string 
         * @static 
         */
        public static function token(){
            return \Illuminate\Html\FormBuilder::token();
        }
        
        /**
         * Create a form label element.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function label($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::label($name, $value, $options);
        }
        
        /**
         * Create a form input field.
         *
         * @param string $type
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function input($type, $name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::input($type, $name, $value, $options);
        }
        
        /**
         * Create a text input field.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function text($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::text($name, $value, $options);
        }
        
        /**
         * Create a password input field.
         *
         * @param string $name
         * @param array $options
         * @return string 
         * @static 
         */
        public static function password($name, $options = array()){
            return \Illuminate\Html\FormBuilder::password($name, $options);
        }
        
        /**
         * Create a hidden input field.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function hidden($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::hidden($name, $value, $options);
        }
        
        /**
         * Create an e-mail input field.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function email($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::email($name, $value, $options);
        }
        
        /**
         * Create a url input field.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function url($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::url($name, $value, $options);
        }
        
        /**
         * Create a file input field.
         *
         * @param string $name
         * @param array $options
         * @return string 
         * @static 
         */
        public static function file($name, $options = array()){
            return \Illuminate\Html\FormBuilder::file($name, $options);
        }
        
        /**
         * Create a textarea input field.
         *
         * @param string $name
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function textarea($name, $value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::textarea($name, $value, $options);
        }
        
        /**
         * Create a select box field.
         *
         * @param string $name
         * @param array $list
         * @param string $selected
         * @param array $options
         * @return string 
         * @static 
         */
        public static function select($name, $list = array(), $selected = null, $options = array()){
            return \Illuminate\Html\FormBuilder::select($name, $list, $selected, $options);
        }
        
        /**
         * Create a select range field.
         *
         * @param string $name
         * @param string $begin
         * @param string $end
         * @param string $selected
         * @param array $options
         * @return string 
         * @static 
         */
        public static function selectRange($name, $begin, $end, $selected = null, $options = array()){
            return \Illuminate\Html\FormBuilder::selectRange($name, $begin, $end, $selected, $options);
        }
        
        /**
         * Create a select year field.
         *
         * @param string $name
         * @param string $begin
         * @param string $end
         * @param string $selected
         * @param array $options
         * @return string 
         * @static 
         */
        public static function selectYear(){
            return \Illuminate\Html\FormBuilder::selectYear();
        }
        
        /**
         * Create a select month field.
         *
         * @param string $name
         * @param string $selected
         * @param array $options
         * @param string $format
         * @return string 
         * @static 
         */
        public static function selectMonth($name, $selected = null, $options = array(), $format = '%B'){
            return \Illuminate\Html\FormBuilder::selectMonth($name, $selected, $options, $format);
        }
        
        /**
         * Get the select option for the given value.
         *
         * @param string $display
         * @param string $value
         * @param string $selected
         * @return string 
         * @static 
         */
        public static function getSelectOption($display, $value, $selected){
            return \Illuminate\Html\FormBuilder::getSelectOption($display, $value, $selected);
        }
        
        /**
         * Create a checkbox input field.
         *
         * @param string $name
         * @param mixed $value
         * @param bool $checked
         * @param array $options
         * @return string 
         * @static 
         */
        public static function checkbox($name, $value = 1, $checked = null, $options = array()){
            return \Illuminate\Html\FormBuilder::checkbox($name, $value, $checked, $options);
        }
        
        /**
         * Create a radio button input field.
         *
         * @param string $name
         * @param mixed $value
         * @param bool $checked
         * @param array $options
         * @return string 
         * @static 
         */
        public static function radio($name, $value = null, $checked = null, $options = array()){
            return \Illuminate\Html\FormBuilder::radio($name, $value, $checked, $options);
        }
        
        /**
         * Create a HTML reset input element.
         *
         * @param string $value
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function reset($value, $attributes = array()){
            return \Illuminate\Html\FormBuilder::reset($value, $attributes);
        }
        
        /**
         * Create a HTML image input element.
         *
         * @param string $url
         * @param string $name
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function image($url, $name = null, $attributes = array()){
            return \Illuminate\Html\FormBuilder::image($url, $name, $attributes);
        }
        
        /**
         * Create a submit button element.
         *
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function submit($value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::submit($value, $options);
        }
        
        /**
         * Create a button element.
         *
         * @param string $value
         * @param array $options
         * @return string 
         * @static 
         */
        public static function button($value = null, $options = array()){
            return \Illuminate\Html\FormBuilder::button($value, $options);
        }
        
        /**
         * Register a custom form macro.
         *
         * @param string $name
         * @param callable $macro
         * @return void 
         * @static 
         */
        public static function macro($name, $macro){
            \Illuminate\Html\FormBuilder::macro($name, $macro);
        }
        
        /**
         * Get the ID attribute for a field name.
         *
         * @param string $name
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function getIdAttribute($name, $attributes){
            return \Illuminate\Html\FormBuilder::getIdAttribute($name, $attributes);
        }
        
        /**
         * Get the value that should be assigned to the field.
         *
         * @param string $name
         * @param string $value
         * @return string 
         * @static 
         */
        public static function getValueAttribute($name, $value = null){
            return \Illuminate\Html\FormBuilder::getValueAttribute($name, $value);
        }
        
        /**
         * Get a value from the session's old input.
         *
         * @param string $name
         * @return string 
         * @static 
         */
        public static function old($name){
            return \Illuminate\Html\FormBuilder::old($name);
        }
        
        /**
         * Determine if the old input is empty.
         *
         * @return bool 
         * @static 
         */
        public static function oldInputIsEmpty(){
            return \Illuminate\Html\FormBuilder::oldInputIsEmpty();
        }
        
        /**
         * Get the session store implementation.
         *
         * @return \Illuminate\Session\Store $session
         * @static 
         */
        public static function getSessionStore(){
            return \Illuminate\Html\FormBuilder::getSessionStore();
        }
        
        /**
         * Set the session store implementation.
         *
         * @param \Illuminate\Session\Store $session
         * @return \Illuminate\Html\FormBuilder 
         * @static 
         */
        public static function setSessionStore($session){
            return \Illuminate\Html\FormBuilder::setSessionStore($session);
        }
        
    }


    class Hash extends \Illuminate\Support\Facades\Hash{
        
        /**
         * Hash the given value.
         *
         * @param string $value
         * @param array $options
         * @return string 
         * @throws \RuntimeException
         * @static 
         */
        public static function make($value, $options = array()){
            return \Illuminate\Hashing\BcryptHasher::make($value, $options);
        }
        
        /**
         * Check the given plain value against a hash.
         *
         * @param string $value
         * @param string $hashedValue
         * @param array $options
         * @return bool 
         * @static 
         */
        public static function check($value, $hashedValue, $options = array()){
            return \Illuminate\Hashing\BcryptHasher::check($value, $hashedValue, $options);
        }
        
        /**
         * Check if the given hash has been hashed using the given options.
         *
         * @param string $hashedValue
         * @param array $options
         * @return bool 
         * @static 
         */
        public static function needsRehash($hashedValue, $options = array()){
            return \Illuminate\Hashing\BcryptHasher::needsRehash($hashedValue, $options);
        }
        
    }


    class HTML extends \Illuminate\Support\Facades\HTML{
        
        /**
         * Register a custom HTML macro.
         *
         * @param string $name
         * @param callable $macro
         * @return void 
         * @static 
         */
        public static function macro($name, $macro){
            \Illuminate\Html\HtmlBuilder::macro($name, $macro);
        }
        
        /**
         * Convert an HTML string to entities.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function entities($value){
            return \Illuminate\Html\HtmlBuilder::entities($value);
        }
        
        /**
         * Convert entities to HTML characters.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function decode($value){
            return \Illuminate\Html\HtmlBuilder::decode($value);
        }
        
        /**
         * Generate a link to a JavaScript file.
         *
         * @param string $url
         * @param array $attributes
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function script($url, $attributes = array(), $secure = null){
            return \Illuminate\Html\HtmlBuilder::script($url, $attributes, $secure);
        }
        
        /**
         * Generate a link to a CSS file.
         *
         * @param string $url
         * @param array $attributes
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function style($url, $attributes = array(), $secure = null){
            return \Illuminate\Html\HtmlBuilder::style($url, $attributes, $secure);
        }
        
        /**
         * Generate an HTML image element.
         *
         * @param string $url
         * @param string $alt
         * @param array $attributes
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function image($url, $alt = null, $attributes = array(), $secure = null){
            return \Illuminate\Html\HtmlBuilder::image($url, $alt, $attributes, $secure);
        }
        
        /**
         * Generate a HTML link.
         *
         * @param string $url
         * @param string $title
         * @param array $attributes
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function link($url, $title = null, $attributes = array(), $secure = null){
            return \Illuminate\Html\HtmlBuilder::link($url, $title, $attributes, $secure);
        }
        
        /**
         * Generate a HTTPS HTML link.
         *
         * @param string $url
         * @param string $title
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function secureLink($url, $title = null, $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::secureLink($url, $title, $attributes);
        }
        
        /**
         * Generate a HTML link to an asset.
         *
         * @param string $url
         * @param string $title
         * @param array $attributes
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function linkAsset($url, $title = null, $attributes = array(), $secure = null){
            return \Illuminate\Html\HtmlBuilder::linkAsset($url, $title, $attributes, $secure);
        }
        
        /**
         * Generate a HTTPS HTML link to an asset.
         *
         * @param string $url
         * @param string $title
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function linkSecureAsset($url, $title = null, $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::linkSecureAsset($url, $title, $attributes);
        }
        
        /**
         * Generate a HTML link to a named route.
         *
         * @param string $name
         * @param string $title
         * @param array $parameters
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function linkRoute($name, $title = null, $parameters = array(), $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::linkRoute($name, $title, $parameters, $attributes);
        }
        
        /**
         * Generate a HTML link to a controller action.
         *
         * @param string $action
         * @param string $title
         * @param array $parameters
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function linkAction($action, $title = null, $parameters = array(), $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::linkAction($action, $title, $parameters, $attributes);
        }
        
        /**
         * Generate a HTML link to an email address.
         *
         * @param string $email
         * @param string $title
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function mailto($email, $title = null, $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::mailto($email, $title, $attributes);
        }
        
        /**
         * Obfuscate an e-mail address to prevent spam-bots from sniffing it.
         *
         * @param string $email
         * @return string 
         * @static 
         */
        public static function email($email){
            return \Illuminate\Html\HtmlBuilder::email($email);
        }
        
        /**
         * Generate an ordered list of items.
         *
         * @param array $list
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function ol($list, $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::ol($list, $attributes);
        }
        
        /**
         * Generate an un-ordered list of items.
         *
         * @param array $list
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function ul($list, $attributes = array()){
            return \Illuminate\Html\HtmlBuilder::ul($list, $attributes);
        }
        
        /**
         * Build an HTML attribute string from an array.
         *
         * @param array $attributes
         * @return string 
         * @static 
         */
        public static function attributes($attributes){
            return \Illuminate\Html\HtmlBuilder::attributes($attributes);
        }
        
        /**
         * Obfuscate a string to prevent spam-bots from sniffing it.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function obfuscate($value){
            return \Illuminate\Html\HtmlBuilder::obfuscate($value);
        }
        
    }


    class Input extends \Illuminate\Support\Facades\Input{
        
        /**
         * Return the Request instance.
         *
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function instance(){
            return \Illuminate\Http\Request::instance();
        }
        
        /**
         * Get the request method.
         *
         * @return string 
         * @static 
         */
        public static function method(){
            return \Illuminate\Http\Request::method();
        }
        
        /**
         * Get the root URL for the application.
         *
         * @return string 
         * @static 
         */
        public static function root(){
            return \Illuminate\Http\Request::root();
        }
        
        /**
         * Get the URL (no query string) for the request.
         *
         * @return string 
         * @static 
         */
        public static function url(){
            return \Illuminate\Http\Request::url();
        }
        
        /**
         * Get the full URL for the request.
         *
         * @return string 
         * @static 
         */
        public static function fullUrl(){
            return \Illuminate\Http\Request::fullUrl();
        }
        
        /**
         * Get the current path info for the request.
         *
         * @return string 
         * @static 
         */
        public static function path(){
            return \Illuminate\Http\Request::path();
        }
        
        /**
         * Get the current encoded path info for the request.
         *
         * @return string 
         * @static 
         */
        public static function decodedPath(){
            return \Illuminate\Http\Request::decodedPath();
        }
        
        /**
         * Get a segment from the URI (1 based index).
         *
         * @param string $index
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function segment($index, $default = null){
            return \Illuminate\Http\Request::segment($index, $default);
        }
        
        /**
         * Get all of the segments for the request path.
         *
         * @return array 
         * @static 
         */
        public static function segments(){
            return \Illuminate\Http\Request::segments();
        }
        
        /**
         * Determine if the current request URI matches a pattern.
         *
         * @param mixed  string
         * @return bool 
         * @static 
         */
        public static function is(){
            return \Illuminate\Http\Request::is();
        }
        
        /**
         * Determine if the request is the result of an AJAX call.
         *
         * @return bool 
         * @static 
         */
        public static function ajax(){
            return \Illuminate\Http\Request::ajax();
        }
        
        /**
         * Determine if the request is over HTTPS.
         *
         * @return bool 
         * @static 
         */
        public static function secure(){
            return \Illuminate\Http\Request::secure();
        }
        
        /**
         * Determine if the request contains a given input item key.
         *
         * @param string|array $key
         * @return bool 
         * @static 
         */
        public static function exists($key){
            return \Illuminate\Http\Request::exists($key);
        }
        
        /**
         * Determine if the request contains a non-emtpy value for an input item.
         *
         * @param string|array $key
         * @return bool 
         * @static 
         */
        public static function has($key){
            return \Illuminate\Http\Request::has($key);
        }
        
        /**
         * Get all of the input and files for the request.
         *
         * @return array 
         * @static 
         */
        public static function all(){
            return \Illuminate\Http\Request::all();
        }
        
        /**
         * Retrieve an input item from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function input($key = null, $default = null){
            return \Illuminate\Http\Request::input($key, $default);
        }
        
        /**
         * Get a subset of the items from the input data.
         *
         * @param array $keys
         * @return array 
         * @static 
         */
        public static function only($keys){
            return \Illuminate\Http\Request::only($keys);
        }
        
        /**
         * Get all of the input except for a specified array of items.
         *
         * @param array $keys
         * @return array 
         * @static 
         */
        public static function except($keys){
            return \Illuminate\Http\Request::except($keys);
        }
        
        /**
         * Retrieve a query string item from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function query($key = null, $default = null){
            return \Illuminate\Http\Request::query($key, $default);
        }
        
        /**
         * Determine if a cookie is set on the request.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasCookie($key){
            return \Illuminate\Http\Request::hasCookie($key);
        }
        
        /**
         * Retrieve a cookie from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function cookie($key = null, $default = null){
            return \Illuminate\Http\Request::cookie($key, $default);
        }
        
        /**
         * Retrieve a file from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return \Symfony\Component\HttpFoundation\File\UploadedFile|array 
         * @static 
         */
        public static function file($key = null, $default = null){
            return \Illuminate\Http\Request::file($key, $default);
        }
        
        /**
         * Determine if the uploaded data contains a file.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasFile($key){
            return \Illuminate\Http\Request::hasFile($key);
        }
        
        /**
         * Retrieve a header from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function header($key = null, $default = null){
            return \Illuminate\Http\Request::header($key, $default);
        }
        
        /**
         * Retrieve a server variable from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function server($key = null, $default = null){
            return \Illuminate\Http\Request::server($key, $default);
        }
        
        /**
         * Retrieve an old input item.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function old($key = null, $default = null){
            return \Illuminate\Http\Request::old($key, $default);
        }
        
        /**
         * Flash the input for the current request to the session.
         *
         * @param string $filter
         * @param array $keys
         * @return void 
         * @static 
         */
        public static function flash($filter = null, $keys = array()){
            \Illuminate\Http\Request::flash($filter, $keys);
        }
        
        /**
         * Flash only some of the input to the session.
         *
         * @param mixed  string
         * @return void 
         * @static 
         */
        public static function flashOnly($keys){
            \Illuminate\Http\Request::flashOnly($keys);
        }
        
        /**
         * Flash only some of the input to the session.
         *
         * @param mixed  string
         * @return void 
         * @static 
         */
        public static function flashExcept($keys){
            \Illuminate\Http\Request::flashExcept($keys);
        }
        
        /**
         * Flush all of the old input from the session.
         *
         * @return void 
         * @static 
         */
        public static function flush(){
            \Illuminate\Http\Request::flush();
        }
        
        /**
         * Merge new input into the current request's input array.
         *
         * @param array $input
         * @return void 
         * @static 
         */
        public static function merge($input){
            \Illuminate\Http\Request::merge($input);
        }
        
        /**
         * Replace the input for the current request.
         *
         * @param array $input
         * @return void 
         * @static 
         */
        public static function replace($input){
            \Illuminate\Http\Request::replace($input);
        }
        
        /**
         * Get the JSON payload for the request.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function json($key = null, $default = null){
            return \Illuminate\Http\Request::json($key, $default);
        }
        
        /**
         * Determine if the request is sending JSON.
         *
         * @return bool 
         * @static 
         */
        public static function isJson(){
            return \Illuminate\Http\Request::isJson();
        }
        
        /**
         * Determine if the current request is asking for JSON in return.
         *
         * @return bool 
         * @static 
         */
        public static function wantsJson(){
            return \Illuminate\Http\Request::wantsJson();
        }
        
        /**
         * Get the data format expected in the response.
         *
         * @return string 
         * @static 
         */
        public static function format($default = 'html'){
            return \Illuminate\Http\Request::format($default);
        }
        
        /**
         * Create an Illuminate request from a Symfony instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function createFromBase($request){
            return \Illuminate\Http\Request::createFromBase($request);
        }
        
        /**
         * Get the session associated with the request.
         *
         * @return \Illuminate\Session\Store 
         * @throws \RuntimeException
         * @static 
         */
        public static function session(){
            return \Illuminate\Http\Request::session();
        }
        
        /**
         * Sets the parameters for this request.
         * 
         * This method also re-initializes all properties.
         *
         * @param array $query The GET parameters
         * @param array $request The POST parameters
         * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array $cookies The COOKIE parameters
         * @param array $files The FILES parameters
         * @param array $server The SERVER parameters
         * @param string $content The raw body data
         * @api 
         * @static 
         */
        public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::initialize($query, $request, $attributes, $cookies, $files, $server, $content);
        }
        
        /**
         * Creates a new request with values from PHP's super globals.
         *
         * @return \Symfony\Component\HttpFoundation\Request A new request
         * @api 
         * @static 
         */
        public static function createFromGlobals(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::createFromGlobals();
        }
        
        /**
         * Creates a Request based on a given URI and configuration.
         * 
         * The information contained in the URI always take precedence
         * over the other information (server and parameters).
         *
         * @param string $uri The URI
         * @param string $method The HTTP method
         * @param array $parameters The query (GET) or request (POST) parameters
         * @param array $cookies The request cookies ($_COOKIE)
         * @param array $files The request files ($_FILES)
         * @param array $server The server parameters ($_SERVER)
         * @param string $content The raw body data
         * @return \Symfony\Component\HttpFoundation\Request A Request instance
         * @api 
         * @static 
         */
        public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::create($uri, $method, $parameters, $cookies, $files, $server, $content);
        }
        
        /**
         * Sets a callable able to create a Request instance.
         * 
         * This is mainly useful when you need to override the Request class
         * to keep BC with an existing system. It should not be used for any
         * other purpose.
         *
         * @param callable|null $callable A PHP callable
         * @static 
         */
        public static function setFactory($callable){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setFactory($callable);
        }
        
        /**
         * Clones a request and overrides some of its parameters.
         *
         * @param array $query The GET parameters
         * @param array $request The POST parameters
         * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array $cookies The COOKIE parameters
         * @param array $files The FILES parameters
         * @param array $server The SERVER parameters
         * @return \Symfony\Component\HttpFoundation\Request The duplicated request
         * @api 
         * @static 
         */
        public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::duplicate($query, $request, $attributes, $cookies, $files, $server);
        }
        
        /**
         * Overrides the PHP global variables according to this request instance.
         * 
         * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
         * $_FILES is never override, see rfc1867
         *
         * @api 
         * @static 
         */
        public static function overrideGlobals(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::overrideGlobals();
        }
        
        /**
         * Sets a list of trusted proxies.
         * 
         * You should only list the reverse proxies that you manage directly.
         *
         * @param array $proxies A list of trusted proxies
         * @api 
         * @static 
         */
        public static function setTrustedProxies($proxies){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedProxies($proxies);
        }
        
        /**
         * Gets the list of trusted proxies.
         *
         * @return array An array of trusted proxies.
         * @static 
         */
        public static function getTrustedProxies(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedProxies();
        }
        
        /**
         * Sets a list of trusted host patterns.
         * 
         * You should only list the hosts you manage using regexs.
         *
         * @param array $hostPatterns A list of trusted host patterns
         * @static 
         */
        public static function setTrustedHosts($hostPatterns){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedHosts($hostPatterns);
        }
        
        /**
         * Gets the list of trusted host patterns.
         *
         * @return array An array of trusted host patterns.
         * @static 
         */
        public static function getTrustedHosts(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedHosts();
        }
        
        /**
         * Sets the name for trusted headers.
         * 
         * The following header keys are supported:
         * 
         *  * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
         *  * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
         *  * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
         *  * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
         * 
         * Setting an empty value allows to disable the trusted header for the given key.
         *
         * @param string $key The header key
         * @param string $value The header name
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function setTrustedHeaderName($key, $value){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedHeaderName($key, $value);
        }
        
        /**
         * Gets the trusted proxy header name.
         *
         * @param string $key The header key
         * @return string The header name
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function getTrustedHeaderName($key){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedHeaderName($key);
        }
        
        /**
         * Normalizes a query string.
         * 
         * It builds a normalized query string, where keys/value pairs are alphabetized,
         * have consistent escaping and unneeded delimiters are removed.
         *
         * @param string $qs Query string
         * @return string A normalized query string for the Request
         * @static 
         */
        public static function normalizeQueryString($qs){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::normalizeQueryString($qs);
        }
        
        /**
         * Enables support for the _method request parameter to determine the intended HTTP method.
         * 
         * Be warned that enabling this feature might lead to CSRF issues in your code.
         * Check that you are using CSRF tokens when required.
         * 
         * The HTTP method can only be overridden when the real HTTP method is POST.
         *
         * @static 
         */
        public static function enableHttpMethodParameterOverride(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::enableHttpMethodParameterOverride();
        }
        
        /**
         * Checks whether support for the _method request parameter is enabled.
         *
         * @return bool True when the _method request parameter is enabled, false otherwise
         * @static 
         */
        public static function getHttpMethodParameterOverride(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHttpMethodParameterOverride();
        }
        
        /**
         * Gets a "parameter" value.
         * 
         * This method is mainly useful for libraries that want to provide some flexibility.
         * 
         * Order of precedence: GET, PATH, POST
         * 
         * Avoid using this method in controllers:
         * 
         *  * slow
         *  * prefer to get from a "named" source
         * 
         * It is better to explicitly get request parameters from the appropriate
         * public property instead (query, attributes, request).
         *
         * @param string $key the key
         * @param mixed $default the default value
         * @param bool $deep is parameter deep in multidimensional array
         * @return mixed 
         * @static 
         */
        public static function get($key, $default = null, $deep = false){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::get($key, $default, $deep);
        }
        
        /**
         * Gets the Session.
         *
         * @return \Symfony\Component\HttpFoundation\SessionInterface|null The session
         * @api 
         * @static 
         */
        public static function getSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getSession();
        }
        
        /**
         * Whether the request contains a Session which was started in one of the
         * previous requests.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function hasPreviousSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::hasPreviousSession();
        }
        
        /**
         * Whether the request contains a Session object.
         * 
         * This method does not give any information about the state of the session object,
         * like whether the session is started or not. It is just a way to check if this Request
         * is associated with a Session instance.
         *
         * @return bool true when the Request contains a Session object, false otherwise
         * @api 
         * @static 
         */
        public static function hasSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::hasSession();
        }
        
        /**
         * Sets the Session.
         *
         * @param \Symfony\Component\HttpFoundation\SessionInterface $session The Session
         * @api 
         * @static 
         */
        public static function setSession($session){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setSession($session);
        }
        
        /**
         * Returns the client IP addresses.
         * 
         * In the returned array the most trusted IP address is first, and the
         * least trusted one last. The "real" client IP address is the last one,
         * but this is also the least trusted one. Trusted proxies are stripped.
         * 
         * Use this method carefully; you should use getClientIp() instead.
         *
         * @return array The client IP addresses
         * @see getClientIp()
         * @static 
         */
        public static function getClientIps(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getClientIps();
        }
        
        /**
         * Returns the client IP address.
         * 
         * This method can read the client IP address from the "X-Forwarded-For" header
         * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
         * header value is a comma+space separated list of IP addresses, the left-most
         * being the original client, and each successive proxy that passed the request
         * adding the IP address where it received the request from.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-For",
         * ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
         * the "client-ip" key.
         *
         * @return string The client IP address
         * @see getClientIps()
         * @see http://en.wikipedia.org/wiki/X-Forwarded-For
         * @api 
         * @static 
         */
        public static function getClientIp(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getClientIp();
        }
        
        /**
         * Returns current script name.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getScriptName(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getScriptName();
        }
        
        /**
         * Returns the path being requested relative to the executed script.
         * 
         * The path info always starts with a /.
         * 
         * Suppose this request is instantiated from /mysite on localhost:
         * 
         *  * http://localhost/mysite              returns an empty string
         *  * http://localhost/mysite/about        returns '/about'
         *  * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
         *  * http://localhost/mysite/about?var=1  returns '/about'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getPathInfo(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPathInfo();
        }
        
        /**
         * Returns the root path from which this request is executed.
         * 
         * Suppose that an index.php file instantiates this request object:
         * 
         *  * http://localhost/index.php         returns an empty string
         *  * http://localhost/index.php/page    returns an empty string
         *  * http://localhost/web/index.php     returns '/web'
         *  * http://localhost/we%20b/index.php  returns '/we%20b'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getBasePath(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getBasePath();
        }
        
        /**
         * Returns the root URL from which this request is executed.
         * 
         * The base URL never ends with a /.
         * 
         * This is similar to getBasePath(), except that it also includes the
         * script filename (e.g. index.php) if one exists.
         *
         * @return string The raw URL (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getBaseUrl(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getBaseUrl();
        }
        
        /**
         * Gets the request's scheme.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getScheme(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getScheme();
        }
        
        /**
         * Returns the port on which the request is made.
         * 
         * This method can read the client port from the "X-Forwarded-Port" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Port" header must contain the client port.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Port",
         * configure it via "setTrustedHeaderName()" with the "client-port" key.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getPort(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPort();
        }
        
        /**
         * Returns the user.
         *
         * @return string|null 
         * @static 
         */
        public static function getUser(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUser();
        }
        
        /**
         * Returns the password.
         *
         * @return string|null 
         * @static 
         */
        public static function getPassword(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPassword();
        }
        
        /**
         * Gets the user info.
         *
         * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
         * @static 
         */
        public static function getUserInfo(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUserInfo();
        }
        
        /**
         * Returns the HTTP host being requested.
         * 
         * The port name will be appended to the host if it's non-standard.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getHttpHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHttpHost();
        }
        
        /**
         * Returns the requested URI.
         *
         * @return string The raw URI (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getRequestUri(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRequestUri();
        }
        
        /**
         * Gets the scheme and HTTP host.
         * 
         * If the URL was called with basic authentication, the user
         * and the password are not added to the generated string.
         *
         * @return string The scheme and HTTP host
         * @static 
         */
        public static function getSchemeAndHttpHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getSchemeAndHttpHost();
        }
        
        /**
         * Generates a normalized URI for the Request.
         *
         * @return string A normalized URI for the Request
         * @see getQueryString()
         * @api 
         * @static 
         */
        public static function getUri(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUri();
        }
        
        /**
         * Generates a normalized URI for the given path.
         *
         * @param string $path A path to use instead of the current one
         * @return string The normalized URI for the path
         * @api 
         * @static 
         */
        public static function getUriForPath($path){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUriForPath($path);
        }
        
        /**
         * Generates the normalized query string for the Request.
         * 
         * It builds a normalized query string, where keys/value pairs are alphabetized
         * and have consistent escaping.
         *
         * @return string|null A normalized query string for the Request
         * @api 
         * @static 
         */
        public static function getQueryString(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getQueryString();
        }
        
        /**
         * Checks whether the request is secure or not.
         * 
         * This method can read the client port from the "X-Forwarded-Proto" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Proto"
         * ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
         * the "client-proto" key.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function isSecure(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isSecure();
        }
        
        /**
         * Returns the host name.
         * 
         * This method can read the client port from the "X-Forwarded-Host" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Host" header must contain the client host name.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Host",
         * configure it via "setTrustedHeaderName()" with the "client-host" key.
         *
         * @return string 
         * @throws \UnexpectedValueException when the host name is invalid
         * @api 
         * @static 
         */
        public static function getHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHost();
        }
        
        /**
         * Sets the request method.
         *
         * @param string $method
         * @api 
         * @static 
         */
        public static function setMethod($method){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setMethod($method);
        }
        
        /**
         * Gets the request "intended" method.
         * 
         * If the X-HTTP-Method-Override header is set, and if the method is a POST,
         * then it is used to determine the "real" intended HTTP method.
         * 
         * The _method request parameter can also be used to determine the HTTP method,
         * but only if enableHttpMethodParameterOverride() has been called.
         * 
         * The method is always an uppercased string.
         *
         * @return string The request method
         * @api 
         * @see getRealMethod
         * @static 
         */
        public static function getMethod(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getMethod();
        }
        
        /**
         * Gets the "real" request method.
         *
         * @return string The request method
         * @see getMethod
         * @static 
         */
        public static function getRealMethod(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRealMethod();
        }
        
        /**
         * Gets the mime type associated with the format.
         *
         * @param string $format The format
         * @return string The associated mime type (null if not found)
         * @api 
         * @static 
         */
        public static function getMimeType($format){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getMimeType($format);
        }
        
        /**
         * Gets the format associated with the mime type.
         *
         * @param string $mimeType The associated mime type
         * @return string|null The format (null if not found)
         * @api 
         * @static 
         */
        public static function getFormat($mimeType){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getFormat($mimeType);
        }
        
        /**
         * Associates a format with mime types.
         *
         * @param string $format The format
         * @param string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
         * @api 
         * @static 
         */
        public static function setFormat($format, $mimeTypes){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setFormat($format, $mimeTypes);
        }
        
        /**
         * Gets the request format.
         * 
         * Here is the process to determine the format:
         * 
         *  * format defined by the user (with setRequestFormat())
         *  * _format request parameter
         *  * $default
         *
         * @param string $default The default format
         * @return string The request format
         * @api 
         * @static 
         */
        public static function getRequestFormat($default = 'html'){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRequestFormat($default);
        }
        
        /**
         * Sets the request format.
         *
         * @param string $format The request format.
         * @api 
         * @static 
         */
        public static function setRequestFormat($format){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setRequestFormat($format);
        }
        
        /**
         * Gets the format associated with the request.
         *
         * @return string|null The format (null if no content type is present)
         * @api 
         * @static 
         */
        public static function getContentType(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getContentType();
        }
        
        /**
         * Sets the default locale.
         *
         * @param string $locale
         * @api 
         * @static 
         */
        public static function setDefaultLocale($locale){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setDefaultLocale($locale);
        }
        
        /**
         * Sets the locale.
         *
         * @param string $locale
         * @api 
         * @static 
         */
        public static function setLocale($locale){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setLocale($locale);
        }
        
        /**
         * Get the locale.
         *
         * @return string 
         * @static 
         */
        public static function getLocale(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getLocale();
        }
        
        /**
         * Checks if the request method is of specified type.
         *
         * @param string $method Uppercase request method (GET, POST etc).
         * @return bool 
         * @static 
         */
        public static function isMethod($method){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isMethod($method);
        }
        
        /**
         * Checks whether the method is safe or not.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function isMethodSafe(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isMethodSafe();
        }
        
        /**
         * Returns the request body content.
         *
         * @param bool $asResource If true, a resource will be returned
         * @return string|resource The request body content or a resource to read the body stream.
         * @throws \LogicException
         * @static 
         */
        public static function getContent($asResource = false){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getContent($asResource);
        }
        
        /**
         * Gets the Etags.
         *
         * @return array The entity tags
         * @static 
         */
        public static function getETags(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getETags();
        }
        
        /**
         * 
         *
         * @return bool 
         * @static 
         */
        public static function isNoCache(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isNoCache();
        }
        
        /**
         * Returns the preferred language.
         *
         * @param array $locales An array of ordered available locales
         * @return string|null The preferred locale
         * @api 
         * @static 
         */
        public static function getPreferredLanguage($locales = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPreferredLanguage($locales);
        }
        
        /**
         * Gets a list of languages acceptable by the client browser.
         *
         * @return array Languages ordered in the user browser preferences
         * @api 
         * @static 
         */
        public static function getLanguages(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getLanguages();
        }
        
        /**
         * Gets a list of charsets acceptable by the client browser.
         *
         * @return array List of charsets in preferable order
         * @api 
         * @static 
         */
        public static function getCharsets(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getCharsets();
        }
        
        /**
         * Gets a list of encodings acceptable by the client browser.
         *
         * @return array List of encodings in preferable order
         * @static 
         */
        public static function getEncodings(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getEncodings();
        }
        
        /**
         * Gets a list of content types acceptable by the client browser
         *
         * @return array List of content types in preferable order
         * @api 
         * @static 
         */
        public static function getAcceptableContentTypes(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getAcceptableContentTypes();
        }
        
        /**
         * Returns true if the request is a XMLHttpRequest.
         * 
         * It works if your JavaScript library set an X-Requested-With HTTP header.
         * It is known to work with common JavaScript frameworks:
         *
         * @link http://en.wikipedia.org/wiki/List_of_Ajax_frameworks#JavaScript
         * @return bool true if the request is an XMLHttpRequest, false otherwise
         * @api 
         * @static 
         */
        public static function isXmlHttpRequest(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isXmlHttpRequest();
        }
        
    }


    class Lang extends \Illuminate\Support\Facades\Lang{
        
        /**
         * Determine if a translation exists.
         *
         * @param string $key
         * @param string $locale
         * @return bool 
         * @static 
         */
        public static function has($key, $locale = null){
            return \Illuminate\Translation\Translator::has($key, $locale);
        }
        
        /**
         * Get the translation for the given key.
         *
         * @param string $key
         * @param array $replace
         * @param string $locale
         * @return string 
         * @static 
         */
        public static function get($key, $replace = array(), $locale = null){
            return \Illuminate\Translation\Translator::get($key, $replace, $locale);
        }
        
        /**
         * Get a translation according to an integer value.
         *
         * @param string $key
         * @param int $number
         * @param array $replace
         * @param string $locale
         * @return string 
         * @static 
         */
        public static function choice($key, $number, $replace = array(), $locale = null){
            return \Illuminate\Translation\Translator::choice($key, $number, $replace, $locale);
        }
        
        /**
         * Get the translation for a given key.
         *
         * @param string $id
         * @param array $parameters
         * @param string $domain
         * @param string $locale
         * @return string 
         * @static 
         */
        public static function trans($id, $parameters = array(), $domain = 'messages', $locale = null){
            return \Illuminate\Translation\Translator::trans($id, $parameters, $domain, $locale);
        }
        
        /**
         * Get a translation according to an integer value.
         *
         * @param string $id
         * @param int $number
         * @param array $parameters
         * @param string $domain
         * @param string $locale
         * @return string 
         * @static 
         */
        public static function transChoice($id, $number, $parameters = array(), $domain = 'messages', $locale = null){
            return \Illuminate\Translation\Translator::transChoice($id, $number, $parameters, $domain, $locale);
        }
        
        /**
         * Load the specified language group.
         *
         * @param string $namespace
         * @param string $group
         * @param string $locale
         * @return void 
         * @static 
         */
        public static function load($namespace, $group, $locale){
            \Illuminate\Translation\Translator::load($namespace, $group, $locale);
        }
        
        /**
         * Add a new namespace to the loader.
         *
         * @param string $namespace
         * @param string $hint
         * @return void 
         * @static 
         */
        public static function addNamespace($namespace, $hint){
            \Illuminate\Translation\Translator::addNamespace($namespace, $hint);
        }
        
        /**
         * Parse a key into namespace, group, and item.
         *
         * @param string $key
         * @return array 
         * @static 
         */
        public static function parseKey($key){
            return \Illuminate\Translation\Translator::parseKey($key);
        }
        
        /**
         * Get the message selector instance.
         *
         * @return \Symfony\Component\Translation\MessageSelector 
         * @static 
         */
        public static function getSelector(){
            return \Illuminate\Translation\Translator::getSelector();
        }
        
        /**
         * Set the message selector instance.
         *
         * @param \Symfony\Component\Translation\MessageSelector $selector
         * @return void 
         * @static 
         */
        public static function setSelector($selector){
            \Illuminate\Translation\Translator::setSelector($selector);
        }
        
        /**
         * Get the language line loader implementation.
         *
         * @return \Illuminate\Translation\LoaderInterface 
         * @static 
         */
        public static function getLoader(){
            return \Illuminate\Translation\Translator::getLoader();
        }
        
        /**
         * Get the default locale being used.
         *
         * @return string 
         * @static 
         */
        public static function locale(){
            return \Illuminate\Translation\Translator::locale();
        }
        
        /**
         * Get the default locale being used.
         *
         * @return string 
         * @static 
         */
        public static function getLocale(){
            return \Illuminate\Translation\Translator::getLocale();
        }
        
        /**
         * Set the default locale.
         *
         * @param string $locale
         * @return void 
         * @static 
         */
        public static function setLocale($locale){
            \Illuminate\Translation\Translator::setLocale($locale);
        }
        
        /**
         * Get the fallback locale being used.
         *
         * @return string 
         * @static 
         */
        public static function getFallback(){
            return \Illuminate\Translation\Translator::getFallback();
        }
        
        /**
         * Set the fallback locale being used.
         *
         * @param string $fallback
         * @return void 
         * @static 
         */
        public static function setFallback($fallback){
            \Illuminate\Translation\Translator::setFallback($fallback);
        }
        
        /**
         * Set the parsed value of a key.
         *
         * @param string $key
         * @param array $parsed
         * @return void 
         * @static 
         */
        public static function setParsedKey($key, $parsed){
            //Method inherited from \Illuminate\Support\NamespacedItemResolver            
            \Illuminate\Translation\Translator::setParsedKey($key, $parsed);
        }
        
    }


    class Log extends \Illuminate\Support\Facades\Log{
        
        /**
         * Adds a log record at the DEBUG level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function debug($message, $context = array()){
            return \Monolog\Logger::debug($message, $context);
        }
        
        /**
         * Adds a log record at the INFO level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function info($message, $context = array()){
            return \Monolog\Logger::info($message, $context);
        }
        
        /**
         * Adds a log record at the NOTICE level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function notice($message, $context = array()){
            return \Monolog\Logger::notice($message, $context);
        }
        
        /**
         * Adds a log record at the WARNING level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function warning($message, $context = array()){
            return \Monolog\Logger::warning($message, $context);
        }
        
        /**
         * Adds a log record at the ERROR level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function error($message, $context = array()){
            return \Monolog\Logger::error($message, $context);
        }
        
        /**
         * Adds a log record at the CRITICAL level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function critical($message, $context = array()){
            return \Monolog\Logger::critical($message, $context);
        }
        
        /**
         * Adds a log record at the ALERT level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function alert($message, $context = array()){
            return \Monolog\Logger::alert($message, $context);
        }
        
        /**
         * Adds a log record at the EMERGENCY level.
         *
         * @param string $message The log message
         * @param array $context The log context
         * @return Boolean Whether the record has been processed
         * @static 
         */
        public static function emergency($message, $context = array()){
            return \Monolog\Logger::emergency($message, $context);
        }
        
        /**
         * Register a file log handler.
         *
         * @param string $path
         * @param string $level
         * @return void 
         * @static 
         */
        public static function useFiles($path, $level = 'debug'){
            \Illuminate\Log\Writer::useFiles($path, $level);
        }
        
        /**
         * Register a daily file log handler.
         *
         * @param string $path
         * @param int $days
         * @param string $level
         * @return void 
         * @static 
         */
        public static function useDailyFiles($path, $days = 0, $level = 'debug'){
            \Illuminate\Log\Writer::useDailyFiles($path, $days, $level);
        }
        
        /**
         * Register a new callback handler for when
         * a log event is triggered.
         *
         * @param \Closure $callback
         * @return void 
         * @throws \RuntimeException
         * @static 
         */
        public static function listen($callback){
            \Illuminate\Log\Writer::listen($callback);
        }
        
        /**
         * Get the underlying Monolog instance.
         *
         * @return \Monolog\Logger 
         * @static 
         */
        public static function getMonolog(){
            return \Illuminate\Log\Writer::getMonolog();
        }
        
        /**
         * Get the event dispatcher instance.
         *
         * @return \Illuminate\Events\Dispatcher 
         * @static 
         */
        public static function getEventDispatcher(){
            return \Illuminate\Log\Writer::getEventDispatcher();
        }
        
        /**
         * Set the event dispatcher instance.
         *
         * @param \Illuminate\Events\Dispatcher
         * @return void 
         * @static 
         */
        public static function setEventDispatcher($dispatcher){
            \Illuminate\Log\Writer::setEventDispatcher($dispatcher);
        }
        
        /**
         * Dynamically pass log calls into the writer.
         *
         * @param mixed  (level, param, param)
         * @return mixed 
         * @static 
         */
        public static function write(){
            return \Illuminate\Log\Writer::write();
        }
        
    }


    class Mail extends \Illuminate\Support\Facades\Mail{
        
        /**
         * Set the global from address and name.
         *
         * @param string $address
         * @param string $name
         * @return void 
         * @static 
         */
        public static function alwaysFrom($address, $name = null){
            \Illuminate\Mail\Mailer::alwaysFrom($address, $name);
        }
        
        /**
         * Send a new message when only a plain part.
         *
         * @param string $view
         * @param array $data
         * @param mixed $callback
         * @return int 
         * @static 
         */
        public static function plain($view, $data, $callback){
            return \Illuminate\Mail\Mailer::plain($view, $data, $callback);
        }
        
        /**
         * Send a new message using a view.
         *
         * @param string|array $view
         * @param array $data
         * @param \Closure|string $callback
         * @return int 
         * @static 
         */
        public static function send($view, $data, $callback){
            return \Illuminate\Mail\Mailer::send($view, $data, $callback);
        }
        
        /**
         * Queue a new e-mail message for sending.
         *
         * @param string|array $view
         * @param array $data
         * @param \Closure|string $callback
         * @param string $queue
         * @return void 
         * @static 
         */
        public static function queue($view, $data, $callback, $queue = null){
            \Illuminate\Mail\Mailer::queue($view, $data, $callback, $queue);
        }
        
        /**
         * Queue a new e-mail message for sending on the given queue.
         *
         * @param string $queue
         * @param string|array $view
         * @param array $data
         * @param \Closure|string $callback
         * @return void 
         * @static 
         */
        public static function queueOn($queue, $view, $data, $callback){
            \Illuminate\Mail\Mailer::queueOn($queue, $view, $data, $callback);
        }
        
        /**
         * Queue a new e-mail message for sending after (n) seconds.
         *
         * @param int $delay
         * @param string|array $view
         * @param array $data
         * @param \Closure|string $callback
         * @param string $queue
         * @return void 
         * @static 
         */
        public static function later($delay, $view, $data, $callback, $queue = null){
            \Illuminate\Mail\Mailer::later($delay, $view, $data, $callback, $queue);
        }
        
        /**
         * Queue a new e-mail message for sending after (n) seconds on the given queue.
         *
         * @param string $queue
         * @param int $delay
         * @param string|array $view
         * @param array $data
         * @param \Closure|string $callback
         * @return void 
         * @static 
         */
        public static function laterOn($queue, $delay, $view, $data, $callback){
            \Illuminate\Mail\Mailer::laterOn($queue, $delay, $view, $data, $callback);
        }
        
        /**
         * Handle a queued e-mail message job.
         *
         * @param \Illuminate\Queue\Jobs\Job $job
         * @param array $data
         * @return void 
         * @static 
         */
        public static function handleQueuedMessage($job, $data){
            \Illuminate\Mail\Mailer::handleQueuedMessage($job, $data);
        }
        
        /**
         * Tell the mailer to not really send messages.
         *
         * @param bool $value
         * @return void 
         * @static 
         */
        public static function pretend($value = true){
            \Illuminate\Mail\Mailer::pretend($value);
        }
        
        /**
         * Get the view environment instance.
         *
         * @return \Illuminate\View\Environment 
         * @static 
         */
        public static function getViewEnvironment(){
            return \Illuminate\Mail\Mailer::getViewEnvironment();
        }
        
        /**
         * Get the Swift Mailer instance.
         *
         * @return \Swift_Mailer 
         * @static 
         */
        public static function getSwiftMailer(){
            return \Illuminate\Mail\Mailer::getSwiftMailer();
        }
        
        /**
         * Get the array of failed recipients.
         *
         * @return array 
         * @static 
         */
        public static function failures(){
            return \Illuminate\Mail\Mailer::failures();
        }
        
        /**
         * Set the Swift Mailer instance.
         *
         * @param \Swift_Mailer $swift
         * @return void 
         * @static 
         */
        public static function setSwiftMailer($swift){
            \Illuminate\Mail\Mailer::setSwiftMailer($swift);
        }
        
        /**
         * Set the log writer instance.
         *
         * @param \Illuminate\Log\Writer $logger
         * @return \Illuminate\Mail\Mailer 
         * @static 
         */
        public static function setLogger($logger){
            return \Illuminate\Mail\Mailer::setLogger($logger);
        }
        
        /**
         * Set the queue manager instance.
         *
         * @param \Illuminate\Queue\QueueManager $queue
         * @return \Illuminate\Mail\Mailer 
         * @static 
         */
        public static function setQueue($queue){
            return \Illuminate\Mail\Mailer::setQueue($queue);
        }
        
        /**
         * Set the IoC container instance.
         *
         * @param \Illuminate\Container\Container $container
         * @return void 
         * @static 
         */
        public static function setContainer($container){
            \Illuminate\Mail\Mailer::setContainer($container);
        }
        
    }


    class Paginator extends \Illuminate\Support\Facades\Paginator{
        
        /**
         * Get a new paginator instance.
         *
         * @param array $items
         * @param int $total
         * @param int $perPage
         * @return \Illuminate\Pagination\Paginator 
         * @static 
         */
        public static function make($items, $total, $perPage){
            return \Illuminate\Pagination\Environment::make($items, $total, $perPage);
        }
        
        /**
         * Get the pagination view.
         *
         * @param \Illuminate\Pagination\Paginator $paginator
         * @param string $view
         * @return \Illuminate\View\View 
         * @static 
         */
        public static function getPaginationView($paginator, $view = null){
            return \Illuminate\Pagination\Environment::getPaginationView($paginator, $view);
        }
        
        /**
         * Get the number of the current page.
         *
         * @return int 
         * @static 
         */
        public static function getCurrentPage(){
            return \Illuminate\Pagination\Environment::getCurrentPage();
        }
        
        /**
         * Set the number of the current page.
         *
         * @param int $number
         * @return void 
         * @static 
         */
        public static function setCurrentPage($number){
            \Illuminate\Pagination\Environment::setCurrentPage($number);
        }
        
        /**
         * Get the root URL for the request.
         *
         * @return string 
         * @static 
         */
        public static function getCurrentUrl(){
            return \Illuminate\Pagination\Environment::getCurrentUrl();
        }
        
        /**
         * Set the base URL in use by the paginator.
         *
         * @param string $baseUrl
         * @return void 
         * @static 
         */
        public static function setBaseUrl($baseUrl){
            \Illuminate\Pagination\Environment::setBaseUrl($baseUrl);
        }
        
        /**
         * Set the input page parameter name used by the paginator.
         *
         * @param string $pageName
         * @return void 
         * @static 
         */
        public static function setPageName($pageName){
            \Illuminate\Pagination\Environment::setPageName($pageName);
        }
        
        /**
         * Get the input page parameter name used by the paginator.
         *
         * @return string 
         * @static 
         */
        public static function getPageName(){
            return \Illuminate\Pagination\Environment::getPageName();
        }
        
        /**
         * Get the name of the pagination view.
         *
         * @param string $view
         * @return string 
         * @static 
         */
        public static function getViewName($view = null){
            return \Illuminate\Pagination\Environment::getViewName($view);
        }
        
        /**
         * Set the name of the pagination view.
         *
         * @param string $viewName
         * @return void 
         * @static 
         */
        public static function setViewName($viewName){
            \Illuminate\Pagination\Environment::setViewName($viewName);
        }
        
        /**
         * Get the locale of the paginator.
         *
         * @return string 
         * @static 
         */
        public static function getLocale(){
            return \Illuminate\Pagination\Environment::getLocale();
        }
        
        /**
         * Set the locale of the paginator.
         *
         * @param string $locale
         * @return void 
         * @static 
         */
        public static function setLocale($locale){
            \Illuminate\Pagination\Environment::setLocale($locale);
        }
        
        /**
         * Get the active request instance.
         *
         * @return \Symfony\Component\HttpFoundation\Request 
         * @static 
         */
        public static function getRequest(){
            return \Illuminate\Pagination\Environment::getRequest();
        }
        
        /**
         * Set the active request instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return void 
         * @static 
         */
        public static function setRequest($request){
            \Illuminate\Pagination\Environment::setRequest($request);
        }
        
        /**
         * Get the current view driver.
         *
         * @return \Illuminate\View\Environment 
         * @static 
         */
        public static function getViewDriver(){
            return \Illuminate\Pagination\Environment::getViewDriver();
        }
        
        /**
         * Set the current view driver.
         *
         * @param \Illuminate\View\Environment $view
         * @return void 
         * @static 
         */
        public static function setViewDriver($view){
            \Illuminate\Pagination\Environment::setViewDriver($view);
        }
        
        /**
         * Get the translator instance.
         *
         * @return \Symfony\Component\Translation\TranslatorInterface 
         * @static 
         */
        public static function getTranslator(){
            return \Illuminate\Pagination\Environment::getTranslator();
        }
        
    }


    class Password extends \Illuminate\Support\Facades\Password{
        
        /**
         * Send a password reminder to a user.
         *
         * @param array $credentials
         * @param \Closure $callback
         * @return string 
         * @static 
         */
        public static function remind($credentials, $callback = null){
            return \Illuminate\Auth\Reminders\PasswordBroker::remind($credentials, $callback);
        }
        
        /**
         * Send the password reminder e-mail.
         *
         * @param \Illuminate\Auth\Reminders\RemindableInterface $user
         * @param string $token
         * @param \Closure $callback
         * @return int 
         * @static 
         */
        public static function sendReminder($user, $token, $callback = null){
            return \Illuminate\Auth\Reminders\PasswordBroker::sendReminder($user, $token, $callback);
        }
        
        /**
         * Reset the password for the given token.
         *
         * @param array $credentials
         * @param \Closure $callback
         * @return mixed 
         * @static 
         */
        public static function reset($credentials, $callback){
            return \Illuminate\Auth\Reminders\PasswordBroker::reset($credentials, $callback);
        }
        
        /**
         * Set a custom password validator.
         *
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function validator($callback){
            \Illuminate\Auth\Reminders\PasswordBroker::validator($callback);
        }
        
        /**
         * Get the user for the given credentials.
         *
         * @param array $credentials
         * @return \Illuminate\Auth\Reminders\RemindableInterface 
         * @throws \UnexpectedValueException
         * @static 
         */
        public static function getUser($credentials){
            return \Illuminate\Auth\Reminders\PasswordBroker::getUser($credentials);
        }
        
    }


    class Queue extends \Illuminate\Support\Facades\Queue{
        
        /**
         * Register an event listener for the failed job event.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function failing($callback){
            \Illuminate\Queue\QueueManager::failing($callback);
        }
        
        /**
         * Determine if the driver is connected.
         *
         * @param string $name
         * @return bool 
         * @static 
         */
        public static function connected($name = null){
            return \Illuminate\Queue\QueueManager::connected($name);
        }
        
        /**
         * Resolve a queue connection instance.
         *
         * @param string $name
         * @return \Illuminate\Queue\SyncQueue 
         * @static 
         */
        public static function connection($name = null){
            return \Illuminate\Queue\QueueManager::connection($name);
        }
        
        /**
         * Add a queue connection resolver.
         *
         * @param string $driver
         * @param \Closure $resolver
         * @return void 
         * @static 
         */
        public static function extend($driver, $resolver){
            \Illuminate\Queue\QueueManager::extend($driver, $resolver);
        }
        
        /**
         * Add a queue connection resolver.
         *
         * @param string $driver
         * @param \Closure $resolver
         * @return void 
         * @static 
         */
        public static function addConnector($driver, $resolver){
            \Illuminate\Queue\QueueManager::addConnector($driver, $resolver);
        }
        
        /**
         * Get the name of the default queue connection.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultDriver(){
            return \Illuminate\Queue\QueueManager::getDefaultDriver();
        }
        
        /**
         * Set the name of the default queue connection.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultDriver($name){
            \Illuminate\Queue\QueueManager::setDefaultDriver($name);
        }
        
        /**
         * Get the full name for the given connection.
         *
         * @param string $connection
         * @return string 
         * @static 
         */
        public static function getName($connection = null){
            return \Illuminate\Queue\QueueManager::getName($connection);
        }
        
        /**
         * Push a new job onto the queue.
         *
         * @param string $job
         * @param mixed $data
         * @param string $queue
         * @return mixed 
         * @static 
         */
        public static function push($job, $data = '', $queue = null){
            return \Illuminate\Queue\SyncQueue::push($job, $data, $queue);
        }
        
        /**
         * Push a raw payload onto the queue.
         *
         * @param string $payload
         * @param string $queue
         * @param array $options
         * @return mixed 
         * @static 
         */
        public static function pushRaw($payload, $queue = null, $options = array()){
            return \Illuminate\Queue\SyncQueue::pushRaw($payload, $queue, $options);
        }
        
        /**
         * Push a new job onto the queue after a delay.
         *
         * @param \DateTime|int $delay
         * @param string $job
         * @param mixed $data
         * @param string $queue
         * @return mixed 
         * @static 
         */
        public static function later($delay, $job, $data = '', $queue = null){
            return \Illuminate\Queue\SyncQueue::later($delay, $job, $data, $queue);
        }
        
        /**
         * Pop the next job off of the queue.
         *
         * @param string $queue
         * @return \Illuminate\Queue\Jobs\Job|null 
         * @static 
         */
        public static function pop($queue = null){
            return \Illuminate\Queue\SyncQueue::pop($queue);
        }
        
        /**
         * Marshal a push queue request and fire the job.
         *
         * @throws \RuntimeException
         * @static 
         */
        public static function marshal(){
            //Method inherited from \Illuminate\Queue\Queue            
            return \Illuminate\Queue\SyncQueue::marshal();
        }
        
        /**
         * Push a new an array of jobs onto the queue.
         *
         * @param array $jobs
         * @param mixed $data
         * @param string $queue
         * @return mixed 
         * @static 
         */
        public static function bulk($jobs, $data = '', $queue = null){
            //Method inherited from \Illuminate\Queue\Queue            
            return \Illuminate\Queue\SyncQueue::bulk($jobs, $data, $queue);
        }
        
        /**
         * Get the current UNIX timestamp.
         *
         * @return int 
         * @static 
         */
        public static function getTime(){
            //Method inherited from \Illuminate\Queue\Queue            
            return \Illuminate\Queue\SyncQueue::getTime();
        }
        
        /**
         * Set the IoC container instance.
         *
         * @param \Illuminate\Container\Container $container
         * @return void 
         * @static 
         */
        public static function setContainer($container){
            //Method inherited from \Illuminate\Queue\Queue            
            \Illuminate\Queue\SyncQueue::setContainer($container);
        }
        
    }


    class Redirect extends \Illuminate\Support\Facades\Redirect{
        
        /**
         * Create a new redirect response to the "home" route.
         *
         * @param int $status
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function home($status = 302){
            return \Illuminate\Routing\Redirector::home($status);
        }
        
        /**
         * Create a new redirect response to the previous location.
         *
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function back($status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::back($status, $headers);
        }
        
        /**
         * Create a new redirect response to the current URI.
         *
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function refresh($status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::refresh($status, $headers);
        }
        
        /**
         * Create a new redirect response, while putting the current URL in the session.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @param bool $secure
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function guest($path, $status = 302, $headers = array(), $secure = null){
            return \Illuminate\Routing\Redirector::guest($path, $status, $headers, $secure);
        }
        
        /**
         * Create a new redirect response to the previously intended location.
         *
         * @param string $default
         * @param int $status
         * @param array $headers
         * @param bool $secure
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function intended($default = '/', $status = 302, $headers = array(), $secure = null){
            return \Illuminate\Routing\Redirector::intended($default, $status, $headers, $secure);
        }
        
        /**
         * Create a new redirect response to the given path.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @param bool $secure
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function to($path, $status = 302, $headers = array(), $secure = null){
            return \Illuminate\Routing\Redirector::to($path, $status, $headers, $secure);
        }
        
        /**
         * Create a new redirect response to an external URL (no validation).
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function away($path, $status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::away($path, $status, $headers);
        }
        
        /**
         * Create a new redirect response to the given HTTPS path.
         *
         * @param string $path
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function secure($path, $status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::secure($path, $status, $headers);
        }
        
        /**
         * Create a new redirect response to a named route.
         *
         * @param string $route
         * @param array $parameters
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function route($route, $parameters = array(), $status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::route($route, $parameters, $status, $headers);
        }
        
        /**
         * Create a new redirect response to a controller action.
         *
         * @param string $action
         * @param array $parameters
         * @param int $status
         * @param array $headers
         * @return \Illuminate\Http\RedirectResponse 
         * @static 
         */
        public static function action($action, $parameters = array(), $status = 302, $headers = array()){
            return \Illuminate\Routing\Redirector::action($action, $parameters, $status, $headers);
        }
        
        /**
         * Get the URL generator instance.
         *
         * @return \Illuminate\Routing\UrlGenerator 
         * @static 
         */
        public static function getUrlGenerator(){
            return \Illuminate\Routing\Redirector::getUrlGenerator();
        }
        
        /**
         * Set the active session store.
         *
         * @param \Illuminate\Session\Store $session
         * @return void 
         * @static 
         */
        public static function setSession($session){
            \Illuminate\Routing\Redirector::setSession($session);
        }
        
    }


    class Redis extends \Illuminate\Support\Facades\Redis{
        
        /**
         * Get a specific Redis connection instance.
         *
         * @param string $name
         * @return \Predis\Connection\SingleConnectionInterface 
         * @static 
         */
        public static function connection($name = 'default'){
            return \Illuminate\Redis\Database::connection($name);
        }
        
        /**
         * Run a command against the Redis database.
         *
         * @param string $method
         * @param array $parameters
         * @return mixed 
         * @static 
         */
        public static function command($method, $parameters = array()){
            return \Illuminate\Redis\Database::command($method, $parameters);
        }
        
    }


    class Request extends \Illuminate\Support\Facades\Request{
        
        /**
         * Return the Request instance.
         *
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function instance(){
            return \Illuminate\Http\Request::instance();
        }
        
        /**
         * Get the request method.
         *
         * @return string 
         * @static 
         */
        public static function method(){
            return \Illuminate\Http\Request::method();
        }
        
        /**
         * Get the root URL for the application.
         *
         * @return string 
         * @static 
         */
        public static function root(){
            return \Illuminate\Http\Request::root();
        }
        
        /**
         * Get the URL (no query string) for the request.
         *
         * @return string 
         * @static 
         */
        public static function url(){
            return \Illuminate\Http\Request::url();
        }
        
        /**
         * Get the full URL for the request.
         *
         * @return string 
         * @static 
         */
        public static function fullUrl(){
            return \Illuminate\Http\Request::fullUrl();
        }
        
        /**
         * Get the current path info for the request.
         *
         * @return string 
         * @static 
         */
        public static function path(){
            return \Illuminate\Http\Request::path();
        }
        
        /**
         * Get the current encoded path info for the request.
         *
         * @return string 
         * @static 
         */
        public static function decodedPath(){
            return \Illuminate\Http\Request::decodedPath();
        }
        
        /**
         * Get a segment from the URI (1 based index).
         *
         * @param string $index
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function segment($index, $default = null){
            return \Illuminate\Http\Request::segment($index, $default);
        }
        
        /**
         * Get all of the segments for the request path.
         *
         * @return array 
         * @static 
         */
        public static function segments(){
            return \Illuminate\Http\Request::segments();
        }
        
        /**
         * Determine if the current request URI matches a pattern.
         *
         * @param mixed  string
         * @return bool 
         * @static 
         */
        public static function is(){
            return \Illuminate\Http\Request::is();
        }
        
        /**
         * Determine if the request is the result of an AJAX call.
         *
         * @return bool 
         * @static 
         */
        public static function ajax(){
            return \Illuminate\Http\Request::ajax();
        }
        
        /**
         * Determine if the request is over HTTPS.
         *
         * @return bool 
         * @static 
         */
        public static function secure(){
            return \Illuminate\Http\Request::secure();
        }
        
        /**
         * Determine if the request contains a given input item key.
         *
         * @param string|array $key
         * @return bool 
         * @static 
         */
        public static function exists($key){
            return \Illuminate\Http\Request::exists($key);
        }
        
        /**
         * Determine if the request contains a non-emtpy value for an input item.
         *
         * @param string|array $key
         * @return bool 
         * @static 
         */
        public static function has($key){
            return \Illuminate\Http\Request::has($key);
        }
        
        /**
         * Get all of the input and files for the request.
         *
         * @return array 
         * @static 
         */
        public static function all(){
            return \Illuminate\Http\Request::all();
        }
        
        /**
         * Retrieve an input item from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function input($key = null, $default = null){
            return \Illuminate\Http\Request::input($key, $default);
        }
        
        /**
         * Get a subset of the items from the input data.
         *
         * @param array $keys
         * @return array 
         * @static 
         */
        public static function only($keys){
            return \Illuminate\Http\Request::only($keys);
        }
        
        /**
         * Get all of the input except for a specified array of items.
         *
         * @param array $keys
         * @return array 
         * @static 
         */
        public static function except($keys){
            return \Illuminate\Http\Request::except($keys);
        }
        
        /**
         * Retrieve a query string item from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function query($key = null, $default = null){
            return \Illuminate\Http\Request::query($key, $default);
        }
        
        /**
         * Determine if a cookie is set on the request.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasCookie($key){
            return \Illuminate\Http\Request::hasCookie($key);
        }
        
        /**
         * Retrieve a cookie from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function cookie($key = null, $default = null){
            return \Illuminate\Http\Request::cookie($key, $default);
        }
        
        /**
         * Retrieve a file from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return \Symfony\Component\HttpFoundation\File\UploadedFile|array 
         * @static 
         */
        public static function file($key = null, $default = null){
            return \Illuminate\Http\Request::file($key, $default);
        }
        
        /**
         * Determine if the uploaded data contains a file.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasFile($key){
            return \Illuminate\Http\Request::hasFile($key);
        }
        
        /**
         * Retrieve a header from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function header($key = null, $default = null){
            return \Illuminate\Http\Request::header($key, $default);
        }
        
        /**
         * Retrieve a server variable from the request.
         *
         * @param string $key
         * @param mixed $default
         * @return string 
         * @static 
         */
        public static function server($key = null, $default = null){
            return \Illuminate\Http\Request::server($key, $default);
        }
        
        /**
         * Retrieve an old input item.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function old($key = null, $default = null){
            return \Illuminate\Http\Request::old($key, $default);
        }
        
        /**
         * Flash the input for the current request to the session.
         *
         * @param string $filter
         * @param array $keys
         * @return void 
         * @static 
         */
        public static function flash($filter = null, $keys = array()){
            \Illuminate\Http\Request::flash($filter, $keys);
        }
        
        /**
         * Flash only some of the input to the session.
         *
         * @param mixed  string
         * @return void 
         * @static 
         */
        public static function flashOnly($keys){
            \Illuminate\Http\Request::flashOnly($keys);
        }
        
        /**
         * Flash only some of the input to the session.
         *
         * @param mixed  string
         * @return void 
         * @static 
         */
        public static function flashExcept($keys){
            \Illuminate\Http\Request::flashExcept($keys);
        }
        
        /**
         * Flush all of the old input from the session.
         *
         * @return void 
         * @static 
         */
        public static function flush(){
            \Illuminate\Http\Request::flush();
        }
        
        /**
         * Merge new input into the current request's input array.
         *
         * @param array $input
         * @return void 
         * @static 
         */
        public static function merge($input){
            \Illuminate\Http\Request::merge($input);
        }
        
        /**
         * Replace the input for the current request.
         *
         * @param array $input
         * @return void 
         * @static 
         */
        public static function replace($input){
            \Illuminate\Http\Request::replace($input);
        }
        
        /**
         * Get the JSON payload for the request.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function json($key = null, $default = null){
            return \Illuminate\Http\Request::json($key, $default);
        }
        
        /**
         * Determine if the request is sending JSON.
         *
         * @return bool 
         * @static 
         */
        public static function isJson(){
            return \Illuminate\Http\Request::isJson();
        }
        
        /**
         * Determine if the current request is asking for JSON in return.
         *
         * @return bool 
         * @static 
         */
        public static function wantsJson(){
            return \Illuminate\Http\Request::wantsJson();
        }
        
        /**
         * Get the data format expected in the response.
         *
         * @return string 
         * @static 
         */
        public static function format($default = 'html'){
            return \Illuminate\Http\Request::format($default);
        }
        
        /**
         * Create an Illuminate request from a Symfony instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function createFromBase($request){
            return \Illuminate\Http\Request::createFromBase($request);
        }
        
        /**
         * Get the session associated with the request.
         *
         * @return \Illuminate\Session\Store 
         * @throws \RuntimeException
         * @static 
         */
        public static function session(){
            return \Illuminate\Http\Request::session();
        }
        
        /**
         * Sets the parameters for this request.
         * 
         * This method also re-initializes all properties.
         *
         * @param array $query The GET parameters
         * @param array $request The POST parameters
         * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array $cookies The COOKIE parameters
         * @param array $files The FILES parameters
         * @param array $server The SERVER parameters
         * @param string $content The raw body data
         * @api 
         * @static 
         */
        public static function initialize($query = array(), $request = array(), $attributes = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::initialize($query, $request, $attributes, $cookies, $files, $server, $content);
        }
        
        /**
         * Creates a new request with values from PHP's super globals.
         *
         * @return \Symfony\Component\HttpFoundation\Request A new request
         * @api 
         * @static 
         */
        public static function createFromGlobals(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::createFromGlobals();
        }
        
        /**
         * Creates a Request based on a given URI and configuration.
         * 
         * The information contained in the URI always take precedence
         * over the other information (server and parameters).
         *
         * @param string $uri The URI
         * @param string $method The HTTP method
         * @param array $parameters The query (GET) or request (POST) parameters
         * @param array $cookies The request cookies ($_COOKIE)
         * @param array $files The request files ($_FILES)
         * @param array $server The server parameters ($_SERVER)
         * @param string $content The raw body data
         * @return \Symfony\Component\HttpFoundation\Request A Request instance
         * @api 
         * @static 
         */
        public static function create($uri, $method = 'GET', $parameters = array(), $cookies = array(), $files = array(), $server = array(), $content = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::create($uri, $method, $parameters, $cookies, $files, $server, $content);
        }
        
        /**
         * Sets a callable able to create a Request instance.
         * 
         * This is mainly useful when you need to override the Request class
         * to keep BC with an existing system. It should not be used for any
         * other purpose.
         *
         * @param callable|null $callable A PHP callable
         * @static 
         */
        public static function setFactory($callable){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setFactory($callable);
        }
        
        /**
         * Clones a request and overrides some of its parameters.
         *
         * @param array $query The GET parameters
         * @param array $request The POST parameters
         * @param array $attributes The request attributes (parameters parsed from the PATH_INFO, ...)
         * @param array $cookies The COOKIE parameters
         * @param array $files The FILES parameters
         * @param array $server The SERVER parameters
         * @return \Symfony\Component\HttpFoundation\Request The duplicated request
         * @api 
         * @static 
         */
        public static function duplicate($query = null, $request = null, $attributes = null, $cookies = null, $files = null, $server = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::duplicate($query, $request, $attributes, $cookies, $files, $server);
        }
        
        /**
         * Overrides the PHP global variables according to this request instance.
         * 
         * It overrides $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE.
         * $_FILES is never override, see rfc1867
         *
         * @api 
         * @static 
         */
        public static function overrideGlobals(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::overrideGlobals();
        }
        
        /**
         * Sets a list of trusted proxies.
         * 
         * You should only list the reverse proxies that you manage directly.
         *
         * @param array $proxies A list of trusted proxies
         * @api 
         * @static 
         */
        public static function setTrustedProxies($proxies){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedProxies($proxies);
        }
        
        /**
         * Gets the list of trusted proxies.
         *
         * @return array An array of trusted proxies.
         * @static 
         */
        public static function getTrustedProxies(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedProxies();
        }
        
        /**
         * Sets a list of trusted host patterns.
         * 
         * You should only list the hosts you manage using regexs.
         *
         * @param array $hostPatterns A list of trusted host patterns
         * @static 
         */
        public static function setTrustedHosts($hostPatterns){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedHosts($hostPatterns);
        }
        
        /**
         * Gets the list of trusted host patterns.
         *
         * @return array An array of trusted host patterns.
         * @static 
         */
        public static function getTrustedHosts(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedHosts();
        }
        
        /**
         * Sets the name for trusted headers.
         * 
         * The following header keys are supported:
         * 
         *  * Request::HEADER_CLIENT_IP:    defaults to X-Forwarded-For   (see getClientIp())
         *  * Request::HEADER_CLIENT_HOST:  defaults to X-Forwarded-Host  (see getClientHost())
         *  * Request::HEADER_CLIENT_PORT:  defaults to X-Forwarded-Port  (see getClientPort())
         *  * Request::HEADER_CLIENT_PROTO: defaults to X-Forwarded-Proto (see getScheme() and isSecure())
         * 
         * Setting an empty value allows to disable the trusted header for the given key.
         *
         * @param string $key The header key
         * @param string $value The header name
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function setTrustedHeaderName($key, $value){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setTrustedHeaderName($key, $value);
        }
        
        /**
         * Gets the trusted proxy header name.
         *
         * @param string $key The header key
         * @return string The header name
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function getTrustedHeaderName($key){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getTrustedHeaderName($key);
        }
        
        /**
         * Normalizes a query string.
         * 
         * It builds a normalized query string, where keys/value pairs are alphabetized,
         * have consistent escaping and unneeded delimiters are removed.
         *
         * @param string $qs Query string
         * @return string A normalized query string for the Request
         * @static 
         */
        public static function normalizeQueryString($qs){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::normalizeQueryString($qs);
        }
        
        /**
         * Enables support for the _method request parameter to determine the intended HTTP method.
         * 
         * Be warned that enabling this feature might lead to CSRF issues in your code.
         * Check that you are using CSRF tokens when required.
         * 
         * The HTTP method can only be overridden when the real HTTP method is POST.
         *
         * @static 
         */
        public static function enableHttpMethodParameterOverride(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::enableHttpMethodParameterOverride();
        }
        
        /**
         * Checks whether support for the _method request parameter is enabled.
         *
         * @return bool True when the _method request parameter is enabled, false otherwise
         * @static 
         */
        public static function getHttpMethodParameterOverride(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHttpMethodParameterOverride();
        }
        
        /**
         * Gets a "parameter" value.
         * 
         * This method is mainly useful for libraries that want to provide some flexibility.
         * 
         * Order of precedence: GET, PATH, POST
         * 
         * Avoid using this method in controllers:
         * 
         *  * slow
         *  * prefer to get from a "named" source
         * 
         * It is better to explicitly get request parameters from the appropriate
         * public property instead (query, attributes, request).
         *
         * @param string $key the key
         * @param mixed $default the default value
         * @param bool $deep is parameter deep in multidimensional array
         * @return mixed 
         * @static 
         */
        public static function get($key, $default = null, $deep = false){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::get($key, $default, $deep);
        }
        
        /**
         * Gets the Session.
         *
         * @return \Symfony\Component\HttpFoundation\SessionInterface|null The session
         * @api 
         * @static 
         */
        public static function getSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getSession();
        }
        
        /**
         * Whether the request contains a Session which was started in one of the
         * previous requests.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function hasPreviousSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::hasPreviousSession();
        }
        
        /**
         * Whether the request contains a Session object.
         * 
         * This method does not give any information about the state of the session object,
         * like whether the session is started or not. It is just a way to check if this Request
         * is associated with a Session instance.
         *
         * @return bool true when the Request contains a Session object, false otherwise
         * @api 
         * @static 
         */
        public static function hasSession(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::hasSession();
        }
        
        /**
         * Sets the Session.
         *
         * @param \Symfony\Component\HttpFoundation\SessionInterface $session The Session
         * @api 
         * @static 
         */
        public static function setSession($session){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setSession($session);
        }
        
        /**
         * Returns the client IP addresses.
         * 
         * In the returned array the most trusted IP address is first, and the
         * least trusted one last. The "real" client IP address is the last one,
         * but this is also the least trusted one. Trusted proxies are stripped.
         * 
         * Use this method carefully; you should use getClientIp() instead.
         *
         * @return array The client IP addresses
         * @see getClientIp()
         * @static 
         */
        public static function getClientIps(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getClientIps();
        }
        
        /**
         * Returns the client IP address.
         * 
         * This method can read the client IP address from the "X-Forwarded-For" header
         * when trusted proxies were set via "setTrustedProxies()". The "X-Forwarded-For"
         * header value is a comma+space separated list of IP addresses, the left-most
         * being the original client, and each successive proxy that passed the request
         * adding the IP address where it received the request from.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-For",
         * ("Client-Ip" for instance), configure it via "setTrustedHeaderName()" with
         * the "client-ip" key.
         *
         * @return string The client IP address
         * @see getClientIps()
         * @see http://en.wikipedia.org/wiki/X-Forwarded-For
         * @api 
         * @static 
         */
        public static function getClientIp(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getClientIp();
        }
        
        /**
         * Returns current script name.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getScriptName(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getScriptName();
        }
        
        /**
         * Returns the path being requested relative to the executed script.
         * 
         * The path info always starts with a /.
         * 
         * Suppose this request is instantiated from /mysite on localhost:
         * 
         *  * http://localhost/mysite              returns an empty string
         *  * http://localhost/mysite/about        returns '/about'
         *  * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
         *  * http://localhost/mysite/about?var=1  returns '/about'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getPathInfo(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPathInfo();
        }
        
        /**
         * Returns the root path from which this request is executed.
         * 
         * Suppose that an index.php file instantiates this request object:
         * 
         *  * http://localhost/index.php         returns an empty string
         *  * http://localhost/index.php/page    returns an empty string
         *  * http://localhost/web/index.php     returns '/web'
         *  * http://localhost/we%20b/index.php  returns '/we%20b'
         *
         * @return string The raw path (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getBasePath(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getBasePath();
        }
        
        /**
         * Returns the root URL from which this request is executed.
         * 
         * The base URL never ends with a /.
         * 
         * This is similar to getBasePath(), except that it also includes the
         * script filename (e.g. index.php) if one exists.
         *
         * @return string The raw URL (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getBaseUrl(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getBaseUrl();
        }
        
        /**
         * Gets the request's scheme.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getScheme(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getScheme();
        }
        
        /**
         * Returns the port on which the request is made.
         * 
         * This method can read the client port from the "X-Forwarded-Port" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Port" header must contain the client port.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Port",
         * configure it via "setTrustedHeaderName()" with the "client-port" key.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getPort(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPort();
        }
        
        /**
         * Returns the user.
         *
         * @return string|null 
         * @static 
         */
        public static function getUser(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUser();
        }
        
        /**
         * Returns the password.
         *
         * @return string|null 
         * @static 
         */
        public static function getPassword(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPassword();
        }
        
        /**
         * Gets the user info.
         *
         * @return string A user name and, optionally, scheme-specific information about how to gain authorization to access the server
         * @static 
         */
        public static function getUserInfo(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUserInfo();
        }
        
        /**
         * Returns the HTTP host being requested.
         * 
         * The port name will be appended to the host if it's non-standard.
         *
         * @return string 
         * @api 
         * @static 
         */
        public static function getHttpHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHttpHost();
        }
        
        /**
         * Returns the requested URI.
         *
         * @return string The raw URI (i.e. not urldecoded)
         * @api 
         * @static 
         */
        public static function getRequestUri(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRequestUri();
        }
        
        /**
         * Gets the scheme and HTTP host.
         * 
         * If the URL was called with basic authentication, the user
         * and the password are not added to the generated string.
         *
         * @return string The scheme and HTTP host
         * @static 
         */
        public static function getSchemeAndHttpHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getSchemeAndHttpHost();
        }
        
        /**
         * Generates a normalized URI for the Request.
         *
         * @return string A normalized URI for the Request
         * @see getQueryString()
         * @api 
         * @static 
         */
        public static function getUri(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUri();
        }
        
        /**
         * Generates a normalized URI for the given path.
         *
         * @param string $path A path to use instead of the current one
         * @return string The normalized URI for the path
         * @api 
         * @static 
         */
        public static function getUriForPath($path){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getUriForPath($path);
        }
        
        /**
         * Generates the normalized query string for the Request.
         * 
         * It builds a normalized query string, where keys/value pairs are alphabetized
         * and have consistent escaping.
         *
         * @return string|null A normalized query string for the Request
         * @api 
         * @static 
         */
        public static function getQueryString(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getQueryString();
        }
        
        /**
         * Checks whether the request is secure or not.
         * 
         * This method can read the client port from the "X-Forwarded-Proto" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Proto" header must contain the protocol: "https" or "http".
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Proto"
         * ("SSL_HTTPS" for instance), configure it via "setTrustedHeaderName()" with
         * the "client-proto" key.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function isSecure(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isSecure();
        }
        
        /**
         * Returns the host name.
         * 
         * This method can read the client port from the "X-Forwarded-Host" header
         * when trusted proxies were set via "setTrustedProxies()".
         * 
         * The "X-Forwarded-Host" header must contain the client host name.
         * 
         * If your reverse proxy uses a different header name than "X-Forwarded-Host",
         * configure it via "setTrustedHeaderName()" with the "client-host" key.
         *
         * @return string 
         * @throws \UnexpectedValueException when the host name is invalid
         * @api 
         * @static 
         */
        public static function getHost(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getHost();
        }
        
        /**
         * Sets the request method.
         *
         * @param string $method
         * @api 
         * @static 
         */
        public static function setMethod($method){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setMethod($method);
        }
        
        /**
         * Gets the request "intended" method.
         * 
         * If the X-HTTP-Method-Override header is set, and if the method is a POST,
         * then it is used to determine the "real" intended HTTP method.
         * 
         * The _method request parameter can also be used to determine the HTTP method,
         * but only if enableHttpMethodParameterOverride() has been called.
         * 
         * The method is always an uppercased string.
         *
         * @return string The request method
         * @api 
         * @see getRealMethod
         * @static 
         */
        public static function getMethod(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getMethod();
        }
        
        /**
         * Gets the "real" request method.
         *
         * @return string The request method
         * @see getMethod
         * @static 
         */
        public static function getRealMethod(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRealMethod();
        }
        
        /**
         * Gets the mime type associated with the format.
         *
         * @param string $format The format
         * @return string The associated mime type (null if not found)
         * @api 
         * @static 
         */
        public static function getMimeType($format){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getMimeType($format);
        }
        
        /**
         * Gets the format associated with the mime type.
         *
         * @param string $mimeType The associated mime type
         * @return string|null The format (null if not found)
         * @api 
         * @static 
         */
        public static function getFormat($mimeType){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getFormat($mimeType);
        }
        
        /**
         * Associates a format with mime types.
         *
         * @param string $format The format
         * @param string|array $mimeTypes The associated mime types (the preferred one must be the first as it will be used as the content type)
         * @api 
         * @static 
         */
        public static function setFormat($format, $mimeTypes){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setFormat($format, $mimeTypes);
        }
        
        /**
         * Gets the request format.
         * 
         * Here is the process to determine the format:
         * 
         *  * format defined by the user (with setRequestFormat())
         *  * _format request parameter
         *  * $default
         *
         * @param string $default The default format
         * @return string The request format
         * @api 
         * @static 
         */
        public static function getRequestFormat($default = 'html'){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getRequestFormat($default);
        }
        
        /**
         * Sets the request format.
         *
         * @param string $format The request format.
         * @api 
         * @static 
         */
        public static function setRequestFormat($format){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setRequestFormat($format);
        }
        
        /**
         * Gets the format associated with the request.
         *
         * @return string|null The format (null if no content type is present)
         * @api 
         * @static 
         */
        public static function getContentType(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getContentType();
        }
        
        /**
         * Sets the default locale.
         *
         * @param string $locale
         * @api 
         * @static 
         */
        public static function setDefaultLocale($locale){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setDefaultLocale($locale);
        }
        
        /**
         * Sets the locale.
         *
         * @param string $locale
         * @api 
         * @static 
         */
        public static function setLocale($locale){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::setLocale($locale);
        }
        
        /**
         * Get the locale.
         *
         * @return string 
         * @static 
         */
        public static function getLocale(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getLocale();
        }
        
        /**
         * Checks if the request method is of specified type.
         *
         * @param string $method Uppercase request method (GET, POST etc).
         * @return bool 
         * @static 
         */
        public static function isMethod($method){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isMethod($method);
        }
        
        /**
         * Checks whether the method is safe or not.
         *
         * @return bool 
         * @api 
         * @static 
         */
        public static function isMethodSafe(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isMethodSafe();
        }
        
        /**
         * Returns the request body content.
         *
         * @param bool $asResource If true, a resource will be returned
         * @return string|resource The request body content or a resource to read the body stream.
         * @throws \LogicException
         * @static 
         */
        public static function getContent($asResource = false){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getContent($asResource);
        }
        
        /**
         * Gets the Etags.
         *
         * @return array The entity tags
         * @static 
         */
        public static function getETags(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getETags();
        }
        
        /**
         * 
         *
         * @return bool 
         * @static 
         */
        public static function isNoCache(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isNoCache();
        }
        
        /**
         * Returns the preferred language.
         *
         * @param array $locales An array of ordered available locales
         * @return string|null The preferred locale
         * @api 
         * @static 
         */
        public static function getPreferredLanguage($locales = null){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getPreferredLanguage($locales);
        }
        
        /**
         * Gets a list of languages acceptable by the client browser.
         *
         * @return array Languages ordered in the user browser preferences
         * @api 
         * @static 
         */
        public static function getLanguages(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getLanguages();
        }
        
        /**
         * Gets a list of charsets acceptable by the client browser.
         *
         * @return array List of charsets in preferable order
         * @api 
         * @static 
         */
        public static function getCharsets(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getCharsets();
        }
        
        /**
         * Gets a list of encodings acceptable by the client browser.
         *
         * @return array List of encodings in preferable order
         * @static 
         */
        public static function getEncodings(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getEncodings();
        }
        
        /**
         * Gets a list of content types acceptable by the client browser
         *
         * @return array List of content types in preferable order
         * @api 
         * @static 
         */
        public static function getAcceptableContentTypes(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::getAcceptableContentTypes();
        }
        
        /**
         * Returns true if the request is a XMLHttpRequest.
         * 
         * It works if your JavaScript library set an X-Requested-With HTTP header.
         * It is known to work with common JavaScript frameworks:
         *
         * @link http://en.wikipedia.org/wiki/List_of_Ajax_frameworks#JavaScript
         * @return bool true if the request is an XMLHttpRequest, false otherwise
         * @api 
         * @static 
         */
        public static function isXmlHttpRequest(){
            //Method inherited from \Symfony\Component\HttpFoundation\Request            
            return \Illuminate\Http\Request::isXmlHttpRequest();
        }
        
    }


    class Response extends \Illuminate\Support\Facades\Response{
        
    }


    class Route extends \Illuminate\Support\Facades\Route{
        
        /**
         * Register a new GET route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function get($uri, $action){
            return \Illuminate\Routing\Router::get($uri, $action);
        }
        
        /**
         * Register a new POST route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function post($uri, $action){
            return \Illuminate\Routing\Router::post($uri, $action);
        }
        
        /**
         * Register a new PUT route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function put($uri, $action){
            return \Illuminate\Routing\Router::put($uri, $action);
        }
        
        /**
         * Register a new PATCH route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function patch($uri, $action){
            return \Illuminate\Routing\Router::patch($uri, $action);
        }
        
        /**
         * Register a new DELETE route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function delete($uri, $action){
            return \Illuminate\Routing\Router::delete($uri, $action);
        }
        
        /**
         * Register a new OPTIONS route with the router.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function options($uri, $action){
            return \Illuminate\Routing\Router::options($uri, $action);
        }
        
        /**
         * Register a new route responding to all verbs.
         *
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function any($uri, $action){
            return \Illuminate\Routing\Router::any($uri, $action);
        }
        
        /**
         * Register a new route with the given verbs.
         *
         * @param array|string $methods
         * @param string $uri
         * @param \Closure|array|string $action
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function match($methods, $uri, $action){
            return \Illuminate\Routing\Router::match($methods, $uri, $action);
        }
        
        /**
         * Register an array of controllers with wildcard routing.
         *
         * @param array $controllers
         * @return void 
         * @static 
         */
        public static function controllers($controllers){
            \Illuminate\Routing\Router::controllers($controllers);
        }
        
        /**
         * Route a controller to a URI with wildcard routing.
         *
         * @param string $uri
         * @param string $controller
         * @param array $names
         * @return void 
         * @static 
         */
        public static function controller($uri, $controller, $names = array()){
            \Illuminate\Routing\Router::controller($uri, $controller, $names);
        }
        
        /**
         * Route a resource to a controller.
         *
         * @param string $name
         * @param string $controller
         * @param array $options
         * @return void 
         * @static 
         */
        public static function resource($name, $controller, $options = array()){
            \Illuminate\Routing\Router::resource($name, $controller, $options);
        }
        
        /**
         * Get the base resource URI for a given resource.
         *
         * @param string $resource
         * @return string 
         * @static 
         */
        public static function getResourceUri($resource){
            return \Illuminate\Routing\Router::getResourceUri($resource);
        }
        
        /**
         * Format a resource wildcard for usage.
         *
         * @param string $value
         * @return string 
         * @static 
         */
        public static function getResourceWildcard($value){
            return \Illuminate\Routing\Router::getResourceWildcard($value);
        }
        
        /**
         * Create a route group with shared attributes.
         *
         * @param array $attributes
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function group($attributes, $callback){
            \Illuminate\Routing\Router::group($attributes, $callback);
        }
        
        /**
         * Merge the given array with the last group stack.
         *
         * @param array $new
         * @return array 
         * @static 
         */
        public static function mergeWithLastGroup($new){
            return \Illuminate\Routing\Router::mergeWithLastGroup($new);
        }
        
        /**
         * Merge the given group attributes.
         *
         * @param array $new
         * @param array $old
         * @return array 
         * @static 
         */
        public static function mergeGroup($new, $old){
            return \Illuminate\Routing\Router::mergeGroup($new, $old);
        }
        
        /**
         * Dispatch the request to the application.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response 
         * @static 
         */
        public static function dispatch($request){
            return \Illuminate\Routing\Router::dispatch($request);
        }
        
        /**
         * Dispatch the request to a route and return the response.
         *
         * @param \Illuminate\Http\Request $request
         * @return mixed 
         * @static 
         */
        public static function dispatchToRoute($request){
            return \Illuminate\Routing\Router::dispatchToRoute($request);
        }
        
        /**
         * Register a route matched event listener.
         *
         * @param callable $callback
         * @return void 
         * @static 
         */
        public static function matched($callback){
            \Illuminate\Routing\Router::matched($callback);
        }
        
        /**
         * Register a new "before" filter with the router.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function before($callback){
            \Illuminate\Routing\Router::before($callback);
        }
        
        /**
         * Register a new "after" filter with the router.
         *
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function after($callback){
            \Illuminate\Routing\Router::after($callback);
        }
        
        /**
         * Register a new filter with the router.
         *
         * @param string $name
         * @param mixed $callback
         * @return void 
         * @static 
         */
        public static function filter($name, $callback){
            \Illuminate\Routing\Router::filter($name, $callback);
        }
        
        /**
         * Register a pattern-based filter with the router.
         *
         * @param string $pattern
         * @param string $name
         * @param array|null $methods
         * @static 
         */
        public static function when($pattern, $name, $methods = null){
            return \Illuminate\Routing\Router::when($pattern, $name, $methods);
        }
        
        /**
         * Register a regular expression based filter with the router.
         *
         * @param string $pattern
         * @param string $name
         * @param array|null $methods
         * @return void 
         * @static 
         */
        public static function whenRegex($pattern, $name, $methods = null){
            \Illuminate\Routing\Router::whenRegex($pattern, $name, $methods);
        }
        
        /**
         * Register a model binder for a wildcard.
         *
         * @param string $key
         * @param string $class
         * @param \Closure $callback
         * @return void 
         * @throws NotFoundHttpException
         * @static 
         */
        public static function model($key, $class, $callback = null){
            \Illuminate\Routing\Router::model($key, $class, $callback);
        }
        
        /**
         * Add a new route parameter binder.
         *
         * @param string $key
         * @param callable $binder
         * @return void 
         * @static 
         */
        public static function bind($key, $binder){
            \Illuminate\Routing\Router::bind($key, $binder);
        }
        
        /**
         * Set a global where pattern on all routes
         *
         * @param string $key
         * @param string $pattern
         * @return void 
         * @static 
         */
        public static function pattern($key, $pattern){
            \Illuminate\Routing\Router::pattern($key, $pattern);
        }
        
        /**
         * Call the given route's before filters.
         *
         * @param \Illuminate\Routing\Route $route
         * @param \Illuminate\Http\Request $request
         * @return mixed 
         * @static 
         */
        public static function callRouteBefore($route, $request){
            return \Illuminate\Routing\Router::callRouteBefore($route, $request);
        }
        
        /**
         * Find the patterned filters matching a request.
         *
         * @param \Illuminate\Http\Request $request
         * @return array 
         * @static 
         */
        public static function findPatternFilters($request){
            return \Illuminate\Routing\Router::findPatternFilters($request);
        }
        
        /**
         * Call the given route's before filters.
         *
         * @param \Illuminate\Routing\Route $route
         * @param \Illuminate\Http\Request $request
         * @param \Illuminate\Http\Response $response
         * @return mixed 
         * @static 
         */
        public static function callRouteAfter($route, $request, $response){
            return \Illuminate\Routing\Router::callRouteAfter($route, $request, $response);
        }
        
        /**
         * Call the given route filter.
         *
         * @param string $filter
         * @param array $parameters
         * @param \Illuminate\Routing\Route $route
         * @param \Illuminate\Http\Request $request
         * @param \Illuminate\Http\Response|null $response
         * @return mixed 
         * @static 
         */
        public static function callRouteFilter($filter, $parameters, $route, $request, $response = null){
            return \Illuminate\Routing\Router::callRouteFilter($filter, $parameters, $route, $request, $response);
        }
        
        /**
         * Run a callback with filters disable on the router.
         *
         * @param callable $callback
         * @return void 
         * @static 
         */
        public static function withoutFilters($callback){
            \Illuminate\Routing\Router::withoutFilters($callback);
        }
        
        /**
         * Enable route filtering on the router.
         *
         * @return void 
         * @static 
         */
        public static function enableFilters(){
            \Illuminate\Routing\Router::enableFilters();
        }
        
        /**
         * Disable route filtering on the router.
         *
         * @return void 
         * @static 
         */
        public static function disableFilters(){
            \Illuminate\Routing\Router::disableFilters();
        }
        
        /**
         * Get a route parameter for the current route.
         *
         * @param string $key
         * @param string $default
         * @return mixed 
         * @static 
         */
        public static function input($key, $default = null){
            return \Illuminate\Routing\Router::input($key, $default);
        }
        
        /**
         * Get the currently dispatched route instance.
         *
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function getCurrentRoute(){
            return \Illuminate\Routing\Router::getCurrentRoute();
        }
        
        /**
         * Get the currently dispatched route instance.
         *
         * @return \Illuminate\Routing\Route 
         * @static 
         */
        public static function current(){
            return \Illuminate\Routing\Router::current();
        }
        
        /**
         * Get the current route name.
         *
         * @return string|null 
         * @static 
         */
        public static function currentRouteName(){
            return \Illuminate\Routing\Router::currentRouteName();
        }
        
        /**
         * Alias for the "currentRouteNamed" method.
         *
         * @param mixed  string
         * @return bool 
         * @static 
         */
        public static function is(){
            return \Illuminate\Routing\Router::is();
        }
        
        /**
         * Determine if the current route matches a given name.
         *
         * @param string $name
         * @return bool 
         * @static 
         */
        public static function currentRouteNamed($name){
            return \Illuminate\Routing\Router::currentRouteNamed($name);
        }
        
        /**
         * Get the current route action.
         *
         * @return string|null 
         * @static 
         */
        public static function currentRouteAction(){
            return \Illuminate\Routing\Router::currentRouteAction();
        }
        
        /**
         * Alias for the "currentRouteUses" method.
         *
         * @param mixed  string
         * @return bool 
         * @static 
         */
        public static function isAction(){
            return \Illuminate\Routing\Router::isAction();
        }
        
        /**
         * Determine if the current route action matches a given action.
         *
         * @param string $action
         * @return bool 
         * @static 
         */
        public static function currentRouteUses($action){
            return \Illuminate\Routing\Router::currentRouteUses($action);
        }
        
        /**
         * Get the request currently being dispatched.
         *
         * @return \Illuminate\Http\Request 
         * @static 
         */
        public static function getCurrentRequest(){
            return \Illuminate\Routing\Router::getCurrentRequest();
        }
        
        /**
         * Get the underlying route collection.
         *
         * @return \Illuminate\Routing\RouteCollection 
         * @static 
         */
        public static function getRoutes(){
            return \Illuminate\Routing\Router::getRoutes();
        }
        
        /**
         * Get the controller dispatcher instance.
         *
         * @return \Illuminate\Routing\ControllerDispatcher 
         * @static 
         */
        public static function getControllerDispatcher(){
            return \Illuminate\Routing\Router::getControllerDispatcher();
        }
        
        /**
         * Set the controller dispatcher instance.
         *
         * @param \Illuminate\Routing\ControllerDispatcher $dispatcher
         * @return void 
         * @static 
         */
        public static function setControllerDispatcher($dispatcher){
            \Illuminate\Routing\Router::setControllerDispatcher($dispatcher);
        }
        
        /**
         * Get a controller inspector instance.
         *
         * @return \Illuminate\Routing\ControllerInspector 
         * @static 
         */
        public static function getInspector(){
            return \Illuminate\Routing\Router::getInspector();
        }
        
        /**
         * Get the response for a given request.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return \Symfony\Component\HttpFoundation\Response 
         * @static 
         */
        public static function handle($request, $type = 1, $catch = true){
            return \Illuminate\Routing\Router::handle($request, $type, $catch);
        }
        
    }


    class Schema extends \Illuminate\Support\Facades\Schema{
        
        /**
         * Determine if the given table exists.
         *
         * @param string $table
         * @return bool 
         * @static 
         */
        public static function hasTable($table){
            return \Illuminate\Database\Schema\MySqlBuilder::hasTable($table);
        }
        
        /**
         * Get the column listing for a given table.
         *
         * @param string $table
         * @return array 
         * @static 
         */
        public static function getColumnListing($table){
            return \Illuminate\Database\Schema\MySqlBuilder::getColumnListing($table);
        }
        
        /**
         * Determine if the given table has a given column.
         *
         * @param string $table
         * @param string $column
         * @return bool 
         * @static 
         */
        public static function hasColumn($table, $column){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::hasColumn($table, $column);
        }
        
        /**
         * Modify a table on the schema.
         *
         * @param string $table
         * @param \Closure $callback
         * @return \Illuminate\Database\Schema\Blueprint 
         * @static 
         */
        public static function table($table, $callback){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::table($table, $callback);
        }
        
        /**
         * Create a new table on the schema.
         *
         * @param string $table
         * @param \Closure $callback
         * @return \Illuminate\Database\Schema\Blueprint 
         * @static 
         */
        public static function create($table, $callback){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::create($table, $callback);
        }
        
        /**
         * Drop a table from the schema.
         *
         * @param string $table
         * @return \Illuminate\Database\Schema\Blueprint 
         * @static 
         */
        public static function drop($table){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::drop($table);
        }
        
        /**
         * Drop a table from the schema if it exists.
         *
         * @param string $table
         * @return \Illuminate\Database\Schema\Blueprint 
         * @static 
         */
        public static function dropIfExists($table){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::dropIfExists($table);
        }
        
        /**
         * Rename a table on the schema.
         *
         * @param string $from
         * @param string $to
         * @return \Illuminate\Database\Schema\Blueprint 
         * @static 
         */
        public static function rename($from, $to){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::rename($from, $to);
        }
        
        /**
         * Get the database connection instance.
         *
         * @return \Illuminate\Database\Connection 
         * @static 
         */
        public static function getConnection(){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::getConnection();
        }
        
        /**
         * Set the database connection instance.
         *
         * @param \Illuminate\Database\Connection
         * @return \Illuminate\Database\Schema\Builder 
         * @static 
         */
        public static function setConnection($connection){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            return \Illuminate\Database\Schema\MySqlBuilder::setConnection($connection);
        }
        
        /**
         * Set the Schema Blueprint resolver callback.
         *
         * @param \Closure $resolver
         * @return void 
         * @static 
         */
        public static function blueprintResolver($resolver){
            //Method inherited from \Illuminate\Database\Schema\Builder            
            \Illuminate\Database\Schema\MySqlBuilder::blueprintResolver($resolver);
        }
        
    }


    class Seeder extends \Illuminate\Database\Seeder{
        
    }


    class Session extends \Illuminate\Support\Facades\Session{
        
        /**
         * Get the session configuration.
         *
         * @return array 
         * @static 
         */
        public static function getSessionConfig(){
            return \Illuminate\Session\SessionManager::getSessionConfig();
        }
        
        /**
         * Get the default session driver name.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultDriver(){
            return \Illuminate\Session\SessionManager::getDefaultDriver();
        }
        
        /**
         * Set the default session driver name.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultDriver($name){
            \Illuminate\Session\SessionManager::setDefaultDriver($name);
        }
        
        /**
         * Get a driver instance.
         *
         * @param string $driver
         * @return mixed 
         * @static 
         */
        public static function driver($driver = null){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Session\SessionManager::driver($driver);
        }
        
        /**
         * Register a custom driver creator Closure.
         *
         * @param string $driver
         * @param \Closure $callback
         * @return \Illuminate\Support\Manager|static 
         * @static 
         */
        public static function extend($driver, $callback){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Session\SessionManager::extend($driver, $callback);
        }
        
        /**
         * Get all of the created "drivers".
         *
         * @return array 
         * @static 
         */
        public static function getDrivers(){
            //Method inherited from \Illuminate\Support\Manager            
            return \Illuminate\Session\SessionManager::getDrivers();
        }
        
        /**
         * Starts the session storage.
         *
         * @return bool True if session started.
         * @throws \RuntimeException If session fails to start.
         * @api 
         * @static 
         */
        public static function start(){
            return \Illuminate\Session\Store::start();
        }
        
        /**
         * Returns the session ID.
         *
         * @return string The session ID.
         * @api 
         * @static 
         */
        public static function getId(){
            return \Illuminate\Session\Store::getId();
        }
        
        /**
         * Sets the session ID
         *
         * @param string $id
         * @api 
         * @static 
         */
        public static function setId($id){
            return \Illuminate\Session\Store::setId($id);
        }
        
        /**
         * Returns the session name.
         *
         * @return mixed The session name.
         * @api 
         * @static 
         */
        public static function getName(){
            return \Illuminate\Session\Store::getName();
        }
        
        /**
         * Sets the session name.
         *
         * @param string $name
         * @api 
         * @static 
         */
        public static function setName($name){
            return \Illuminate\Session\Store::setName($name);
        }
        
        /**
         * Invalidates the current session.
         * 
         * Clears all session attributes and flashes and regenerates the
         * session and deletes the old session from persistence.
         *
         * @param int $lifetime Sets the cookie lifetime for the session cookie. A null value
         *                          will leave the system settings unchanged, 0 sets the cookie
         *                          to expire with browser session. Time is in seconds, and is
         *                          not a Unix timestamp.
         * @return bool True if session invalidated, false if error.
         * @api 
         * @static 
         */
        public static function invalidate($lifetime = null){
            return \Illuminate\Session\Store::invalidate($lifetime);
        }
        
        /**
         * Migrates the current session to a new session id while maintaining all
         * session attributes.
         *
         * @param bool $destroy Whether to delete the old session or leave it to garbage collection.
         * @param int $lifetime Sets the cookie lifetime for the session cookie. A null value
         *                          will leave the system settings unchanged, 0 sets the cookie
         *                          to expire with browser session. Time is in seconds, and is
         *                          not a Unix timestamp.
         * @return bool True if session migrated, false if error.
         * @api 
         * @static 
         */
        public static function migrate($destroy = false, $lifetime = null){
            return \Illuminate\Session\Store::migrate($destroy, $lifetime);
        }
        
        /**
         * Generate a new session identifier.
         *
         * @param bool $destroy
         * @return bool 
         * @static 
         */
        public static function regenerate($destroy = false){
            return \Illuminate\Session\Store::regenerate($destroy);
        }
        
        /**
         * Force the session to be saved and closed.
         * 
         * This method is generally not required for real sessions as
         * the session will be automatically saved at the end of
         * code execution.
         *
         * @static 
         */
        public static function save(){
            return \Illuminate\Session\Store::save();
        }
        
        /**
         * Age the flash data for the session.
         *
         * @return void 
         * @static 
         */
        public static function ageFlashData(){
            \Illuminate\Session\Store::ageFlashData();
        }
        
        /**
         * Checks if an attribute is defined.
         *
         * @param string $name The attribute name
         * @return bool true if the attribute is defined, false otherwise
         * @api 
         * @static 
         */
        public static function has($name){
            return \Illuminate\Session\Store::has($name);
        }
        
        /**
         * Returns an attribute.
         *
         * @param string $name The attribute name
         * @param mixed $default The default value if not found.
         * @return mixed 
         * @api 
         * @static 
         */
        public static function get($name, $default = null){
            return \Illuminate\Session\Store::get($name, $default);
        }
        
        /**
         * Determine if the session contains old input.
         *
         * @param string $key
         * @return bool 
         * @static 
         */
        public static function hasOldInput($key = null){
            return \Illuminate\Session\Store::hasOldInput($key);
        }
        
        /**
         * Get the requested item from the flashed input array.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function getOldInput($key = null, $default = null){
            return \Illuminate\Session\Store::getOldInput($key, $default);
        }
        
        /**
         * Sets an attribute.
         *
         * @param string $name
         * @param mixed $value
         * @api 
         * @static 
         */
        public static function set($name, $value){
            return \Illuminate\Session\Store::set($name, $value);
        }
        
        /**
         * Put a key / value pair or array of key / value pairs in the session.
         *
         * @param string|array $key
         * @param mixed|null $value
         * @return void 
         * @static 
         */
        public static function put($key, $value){
            \Illuminate\Session\Store::put($key, $value);
        }
        
        /**
         * Push a value onto a session array.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function push($key, $value){
            \Illuminate\Session\Store::push($key, $value);
        }
        
        /**
         * Flash a key / value pair to the session.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function flash($key, $value){
            \Illuminate\Session\Store::flash($key, $value);
        }
        
        /**
         * Flash an input array to the session.
         *
         * @param array $value
         * @return void 
         * @static 
         */
        public static function flashInput($value){
            \Illuminate\Session\Store::flashInput($value);
        }
        
        /**
         * Reflash all of the session flash data.
         *
         * @return void 
         * @static 
         */
        public static function reflash(){
            \Illuminate\Session\Store::reflash();
        }
        
        /**
         * Reflash a subset of the current flash data.
         *
         * @param array|mixed $keys
         * @return void 
         * @static 
         */
        public static function keep($keys = null){
            \Illuminate\Session\Store::keep($keys);
        }
        
        /**
         * Returns attributes.
         *
         * @return array Attributes
         * @api 
         * @static 
         */
        public static function all(){
            return \Illuminate\Session\Store::all();
        }
        
        /**
         * Sets attributes.
         *
         * @param array $attributes Attributes
         * @static 
         */
        public static function replace($attributes){
            return \Illuminate\Session\Store::replace($attributes);
        }
        
        /**
         * Removes an attribute.
         *
         * @param string $name
         * @return mixed The removed value or null when it does not exist
         * @api 
         * @static 
         */
        public static function remove($name){
            return \Illuminate\Session\Store::remove($name);
        }
        
        /**
         * Remove an item from the session.
         *
         * @param string $key
         * @return void 
         * @static 
         */
        public static function forget($key){
            \Illuminate\Session\Store::forget($key);
        }
        
        /**
         * Clears all attributes.
         *
         * @api 
         * @static 
         */
        public static function clear(){
            return \Illuminate\Session\Store::clear();
        }
        
        /**
         * Remove all of the items from the session.
         *
         * @return void 
         * @static 
         */
        public static function flush(){
            \Illuminate\Session\Store::flush();
        }
        
        /**
         * Checks if the session was started.
         *
         * @return bool 
         * @static 
         */
        public static function isStarted(){
            return \Illuminate\Session\Store::isStarted();
        }
        
        /**
         * Registers a SessionBagInterface with the session.
         *
         * @param \Symfony\Component\HttpFoundation\Session\SessionBagInterface $bag
         * @static 
         */
        public static function registerBag($bag){
            return \Illuminate\Session\Store::registerBag($bag);
        }
        
        /**
         * Gets a bag instance by name.
         *
         * @param string $name
         * @return \Symfony\Component\HttpFoundation\Session\SessionBagInterface 
         * @static 
         */
        public static function getBag($name){
            return \Illuminate\Session\Store::getBag($name);
        }
        
        /**
         * Gets session meta.
         *
         * @return \Symfony\Component\HttpFoundation\Session\MetadataBag 
         * @static 
         */
        public static function getMetadataBag(){
            return \Illuminate\Session\Store::getMetadataBag();
        }
        
        /**
         * Get the raw bag data array for a given bag.
         *
         * @param string $name
         * @return array 
         * @static 
         */
        public static function getBagData($name){
            return \Illuminate\Session\Store::getBagData($name);
        }
        
        /**
         * Get the CSRF token value.
         *
         * @return string 
         * @static 
         */
        public static function token(){
            return \Illuminate\Session\Store::token();
        }
        
        /**
         * Get the CSRF token value.
         *
         * @return string 
         * @static 
         */
        public static function getToken(){
            return \Illuminate\Session\Store::getToken();
        }
        
        /**
         * Regenerate the CSRF token value.
         *
         * @return void 
         * @static 
         */
        public static function regenerateToken(){
            \Illuminate\Session\Store::regenerateToken();
        }
        
        /**
         * Get the underlying session handler implementation.
         *
         * @return \SessionHandlerInterface 
         * @static 
         */
        public static function getHandler(){
            return \Illuminate\Session\Store::getHandler();
        }
        
        /**
         * Determine if the session handler needs a request.
         *
         * @return bool 
         * @static 
         */
        public static function handlerNeedsRequest(){
            return \Illuminate\Session\Store::handlerNeedsRequest();
        }
        
        /**
         * Set the request on the handler instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return void 
         * @static 
         */
        public static function setRequestOnHandler($request){
            \Illuminate\Session\Store::setRequestOnHandler($request);
        }
        
    }


    class SSH extends \Illuminate\Support\Facades\SSH{
        
        /**
         * Get a remote connection instance.
         *
         * @param string|array|mixed $name
         * @return \Illuminate\Remote\Connection 
         * @static 
         */
        public static function into($name){
            return \Illuminate\Remote\RemoteManager::into($name);
        }
        
        /**
         * Get a remote connection instance.
         *
         * @param string|array $name
         * @return \Illuminate\Remote\Connection 
         * @static 
         */
        public static function connection($name = null){
            return \Illuminate\Remote\RemoteManager::connection($name);
        }
        
        /**
         * Get a connection group instance by name.
         *
         * @param string $name
         * @return \Illuminate\Remote\Connection 
         * @static 
         */
        public static function group($name){
            return \Illuminate\Remote\RemoteManager::group($name);
        }
        
        /**
         * Resolve a multiple connection instance.
         *
         * @param array $names
         * @return \Illuminate\Remote\MultiConnection 
         * @static 
         */
        public static function multiple($names){
            return \Illuminate\Remote\RemoteManager::multiple($names);
        }
        
        /**
         * Resolve a remote connection instance.
         *
         * @param string $name
         * @return \Illuminate\Remote\Connection 
         * @static 
         */
        public static function resolve($name){
            return \Illuminate\Remote\RemoteManager::resolve($name);
        }
        
        /**
         * Get the default connection name.
         *
         * @return string 
         * @static 
         */
        public static function getDefaultConnection(){
            return \Illuminate\Remote\RemoteManager::getDefaultConnection();
        }
        
        /**
         * Set the default connection name.
         *
         * @param string $name
         * @return void 
         * @static 
         */
        public static function setDefaultConnection($name){
            \Illuminate\Remote\RemoteManager::setDefaultConnection($name);
        }
        
        /**
         * Define a set of commands as a task.
         *
         * @param string $task
         * @param string|array $commands
         * @return void 
         * @static 
         */
        public static function define($task, $commands){
            \Illuminate\Remote\Connection::define($task, $commands);
        }
        
        /**
         * Run a task against the connection.
         *
         * @param string $task
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function task($task, $callback = null){
            \Illuminate\Remote\Connection::task($task, $callback);
        }
        
        /**
         * Run a set of commands against the connection.
         *
         * @param string|array $commands
         * @param \Closure $callback
         * @return void 
         * @static 
         */
        public static function run($commands, $callback = null){
            \Illuminate\Remote\Connection::run($commands, $callback);
        }
        
        /**
         * Download the contents of a remote file.
         *
         * @param string $remote
         * @param string $local
         * @return void 
         * @static 
         */
        public static function get($remote, $local){
            \Illuminate\Remote\Connection::get($remote, $local);
        }
        
        /**
         * Get the contents of a remote file.
         *
         * @param string $remote
         * @return string 
         * @static 
         */
        public static function getString($remote){
            return \Illuminate\Remote\Connection::getString($remote);
        }
        
        /**
         * Upload a local file to the server.
         *
         * @param string $local
         * @param string $remote
         * @return void 
         * @static 
         */
        public static function put($local, $remote){
            \Illuminate\Remote\Connection::put($local, $remote);
        }
        
        /**
         * Upload a string to to the given file on the server.
         *
         * @param string $remote
         * @param string $contents
         * @return void 
         * @static 
         */
        public static function putString($remote, $contents){
            \Illuminate\Remote\Connection::putString($remote, $contents);
        }
        
        /**
         * Display the given line using the default output.
         *
         * @param string $line
         * @return void 
         * @static 
         */
        public static function display($line){
            \Illuminate\Remote\Connection::display($line);
        }
        
        /**
         * Get the exit status of the last command.
         *
         * @return int|bool 
         * @static 
         */
        public static function status(){
            return \Illuminate\Remote\Connection::status();
        }
        
        /**
         * Get the gateway implementation.
         *
         * @return \Illuminate\Remote\GatewayInterface 
         * @throws \RuntimeException
         * @static 
         */
        public static function getGateway(){
            return \Illuminate\Remote\Connection::getGateway();
        }
        
        /**
         * Get the output implementation for the connection.
         *
         * @return \Symfony\Component\Console\Output\OutputInterface 
         * @static 
         */
        public static function getOutput(){
            return \Illuminate\Remote\Connection::getOutput();
        }
        
        /**
         * Set the output implementation.
         *
         * @param \Symfony\Component\Console\Output\OutputInterface $output
         * @return void 
         * @static 
         */
        public static function setOutput($output){
            \Illuminate\Remote\Connection::setOutput($output);
        }
        
    }


    class Str extends \Illuminate\Support\Str{
        
    }


    class URL extends \Illuminate\Support\Facades\URL{
        
        /**
         * Get the full URL for the current request.
         *
         * @return string 
         * @static 
         */
        public static function full(){
            return \Illuminate\Routing\UrlGenerator::full();
        }
        
        /**
         * Get the current URL for the request.
         *
         * @return string 
         * @static 
         */
        public static function current(){
            return \Illuminate\Routing\UrlGenerator::current();
        }
        
        /**
         * Get the URL for the previous request.
         *
         * @return string 
         * @static 
         */
        public static function previous(){
            return \Illuminate\Routing\UrlGenerator::previous();
        }
        
        /**
         * Generate a absolute URL to the given path.
         *
         * @param string $path
         * @param mixed $extra
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function to($path, $extra = array(), $secure = null){
            return \Illuminate\Routing\UrlGenerator::to($path, $extra, $secure);
        }
        
        /**
         * Generate a secure, absolute URL to the given path.
         *
         * @param string $path
         * @param array $parameters
         * @return string 
         * @static 
         */
        public static function secure($path, $parameters = array()){
            return \Illuminate\Routing\UrlGenerator::secure($path, $parameters);
        }
        
        /**
         * Generate a URL to an application asset.
         *
         * @param string $path
         * @param bool $secure
         * @return string 
         * @static 
         */
        public static function asset($path, $secure = null){
            return \Illuminate\Routing\UrlGenerator::asset($path, $secure);
        }
        
        /**
         * Generate a URL to a secure asset.
         *
         * @param string $path
         * @return string 
         * @static 
         */
        public static function secureAsset($path){
            return \Illuminate\Routing\UrlGenerator::secureAsset($path);
        }
        
        /**
         * Get the URL to a named route.
         *
         * @param string $name
         * @param mixed $parameters
         * @param bool $absolute
         * @param \Illuminate\Routing\Route $route
         * @return string 
         * @throws \InvalidArgumentException
         * @static 
         */
        public static function route($name, $parameters = array(), $absolute = true, $route = null){
            return \Illuminate\Routing\UrlGenerator::route($name, $parameters, $absolute, $route);
        }
        
        /**
         * Get the URL to a controller action.
         *
         * @param string $action
         * @param mixed $parameters
         * @param bool $absolute
         * @return string 
         * @static 
         */
        public static function action($action, $parameters = array(), $absolute = true){
            return \Illuminate\Routing\UrlGenerator::action($action, $parameters, $absolute);
        }
        
        /**
         * Determine if the given path is a valid URL.
         *
         * @param string $path
         * @return bool 
         * @static 
         */
        public static function isValidUrl($path){
            return \Illuminate\Routing\UrlGenerator::isValidUrl($path);
        }
        
        /**
         * Get the request instance.
         *
         * @return \Symfony\Component\HttpFoundation\Request 
         * @static 
         */
        public static function getRequest(){
            return \Illuminate\Routing\UrlGenerator::getRequest();
        }
        
        /**
         * Set the current request instance.
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return void 
         * @static 
         */
        public static function setRequest($request){
            \Illuminate\Routing\UrlGenerator::setRequest($request);
        }
        
    }


    class Validator extends \Illuminate\Support\Facades\Validator{
        
        /**
         * Create a new Validator instance.
         *
         * @param array $data
         * @param array $rules
         * @param array $messages
         * @param array $customAttributes
         * @return \Illuminate\Validation\Validator 
         * @static 
         */
        public static function make($data, $rules, $messages = array(), $customAttributes = array()){
            return \Illuminate\Validation\Factory::make($data, $rules, $messages, $customAttributes);
        }
        
        /**
         * Register a custom validator extension.
         *
         * @param string $rule
         * @param \Closure|string $extension
         * @param string $message
         * @return void 
         * @static 
         */
        public static function extend($rule, $extension, $message = null){
            \Illuminate\Validation\Factory::extend($rule, $extension, $message);
        }
        
        /**
         * Register a custom implicit validator extension.
         *
         * @param string $rule
         * @param \Closure|string $extension
         * @param string $message
         * @return void 
         * @static 
         */
        public static function extendImplicit($rule, $extension, $message = null){
            \Illuminate\Validation\Factory::extendImplicit($rule, $extension, $message);
        }
        
        /**
         * Register a custom implicit validator message replacer.
         *
         * @param string $rule
         * @param \Closure|string $replacer
         * @return void 
         * @static 
         */
        public static function replacer($rule, $replacer){
            \Illuminate\Validation\Factory::replacer($rule, $replacer);
        }
        
        /**
         * Set the Validator instance resolver.
         *
         * @param \Closure $resolver
         * @return void 
         * @static 
         */
        public static function resolver($resolver){
            \Illuminate\Validation\Factory::resolver($resolver);
        }
        
        /**
         * Get the Translator implementation.
         *
         * @return \Symfony\Component\Translation\TranslatorInterface 
         * @static 
         */
        public static function getTranslator(){
            return \Illuminate\Validation\Factory::getTranslator();
        }
        
        /**
         * Get the Presence Verifier implementation.
         *
         * @return \Illuminate\Validation\PresenceVerifierInterface 
         * @static 
         */
        public static function getPresenceVerifier(){
            return \Illuminate\Validation\Factory::getPresenceVerifier();
        }
        
        /**
         * Set the Presence Verifier implementation.
         *
         * @param \Illuminate\Validation\PresenceVerifierInterface $presenceVerifier
         * @return void 
         * @static 
         */
        public static function setPresenceVerifier($presenceVerifier){
            \Illuminate\Validation\Factory::setPresenceVerifier($presenceVerifier);
        }
        
    }


    class View extends \Illuminate\Support\Facades\View{
        
        /**
         * Get the evaluated view contents for the given view.
         *
         * @param string $view
         * @param array $data
         * @param array $mergeData
         * @return \Illuminate\View\View 
         * @static 
         */
        public static function make($view, $data = array(), $mergeData = array()){
            return \Illuminate\View\Environment::make($view, $data, $mergeData);
        }
        
        /**
         * Get the evaluated view contents for a named view.
         *
         * @param string $view
         * @param mixed $data
         * @return \Illuminate\View\View 
         * @static 
         */
        public static function of($view, $data = array()){
            return \Illuminate\View\Environment::of($view, $data);
        }
        
        /**
         * Register a named view.
         *
         * @param string $view
         * @param string $name
         * @return void 
         * @static 
         */
        public static function name($view, $name){
            \Illuminate\View\Environment::name($view, $name);
        }
        
        /**
         * Determine if a given view exists.
         *
         * @param string $view
         * @return bool 
         * @static 
         */
        public static function exists($view){
            return \Illuminate\View\Environment::exists($view);
        }
        
        /**
         * Get the rendered contents of a partial from a loop.
         *
         * @param string $view
         * @param array $data
         * @param string $iterator
         * @param string $empty
         * @return string 
         * @static 
         */
        public static function renderEach($view, $data, $iterator, $empty = 'raw|'){
            return \Illuminate\View\Environment::renderEach($view, $data, $iterator, $empty);
        }
        
        /**
         * Add a piece of shared data to the environment.
         *
         * @param string $key
         * @param mixed $value
         * @return void 
         * @static 
         */
        public static function share($key, $value = null){
            \Illuminate\View\Environment::share($key, $value);
        }
        
        /**
         * Register a view creator event.
         *
         * @param array|string $views
         * @param \Closure|string $callback
         * @return array 
         * @static 
         */
        public static function creator($views, $callback){
            return \Illuminate\View\Environment::creator($views, $callback);
        }
        
        /**
         * Register multiple view composers via an array.
         *
         * @param array $composers
         * @return array 
         * @static 
         */
        public static function composers($composers){
            return \Illuminate\View\Environment::composers($composers);
        }
        
        /**
         * Register a view composer event.
         *
         * @param array|string $views
         * @param \Closure|string $callback
         * @return array 
         * @static 
         */
        public static function composer($views, $callback, $priority = null){
            return \Illuminate\View\Environment::composer($views, $callback, $priority);
        }
        
        /**
         * Call the composer for a given view.
         *
         * @param \Illuminate\View\View $view
         * @return void 
         * @static 
         */
        public static function callComposer($view){
            \Illuminate\View\Environment::callComposer($view);
        }
        
        /**
         * Call the creator for a given view.
         *
         * @param \Illuminate\View\View $view
         * @return void 
         * @static 
         */
        public static function callCreator($view){
            \Illuminate\View\Environment::callCreator($view);
        }
        
        /**
         * Start injecting content into a section.
         *
         * @param string $section
         * @param string $content
         * @return void 
         * @static 
         */
        public static function startSection($section, $content = ''){
            \Illuminate\View\Environment::startSection($section, $content);
        }
        
        /**
         * Inject inline content into a section.
         *
         * @param string $section
         * @param string $content
         * @return void 
         * @static 
         */
        public static function inject($section, $content){
            \Illuminate\View\Environment::inject($section, $content);
        }
        
        /**
         * Stop injecting content into a section and return its contents.
         *
         * @return string 
         * @static 
         */
        public static function yieldSection(){
            return \Illuminate\View\Environment::yieldSection();
        }
        
        /**
         * Stop injecting content into a section.
         *
         * @param bool $overwrite
         * @return string 
         * @static 
         */
        public static function stopSection($overwrite = false){
            return \Illuminate\View\Environment::stopSection($overwrite);
        }
        
        /**
         * Stop injecting content into a section and append it.
         *
         * @return string 
         * @static 
         */
        public static function appendSection(){
            return \Illuminate\View\Environment::appendSection();
        }
        
        /**
         * Get the string contents of a section.
         *
         * @param string $section
         * @param string $default
         * @return string 
         * @static 
         */
        public static function yieldContent($section, $default = ''){
            return \Illuminate\View\Environment::yieldContent($section, $default);
        }
        
        /**
         * Flush all of the section contents.
         *
         * @return void 
         * @static 
         */
        public static function flushSections(){
            \Illuminate\View\Environment::flushSections();
        }
        
        /**
         * Flush all of the section contents if done rendering.
         *
         * @return void 
         * @static 
         */
        public static function flushSectionsIfDoneRendering(){
            \Illuminate\View\Environment::flushSectionsIfDoneRendering();
        }
        
        /**
         * Increment the rendering counter.
         *
         * @return void 
         * @static 
         */
        public static function incrementRender(){
            \Illuminate\View\Environment::incrementRender();
        }
        
        /**
         * Decrement the rendering counter.
         *
         * @return void 
         * @static 
         */
        public static function decrementRender(){
            \Illuminate\View\Environment::decrementRender();
        }
        
        /**
         * Check if there are no active render operations.
         *
         * @return bool 
         * @static 
         */
        public static function doneRendering(){
            return \Illuminate\View\Environment::doneRendering();
        }
        
        /**
         * Add a location to the array of view locations.
         *
         * @param string $location
         * @return void 
         * @static 
         */
        public static function addLocation($location){
            \Illuminate\View\Environment::addLocation($location);
        }
        
        /**
         * Add a new namespace to the loader.
         *
         * @param string $namespace
         * @param string|array $hints
         * @return void 
         * @static 
         */
        public static function addNamespace($namespace, $hints){
            \Illuminate\View\Environment::addNamespace($namespace, $hints);
        }
        
        /**
         * Prepend a new namespace to the loader.
         *
         * @param string $namespace
         * @param string|array $hints
         * @return void 
         * @static 
         */
        public static function prependNamespace($namespace, $hints){
            \Illuminate\View\Environment::prependNamespace($namespace, $hints);
        }
        
        /**
         * Register a valid view extension and its engine.
         *
         * @param string $extension
         * @param string $engine
         * @param \Closure $resolver
         * @return void 
         * @static 
         */
        public static function addExtension($extension, $engine, $resolver = null){
            \Illuminate\View\Environment::addExtension($extension, $engine, $resolver);
        }
        
        /**
         * Get the extension to engine bindings.
         *
         * @return array 
         * @static 
         */
        public static function getExtensions(){
            return \Illuminate\View\Environment::getExtensions();
        }
        
        /**
         * Get the engine resolver instance.
         *
         * @return \Illuminate\View\Engines\EngineResolver 
         * @static 
         */
        public static function getEngineResolver(){
            return \Illuminate\View\Environment::getEngineResolver();
        }
        
        /**
         * Get the view finder instance.
         *
         * @return \Illuminate\View\ViewFinderInterface 
         * @static 
         */
        public static function getFinder(){
            return \Illuminate\View\Environment::getFinder();
        }
        
        /**
         * Set the view finder instance.
         *
         * @return void 
         * @static 
         */
        public static function setFinder($finder){
            \Illuminate\View\Environment::setFinder($finder);
        }
        
        /**
         * Get the event dispatcher instance.
         *
         * @return \Illuminate\Events\Dispatcher 
         * @static 
         */
        public static function getDispatcher(){
            return \Illuminate\View\Environment::getDispatcher();
        }
        
        /**
         * Set the event dispatcher instance.
         *
         * @param \Illuminate\Events\Dispatcher
         * @return void 
         * @static 
         */
        public static function setDispatcher($events){
            \Illuminate\View\Environment::setDispatcher($events);
        }
        
        /**
         * Get the IoC container instance.
         *
         * @return \Illuminate\Container\Container 
         * @static 
         */
        public static function getContainer(){
            return \Illuminate\View\Environment::getContainer();
        }
        
        /**
         * Set the IoC container instance.
         *
         * @param \Illuminate\Container\Container $container
         * @return void 
         * @static 
         */
        public static function setContainer($container){
            \Illuminate\View\Environment::setContainer($container);
        }
        
        /**
         * Get an item from the shared data.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed 
         * @static 
         */
        public static function shared($key, $default = null){
            return \Illuminate\View\Environment::shared($key, $default);
        }
        
        /**
         * Get all of the shared data for the environment.
         *
         * @return array 
         * @static 
         */
        public static function getShared(){
            return \Illuminate\View\Environment::getShared();
        }
        
        /**
         * Get the entire array of sections.
         *
         * @return array 
         * @static 
         */
        public static function getSections(){
            return \Illuminate\View\Environment::getSections();
        }
        
        /**
         * Get all of the registered named views in environment.
         *
         * @return array 
         * @static 
         */
        public static function getNames(){
            return \Illuminate\View\Environment::getNames();
        }
        
    }


    class Sentry extends \Cartalyst\Sentry\Facades\Laravel\Sentry{
        
        /**
         * Registers a user by giving the required credentials
         * and an optional flag for whether to activate the user.
         *
         * @param array $credentials
         * @param bool $activate
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @static 
         */
        public static function register($credentials, $activate = false){
            return \Cartalyst\Sentry\Sentry::register($credentials, $activate);
        }
        
        /**
         * Attempts to authenticate the given user
         * according to the passed credentials.
         *
         * @param array $credentials
         * @param bool $remember
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \Cartalyst\Sentry\Throttling\UserBannedException
         * @throws \Cartalyst\Sentry\Throttling\UserSuspendedException
         * @throws \Cartalyst\Sentry\Users\LoginRequiredException
         * @throws \Cartalyst\Sentry\Users\PasswordRequiredException
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function authenticate($credentials, $remember = false){
            return \Cartalyst\Sentry\Sentry::authenticate($credentials, $remember);
        }
        
        /**
         * Alias for authenticating with the remember flag checked.
         *
         * @param array $credentials
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @static 
         */
        public static function authenticateAndRemember($credentials){
            return \Cartalyst\Sentry\Sentry::authenticateAndRemember($credentials);
        }
        
        /**
         * Check to see if the user is logged in and activated, and hasn't been banned or suspended.
         *
         * @return bool 
         * @static 
         */
        public static function check(){
            return \Cartalyst\Sentry\Sentry::check();
        }
        
        /**
         * Logs in the given user and sets properties
         * in the session.
         *
         * @param \Cartalyst\Sentry\Users\UserInterface $user
         * @param bool $remember
         * @return void 
         * @throws \Cartalyst\Sentry\Users\UserNotActivatedException
         * @static 
         */
        public static function login($user, $remember = false){
            \Cartalyst\Sentry\Sentry::login($user, $remember);
        }
        
        /**
         * Alias for logging in and remembering.
         *
         * @param \Cartalyst\Sentry\Users\UserInterface $user
         * @static 
         */
        public static function loginAndRemember($user){
            return \Cartalyst\Sentry\Sentry::loginAndRemember($user);
        }
        
        /**
         * Logs the current user out.
         *
         * @return void 
         * @static 
         */
        public static function logout(){
            \Cartalyst\Sentry\Sentry::logout();
        }
        
        /**
         * Sets the user to be used by Sentry.
         *
         * @param \Cartalyst\Sentry\Users\UserInterface
         * @return void 
         * @static 
         */
        public static function setUser($user){
            \Cartalyst\Sentry\Sentry::setUser($user);
        }
        
        /**
         * Returns the current user being used by Sentry, if any.
         *
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @static 
         */
        public static function getUser(){
            return \Cartalyst\Sentry\Sentry::getUser();
        }
        
        /**
         * Sets the session driver for Sentry.
         *
         * @param \Cartalyst\Sentry\Sessions\SessionInterface $session
         * @return void 
         * @static 
         */
        public static function setSession($session){
            \Cartalyst\Sentry\Sentry::setSession($session);
        }
        
        /**
         * Gets the session driver for Sentry.
         *
         * @return \Cartalyst\Sentry\Sessions\SessionInterface 
         * @static 
         */
        public static function getSession(){
            return \Cartalyst\Sentry\Sentry::getSession();
        }
        
        /**
         * Sets the cookie driver for Sentry.
         *
         * @param \Cartalyst\Sentry\Cookies\CookieInterface $cookie
         * @return void 
         * @static 
         */
        public static function setCookie($cookie){
            \Cartalyst\Sentry\Sentry::setCookie($cookie);
        }
        
        /**
         * Gets the cookie driver for Sentry.
         *
         * @return \Cartalyst\Sentry\Cookies\CookieInterface 
         * @static 
         */
        public static function getCookie(){
            return \Cartalyst\Sentry\Sentry::getCookie();
        }
        
        /**
         * Sets the group provider for Sentry.
         *
         * @param \Cartalyst\Sentry\Groups\ProviderInterface
         * @return void 
         * @static 
         */
        public static function setGroupProvider($groupProvider){
            \Cartalyst\Sentry\Sentry::setGroupProvider($groupProvider);
        }
        
        /**
         * Gets the group provider for Sentry.
         *
         * @return \Cartalyst\Sentry\Groups\ProviderInterface 
         * @static 
         */
        public static function getGroupProvider(){
            return \Cartalyst\Sentry\Sentry::getGroupProvider();
        }
        
        /**
         * Sets the user provider for Sentry.
         *
         * @param \Cartalyst\Sentry\Users\ProviderInterface
         * @return void 
         * @static 
         */
        public static function setUserProvider($userProvider){
            \Cartalyst\Sentry\Sentry::setUserProvider($userProvider);
        }
        
        /**
         * Gets the user provider for Sentry.
         *
         * @return \Cartalyst\Sentry\Users\ProviderInterface 
         * @static 
         */
        public static function getUserProvider(){
            return \Cartalyst\Sentry\Sentry::getUserProvider();
        }
        
        /**
         * Sets the throttle provider for Sentry.
         *
         * @param \Cartalyst\Sentry\Throttling\ProviderInterface
         * @return void 
         * @static 
         */
        public static function setThrottleProvider($throttleProvider){
            \Cartalyst\Sentry\Sentry::setThrottleProvider($throttleProvider);
        }
        
        /**
         * Gets the throttle provider for Sentry.
         *
         * @return \Cartalyst\Sentry\Throttling\ProviderInterface 
         * @static 
         */
        public static function getThrottleProvider(){
            return \Cartalyst\Sentry\Sentry::getThrottleProvider();
        }
        
        /**
         * Sets the IP address Sentry is bound to.
         *
         * @param string $ipAddress
         * @return void 
         * @static 
         */
        public static function setIpAddress($ipAddress){
            \Cartalyst\Sentry\Sentry::setIpAddress($ipAddress);
        }
        
        /**
         * Gets the IP address Sentry is bound to.
         *
         * @return string 
         * @static 
         */
        public static function getIpAddress(){
            return \Cartalyst\Sentry\Sentry::getIpAddress();
        }
        
        /**
         * Find the group by ID.
         *
         * @param int $id
         * @return \Cartalyst\Sentry\Groups\GroupInterface $group
         * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
         * @static 
         */
        public static function findGroupById($id){
            return \Cartalyst\Sentry\Sentry::findGroupById($id);
        }
        
        /**
         * Find the group by name.
         *
         * @param string $name
         * @return \Cartalyst\Sentry\Groups\GroupInterface $group
         * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
         * @static 
         */
        public static function findGroupByName($name){
            return \Cartalyst\Sentry\Sentry::findGroupByName($name);
        }
        
        /**
         * Returns all groups.
         *
         * @return array $groups
         * @static 
         */
        public static function findAllGroups(){
            return \Cartalyst\Sentry\Sentry::findAllGroups();
        }
        
        /**
         * Creates a group.
         *
         * @param array $attributes
         * @return \Cartalyst\Sentry\Groups\GroupInterface 
         * @static 
         */
        public static function createGroup($attributes){
            return \Cartalyst\Sentry\Sentry::createGroup($attributes);
        }
        
        /**
         * Finds a user by the given user ID.
         *
         * @param mixed $id
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function findUserById($id){
            return \Cartalyst\Sentry\Sentry::findUserById($id);
        }
        
        /**
         * Finds a user by the login value.
         *
         * @param string $login
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function findUserByLogin($login){
            return \Cartalyst\Sentry\Sentry::findUserByLogin($login);
        }
        
        /**
         * Finds a user by the given credentials.
         *
         * @param array $credentials
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function findUserByCredentials($credentials){
            return \Cartalyst\Sentry\Sentry::findUserByCredentials($credentials);
        }
        
        /**
         * Finds a user by the given activation code.
         *
         * @param string $code
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \RuntimeException
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function findUserByActivationCode($code){
            return \Cartalyst\Sentry\Sentry::findUserByActivationCode($code);
        }
        
        /**
         * Finds a user by the given reset password code.
         *
         * @param string $code
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @throws \RuntimeException
         * @throws \Cartalyst\Sentry\Users\UserNotFoundException
         * @static 
         */
        public static function findUserByResetPasswordCode($code){
            return \Cartalyst\Sentry\Sentry::findUserByResetPasswordCode($code);
        }
        
        /**
         * Returns an all users.
         *
         * @return array 
         * @static 
         */
        public static function findAllUsers(){
            return \Cartalyst\Sentry\Sentry::findAllUsers();
        }
        
        /**
         * Returns all users who belong to
         * a group.
         *
         * @param \Cartalyst\Sentry\Groups\GroupInterface $group
         * @return array 
         * @static 
         */
        public static function findAllUsersInGroup($group){
            return \Cartalyst\Sentry\Sentry::findAllUsersInGroup($group);
        }
        
        /**
         * Returns all users with access to
         * a permission(s).
         *
         * @param string|array $permissions
         * @return array 
         * @static 
         */
        public static function findAllUsersWithAccess($permissions){
            return \Cartalyst\Sentry\Sentry::findAllUsersWithAccess($permissions);
        }
        
        /**
         * Returns all users with access to
         * any given permission(s).
         *
         * @param array $permissions
         * @return array 
         * @static 
         */
        public static function findAllUsersWithAnyAccess($permissions){
            return \Cartalyst\Sentry\Sentry::findAllUsersWithAnyAccess($permissions);
        }
        
        /**
         * Creates a user.
         *
         * @param array $credentials
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @static 
         */
        public static function createUser($credentials){
            return \Cartalyst\Sentry\Sentry::createUser($credentials);
        }
        
        /**
         * Returns an empty user object.
         *
         * @return \Cartalyst\Sentry\Users\UserInterface 
         * @static 
         */
        public static function getEmptyUser(){
            return \Cartalyst\Sentry\Sentry::getEmptyUser();
        }
        
        /**
         * Finds a throttler by the given user ID.
         *
         * @param mixed $id
         * @param string $ipAddress
         * @return \Cartalyst\Sentry\Throttling\ThrottleInterface 
         * @static 
         */
        public static function findThrottlerByUserId($id, $ipAddress = null){
            return \Cartalyst\Sentry\Sentry::findThrottlerByUserId($id, $ipAddress);
        }
        
        /**
         * Finds a throttling interface by the given user login.
         *
         * @param string $login
         * @param string $ipAddress
         * @return \Cartalyst\Sentry\Throttling\ThrottleInterface 
         * @static 
         */
        public static function findThrottlerByUserLogin($login, $ipAddress = null){
            return \Cartalyst\Sentry\Sentry::findThrottlerByUserLogin($login, $ipAddress);
        }
        
    }


    class Image extends \Intervention\Image\Facades\Image{
        
        /**
         * Initiates an Image instance from different input types
         *
         * @param mixed $data
         * @return \Intervention\Image\Intervention\Image\Image 
         * @static 
         */
        public static function make($data){
            return \Intervention\Image\ImageManager::make($data);
        }
        
        /**
         * Creates an empty image canvas
         *
         * @param integer $width
         * @param integer $height
         * @param mixed $background
         * @return \Intervention\Image\Intervention\Image\Image 
         * @static 
         */
        public static function canvas($width, $height, $background = null){
            return \Intervention\Image\ImageManager::canvas($width, $height, $background);
        }
        
        /**
         * Create new cached image and run callback
         * (requires additional package intervention/imagecache)
         *
         * @param \Closure $callback
         * @param integer $lifetime
         * @param boolean $returnObj
         * @return \Intervention\Image\Image 
         * @static 
         */
        public static function cache($callback, $lifetime = null, $returnObj = false){
            return \Intervention\Image\ImageManager::cache($callback, $lifetime, $returnObj);
        }
        
    }


    class Geocoder extends \Toin0u\Geocoder\GeocoderFacade{
        
        /**
         * 
         *
         * @param \Geocoder\ResultFactoryInterface $resultFactory
         * @static 
         */
        public static function setResultFactory($resultFactory = null){
            return \Geocoder\Geocoder::setResultFactory($resultFactory);
        }
        
        /**
         * 
         *
         * @param integer $maxResults
         * @return \Geocoder\GeocoderInterface 
         * @static 
         */
        public static function limit($maxResults){
            return \Geocoder\Geocoder::limit($maxResults);
        }
        
        /**
         * 
         *
         * @return integer $maxResults
         * @static 
         */
        public static function getMaxResults(){
            return \Geocoder\Geocoder::getMaxResults();
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function geocode($value){
            return \Geocoder\Geocoder::geocode($value);
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function reverse($latitude, $longitude){
            return \Geocoder\Geocoder::reverse($latitude, $longitude);
        }
        
        /**
         * Registers a provider.
         *
         * @param \Geocoder\ProviderInterface $provider
         * @return \Geocoder\GeocoderInterface 
         * @static 
         */
        public static function registerProvider($provider){
            return \Geocoder\Geocoder::registerProvider($provider);
        }
        
        /**
         * Registers a set of providers.
         *
         * @param \Geocoder\ProviderInterface[] $providers
         * @return \Geocoder\GeocoderInterface 
         * @static 
         */
        public static function registerProviders($providers = array()){
            return \Geocoder\Geocoder::registerProviders($providers);
        }
        
        /**
         * Sets the provider to use.
         *
         * @param string $name A provider's name
         * @return \Geocoder\GeocoderInterface 
         * @static 
         */
        public static function using($name){
            return \Geocoder\Geocoder::using($name);
        }
        
        /**
         * Returns registered providers indexed by name.
         *
         * @return \Geocoder\ProviderInterface[] 
         * @static 
         */
        public static function getProviders(){
            return \Geocoder\Geocoder::getProviders();
        }
        
    }


    class Calendar extends \Gloudemans\Calendar\Facades\Calendar{
        
        /**
         * Initialize the user preferences
         * 
         * Accepts an associative array as input, containing display preferences
         *
         * @access public
         * @param array  config preferences
         * @return void 
         * @static 
         */
        public static function initialize($config = array()){
            \Gloudemans\Calendar\CalendarGenerator::initialize($config);
        }
        
        /**
         * Generate the calendar
         *
         * @access public
         * @param integer  the year
         * @param integer  the month
         * @param array  the data to be shown in the calendar cells
         * @return string 
         * @static 
         */
        public static function generate($year = '', $month = '', $data = array()){
            return \Gloudemans\Calendar\CalendarGenerator::generate($year, $month, $data);
        }
        
    }


    class Geotools extends \Toin0u\Geotools\GeotoolsFacade{
        
        /**
         * Set the latitude and the longitude of the coordinates into an selected ellipsoid.
         *
         * @param \Toin0u\Geotools\ResultInterface|array|string $coordinates The coordinates.
         * @param \Toin0u\Geotools\Ellipsoid $ellipsoid The selected ellipsoid (WGS84 by default).
         * @return \Toin0u\Geotools\Coordinate 
         * @static 
         */
        public static function coordinate($coordinates, $ellipsoid = null){
            return \Toin0u\Geotools\Geotools::coordinate($coordinates, $ellipsoid);
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function distance(){
            //Method inherited from \League\Geotools\Geotools            
            return \Toin0u\Geotools\Geotools::distance();
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function point(){
            //Method inherited from \League\Geotools\Geotools            
            return \Toin0u\Geotools\Geotools::point();
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function batch($geocoder){
            //Method inherited from \League\Geotools\Geotools            
            return \Toin0u\Geotools\Geotools::batch($geocoder);
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function geohash(){
            //Method inherited from \League\Geotools\Geotools            
            return \Toin0u\Geotools\Geotools::geohash();
        }
        
        /**
         * {@inheritDoc}
         *
         * @static 
         */
        public static function convert($coordinates){
            //Method inherited from \League\Geotools\Geotools            
            return \Toin0u\Geotools\Geotools::convert($coordinates);
        }
        
    }


    class Share extends \Thujohn\Share\ShareFacade{
        
        /**
         * 
         *
         * @static 
         */
        public static function load($link, $text = '', $media = ''){
            return \Thujohn\Share\Share::load($link, $text, $media);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function services(){
            return \Thujohn\Share\Share::services();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function delicious(){
            return \Thujohn\Share\Share::delicious();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function digg(){
            return \Thujohn\Share\Share::digg();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function evernote(){
            return \Thujohn\Share\Share::evernote();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function facebook(){
            return \Thujohn\Share\Share::facebook();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function gmail(){
            return \Thujohn\Share\Share::gmail();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function gplus(){
            return \Thujohn\Share\Share::gplus();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function linkedin(){
            return \Thujohn\Share\Share::linkedin();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function pinterest(){
            return \Thujohn\Share\Share::pinterest();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function reddit(){
            return \Thujohn\Share\Share::reddit();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function scoopit(){
            return \Thujohn\Share\Share::scoopit();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function springpad(){
            return \Thujohn\Share\Share::springpad();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function tumblr(){
            return \Thujohn\Share\Share::tumblr();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function twitter(){
            return \Thujohn\Share\Share::twitter();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function viadeo(){
            return \Thujohn\Share\Share::viadeo();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function vk(){
            return \Thujohn\Share\Share::vk();
        }
        
    }


    class Omnipay extends \Ignited\LaravelOmnipay\Facades\OmnipayFacade{
        
        /**
         * Get an instance of the specified gateway
         *
         * @param \Ignited\LaravelOmnipay\index  of config array to use
         * @return \Ignited\LaravelOmnipay\Omnipay\Common\AbstractGateway 
         * @static 
         */
        public static function gateway($name = null){
            return \Ignited\LaravelOmnipay\LaravelOmnipayManager::gateway($name);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function creditCard($cardInput){
            return \Ignited\LaravelOmnipay\LaravelOmnipayManager::creditCard($cardInput);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function getGateway(){
            return \Ignited\LaravelOmnipay\LaravelOmnipayManager::getGateway();
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function setGateway($name){
            return \Ignited\LaravelOmnipay\LaravelOmnipayManager::setGateway($name);
        }
        
    }


    class Twitter extends \Philo\Twitter\Facades\Twitter{
        
        /**
         * Get the timeout
         *
         * @return int 
         * @static 
         */
        public static function getTimeOut(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::getTimeOut();
        }
        
        /**
         * Get the useragent that will be used. Our version will be prepended to yours.
         * 
         * It will look like: "PHP Twitter/<version> <your-user-agent>"
         *
         * @return string 
         * @static 
         */
        public static function getUserAgent(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::getUserAgent();
        }
        
        /**
         * Set the oAuth-token
         *
         * @param string $token The token to use.
         * @static 
         */
        public static function setOAuthToken($token){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::setOAuthToken($token);
        }
        
        /**
         * Set the oAuth-secret
         *
         * @param string $secret The secret to use.
         * @static 
         */
        public static function setOAuthTokenSecret($secret){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::setOAuthTokenSecret($secret);
        }
        
        /**
         * Set the timeout
         *
         * @param int $seconds The timeout in seconds.
         * @static 
         */
        public static function setTimeOut($seconds){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::setTimeOut($seconds);
        }
        
        /**
         * Get the useragent that will be used. Our version will be prepended to yours.
         * 
         * It will look like: "PHP Twitter/<version> <your-user-agent>"
         *
         * @param string $userAgent Your user-agent, it should look like <app-name>/<app-version>.
         * @static 
         */
        public static function setUserAgent($userAgent){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::setUserAgent($userAgent);
        }
        
        /**
         * Returns the 20 most recent mentions (tweets containing a users's @screen_name) for the authenticating user.
         * 
         * The timeline returned is the equivalent of the one seen when you view your mentions on twitter.com.
         * This method can only return up to 800 tweets.
         *
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of tweets to try and retrieve, up to a maximum of 200. The value of count is best thought of as a limit to the number of tweets to return because suspended or deleted content is removed after the count has been applied. We include retweets in the count, even if include_rts is not supplied.
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @param \TijsVerkoyen\Twitter\bool[optional] $contributorDetails This parameter enhances the contributors element of the status response to include the screen_name of the contributor. By default only the user_id of the contributor is included.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function statusesMentionsTimeline($count = null, $sinceId = null, $maxId = null, $trimUser = null, $contributorDetails = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesMentionsTimeline($count, $sinceId, $maxId, $trimUser, $contributorDetails, $includeEntities);
        }
        
        /**
         * Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.
         * 
         * User timelines belonging to protected users may only be requested when the authenticated user either "owns" the timeline or is an approved follower of the owner.
         * The timeline returned is the equivalent of the one seen when you view a user's profile on twitter.com.
         * This method can only return up to 3,200 of a user's most recent Tweets. Native retweets of other statuses by the user is included in this total, regardless of whether include_rts is set to false when requesting this resource.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for. Helpful for disambiguating when a valid screen name is also a user ID.
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of tweets to try and retrieve, up to a maximum of 200 per distinct request. The value of count is best thought of as a limit to the number of tweets to return because suspended or deleted content is removed after the count has been applied. We include retweets in the count, even if include_rts is not supplied.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @param \TijsVerkoyen\Twitter\bool[optional] $excludeReplies This parameter will prevent replies from appearing in the returned timeline. Using exclude_replies with the count parameter will mean you will receive up-to count tweets — this is because the count parameter retrieves that many tweets before filtering out retweets and replies.
         * @param \TijsVerkoyen\Twitter\bool[optional] $contributorDetails This parameter enhances the contributors element of the status response to include the screen_name of the contributor. By default only the user_id of the contributor is included.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeRts When set to false, the timeline will strip any native retweets (though they will still count toward both the maximal length of the timeline and the slice selected by the count parameter). Note: If you're using the trim_user parameter in conjunction with include_rts, the retweets will still contain a full user object.
         * @return array 
         * @static 
         */
        public static function statusesUserTimeline($userId = null, $screenName = null, $sinceId = null, $count = null, $maxId = null, $trimUser = null, $excludeReplies = null, $contributorDetails = null, $includeRts = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesUserTimeline($userId, $screenName, $sinceId, $count, $maxId, $trimUser, $excludeReplies, $contributorDetails, $includeRts);
        }
        
        /**
         * Returns the 20 most recent statuses, including retweets if they exist, posted by the authenticating user and the user's they follow. This is the same timeline seen by a user when they login to twitter.com.
         * 
         * This method is identical to statusesFriendsTimeline, except that this method always includes retweets.
         *
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of records to retrieve. Must be less than or equal to 200. Defaults to 20.
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @param \TijsVerkoyen\Twitter\bool[optional] $excludeReplies This parameter will prevent replies from appearing in the returned timeline. Using exclude_replies with the count parameter will mean you will receive up-to count tweets — this is because the count parameter retrieves that many tweets before filtering out retweets and replies.
         * @param \TijsVerkoyen\Twitter\bool[optional] $contributorDetails This parameter enhances the contributors element of the status response to include the screen_name of the contributor. By default only the user_id of the contributor is included.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function statusesHomeTimeline($count = null, $sinceId = null, $maxId = null, $trimUser = null, $excludeReplies = null, $contributorDetails = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesHomeTimeline($count, $sinceId, $maxId, $trimUser, $excludeReplies, $contributorDetails, $includeEntities);
        }
        
        /**
         * Returns the most recent tweets authored by the authenticating user that have recently been retweeted by others. This timeline is a subset of the user's GET statuses/user_timeline.
         *
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of records to retrieve. Must be less than or equal to 100. If omitted, 20 will be assumed.
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The tweet entities node will be disincluded when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeUserEntities The user entities node will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function statusesRetweetsOfMe($count = null, $sinceId = null, $maxId = null, $trimUser = null, $includeEntities = null, $includeUserEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesRetweetsOfMe($count, $sinceId, $maxId, $trimUser, $includeEntities, $includeUserEntities);
        }
        
        /**
         * Returns up to 100 of the first retweets of a given tweet.
         *
         * @param string $id The numerical ID of the desired status.
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of records to retrieve. Must be less than or equal to 100.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @return array 
         * @static 
         */
        public static function statusesRetweets($id, $count = null, $trimUser = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesRetweets($id, $count, $trimUser);
        }
        
        /**
         * Returns a single Tweet, specified by the id parameter. The Tweet's author will also be embedded within the tweet.
         *
         * @param string $id The numerical ID of the desired Tweet.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeMyRetweet When set to true, any Tweets returned that have been retweeted by the authenticating user will include an additional current_user_retweet node, containing the ID of the source status for the retweet.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function statusesShow($id, $trimUser = null, $includeMyRetweet = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesShow($id, $trimUser, $includeMyRetweet, $includeEntities);
        }
        
        /**
         * Destroys the status specified by the required ID parameter. The authenticating user must be the author of the specified status. Returns the destroyed status if successful.
         *
         * @param string $id The numerical ID of the desired status.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @return array 
         * @static 
         */
        public static function statusesDestroy($id, $trimUser = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesDestroy($id, $trimUser);
        }
        
        /**
         * Updates the authenticating user's status. A status update with text identical to the authenticating user's text identical to the authenticating user's current status will be ignored to prevent duplicates.
         *
         * @param string $status The text of your status update, typically up to 140 characters. URL encode as necessary. t.co link wrapping may effect character counts. There are some special commands in this field to be aware of. For instance, preceding a message with "D " or "M " and following it with a screen name can create a direct message to that user if the relationship allows for it.
         * @param \TijsVerkoyen\Twitter\string[optional] $inReplyToStatusId The ID of an existing status that the update is in reply to. Note: This parameter will be ignored unless the author of the tweet this parameter references is mentioned within the status text. Therefore, you must include @username, where username is the author of the referenced tweet, within the update.
         * @param \TijsVerkoyen\Twitter\float[optional] $lat The latitude of the location this tweet refers to. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn't a corresponding long parameter.
         * @param \TijsVerkoyen\Twitter\float[optional] $long The longitude of the location this tweet refers to. The valid ranges for longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter will be ignored if outside that range, if it is not a number, if geo_enabled is disabled, or if there not a corresponding lat parameter.
         * @param \TijsVerkoyen\Twitter\string[optional] $placeId A place in the world. These IDs can be retrieved from GET geo/reverse_geocode.
         * @param \TijsVerkoyen\Twitter\bool[optional] $displayCoordinates Whether or not to put a pin on the exact coordinates a tweet has been sent from.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @return array 
         * @static 
         */
        public static function statusesUpdate($status, $inReplyToStatusId = null, $lat = null, $long = null, $placeId = null, $displayCoordinates = null, $trimUser = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesUpdate($status, $inReplyToStatusId, $lat, $long, $placeId, $displayCoordinates, $trimUser);
        }
        
        /**
         * Retweets a tweet. Returns the original tweet with retweet details embedded.
         *
         * @param string $id The numerical ID of the desired status.
         * @param \TijsVerkoyen\Twitter\bool[optional] $trimUser When set to true, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
         * @return array 
         * @static 
         */
        public static function statusesRetweet($id, $trimUser = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesRetweet($id, $trimUser);
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function statusesUpdateWithMedia(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesUpdateWithMedia();
        }
        
        /**
         * 
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $id The Tweet/status ID to return embed code for.
         * @param \TijsVerkoyen\Twitter\string[optional] $url The URL of the Tweet/status to be embedded.
         * @param \TijsVerkoyen\Twitter\int[optional] $maxwidth The maximum width in pixels that the embed should be rendered at. This value is constrained to be between 250 and 550 pixels. Note that Twitter does not support the oEmbed maxheight parameter. Tweets are fundamentally text, and are therefore of unpredictable height that cannot be scaled like an image or video. Relatedly, the oEmbed response will not provide a value for height. Implementations that need consistent heights for Tweets should refer to the hide_thread and hide_media parameters below.
         * @param \TijsVerkoyen\Twitter\bool[optional] $hideMedia Specifies whether the embedded Tweet should automatically expand images which were uploaded via POST statuses/update_with_media. When set to true images will not be expanded. Defaults to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $hideThread Specifies whether the embedded Tweet should automatically show the original message in the case that the embedded Tweet is a reply. When set to true the original Tweet will not be shown. Defaults to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $omitScript Specifies whether the embedded Tweet HTML should include a <script> element pointing to widgets.js. In cases where a page already includes widgets.js, setting this value to true will prevent a redundant script element from being included. When set to true the <script> element will not be included in the embed HTML, meaning that pages must include a reference to widgets.js manually. Defaults to false.
         * @param \TijsVerkoyen\Twitter\string[optional] $align Specifies whether the embedded Tweet should be left aligned, right aligned, or centered in the page. Valid values are left, right, center, and none. Defaults to none, meaning no alignment styles are specified for the Tweet.
         * @param \TijsVerkoyen\Twitter\string[optional] $related A value for the TWT related parameter, as described in Web Intents. This value will be forwarded to all Web Intents calls.
         * @param \TijsVerkoyen\Twitter\string[optional] $lang Language code for the rendered embed. This will affect the text and localization of the rendered HTML.
         * @return array 
         * @static 
         */
        public static function statusesOEmbed($id = null, $url = null, $maxwidth = null, $hideMedia = null, $hideThread = null, $omitScript = null, $align = null, $related = null, $lang = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesOEmbed($id, $url, $maxwidth, $hideMedia, $hideThread, $omitScript, $align, $related, $lang);
        }
        
        /**
         * Returns tweets that match a specified query.
         *
         * @param string $q A UTF-8, URL-encoded search query of 1,000 characters maximum, including operators. Queries may additionally be limited by complexity.
         * @param \TijsVerkoyen\Twitter\string[optional] $geocode Returns tweets by users located within a given radius of the given latitude/longitude. The location is preferentially taking from the Geotagging API, but will fall back to their Twitter profile. The parameter value is specified by "latitude,longitude,radius", where radius units must be specified as either "mi" (miles) or "km" (kilometers). Note that you cannot use the near operator via the API to geocode arbitrary locations; however you can use this geocode parameter to search near geocodes directly. A maximum of 1,000 distinct "sub-regions" will be considered when using the radius modifier.
         * @param \TijsVerkoyen\Twitter\string[optional] $lang Restricts tweets to the given language, given by an ISO 639-1 code. Language detection is best-effort.
         * @param \TijsVerkoyen\Twitter\string[optional] $locale Specify the language of the query you are sending (only ja is currently effective). This is intended for language-specific consumers and the default should work in the majority of cases.
         * @param \TijsVerkoyen\Twitter\string[optional] $resultType Specifies what type of search results you would prefer to receive. The current default is "mixed." Valid values include: mixed: Include both popular and real time results in the response, recent: return only the most recent results in the response, popular: return only the most popular results in the response.
         * @param \TijsVerkoyen\Twitter\int[optional] $count The number of tweets to return per page, up to a maximum of 100. Defaults to 15. This was formerly the "rpp" parameter in the old Search API.
         * @param \TijsVerkoyen\Twitter\string[optional] $until Returns tweets generated before the given date. Date should be formatted as YYYY-MM-DD. Keep in mind that the search index may not go back as far as the date you specify here.
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function searchTweets($q, $geocode = null, $lang = null, $locale = null, $resultType = null, $count = null, $until = null, $sinceId = null, $maxId = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::searchTweets($q, $geocode, $lang, $locale, $resultType, $count, $until, $sinceId, $maxId, $includeEntities);
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function statusesFilter(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesFilter();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function statusesSample(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesSample();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function statusesFirehose(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::statusesFirehose();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function user(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::user();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function site(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::site();
        }
        
        /**
         * Returns the 20 most recent direct messages sent to the authenticating user. Includes detailed information about the sender and recipient user. You can request up to 200 direct messages per call, up to a maximum of 800 incoming DMs.
         * 
         * Important: This method requires an access token with RWD (read, write & direct message) permissions. Consult The Application Permission Model for more information.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of direct messages to try and retrieve, up to a maximum of 200. The value of count is best thought of as a limit to the number of Tweets to return because suspended or deleted content is removed after the count has been applied.
         * @param \TijsVerkoyen\Twitter\int[optional] $page Specifies the page of results to retrieve.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function directMessages($sinceId = null, $maxId = null, $count = null, $page = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::directMessages($sinceId, $maxId, $count, $page, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns the 20 most recent direct messages sent by the authenticating user. Includes detailed information about the sender and recipient user. You can request up to 200 direct messages per call, up to a maximum of 800 outgoing DMs.
         * 
         * Important: This method requires an access token with RWD (read, write & direct message) permissions. Consult The Application Permission Model for more information.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[optional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of records to retrieve. Must be less than or equal to 200.
         * @param \TijsVerkoyen\Twitter\int[optional] $page Specifies the page of results to retrieve.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @return array 
         * @static 
         */
        public static function directMessagesSent($sinceId = null, $maxId = null, $count = null, $page = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::directMessagesSent($sinceId, $maxId, $count, $page, $includeEntities);
        }
        
        /**
         * 
         *
         * @param string $id The ID of the direct message.
         * @return array 
         * @static 
         */
        public static function directMessagesShow($id){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::directMessagesShow($id);
        }
        
        /**
         * Destroys the direct message specified in the required ID parameter. The authenticating user must be the recipient of the specified direct message.
         * 
         * Important: This method requires an access token with RWD (read, write & direct message) permissions. Consult The Application Permission Model for more information.
         *
         * @param string $id The ID of the direct message to delete.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @return array 
         * @static 
         */
        public static function directMessagesDestroy($id, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::directMessagesDestroy($id, $includeEntities);
        }
        
        /**
         * Sends a new direct message to the specified user from the authenticating user. Requires both the user and text parameters and must be a POST. Returns the sent message in the requested format if successful.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user who should receive the direct message. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user who should receive the direct message. Helpful for disambiguating when a valid screen name is also a user ID.
         * @param string $text The text of your direct message. Be sure to URL encode as necessary, and keep the message under 140 characters.
         * @return array 
         * @static 
         */
        public static function directMessagesNew($userId, $screenName, $text){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::directMessagesNew($userId, $screenName, $text);
        }
        
        /**
         * Returns a cursored collection of user IDs for every user the specified user is following (otherwise known as their "friends").
         * 
         * At this time, results are ordered with the most recent following first — however, this ordering is subject to unannounced change and eventual consistency issues. Results are given in groups of 5,000 user IDs and multiple "pages" of results can be navigated through using the next_cursor value in subsequent requests. See Using cursors to navigate collections for more information.
         * This method is especially powerful when used in conjunction with GET users/lookup, a method that allows you to convert user IDs into full user objects in bulk.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $cursor Causes the list of connections to be broken into pages of no more than 5000 IDs at a time. The number of IDs returned is not guaranteed to be 5000 as suspended users are filtered out after connections are queried. If no cursor is provided, a value of -1 will be assumed, which is the first "page." The response from the API will include a previous_cursor and next_cursor to allow paging back and forth
         * @param \TijsVerkoyen\Twitter\bool[optional] $stringifyIds Many programming environments will not consume our Tweet ids due to their size. Provide this option to have ids returned as strings instead.
         * @return array 
         * @static 
         */
        public static function friendsIds($userId = null, $screenName = null, $cursor = null, $stringifyIds = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendsIds($userId, $screenName, $cursor, $stringifyIds);
        }
        
        /**
         * Returns a cursored collection of user IDs for every user following the specified user.
         * 
         * At this time, results are ordered with the most recent following first — however, this ordering is subject to unannounced change and eventual consistency issues. Results are given in groups of 5,000 user IDs and multiple "pages" of results can be navigated through using the next_cursor value in subsequent requests. See Using cursors to navigate collections for more information.
         * This method is especially powerful when used in conjunction with GET users/lookup, a method that allows you to convert user IDs into full user objects in bulk.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $cursor Causes the list of connections to be broken into pages of no more than 5000 IDs at a time. The number of IDs returned is not guaranteed to be 5000 as suspended users are filtered out after connections are queried. If no cursor is provided, a value of -1 will be assumed, which is the first "page." The response from the API will include a previous_cursor and next_cursor to allow paging back and forth
         * @param \TijsVerkoyen\Twitter\bool[optional] $stringifyIds Many programming environments will not consume our Tweet ids due to their size. Provide this option to have ids returned as strings instead.
         * @return array 
         * @static 
         */
        public static function followersIds($userId = null, $screenName = null, $cursor = null, $stringifyIds = true){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::followersIds($userId, $screenName, $cursor, $stringifyIds);
        }
        
        /**
         * Returns the relationships of the authenticating user to the comma-separated list of up to 100 screen_names or user_ids provided.
         * 
         * Values for connections can be: following, following_requested, followed_by, none.
         *
         * @param \TijsVerkoyen\Twitter\mixed[optional] $userIds An array of user IDs, up to 100 are allowed in a single request.
         * @param \TijsVerkoyen\Twitter\mixed[optional] $screenNames An array of screen names, up to 100 are allowed in a single request.
         * @return array 
         * @static 
         */
        public static function friendshipsLookup($userIds = null, $screenNames = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsLookup($userIds, $screenNames);
        }
        
        /**
         * Returns a collection of numeric IDs for every user who has a pending request to follow the authenticating user.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $cursor Causes the list of connections to be broken into pages of no more than 5000 IDs at a time. The number of IDs returned is not guaranteed to be 5000 as suspended users are filtered out after connections are queried. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $stringifyIds Many programming environments will not consume our Tweet ids due to their size. Provide this option to have ids returned as strings instead.
         * @return array 
         * @static 
         */
        public static function friendshipsIncoming($cursor = null, $stringifyIds = true){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsIncoming($cursor, $stringifyIds);
        }
        
        /**
         * Returns a collection of numeric IDs for every protected user for whom the authenticating user has a pending follow request.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $cursor Causes the list of connections to be broken into pages of no more than 5000 IDs at a time. The number of IDs returned is not guaranteed to be 5000 as suspended users are filtered out after connections are queried. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $stringifyIds Many programming environments will not consume our Tweet ids due to their size. Provide this option to have ids returned as strings instead.
         * @return array 
         * @static 
         */
        public static function friendshipsOutgoing($cursor = null, $stringifyIds = true){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsOutgoing($cursor, $stringifyIds);
        }
        
        /**
         * Allows the authenticating users to follow the user specified in the ID parameter.
         * 
         * Returns the befriended user in the requested format when successful. Returns a string describing the failure condition when unsuccessful. If you are already friends with the user a HTTP 403 may be returned, though for performance reasons you may get a 200 OK message even if the friendship already exists.
         * Actions taken in this method are asynchronous and changes will be eventually consistent.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to befriend.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to befriend.
         * @param \TijsVerkoyen\Twitter\bool[optional] $follow Enable notifications for the target user.
         * @return array 
         * @static 
         */
        public static function friendshipsCreate($userId = null, $screenName = null, $follow = false){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsCreate($userId, $screenName, $follow);
        }
        
        /**
         * Allows the authenticating user to unfollow the user specified in the ID parameter.
         * 
         * Returns the unfollowed user in the requested format when successful. Returns a string describing the failure condition when unsuccessful.
         * Actions taken in this method are asynchronous and changes will be eventually consistent.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to unfollow.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to unfollow.
         * @return array 
         * @static 
         */
        public static function friendshipsDestroy($userId = null, $screenName = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsDestroy($userId, $screenName);
        }
        
        /**
         * Allows one to enable or disable retweets and device notifications from the specified user.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to befriend.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to befriend.
         * @param \TijsVerkoyen\Twitter\bool[optional] $device Enable/disable device notifications from the target user.
         * @param \TijsVerkoyen\Twitter\bool[optional] $retweets Enable/disable retweets from the target user.
         * @return array 
         * @static 
         */
        public static function friendshipsUpdate($userId = null, $screenName = null, $device = null, $retweets = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsUpdate($userId, $screenName, $device, $retweets);
        }
        
        /**
         * Returns detailed information about the relationship between two arbitrary users.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $sourceId The user_id of the subject user.
         * @param \TijsVerkoyen\Twitter\string[optional] $sourceScreenName The screen_name of the subject user.
         * @param \TijsVerkoyen\Twitter\string[optional] $targetId The screen_name of the subject user.
         * @param \TijsVerkoyen\Twitter\string[optional] $targetScreenName The screen_name of the target user.
         * @return array 
         * @static 
         */
        public static function friendshipsShow($sourceId = null, $sourceScreenName = null, $targetId = null, $targetScreenName = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendshipsShow($sourceId, $sourceScreenName, $targetId, $targetScreenName);
        }
        
        /**
         * Returns a cursored collection of user objects for every user the specified user is following (otherwise known as their "friends").
         * 
         * At this time, results are ordered with the most recent following first — however, this ordering is subject to unannounced change and eventual consistency issues. Results are given in groups of 20 users and multiple "pages" of results can be navigated through using the next_cursor value in subsequent requests. See Using cursors to navigate collections for more information.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\int[optional] $cursor Causes the results to be broken into pages of no more than 20 records at a time. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The user object entities node will be disincluded when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function friendsList($userId = null, $screenName = null, $cursor = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::friendsList($userId, $screenName, $cursor, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns a cursored collection of user objects for users following the specified user.
         * 
         * At this time, results are ordered with the most recent following first — however, this ordering is subject to unannounced change and eventual consistency issues. Results are given in groups of 20 users and multiple "pages" of results can be navigated through using the next_cursor value in subsequent requests. See Using cursors to navigate collections for more information.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\int[optional] $cursor Causes the results to be broken into pages of no more than 20 records at a time. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The user object entities node will be disincluded when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function followersList($userId = null, $screenName = null, $cursor = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::followersList($userId, $screenName, $cursor, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns settings (including current trend, geo and sleep time information) for the authenticating user.
         *
         * @return array 
         * @static 
         */
        public static function accountSettings(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountSettings();
        }
        
        /**
         * Returns an HTTP 200 OK response code and a representation of the requesting user if authentication was successful; returns a 401 status code and an error message if not. Use this method to test if supplied user credentials are valid.
         *
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to true, statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function accountVerifyCredentials($includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountVerifyCredentials($includeEntities, $skipStatus);
        }
        
        /**
         * Updates the authenticating user's settings.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $trendLocationWoeId The Yahoo! Where On Earth ID to use as the user's default trend location. Global information is available by using 1 as the WOEID. The woeid must be one of the locations returned by trendsAvailable.
         * @param \TijsVerkoyen\Twitter\bool[optional] $sleepTimeEnabled When set to true, will enable sleep time for the user. Sleep time is the time when push or SMS notifications should not be sent to the user.
         * @param \TijsVerkoyen\Twitter\string[optional] $startSleepTime The hour that sleep time should begin if it is enabled. The value for this parameter should be provided in ISO8601 format (i.e. 00-23). The time is considered to be in the same timezone as the user's time_zone setting.
         * @param \TijsVerkoyen\Twitter\string[optional] $endSleepTime The hour that sleep time should end if it is enabled. The value for this parameter should be provided in ISO8601 format (i.e. 00-23). The time is considered to be in the same timezone as the user's time_zone setting.
         * @param \TijsVerkoyen\Twitter\string[optional] $timeZone The timezone dates and times should be displayed in for the user. The timezone must be one of the Rails TimeZone names.
         * @param \TijsVerkoyen\Twitter\string[optional] $lang The language which Twitter should render in for this user. The language must be specified by the appropriate two letter ISO 639-1 representation. Currently supported languages are provided by helpLanguages.
         * @return array 
         * @static 
         */
        public static function accountSettingsUpdate($trendLocationWoeId = null, $sleepTimeEnabled = null, $startSleepTime = null, $endSleepTime = null, $timeZone = null, $lang = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountSettingsUpdate($trendLocationWoeId, $sleepTimeEnabled, $startSleepTime, $endSleepTime, $timeZone, $lang);
        }
        
        /**
         * Sets which device Twitter delivers updates to for the authenticating user. Sending none as the device parameter will disable SMS updates.
         *
         * @return array 
         * @param string $device Must be one of: sms, none.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities When set to true, each tweet will include a node called "entities,". This node offers a variety of metadata about the tweet in a discreet structure, including: user_mentions, urls, and hashtags. While entities are opt-in on timelines at present, they will be made a default component of output in the future. See Tweet Entities for more detail on entities.
         * @static 
         */
        public static function accountUpdateDeliveryDevice($device, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateDeliveryDevice($device, $includeEntities);
        }
        
        /**
         * Sets values that users are able to set under the "Account" tab of their settings page. Only the parameters specified will be updated.
         *
         * @return array 
         * @param \TijsVerkoyen\Twitter\string[optional] $name Full name associated with the profile. Maximum of 20 characters.
         * @param \TijsVerkoyen\Twitter\string[optional] $url URL associated with the profile. Will be prepended with "http://" if not present. Maximum of 100 characters.
         * @param \TijsVerkoyen\Twitter\string[optional] $location The city or country describing where the user of the account is located. The contents are not normalized or geocoded in any way. Maximum of 30 characters.
         * @param \TijsVerkoyen\Twitter\string[optional] $description A description of the user owning the account. Maximum of 160 characters.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to true, statuses will not be included in the returned user objects.
         * @static 
         */
        public static function accountUpdateProfile($name = null, $url = null, $location = null, $description = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateProfile($name, $url, $location, $description, $includeEntities, $skipStatus);
        }
        
        /**
         * Updates the authenticating user's profile background image.
         *
         * @return array 
         * @param string $image The path to the background image for the profile. Must be a valid GIF, JPG, or PNG image of less than 800 kilobytes in size. Images with width larger than 2048 pixels will be forceably scaled down.
         * @param \TijsVerkoyen\Twitter\bool[optional] $tile Whether or not to tile the background image. If set to true the background image will be displayed tiled. The image will not be tiled otherwise.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities When set to true each tweet will include a node called "entities,". This node offers a variety of metadata about the tweet in a discreet structure, including: user_mentions, urls, and hashtags.
         * @static 
         */
        public static function accountUpdateProfileBackgroundImage($image, $tile = false, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateProfileBackgroundImage($image, $tile, $includeEntities);
        }
        
        /**
         * Sets one or more hex values that control the color scheme of the authenticating user's profile page on twitter.com.
         * 
         * Each parameter's value must be a valid hexidecimal value, and may be either three or six characters (ex: #fff or #ffffff).
         *
         * @return array 
         * @param \TijsVerkoyen\Twitter\string[optional] $profileBackgroundColor Profile background color.
         * @param \TijsVerkoyen\Twitter\string[optional] $profileTextColor Profile text color.
         * @param \TijsVerkoyen\Twitter\string[optional] $profileLinkColor Profile link color.
         * @param \TijsVerkoyen\Twitter\string[optional] $profileSidebarFillColor Profile sidebar's background color.
         * @param \TijsVerkoyen\Twitter\string[optional] $profileSidebarBorderColor Profile sidebar's border color.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities When set to true each tweet will include a node called "entities,". This node offers a variety of metadata about the tweet in a discreet structure, including: user_mentions, urls, and hashtags.
         * @static 
         */
        public static function accountUpdateProfileColors($profileBackgroundColor = null, $profileTextColor = null, $profileLinkColor = null, $profileSidebarFillColor = null, $profileSidebarBorderColor = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateProfileColors($profileBackgroundColor, $profileTextColor, $profileLinkColor, $profileSidebarFillColor, $profileSidebarBorderColor, $includeEntities);
        }
        
        /**
         * Updates the authenticating user's profile image.
         *
         * @return array 
         * @param string $image The path to the avatar image for the profile. Must be a valid GIF, JPG, or PNG image of less than 700 kilobytes in size. Images with width larger than 500 pixels will be scaled down.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities When set to true each tweet will include a node called "entities,". This node offers a variety of metadata about the tweet in a discreet structure, including: user_mentions, urls, and hashtags.
         * @static 
         */
        public static function accountUpdateProfileImage($image, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateProfileImage($image, $includeEntities);
        }
        
        /**
         * Not implemented yet
         *
         * @param \TijsVerkoyen\Twitter\int[optional] $cursor Causes the results to be broken into pages of no more than 20 records at a time. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The user object entities node will be disincluded when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function blocksList($cursor = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::blocksList($cursor, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns an array of numeric user ids the authenticating user is blocking.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $cursor Causes the list of IDs to be broken into pages of no more than 5000 IDs at a time. The number of IDs returned is not guaranteed to be 5000 as suspended users are filtered out after connections are queried. If no cursor is provided, a value of -1 will be assumed, which is the first "page."
         * @param \TijsVerkoyen\Twitter\bool[optional] $stringifyIds Many programming environments will not consume our ids due to their size. Provide this option to have ids returned as strings instead.
         * @return array 
         * @static 
         */
        public static function blocksIds($cursor = null, $stringifyIds = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::blocksIds($cursor, $stringifyIds);
        }
        
        /**
         * Blocks the specified user from following the authenticating user. In addition the blocked user will not show in the authenticating users mentions or timeline (unless retweeted by another user). If a follow or friend relationship exists it is destroyed.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the potentially blocked user. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the potentially blocked user. Helpful for disambiguating when a valid screen name is also a user ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function blocksCreate($userId = null, $screenName = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::blocksCreate($userId, $screenName, $includeEntities, $skipStatus);
        }
        
        /**
         * Un-blocks the user specified in the ID parameter for the authenticating user. Returns the un-blocked user in the requested format when successful. If relationships existed before the block was instated, they will not be restored.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the potentially blocked user. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the potentially blocked user. Helpful for disambiguating when a valid screen name is also a user ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function blocksDestroy($userId = null, $screenName = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::blocksDestroy($userId, $screenName, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns fully-hydrated user objects for up to 100 users per request, as specified by comma-separated values passed to the user_id and/or screen_name parameters.
         *
         * @param \TijsVerkoyen\Twitter\mixed[optional] $userIds An array of user IDs, up to 100 are allowed in a single request.
         * @param \TijsVerkoyen\Twitter\mixed[optional] $screenNames An array of screen names, up to 100 are allowed in a single request.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node that may appear within embedded statuses will be disincluded when set to false.
         * @return array 
         * @static 
         */
        public static function usersLookup($userIds = null, $screenNames = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersLookup($userIds, $screenNames, $includeEntities);
        }
        
        /**
         * Returns a variety of information about the user specified by the required user_id or screen_name parameter.
         * 
         * The author's most recent Tweet will be returned inline when possible.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The screen name of the user for whom to return results for. Either a id or screen_name is required for this method.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The ID of the user for whom to return results for. Either an id or screen_name is required for this method.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @return array 
         * @static 
         */
        public static function usersShow($userId = null, $screenName = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersShow($userId, $screenName, $includeEntities);
        }
        
        /**
         * Run a search for users similar to the Find People button on Twitter.com; the same results returned by people search on Twitter.com will be returned by using this API.
         * 
         * Usage note: It is only possible to retrieve the first 1000 matches from this API.
         *
         * @param string $q The search query to run against people search.
         * @param \TijsVerkoyen\Twitter\int[optional] $page Specifies the page of results to retrieve.
         * @param \TijsVerkoyen\Twitter\int[optional] $count The number of potential user results to retrieve per page. This value has a maximum of 20.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be disincluded from embedded tweet objects when set to false.
         * @return array 
         * @static 
         */
        public static function usersSearch($q, $page = null, $count = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersSearch($q, $page, $count, $includeEntities);
        }
        
        /**
         * Returns a collection of users that the specified user can "contribute" to.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function usersContributees($userId = null, $screenName = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersContributees($userId, $screenName, $includeEntities, $skipStatus);
        }
        
        /**
         * Returns a collection of users who can contribute to the specified account.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will not be included when set to false.
         * @param \TijsVerkoyen\Twitter\bool[optional] $skipStatus When set to either true, t or 1 statuses will not be included in the returned user objects.
         * @return array 
         * @static 
         */
        public static function usersContributors($userId = null, $screenName = null, $includeEntities = null, $skipStatus = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersContributors($userId, $screenName, $includeEntities, $skipStatus);
        }
        
        /**
         * Removes the uploaded profile banner for the authenticating user.
         *
         * @return bool 
         * @static 
         */
        public static function accountRemoveProfileBanner(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountRemoveProfileBanner();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function accountUpdateProfileBanner(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::accountUpdateProfileBanner();
        }
        
        /**
         * Returns a map of the available size variations of the specified user's profile banner. If the user has not uploaded a profile banner, a HTTP 404 will be served instead.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user for whom to return results for. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The screen name of the user for whom to return results for. Helpful for disambiguating when a valid screen name is also a user ID.
         * @return array 
         * @static 
         */
        public static function usersProfileBanner($userId = null, $screenName = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersProfileBanner($userId, $screenName);
        }
        
        /**
         * Access the users in a given category of the Twitter suggested user list.
         * 
         * It is recommended that applications cache this data for no more than one hour.
         *
         * @param string $slug The short name of list or a category.
         * @param \TijsVerkoyen\Twitter\string[optional] $lang Restricts the suggested categories to the requested language. The language must be specified by the appropriate two letter ISO 639-1 representation. Currently supported languages are provided by the helpLanguages API request. Unsupported language codes will receive English (en) results.
         * @return array 
         * @static 
         */
        public static function usersSuggestionsSlug($slug, $lang = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersSuggestionsSlug($slug, $lang);
        }
        
        /**
         * Access to Twitter's suggested user list. This returns the list of suggested user categories. The category can be used in usersSuggestionsSlug to get the users in that category.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $lang Restricts the suggested categories to the requested language. The language must be specified by the appropriate two letter ISO 639-1 representation. Currently supported languages are provided by the helpLanguages API request. Unsupported language codes will receive English (en) results.
         * @return array 
         * @static 
         */
        public static function usersSuggestions($lang = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersSuggestions($lang);
        }
        
        /**
         * Access the users in a given category of the Twitter suggested user list and return their most recent status if they are not a protected user.
         *
         * @param string $slug The short name of list or a category
         * @return array 
         * @static 
         */
        public static function usersSuggestionsSlugMembers($slug){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::usersSuggestionsSlugMembers($slug);
        }
        
        /**
         * Returns the 20 most recent Tweets favorited by the authenticating or specified user.
         *
         * @param \TijsVerkoyen\Twitter\string[otpional] $userId The ID of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\string[otpional] $screenName The screen name of the user for whom to return results for.
         * @param \TijsVerkoyen\Twitter\int[optional] $count Specifies the number of records to retrieve. Must be less than or equal to 200. Defaults to 20.
         * @param \TijsVerkoyen\Twitter\string[otpional] $sinceId Returns results with an ID greater than (that is, more recent than) the specified ID. There are limits to the number of Tweets which can be accessed through the API. If the limit of Tweets has occured since the since_id, the since_id will be forced to the oldest ID available.
         * @param \TijsVerkoyen\Twitter\string[otpional] $maxId Returns results with an ID less than (that is, older than) or equal to the specified ID.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be omitted when set to false.
         * @return array 
         * @static 
         */
        public static function favoritesList($userId = null, $screenName = null, $count = 20, $sinceId = null, $maxId = null, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::favoritesList($userId, $screenName, $count, $sinceId, $maxId, $includeEntities);
        }
        
        /**
         * Un-favorites the status specified in the ID parameter as the authenticating user. Returns the un-favorited status in the requested format when successful.
         * 
         * This process invoked by this method is asynchronous. The immediately returned status may not indicate the resultant favorited status of the tweet. A 200 OK response from this method will indicate whether the intended action was successful or not.
         *
         * @return array 
         * @param string $id The numerical ID of the desired status.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be omitted when set to false.
         * @static 
         */
        public static function favoritesDestroy($id, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::favoritesDestroy($id, $includeEntities);
        }
        
        /**
         * Favorites the status specified in the ID parameter as the authenticating user. Returns the favorite status when successful.
         * 
         * This process invoked by this method is asynchronous. The immediately returned status may not indicate the resultant favorited status of the tweet. A 200 OK response from this method will indicate whether the intended action was successful or not.
         *
         * @param string $id The numerical ID of the desired status.
         * @param \TijsVerkoyen\Twitter\bool[optional] $includeEntities The entities node will be omitted when set to false.
         * @return array 
         * @static 
         */
        public static function favoritesCreate($id, $includeEntities = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::favoritesCreate($id, $includeEntities);
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsList(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsList();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsStatuses(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsStatuses();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembersDestroy(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembersDestroy();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMemberships(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMemberships();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsSubscribers(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsSubscribers();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsSubscribersCreate(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsSubscribersCreate();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsSubscribersShow(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsSubscribersShow();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsSubscribersDestroy(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsSubscribersDestroy();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembersCreateAll(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembersCreateAll();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembersShow(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembersShow();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembers(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembers();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembersCreate(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembersCreate();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsDestroy(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsDestroy();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsUpdate(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsUpdate();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsCreate(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsCreate();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsShow(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsShow();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listSubscriptions(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listSubscriptions();
        }
        
        /**
         * Not implemented yet
         *
         * @static 
         */
        public static function listsMembersDestroyAll(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::listsMembersDestroyAll();
        }
        
        /**
         * Returns the authenticated user's saved search queries.
         *
         * @return array 
         * @static 
         */
        public static function savedSearchesList(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::savedSearchesList();
        }
        
        /**
         * Retrieve the information for the saved search represented by the given id. The authenticating user must be the owner of saved search ID being requested.
         *
         * @return array 
         * @param string $id The ID of the saved search.
         * @static 
         */
        public static function savedSearchesShow($id){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::savedSearchesShow($id);
        }
        
        /**
         * Create a new saved search for the authenticated user. A user may only have 25 saved searches.
         *
         * @return array 
         * @param string $query The query of the search the user would like to save.
         * @static 
         */
        public static function savedSearchesCreate($query){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::savedSearchesCreate($query);
        }
        
        /**
         * Destroys a saved search for the authenticating user. The authenticating user must be the owner of saved search id being destroyed.
         *
         * @return array 
         * @param string $id The ID of the saved search.
         * @static 
         */
        public static function savedSearchesDestroy($id){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::savedSearchesDestroy($id);
        }
        
        /**
         * Returns all the information about a known place.
         *
         * @param string $id A place in the world. These IDs can be retrieved from geo/reverse_geocode.
         * @return array 
         * @static 
         */
        public static function geoId($id){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::geoId($id);
        }
        
        /**
         * Given a latitude and a longitude, searches for up to 20 places that can be used as a place_id when updating a status.
         * 
         * This request is an informative call and will deliver generalized results about geography.
         *
         * @param float $lat The latitude to search around. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn't a corresponding long parameter.
         * @param float $long The longitude to search around. The valid ranges for longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter will be ignored if outside that range, if it is not a number, if geo_enabled is disabled, or if there not a corresponding lat parameter.
         * @param \TijsVerkoyen\Twitter\string[optional] $accuracy A hint on the "region" in which to search. If a number, then this is a radius in meters, but it can also take a string that is suffixed with ft to specify feet. If this is not passed in, then it is assumed to be 0m. If coming from a device, in practice, this value is whatever accuracy the device has measuring its location (whether it be coming from a GPS, WiFi triangulation, etc.).
         * @param \TijsVerkoyen\Twitter\string[optional] $granularity This is the minimal granularity of place types to return and must be one of: poi, neighborhood, city, admin or country. If no granularity is provided for the request neighborhood is assumed. Setting this to city, for example, will find places which have a type of city, admin or country.
         * @param \TijsVerkoyen\Twitter\int[optional] $maxResults A hint as to the number of results to return. This does not guarantee that the number of results returned will equal max_results, but instead informs how many "nearby" results to return. Ideally, only pass in the number of places you intend to display to the user here.
         * @return array 
         * @static 
         */
        public static function geoReverseGeoCode($lat, $long, $accuracy = null, $granularity = null, $maxResults = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::geoReverseGeoCode($lat, $long, $accuracy, $granularity, $maxResults);
        }
        
        /**
         * Search for places that can be attached to a statuses/update. Given a latitude and a longitude pair, an IP address, or a name, this request will return a list of all the valid places that can be used as the place_id when updating a status.
         * 
         * Conceptually, a query can be made from the user's location, retrieve a list of places, have the user validate the location he or she is at, and then send the ID of this location with a call to POST statuses/update.
         * This is the recommended method to use find places that can be attached to statuses/update. Unlike GET geo/reverse_geocode which provides raw data access, this endpoint can potentially re-order places with regards to the user who is authenticated. This approach is also preferred for interactive place matching with the user.
         *
         * @param \TijsVerkoyen\Twitter\float[optional] $lat The latitude to search around. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn't a corresponding long parameter.
         * @param \TijsVerkoyen\Twitter\float[optional] $long The longitude to search around. The valid ranges for longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter will be ignored if outside that range, if it is not a number, if geo_enabled is disabled, or if there not a corresponding lat parameter.
         * @param \TijsVerkoyen\Twitter\string[optional] $query Free-form text to match against while executing a geo-based query, best suited for finding nearby locations by name. Remember to URL encode the query.
         * @param \TijsVerkoyen\Twitter\string[optional] $ip An IP address. Used when attempting to fix geolocation based off of the user's IP address.
         * @param \TijsVerkoyen\Twitter\string[optional] $granularity This is the minimal granularity of place types to return and must be one of: poi, neighborhood, city, admin or country. If no granularity is provided for the request neighborhood is assumed. Setting this to city, for example, will find places which have a type of city, admin or country.
         * @param \TijsVerkoyen\Twitter\string[optional] $accuracy A hint on the "region" in which to search. If a number, then this is a radius in meters, but it can also take a string that is suffixed with ft to specify feet. If this is not passed in, then it is assumed to be 0m. If coming from a device, in practice, this value is whatever accuracy the device has measuring its location (whether it be coming from a GPS, WiFi triangulation, etc.).
         * @param \TijsVerkoyen\Twitter\int[optional] $maxResults A hint as to the number of results to return. This does not guarantee that the number of results returned will equal max_results, but instead informs how many "nearby" results to return. Ideally, only pass in the number of places you intend to display to the user here.
         * @param \TijsVerkoyen\Twitter\string[optional] $containedWithin This is the place_id which you would like to restrict the search results to. Setting this value means only places within the given place_id will be found. Specify a place_id. For example, to scope all results to places within "San Francisco, CA USA", you would specify a place_id of "5a110d312052166f"
         * @param \TijsVerkoyen\Twitter\array[optional] $attributes This parameter searches for places which have this given street address. There are other well-known, and application specific attributes available. Custom attributes are also permitted. This should be an key-value-pair-array.
         * @return array 
         * @static 
         */
        public static function geoSearch($lat = null, $long = null, $query = null, $ip = null, $granularity = null, $accuracy = null, $maxResults = null, $containedWithin = null, $attributes = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::geoSearch($lat, $long, $query, $ip, $granularity, $accuracy, $maxResults, $containedWithin, $attributes);
        }
        
        /**
         * Locates places near the given coordinates which are similar in name.
         * 
         * Conceptually you would use this method to get a list of known places to choose from first. Then, if the desired place doesn't exist, make a request to POST geo/place to create a new one.
         * The token contained in the response is the token needed to be able to create a new place.
         *
         * @param float $lat The latitude to search around. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn't a corresponding long parameter.
         * @param float $long The longitude to search around. The valid ranges for longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter will be ignored if outside that range, if it is not a number, if geo_enabled is disabled, or if there not a corresponding lat parameter.
         * @param string $name The name a place is known as.
         * @param \TijsVerkoyen\Twitter\string[optional] $containedWithin This is the place_id which you would like to restrict the search results to. Setting this value means only places within the given place_id will be found. Specify a place_id. For example, to scope all results to places within "San Francisco, CA USA", you would specify a place_id of "5a110d312052166f"
         * @param \TijsVerkoyen\Twitter\array[optional] $attributes This parameter searches for places which have this given street address. There are other well-known, and application specific attributes available. Custom attributes are also permitted.
         * @return array 
         * @static 
         */
        public static function geoSimilarPlaces($lat, $long, $name, $containedWithin = null, $attributes = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::geoSimilarPlaces($lat, $long, $name, $containedWithin, $attributes);
        }
        
        /**
         * Creates a new place at the given latitude and longitude.
         *
         * @param string $name The name a place is known as.
         * @param string $containedWithin The place_id within which the new place can be found. Try and be as close as possible with the containing place. For example, for a room in a building, set the contained_within as the building place_id.
         * @param string $token The token found in the response from geo/similar_places.
         * @param float $lat The latitude the place is located at. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn't a corresponding long parameter.
         * @param float $long The longitude the place is located at. The valid ranges for longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter will be ignored if outside that range, if it is not a number, if geo_enabled is disabled, or if there not a corresponding lat parameter.
         * @param \TijsVerkoyen\Twitter\array[optional] $attributes This parameter searches for places which have this given street address. There are other well-known, and application specific attributes available. Custom attributes are also permitted. This should be an key-value-pair-array.
         * @return array 
         * @static 
         */
        public static function geoPlace($name, $containedWithin, $token, $lat, $long, $attributes = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::geoPlace($name, $containedWithin, $token, $lat, $long, $attributes);
        }
        
        /**
         * Returns the top 10 trending topics for a specific WOEID, if trending information is available for it.
         * 
         * The response is an array of "trend" objects that encode the name of the trending topic, the query parameter that can be used to search for the topic on Twitter Search, and the Twitter Search URL.
         * This information is cached for 5 minutes. Requesting more frequently than that will not return any more data, and will count against your rate limit usage.
         *
         * @param string $id The Yahoo! Where On Earth ID of the location to return trending information for. Global information is available by using 1 as the WOEID.
         * @param \TijsVerkoyen\Twitter\string[optional] $exclude Setting this equal to hashtags will remove all hashtags from the trends list.
         * @return array 
         * @static 
         */
        public static function trendsPlace($id, $exclude = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::trendsPlace($id, $exclude);
        }
        
        /**
         * Returns the locations that Twitter has trending topic information for.
         * 
         * The response is an array of "locations" that encode the location's WOEID (a Yahoo! Where On Earth ID) and some other human-readable information such as a canonical name and country the location belongs in.
         * The WOEID that is returned in the location object is to be used when querying for a specific trend.
         *
         * @param \TijsVerkoyen\Twitter\float[optional] $lat If passed in conjunction with long, then the available trend locations will be sorted by distance to the lat  and long passed in. The sort is nearest to furthest.
         * @param \TijsVerkoyen\Twitter\float[optional] $long If passed in conjunction with lat, then the available trend locations will be sorted by distance to the lat  and long passed in. The sort is nearest to furthest.
         * @return array 
         * @static 
         */
        public static function trendsAvailable($lat = null, $long = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::trendsAvailable($lat, $long);
        }
        
        /**
         * Returns the locations that Twitter has trending topic information for, closest to a specified location.
         * 
         * The response is an array of "locations" that encode the location's WOEID and some other human-readable information such as a canonical name and country the location belongs in.
         *
         * @param \TijsVerkoyen\Twitter\float[optional] $lat If provided with a long parameter the available trend locations will be sorted by distance, nearest to furthest, to the co-ordinate pair. The valid ranges for longitude is -180.0 to +180.0 (West is negative, East is positive) inclusive.
         * @param \TijsVerkoyen\Twitter\float[optional] $long If provided with a lat parameter the available trend locations will be sorted by distance, nearest to furthest, to the co-ordinate pair. The valid ranges for longitude is -180.0 to +180.0 (West is negative, East is positive) inclusive.
         * @return array 
         * @static 
         */
        public static function trendsClosest($lat = null, $long = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::trendsClosest($lat, $long);
        }
        
        /**
         * The user specified in the id is blocked by the authenticated user and reported as a spammer.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $screenName The ID or screen_name of the user you want to report as a spammer. Helpful for disambiguating when a valid screen name is also a user ID.
         * @param \TijsVerkoyen\Twitter\string[optional] $userId The ID of the user you want to report as a spammer. Helpful for disambiguating when a valid user ID is also a valid screen name.
         * @return array 
         * @static 
         */
        public static function reportSpam($screenName = null, $userId = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::reportSpam($screenName, $userId);
        }
        
        /**
         * Allows a Consumer application to use an OAuth request_token to request user authorization.
         * 
         * This method is a replacement fulfills Secion 6.2 of the OAuth 1.0 authentication flow for
         * applications using the Sign in with Twitter authentication flow. The method will use the
         * currently logged in user as the account to for access authorization unless the force_login
         * parameter is set to true
         *
         * @param string $token The token.
         * @param \TijsVerkoyen\Twitter\bool[optional] $force Force the authentication.
         * @param \TijsVerkoyen\Twitter\string[optional] $screen_name Prefill the username input box of the OAuth login.
         * @static 
         */
        public static function oAuthAuthenticate($token, $force = false, $screen_name = false){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::oAuthAuthenticate($token, $force, $screen_name);
        }
        
        /**
         * Will redirect to the page to authorize the applicatione
         *
         * @param string $token The token.
         * @static 
         */
        public static function oAuthAuthorize($token){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::oAuthAuthorize($token);
        }
        
        /**
         * Allows a Consumer application to exchange the OAuth Request Token for an OAuth Access Token.
         * 
         * This method fulfills Secion 6.3 of the OAuth 1.0 authentication flow.
         *
         * @param string $token The token to use.
         * @param string $verifier The verifier.
         * @return array 
         * @static 
         */
        public static function oAuthAccessToken($token, $verifier){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::oAuthAccessToken($token, $verifier);
        }
        
        /**
         * Allows a Consumer application to obtain an OAuth Request Token to request user authorization.
         * 
         * This method fulfills Secion 6.1 of the OAuth 1.0 authentication flow.
         *
         * @param \TijsVerkoyen\Twitter\string[optional] $callbackURL The callback URL.
         * @return array An array containg the token and the secret
         * @static 
         */
        public static function oAuthRequestToken($callbackURL = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::oAuthRequestToken($callbackURL);
        }
        
        /**
         * Returns the current configuration used by Twitter including twitter.com slugs which are not usernames, maximum photo resolutions, and t.co URL lengths.
         * 
         * It is recommended applications request this endpoint when they are loaded, but no more than once a day.
         *
         * @return array 
         * @static 
         */
        public static function helpConfiguration(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::helpConfiguration();
        }
        
        /**
         * Returns the list of languages supported by Twitter along with their ISO 639-1 code. The ISO 639-1 code is the two letter value to use if you include lang with any of your requests.
         *
         * @return array 
         * @static 
         */
        public static function helpLanguages(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::helpLanguages();
        }
        
        /**
         * Returns Twitter's Privacy Policy
         *
         * @return array 
         * @static 
         */
        public static function helpPrivacy(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::helpPrivacy();
        }
        
        /**
         * Returns the Twitter Terms of Service in the requested format. These are not the same as the Developer Rules of the Road.
         *
         * @return array 
         * @static 
         */
        public static function helpTos(){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::helpTos();
        }
        
        /**
         * Returns the current rate limits for methods belonging to the specified resource families.
         * 
         * Each 1.1 API resource belongs to a "resource family" which is indicated in its method documentation. You can typically determine a method's resource family from the first component of the path after the resource version.
         * This method responds with a map of methods belonging to the families specified by the resources parameter, the current remaining uses for each of those resources within the current rate limiting window, and its expiration time in epoch time. It also includes a rate_limit_context field that indicates the current access token context.
         * You may also issue requests to this method without any parameters to receive a map of all rate limited GET methods. If your application only uses a few of methods, please explicitly provide a resources parameter with the specified resource families you work with.
         *
         * @param array $resources A comma-separated list of resource families you want to know the current rate limit disposition for. For best performance, only specify the resource families pertinent to your application.
         * @return string 
         * @static 
         */
        public static function applicationRateLimitStatus($resources = null){
            //Method inherited from \TijsVerkoyen\Twitter\Twitter            
            return \Philo\Twitter\Twitter::applicationRateLimitStatus($resources);
        }
        
    }


    class PDF extends \Thujohn\Pdf\PdfFacade{
        
        /**
         * 
         *
         * @static 
         */
        public static function load($html, $size = 'A4', $orientation = 'portrait'){
            return \Thujohn\Pdf\Pdf::load($html, $size, $orientation);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function show($filename = 'dompdf_out', $options = array()){
            return \Thujohn\Pdf\Pdf::show($filename, $options);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function download($filename = 'dompdf_out', $options = array()){
            return \Thujohn\Pdf\Pdf::download($filename, $options);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function output($options = array()){
            return \Thujohn\Pdf\Pdf::output($options);
        }
        
        /**
         * 
         *
         * @static 
         */
        public static function clear(){
            return \Thujohn\Pdf\Pdf::clear();
        }
        
    }


    class OpenGraph extends \ChrisKonnertz\OpenGraph\OpenGraph{
        
    }


    class MailchimpWrapper extends \Hugofirth\Mailchimp\Facades\MailchimpWrapper{
        
        /**
         * Get Mailchimp_Folders object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Folders 
         * @static 
         */
        public static function folders(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::folders();
        }
        
        /**
         * Get Mailchimp_Templates object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Templates 
         * @static 
         */
        public static function templates(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::templates();
        }
        
        /**
         * Get Mailchimp_Users object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Users 
         * @static 
         */
        public static function users(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::users();
        }
        
        /**
         * Get Mailchimp_Helper object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Helper 
         * @static 
         */
        public static function helper(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::helper();
        }
        
        /**
         * Get Mailchimp_Mobile object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Mobile 
         * @static 
         */
        public static function mobile(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::mobile();
        }
        
        /**
         * Get Mailchimp_Ecomm object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Ecomm 
         * @static 
         */
        public static function ecomm(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::ecomm();
        }
        
        /**
         * Get Mailchimp_Neapolitan object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Neapolitan 
         * @static 
         */
        public static function neapolitan(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::neapolitan();
        }
        
        /**
         * Get Mailchimp_Lists object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Lists 
         * @static 
         */
        public static function lists(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::lists();
        }
        
        /**
         * Get Mailchimp_Campaigns object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Campaigns 
         * @static 
         */
        public static function campaigns(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::campaigns();
        }
        
        /**
         * Get Mailchimp_Vip object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Vip 
         * @static 
         */
        public static function vip(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::vip();
        }
        
        /**
         * Get Mailchimp_Reports object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Reports 
         * @static 
         */
        public static function reports(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::reports();
        }
        
        /**
         * Get Mailchimp_Gallery object
         *
         * @return \Hugofirth\Mailchimp\Mailchimp_Gallery 
         * @static 
         */
        public static function gallery(){
            return \Hugofirth\Mailchimp\MailchimpWrapper::gallery();
        }
        
    }


    class JavaScript extends \Laracasts\Utilities\JavaScript\Facades\JavaScript{
        
        /**
         * Bind given array of variables to view
         *
         * @param array $vars
         * @static 
         */
        public static function put($vars){
            return \Laracasts\Utilities\JavaScript\PHPToJavaScriptTransformer::put($vars);
        }
        
        /**
         * Translate the array of PHP vars
         * to JavaScript syntax.
         *
         * @param array $vars
         * @internal param $js
         * @return array 
         * @static 
         */
        public static function buildJavaScriptSyntax($vars){
            return \Laracasts\Utilities\JavaScript\PHPToJavaScriptTransformer::buildJavaScriptSyntax($vars);
        }
        
    }


    class FacebookConnect extends \Pitchanon\FacebookConnect\Facades\FacebookConnect{
        
        /**
         * getInstance.
         *
         * @param array $application Example: array('appId' => YOUR_APP_ID, 'secret' => YOUR_APP_SECRET);
         * @return object new Facebook($application)
         * @author Pitchanon D. <Pitchanon.d@gmail.com>
         * @static 
         */
        public static function getFacebook($application = array()){
            return \Pitchanon\FacebookConnect\Provider\FacebookConnect::getFacebook($application);
        }
        
        /**
         * Authenticated.
         *
         * @param array $permissions List permissions
         * @param string $url_app Canvas URL
         * @return array User data facebook
         * @author Pitchanon D. <Pitchanon.d@gmail.com>
         * @static 
         */
        public static function getUser($permissions, $url_app){
            return \Pitchanon\FacebookConnect\Provider\FacebookConnect::getUser($permissions, $url_app);
        }
        
        /**
         * Check user likes the page in Facebook.
         *
         * @param integer $page_id Facebook fan page id
         * @param integer $user_id Facebook User id
         * @return \Pitchanon\FacebookConnect\Provider\[type] [description]
         * @author Pitchanon D. <Pitchanon.d@gmail.com>
         * @static 
         */
        public static function getUserLikePage($page_id, $user_id){
            return \Pitchanon\FacebookConnect\Provider\FacebookConnect::getUserLikePage($page_id, $user_id);
        }
        
        /**
         * post links, feed to user facebook wall.
         *
         * @param array $message Example: $message = array('link' => '', 'message' => '','picture' => '', 'name' => '','description'   => '', 'access_token' => '');
         * @param string $type Type of message (links,feed)
         * @return string Id of message
         * @author Pitchanon D. <Pitchanon.d@gmail.com>
         * @static 
         */
        public static function postToFacebook($message, $type = null){
            return \Pitchanon\FacebookConnect\Provider\FacebookConnect::postToFacebook($message, $type);
        }
        
    }


}

