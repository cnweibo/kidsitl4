<?php

class BishunController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * ='1402629792_7.swf
	 * @return Response
	 */
	public function getBishun($filename)
	{
		//
		$absolutefilename = app_path().'/storage/uploaded/'.$filename;
		// dd($absolutefilename);
		return (File::get($absolutefilename));
		Response::download($absolutefilename);
		//Return "received";
	}

	/**
	 * Show the bishun page.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//show the bishun page
		$bishuns = Bishun::all();
		return View::make('site.bishun.bishun', compact('bishuns'));   
	}
	/**
	 * process the bishun search form.
	 *
	 * @return Response
	 */
	public function postSearch()
	{
		$bishunsearch = Input::get('bishunsearch');
		// dd($bishunsearch);
		if ($bishunsearch){
			// populate the html markup which will be displayed in ajax page
			//show the searched bishun items
			$bishuns = Bishun::where('hanzi','=', $bishunsearch)->first();
			//dd(get_class($bishuns));
			// dd($bishuns);
			return (View::make('site.bishun.bishunSearchPartial',compact('bishuns')));
		}else{
			$bishuns = Bishun::all();
			return View::make('site.bishun.bishunSearchPartial', compact('bishuns'));   
		}
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	

}