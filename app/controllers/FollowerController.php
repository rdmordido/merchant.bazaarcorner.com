<?php

class FollowerController extends BaseController {

	public function index()
	{
		return View::make('follower_list');
	}

}
