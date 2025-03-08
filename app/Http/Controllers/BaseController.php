<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected function redirectResponse($result, $route = null)
    {
        if ($result['status']) {
            return redirect()->to($route ?? url()->previous())
                           ->with('success', $result['message']);
        }
        return redirect()->back()->with('error', $result['message']);
    }

    protected function viewResponse($view, $result, $extraData = [])
    {
        if (!$result['status']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return view($view, array_merge(
            ['data' => $result['data']], 
            $extraData
        ));
    }
} 