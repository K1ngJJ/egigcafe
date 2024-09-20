<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PackageStatus;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Menu;
use App\Models\Rating;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\PackageStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    
    public function index()
{
    if (auth()->check()) {
        $user = Auth::user();
        $packages = $user->availablePackages()->get();
    } else {
        // If the user is not authenticated, you may choose to handle it differently,
        // such as redirecting them to the login page or showing a message.
        $packages = collect(); // Empty collection if the user is not authenticated
    }
    
    $services = Service::all();

    $serviceRatings = Rating::selectRaw('service_id, AVG(service_rating) as average_rating')
    ->groupBy('service_id')
    ->get()
    ->pluck('average_rating', 'service_id');
    
    return view('cservices.index', compact('packages', 'services', 'serviceRatings'));
}


    public function store(PackageStoreRequest $request)
    {
        $image = $request->file('image')->store('public/packages');
    
        $package = Package::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);
    
        if ($request->has('services')) {
            $package->services()->attach($request->services);
        }
    
        $firstServiceId = $package->services->first()->id;
    
        return redirect()->route('cservices.show', $firstServiceId)->with('success', 'Package created successfully.');
    } 

    public function show(Service $service)
    {
        // Get the authenticated user if available
        $user = Auth::user();

        // Fetch only the packages that are available for the given service
        $availablePackages = $service->packages()->where('status', PackageStatus::Available)->get();
        
        // Proceed with the rest of the logic
        $availablePackages = Package::where(function ($query) use ($user) {
                $query->whereNull('user_id'); // Packages without a user_id
                if ($user !== null) {
                    $query->orWhere('user_id', $user->id);
                }
            })
            ->whereHas('services', function ($query) use ($service) {
                $query->where('services.id', $service->id);
            })
            ->where('status', PackageStatus::Available)
            ->get();

            $packageRatings = Rating::selectRaw('package_id, AVG(package_rating) as average_rating')
            ->groupBy('package_id')
            ->get()
            ->pluck('average_rating', 'package_id');
        
        $menus = Menu::all();
        $services = Service::all(); 
        $selectedId = $service->id; 
        
        return view('cservices.show', compact('service', 'availablePackages', 'menus', 'services', 'selectedId', 'packageRatings'));
    }
    

    
    public function destroy(Package $package)
    {
        $firstServiceId = $package->services->first()->id;
    
        Storage::delete($package->image);
        $package->services()->detach();
        $package->delete();
    
        return redirect()->route('cservices.show', $firstServiceId)->with('danger', 'Package deleted successfully.');
    }
    
    
}

