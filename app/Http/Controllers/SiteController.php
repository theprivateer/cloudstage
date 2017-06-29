<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSite;
use App\Jobs\UpdateRoute53;
use App\Notifications\SiteCreated;
use App\Site;
use App\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = \Auth::user()->sites;

        return view('site.index', compact('sites'));
    }

    public function create()
    {
        return view('site.create');
    }

    public function store(CreateSite $request)
    {
        $site = new Site($request->except(['_token']));

        \Auth::user()->sites()->save($site);

        dispatch(new UpdateRoute53($site));

        $me = User::find(1);

        $me->notify(new SiteCreated($site));

        return redirect()->route('site.index');
    }

    public function edit($uuid)
    {
        $site = Site::where('uuid', $uuid)->where('user_id', \Auth::user()->id)->firstOrFail();

        return view('site.edit', compact('site'));
    }

    public function update(Request $request, $uuid)
    {
        $site = Site::where('uuid', $uuid)->where('user_id', \Auth::user()->id)->firstOrFail();

        $site->fill($request->except(['_token']));

        $site->save();

        dispatch(new UpdateRoute53($site));

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $site = Site::where('uuid', $request->get('uuid'))->where('user_id', \Auth::user()->id)->firstOrFail();

        dispatch(new UpdateRoute53($site, 'DELETE'));

        return redirect()->route('site.index');
    }
}
