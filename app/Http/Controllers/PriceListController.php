<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceList\StorePriceListRequest;
use App\Http\Requests\PriceList\UpdatePriceListRequest;
use App\Models\PriceList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PriceListController extends Controller
{

    public function index(Request $request): Response
    {
        $pricelists = PriceList::search($request->input('search'))
            ->paginate(4);
        return Inertia::render('PriceLists/Index', [
            'pricelists' => $pricelists,
            'request' => $request,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('PriceLists/Create');
    }

    public function store(StorePriceListRequest $request): RedirectResponse
    {
        PriceList::create($request->validated());
        return redirect()->route('pricelists.index');
    }

    public function show(PriceList $pricelist): Response
    {
        return Inertia::render('PriceLists/Show', [
            'pricelist' => $pricelist,
        ]);
    }

    public function edit(PriceList $pricelist): Response
    {
        return Inertia::render('PriceLists/Edit', [
            'pricelist' => $pricelist,
        ]);
    }
    public function update(UpdatePriceListRequest $request, PriceList $pricelist): RedirectResponse
    {
        $pricelist->update($request->validated());
        return redirect()->route('pricelists.index');
    }

    public function destroy(PriceList $pricelist): void
    {
        $pricelist->delete();
    }
}
