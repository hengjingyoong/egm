<?php

namespace App\Http\Controllers\system_admin;

use App\Http\Controllers\Controller;
use App\Models\Counselor;
use App\Models\SchoolAdmin;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    /**
     * AccountManagerController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show list of all school admin accounts.
     * Redirect users back to their page if they are not system admin.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function admin_acc_index(Request $request)
    {
        $notification = $this->checkUser('system_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }
        // If system admin got search something
        if(isset($request->keyword) || isset($request->search_status))
        {
            $keyword = $request->keyword;
            // If system admin want to view all admin accounts
            if($request->search_status == 'all'){
                $admins = SchoolAdmin::join('users', 'users.id', '=', 'school_admins.user_id')
                    ->orwhere('school_admins.school_name', 'like', '%' . $keyword . '%')
                    ->orwhere('users.email', 'like', '%' . $keyword . '%')
                    ->select('*','school_admins.id as school_admin_id')
                    ->orderBy('school_admins.id', 'desc')
                    ->paginate(5);
            }// If system admin want to view active / inactive / rejected admin accounts
            else{
                $admins = SchoolAdmin::join('users', 'users.id', '=', 'school_admins.user_id')
                    ->where('school_admins.status', '=', $request->search_status)
                    ->where(function($query) use ($keyword) {
                        $query->orwhere('school_admins.school_name', 'like', '%' . $keyword . '%')
                            ->orwhere('users.email', 'like', '%' . $keyword . '%');
                    })
                    ->select('*','school_admins.id as school_admin_id')
                    ->orderBy('school_admins.id', 'desc')
                    ->paginate(5);
            }
            return view('system_admin.account_manager.admin_index')->withAdmins($admins);
        }
        // system admin no searching anything
        $admins = SchoolAdmin::join('users', 'users.id', '=', 'school_admins.user_id')
            ->select('*','school_admins.id as school_admin_id')
            ->orderBy('school_admins.id', 'desc')
            ->paginate(5);
        return view('system_admin.account_manager.admin_index')->withAdmins($admins);
    }

    /**
     * Update counselor account status.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function counselor_acc_update(Request $request, $id)
    {
        $counselor = Counselor::find($id);

        $counselor->status = $request->status;
        switch($request->status)
        {
            case 'active':
                $action = 'approved';
                break;
            case 'inactive':
                $action = 'deactivated';
                break;
            case 'rejected':
                $action = 'rejected';
                break;
        }
        $counselor->save();

        $notification = array(
            'title' => 'Account Status Updated',
            'message' => 'You have ' . $action . ' the selected account!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update school admin account status.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function admin_acc_update(Request $request, $id)
    {
        $admin = SchoolAdmin::find($id);

        $admin->status = $request->status;
        switch($request->status)
        {
            case 'active':
                $action = 'approved';
                break;
            case 'inactive':
                $action = 'deactivated';
                break;
            case 'rejected':
                $action = 'rejected';
                break;
        }
        $admin->save();

        $notification = array(
            'title' => 'Account Status Updated',
            'message' => 'You have ' . $action . ' the selected account!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
