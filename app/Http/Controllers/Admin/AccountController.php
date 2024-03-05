<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AccountDataTable;
use App\DataTables\ActivityLogDataTable;
use App\DataTables\DecommissionAccountDataTable;
use App\DataTables\InactiveAccountDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
use URL;

class AccountController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index(Request $request, AccountDataTable $dt, DecommissionAccountDataTable $decomDataTable, InactiveAccountDataTable $inactiveDataTable) {

		if ($request->get('table') == 'accountDataTable') {
			return $dt->render('admin.accounts.list', ['title' => 'MANAGERS']);
		}
		if ($request->get('table') == 'decomDataTable') {
			return $decomDataTable->render('admin.accounts.list', ['title' => 'MANAGERS']);
		}
		if ($request->get('table') == 'inactiveDataTable') {
			return $inactiveDataTable->render('admin.accounts.list', ['title' => 'MANAGERS']);
		}
		return $dt->render('admin.accounts.list', [
			'decomDataTable' => $decomDataTable->with('status', 'decommission')->html(),
			'inactiveDataTable' => $inactiveDataTable->with('status', 'IN')->html(),
			'title' => 'MANAGERS',
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Account  $account
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $module, $id, ActivityLogDataTable $dt) {
		$account = Admin::withTrashed()->find($id);
		$previous_url = URL::previous();

		return $dt->with(['userid' => $id, 'module' => $module])->render('admin.accounts.view', [
			'account' => $account,
			'module' => $module,
			'title' => 'View Manager',
			'previous_url' => $previous_url,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Account  $account
	 * @return \Illuminate\Http\Response
	 */
	public function status($id) {
		$account = Admin::find($id);
		$account->status = $account->status == 'AC' ? 'IN' : 'AC';
		$account->save();
		$previous_url = URL::previous();

		session()->flash('success', 'Account ' . ($account->status == 'AC' ? 'activated' : 'deactivated') . ' successfully!');
		return redirect(url($previous_url));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Account  $account
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$account = Admin::find($id);
		$account->status = 'DL';
		$account->save();
		$previous_url = URL::previous();

		$account->delete();
		session()->flash('success', 'Account deleted successfully!');
		return redirect(url($previous_url));
	}
}
