<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\position;
use App\Model\employee;
use App\Model\section_type;
use App\Model\section_property;
use App\Model\section;

class SectionController extends Controller
{

	public function manageSectiontypes(Request $request,$status="",$sectionId="")
	{
		if(Input::has('btn_saveSectionType'))
		{
			$section 				= new section_type();
			$section->section_type = $request->get('txt_sectiontype');
			$section->status 		="1";
			$section->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateSection'))
			{
				$section 				= section_type::find($request->get('txt_id'));
				$section->section_type 	= $request->get('txt_sectiontype');
				$section->status 		="1";
				$section->save();
				return redirect()->action('Section@manageSectiontypes');
			}
			else
			{
				$sectionId 			= decrypt($sectionId);
				$section 			= section_type::find($sectionId);
				return view('admin/editmanageSectiontypes',compact('section'));
			}
		}
		elseif($status == "delete")
		{
			$section 				= section_type::find($request->get('txt_sectionId'));
			$section->status 		= "0";
			$section->save();
			return redirect()->back();
		}
		else
		{
			$section_type 			= section_type::where('status','1')->get();
			return view('admin/manageSectionTypes',compact('section_type'));
		}
	}

	public function manageSectionProperties(Request $request,$status="",$sectionprptyId="")
	{
		if(Input::has('btn_saveSectionProperty'))
		{
			$section 						= new section_property();
			$section->section_property_name = $request->get('txt_secpropname');
			$section->status 				="1";
			$section->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateSection'))
			{
				$section 						= section_property::find($request->get('txt_id'));
				$section->section_property_name = $request->get('txt_secpropname');
				$section->status 				="1";
				$section->save();
				return redirect()->action('Section@manageSectionProperties');
			}
			else
			{
				$sectionprptyId			= decrypt($sectionprptyId);
				$sectionprpty 			= section_property::find($sectionprptyId);
				return view('admin/editmanageSectionProperties',compact('sectionprpty'));
			}
		}
		elseif($status == "delete")
		{
			$section 			= section_property::find($request->get('txt_sectionPrptyId'));
			$section->status 	= "0";
			$section->save();
			return redirect()->back();
		}
		else
		{
			$sectionProperty 		= section_property::where('status','1')->get();
			return view('admin/manageSectionProperties',compact('sectionProperty'));
		}
	}

	public function manageSection(Request $request,$status="",$sectionId="")
	{
		$sectionType 	= section_type::where('status','1')->get();
		$sectionPrpty 	= section_property::where('status','1')->get();
		$restaurant 	= restaurant::where('status','1')->get();

		if(Input::has('btn_saveSection'))
		{
			$section 						= new section();
			$section->section_name 			= $request->get('txt_sectionname');
			$section->section_type_id 		= $request->get('ddl_sectionType');
			$section->section_property_id 	= $request->get('ddl_sectionProperty');
			$section->restaurant_id 		= $request->get('ddl_restaurant');
			$section->status 					="1";
			$section->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateSection'))
			{
				$section 						= section::find($request->get('txt_id'));
				$section->section_name 			= $request->get('txt_sectionname');
				$section->section_type_id 		= $request->get('ddl_sectionType');
				$section->section_property_id 	= $request->get('ddl_sectionProperty');
				$section->restaurant_id 		= $request->get('ddl_restaurant');
				$section->status 					="1";
				$section->save();
				return redirect()->action('SectionController@manageSection');
			}
			else
			{
				$sectionId 				= decrypt($sectionId);
				$section 				= section::find($sectionId);
				return view('admin/editmanageSection',compact('section','sectionType','sectionPrpty','restaurant'));
			}
		}
		elseif($status == "delete")
		{
			$section 			= section::find($request->get('txt_sectionId'));
			$section->status 	= "0";
			$section->save();
			return redirect()->back();
		}
		else
		{
			$section 		= section::getFullSections();
			return view('admin/manageSection',compact('section','sectionType','sectionPrpty','restaurant'));
		}
	}
}