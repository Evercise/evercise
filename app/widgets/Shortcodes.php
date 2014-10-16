<?php


class Shortcodes
{


    protected $elastic;
    protected $search;

    protected $evercisegroup;
    protected $input;
    protected $log;
    protected $redirect;
    protected $paginator;
    protected $config;

    public function __construct()
    {

        $this->evercisegroup = new Evercisegroup;
        $this->input = Request::getFacadeRoot();
        $this->log = Log::getFacadeRoot();
        $this->link = new Link;
        $this->view = View::getFacadeRoot();
        $this->place = new Place;
        $this->redirect = Redirect::getFacadeRoot();
        $this->config = Config::getFacadeRoot();

        $this->elastic = new Elastic(
            Geotools::getFacadeRoot(),
            $this->evercisegroup,
            Es::getFacadeRoot(),
            $this->log
        );
        $this->search = new Search($this->elastic, $this->evercisegroup, $this->log);

    }

    public function singleClass($attr, $content = null, $name = null)
    {
        $class = false;
        $area = false;
        $params = [
            'from' => 0,
            'size' => 1
        ];

        if(!empty($attr['area'])) {
            /** AreaID is defined. So get that */
            $area =  $this->place->find($attr['area']);
        } else {
            /** Area is not defined. Is the NearMe option defined? */
            if(!empty($attr['nearme'])) {
                $place = Place::getLocation($this->input->ip(), true, true);
                $zip = $place->getZipcode();
                $params['radius'] = '3mi';
                $area = $this->place->getByLocation($zip);
            }
        }

        if(!$area) {
            $area = $this->link->where('permalink', '=', 'london')->first()->getArea;
        }

        switch($attr['type']) {
            case 'id':
                if(!empty($result = $this->search->cleanSingleResults($this->search->getSingle($attr['param'])))) {
                    $class = $result[0];
                }
                break;
            case 'search':
                $params['search'] = $attr['param'];
                if(!empty($result = $this->search->cleanSingleResults($this->search->getResults($area, $params)))) {
                    $class = $result[0];
                }
                break;
        }


        if (!$class) {
            /** Get a random one */
            if(!empty($result = $this->search->cleanSingleResults($this->search->getSingle(0)))) {
                $class = $result[0];
            }
        }



        return $this->view->make('widgets/cms_single_class', (array)$class)->render();
    }
}