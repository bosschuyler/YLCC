<?php



class IndexController extends BaseController {
	protected $layout = 'layouts.main';

	public function dark(){
		$layout = View::make('layouts.main');
		$layout->content = View::make('index.index');
		return $layout;
	}

	public function light()	{
		$this->layout->content = View::make('index.index');
	}

	public function aboutUs() {
		$this->layout->content = View::make('index.about-us');
	}

	public function activitySchedule() {
		$this->layout->content = View::make('index.activity-schedule');
	}

	public function ourFacility() {
		$this->layout->content = View::make('index.facility');
	}

	public function menu() {
		$this->layout->content = View::make('index.menu');
	}
}