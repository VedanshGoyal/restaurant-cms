<?php

namespace Restaurant\Http\Controllers;

use Illuminate\Foundation\Application;

class HTMLController extends Controller
{
    // @var Illuminate\Foundation\Application
    protected $app;

    /**
     * Initialize new controller instance
     *
     * @param Application
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * home page HTML view
     *
     * @return View
     */
    public function home()
    {
        $repoName = 'Restaurant\Repositories\{name}Repo';
        $data = [];
        $data['hours'] = $this->app[str_replace('{name}', 'Hour', $repoName)]->readAll()->sortBy('id');
        $data['info'] = $this->app[str_replace('{name}', 'Info', $repoName)]->readSingle(1);
        $data['about'] = $this->app[str_replace('{name}', 'About', $repoName)]->readSingle(1);
        $data['menuSections'] = $this->app[str_replace('{name}', 'MenuSection', $repoName)]->readAll();
        $data['photos'] = $this->app[str_replace('{name}', 'Photo', $repoName)]->readAll();
        $view = view('index', $data);

        return $view;
    }

    /**
     * dash page HTML view
     *
     * @return View
     */
    public function dash()
    {
        return view('dash');
    }

    /**
     * menu page HTML view
     *
     * @return View
     */
    public function menu()
    {
        return view('menu');
    }
}
