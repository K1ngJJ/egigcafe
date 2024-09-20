@extends(( !Auth::check() || auth()->user()->role == 'customer' ) ? 'layouts.app' : 'layouts.backend' )

@section('links')
<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'menu' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')

<style>
.btn-dark {
    background-color: black;
    color: white;
} 

.btn-dark:hover {
    background-color: white;
    color: black;
} 

.btn-success {
    background-color: black;
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}
.gradient-hr {
    border: none; /* Remove default border */
    height: 8px; /* Increase height for a bolder appearance */
    background: linear-gradient(to right, #000000, #FF4500, #dc3545); /* Increase contrast by using a more intense orange */
    border-radius: 8px; /* Keep the rounded edges */
}

.border-gradient {
    border-image: linear-gradient(to right, black, #FF8C00, #dc3545)1;
}

</style>
@if (Auth::check() && auth()->user()->role != 'customer')
<section class="menu" style="margin-top: 15vh;">
@else
<section class="menu" style="margin-top: 20vh;">
@endif
    <div class="container">
    <table class="table table-hover">
        <div class="col-12 pt-3 h-100 shadow rounded bg-white ">
            <h6 class="d-flex justify-content-center menu-title ">OUR MENU</h2>
            <br>
        </div>
    </table>
        @if (session('success'))
        <div class="alert alert-success fixed-bottom" role="alert" style="width:500px;left:30px;bottom:20px">
            {{ session('success') }}
        </div>
        @endif
 <hr class="my-2 gradient-hr">
    <div class="row menu-bar">
        @if (Auth::check() && auth()->user()->role != 'customer')
            <div class="col-md-2 d-flex align-items-center">
                <div class="dropstart">    
                    <button type="button" class="btn btn-success" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu p-3" style="width: 100%; max-width: 350px; min-width: 290px;">    
                        <form method='post' action="{{ route('saveMenuItem') }}" enctype="multipart/form-data" class="px-4 py-3">
                            @csrf
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="item-image" class="form-label">Item Image</label>
                                        <input name="menuImage" class="form-control" type="file" id="item-image" required>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                                            <select name="menuType" class="form-select" id="itemTypeInputGroup">
                                                <option value="Silog">Silog</option>
                                                <option value="Sandwich">Sandwich</option>
                                                <option value="Burger">Burger</option>
                                                <option value="Pasta">Pasta</option>
                                                <option value="Snacks">Snacks</option>
                                                <option value="Milk Tea">Milk Tea</option>
                                                <option value="Fruit Tea">Fruit Tea</option>
                                                <option value="Etc.">Etc.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemName" class="form-label">Item Name</label>
                                        <input name="menuName" type="text" class="form-control" placeholder="Name" aria-label="Item Name" required>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemPrice" class="form-label">Item Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input name="menuPrice" type="number" min="0" step="0.01" class="form-control" placeholder="Price" aria-label="Item Price" required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemEstCost" class="form-label">Item Estimated Cost</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input name="menuEstCost" type="number" min="0" step="0.01" class="form-control" placeholder="Cost" aria-label="Item Cost" required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemDescription" class="form-label">Item Description</label>
                                        <textarea name="menuDescription" class="form-control" placeholder="Description" aria-label="Item Description" required></textarea>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="itemSizeInputGroup" class="form-label">Portion</label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="itemSizeInputGroup">Size:</label>
                                            <select name="menuSize" class="form-select" id="itemSizeInputGroup">
                                                <option value="1-2">1 - 2 People</option>
                                                <option value="3-4">3 - 4 People</option>
                                                <option value=">5">More than 5 People</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="specialCondition" class="form-label">Special Condition</label>
                                        <div class="form-check">
                                            <input name="menuAllergic" type="hidden" value="0">
                                            <input name="menuAllergic" value="1" type="checkbox" class="form-check-input" id="allergicCheck">
                                            <label class="form-check-label" for="allergicCheck">
                                                Allergic
                                            </label>
                                            <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                            <label class="form-check-label" for="dropdownCheck">
                                            Allergic
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="menuVegetarian" type="hidden" value="0">
                                            <input name="menuVegetarian" value="1" type="checkbox" class="form-check-input" id="vegetarianCheck">
                                            <label class="form-check-label" for="vegetarianCheck">
                                                Vegetarian
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="menuVegan" type="hidden" value="0">
                                            <input name="menuVegan" value="1" type="checkbox" class="form-check-input" id="veganCheck">
                                            <label class="form-check-label" for="veganCheck">
                                                Vegan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="dropdown-divider"></div>
                            
                                <button type="submit" class="btn btn-outline-success">Add Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    
        <div class="col-md-12 text-center">
            <form method="get" action="{{ route('filterMenu') }}" class="d-flex flex-wrap justify-content-center">
                <button type="submit" name="menuType" value="" class="btn btn-light menu-type-button mx-1 my-1">All</button>
                <button type="submit" name="menuType" value="Silog" class="btn btn-light menu-type-button mx-1 my-1">Silog</button>
                <button type="submit" name="menuType" value="Sandwich" class="btn btn-light menu-type-button mx-1 my-1">Sandwich</button>
                <button type="submit" name="menuType" value="Burger" class="btn btn-light menu-type-button mx-1 my-1">Burger</button>
                <button type="submit" name="menuType" value="Pasta" class="btn btn-light menu-type-button mx-1 my-1">Pasta</button>
                <button type="submit" name="menuType" value="Snacks" class="btn btn-light menu-type-button mx-1 my-1">Snacks</button>
                <button type="submit" name="menuType" value="Milk Tea" class="btn btn-light menu-type-button mx-1 my-1">Milk Tea</button>
                <button type="submit" name="menuType" value="Fruit Tea" class="btn btn-light menu-type-button mx-1 my-1">Fruit Tea</button>
                <button type="submit" name="menuType" value="Etc." class="btn btn-light menu-type-button mx-1 my-1">Etc.</button>
            </form>
        </div>
     <hr class="my-2 gradient-hr">

       <div class="col-md-12 d-flex align-items-center">
        <div class="dropstart w-100 d-flex justify-content-end">    
            <button type="button" class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="filter-button">
                Filter <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu p-3" style="width: 80%; max-width: 300px; min-width: 200px;">
                <form method="get" action="{{ route('filterMenu') }}" class="row g-2">
                    <div class="col-12">
                        <label for="itemTypeInputGroup" class="form-label">Item Type</label>
                        <div class="input-group">
                            <label class="input-group-text" for="itemTypeInputGroup">Type:</label>
                            <select name="menuType" class="form-select" id="itemTypeInputGroup">
                                <option value="">All</option>
                                <option value="Silog">Silog</option>
                                <option value="Sandwich">Sandwich</option>
                                <option value="Burger">Burger</option>
                                <option value="Pasta">Pasta</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Milk Tea">Milk Tea</option>
                                <option value="Fruit Tea">Fruit Tea</option>
                                <option value="Etc.">Etc.</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="priceRangeInputGroup" class="form-label">Price Range</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input name="fromPrice" type="number" class="form-control" placeholder="Min" aria-label="From Price">
                            <span class="input-group-text">to</span>
                            <input name="toPrice" type="number" class="form-control" placeholder="Max" aria-label="To Price">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="sizeInputGroup" class="form-label">Portion</label>
                        <div class="input-group">
                            <label class="input-group-text" for="sizeInputGroup">Size:</label>
                            <select name="menuSize" class="form-select" id="sizeInputGroup">
                                <option value="">All</option>
                                <option value="1-2">1 - 2 People</option>
                                <option value="3-4">3 - 4 People</option>
                                <option value=">5">More than 5 People</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <label for="specialConditionInputGroup" class="form-label">Special Condition</label>
                        <div class="form-check">
                             <input name='menuAllergic' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Allergic
                                    </label>
                        </div>
                        <div class="form-check">
                            <input name='menuVegetarian' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegetarian
                                    </label>
                        </div>
                        <div class="form-check">
                           <input name='menuVegan' value=1 type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                    Vegan
                                    </label>
                        </div>
                    </div>
    
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark w-100">Apply Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="d-flex flex-wrap mt-2 mb-5">
        @forelse ($menus as $menu)
            
            <div class="card col-md-3 col-6 d-flex align-items-center">
                <div class="card-body w-100">
                    <form class="d-flex flex-column justify-content-between h-100" action="{{ route('addToCart') }}" method="post">
                        @csrf
                        <div class="flex-center">
                            <img class="card-img-top menuImage" src="{{ asset('menuImages/' . $menu->image) }}">
                        </div>

                        <h5 class="card-title mt-3">
                            {{ $menu->name }} 
                        </h5>
                        
                        <h6 class="card-subtitle mb-2 text-muted">{{ $menu->description }}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">For {{ $menu->size }} people</h6>
                        
                        <div class="d-flex justify-content-between">
                            <p class="card-text fs-5 fw-bold">₱ {{ number_format($menu->price, 2) }}</p>
                            <h6 class="card-text flex-center">
                                @if($menu->allergic)
                                <i class="fa fa-exclamation-circle allergic-alert" aria-hidden="true" data-bs-toggle="tooltip" title="Allergic Warning"></i>
                                @endif

                                @if($menu->vegan)
                                <i class="fa fa-tree" aria-hidden="true" data-bs-toggle="tooltip" title="Vegan Friendly"></i>
                                @elseif($menu->vegetarian)
                                <i class="fa fa-leaf" aria-hidden="true" data-bs-toggle="tooltip" title="Vegetarian Friendly"></i>
                                @endif
                            </h6>
                        </div>

                        <input name="menuID" type="hidden" value="{{ $menu->id }}">
                        <input name="menuName" type="hidden" value="{{ $menu->name }}">
                        @if (Auth::check())
                            @if (auth()->user()->role == 'customer')
                                <button type="submit" class="primary-btn w-100 mt-3">Add to Cart</button>
                            @else
                                <div class="dropdown w-100 mt-3">
                                    <a href="#" role="button" id="dropdownMenuLink" 
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <button class="primary-btn w-100">Edit</button>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href={{"./editMenuImages/".$menu['id']}}>Edit Images</a></li>
                                        <li><a class="dropdown-item" href={{"./editMenuDetails/".$menu['id']}}>Edit Details</a></li>
                                        <li><a class="dropdown-item" href={{"./delete/".$menu['id']}}>Delete</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        
        @empty
        <div class="row">
            <div class="col-12">
                <h1>No result found... <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
            </div>
        </div>
        @endforelse
        </div>
    </div>
</section>
@endsection