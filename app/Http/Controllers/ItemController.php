<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public  function Item()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////

        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        Session::put('menu', 'Item');
        $pagetitle = 'Item';
        // $item = DB::table('item')->where('ItemType', '!=', 'RawMaterial')->orWhereNull('ItemType')->get();
        $item = DB::table('item')->get();
        $unit = DB::table('unit')->get();

        $item_type = DB::table('item_type')->get();

        $chartofaccount = DB::table('chartofaccount')->where(DB::raw('right(ChartOfAccountID,4)'), 00000)->where(DB::raw('right(ChartOfAccountID,5)'), '!=', 00000)->get();
        return view('item', compact('pagetitle', 'item', 'unit', 'chartofaccount','item_type'));
    }
    public  function ItemSave(request $request)
    {
        // dd($request->all());
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), 'Item/Inventory', 'List / Create');
        if ($allow == 0) {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $request->validate(
            [
                'ItemName' => 'required|max:55',
                'Unit' => 'required',
                'SellingPrice' => 'required',
                'CostPrice' => 'required',
            ]
        );
        $data = array(
            'ItemType' => $request->ItemType,
            'ItemCode' => $request->ItemCode,
            'ItemName' => $request->ItemName,
            'UnitName' => $request->Unit,
            'BaseUnit' => $request->BaseUnit != '' ? $request->BaseUnit : $request->Unit,
            'ConversionRate' => $request->conRate,
            'Taxable' => $request->Taxable,
            'Percentage' => $request->Percentage,
            'CostPrice' => $request->CostPrice,
            'CostChartofAccountID' => $request->CostChartofAccountID,
            'CostDescription' => $request->CostDescription,
            'SellingPrice' => $request->SellingPrice,
            'SellingChartofAccountID' => $request->SellingChartofAccountID,
            'SellingDescription' => $request->SellingDescription,
            'description' => $request->description,

        );
        $id = DB::table('item')->insertGetId($data);
        return redirect('Item')->with('error', 'Save Successfully.')->with('class', 'success');
    }
    public  function ItemEdit($id)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), 'Item/Inventory', 'Update');
        if ($allow == 0) {

            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        Session::put('menu', 'Item');
        $pagetitle = 'Item Edit';

        $item = DB::table('item')->where('ItemID', $id)->first();
        $unit = DB::table('unit')->get();
        $chartofaccount = DB::table('chartofaccount')->where(DB::raw('right(ChartOfAccountID,4)'), 00000)->where(DB::raw('right(ChartOfAccountID,5)'), '!=', 00000)->get();

        return view('item_edit', compact('pagetitle', 'item', 'unit', 'chartofaccount'));
    }

    public  function ItemUpdate(request $request)
    {
        // dd($request->all());
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), 'Item/Inventory', 'Update');
        if ($allow == 0) {

            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $request->validate(
            [
                'ItemName' => 'required|max:55',
                'Unit' => 'required',
                'SellingPrice' => 'required',
                'CostPrice' => 'required',
            ]
        );
        $data = array(
            'ItemType' => $request->ItemType,
            'ItemCode' => $request->ItemCode,
            'ItemName' => $request->ItemName,
            'UnitName' => $request->Unit,
            'BaseUnit' => $request->BaseUnit != '' ? $request->BaseUnit : $request->Unit,
            'ConversionRate' => $request->conRate,
            'Taxable' => $request->Taxable,
            'Percentage' => $request->Percentage,
            'CostPrice' => $request->CostPrice,
            'CostChartofAccountID' => $request->CostChartofAccountID,
            'CostDescription' => $request->CostDescription,
            'SellingPrice' => $request->SellingPrice,
            'SellingChartofAccountID' => $request->SellingChartofAccountID,
            'SellingDescription' => $request->SellingDescription,
            'description' => $request->description,

        );
        DB::table('item')->where('ItemID', $request->input('ItemID'))->update($data);
        return redirect('Item')->with('error', 'Updated Successfully.')->with('class', 'success');
    }
    public  function ItemDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), 'Item/Inventory', 'Delete');
        if ($allow == 0) {

            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('item')->where('ItemID', $id)->delete();
        return redirect('Item')->with('error', 'Deleted Successfully')->with('class', 'success');
    }
}
