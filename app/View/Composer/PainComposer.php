<?php

namespace App\View\Composer;

use App\Models\Category;
use Illuminate\View\View;

 /**
  * 
  */
 class PainComposer
 {
 	
 	function __construct()
 	{
 		// code...
 	}

 	public function compose(View $view)
 	{
 		$categories = Category::pluck('name', 'slug')->toArray();

 		$view->with('categories', $categories);
 	}
 }