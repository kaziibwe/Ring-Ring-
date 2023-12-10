<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\advert;
use App\Models\product;
use App\Models\category;
use App\Models\orderitem;
use App\Models\sideadvert;
use App\Models\productsize;
use App\Models\subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{



    private function prepareCommonData()
    {
        $categories = category::with('subcategories.products')->get();

        foreach ($categories as $category) {
            foreach ($category->subcategories as $subcategory) {
                $subcategory->product_count = $subcategory->products->count();
                $subcategory->total_units = $subcategory->products->sum('numberunit');
                // foreach($subcategory->$products as $product)
            }
        }

        // $productcarts=product::load(['productsizes']);
        $featuredProducts = Product::where('featured', 'yes')->take(8)->get();
        $recentProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
        $shopProducts = Product::where('Active', 'yes')->orderBy('created_at', 'desc');
        $adverts = advert::get();
        $sideAdverts = sideadvert::get();
        return compact('categories', 'featuredProducts', 'recentProducts', 'adverts', 'sideAdverts', 'shopProducts');
    }



    // controller to go the profile user
    public function showUserProfile()
    {
        $data = $this->prepareCommonData();

        return view('front_end.front.customerprofile', array_merge($data));
    }



public function userOrders()
{
    $data = $this->prepareCommonData();

    // Get the authenticated user (assuming you are using Laravel's built-in authentication)
    $user = Auth::guard('customer')->user();
    if ($user) {
        // Use the authenticated user's ID to retrieve their delivery history
        $customerId = $user->id;
        // Retrieve the delivery history for the specific delivery man
        $customerOrders = DB::table('orders')
            ->where('customer_id', $customerId)
            ->orderBy('id', 'desc') // Order by the creation date in descending order
            ->paginate(5);
        // Pass the delivery history data to the view
                return view('front_end.front.viewordercustomer', array_merge($data, compact('customerOrders')));

    } else {
        // Redirect unauthorized users to a different page or show an error message
        return redirect('/login')->with('danger', 'Unauthorized access.');
    }
}

public function viewuserOrdersdetails(order $order)
{
    $data = $this->prepareCommonData();

    // Load the correct relationship for sizes
    $order->load(['orderitems']);
    // return view('front_end.front.viewordercustomer', compact('order'));
    return view('front_end.front.customerorderdetail', array_merge($data, compact('order')));

}
//  controller to view the order details by the customer




// use App\Models\Order; // Import your Order model

// public function viewOrderDetails($orderId)
// {
//     // Retrieve the order details based on the $orderId
//     $order = Order::find($orderId);

//     if (!$order) {
//         abort(404); // Order not found, you can handle this differently if needed
//     }

//     // Retrieve the related order items for this order
//     $orderItems = $order->orderItems;

//     // Pass the order and order items data to the view, including the $orderId
//     return view('front_end.front.viewordercustomer', [
//         'order' => $order,
//         'orderItems' => $orderItems,
//         'orderId' => $orderId,
//     ]);
// }

// public function viewOrderDetails(Order $order){
//     return view('front_end.front.viewordercustomer',['order'=>$order]);
// }



// public function userOrdersdetails(Request $request, $orderId)
// {
//         dd($orderId);
//     $data = $this->prepareCommonData();

//     // Retrieve the delivery history for the specific order ID
//     $customerOrdersDetails = DB::table('orderitems')
//         ->where('order_id', $orderId)
//         ->get();

//     // Pass the order details data to the view
//     // return view('front_end.front.viewordercustomer', compact('customerOrdersDetails'));
//     return view('front_end.front.customerorderdetail', array_merge($data, compact('customerOrdersDetails','orderId')));

// }



    // private function prepareCommonData()
    // {
    //     $categories = Category::with('subcategories.products.productsizes')->get();

    //     foreach ($categories as $category) {
    //         foreach ($category->subcategories as $subcategory) {
    //             $subcategory->product_count = 0;
    //             $subcategory->total_units = 0;
    //             $subcategory->total_reviews = 0; // New variable for counting reviews

    //             foreach ($subcategory->products as $product) {
    //                 $subcategory->product_count += $product->productsizes->count();
    //                 $subcategory->total_units += $product->productsizes->sum('numberunit');

    //                 // Count the total reviews for each product
    //                 // $subcategory->total_reviews += $product->reviews->count();
    //                 $subcategory->total_reviews += optional($product->reviews)->count() ?? 0;

    //             }
    //         }
    //     }

    //     $featuredProducts = Product::where('featured', 'yes')->take(8)->get();
    //     $recentProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
    //     $shopProducts = Product::where('Active', 'yes')->orderBy('created_at', 'desc')->get();
    //     $adverts = Advert::get();
    //     $sideAdverts = SideAdvert::get();

    //     return compact('categories', 'featuredProducts', 'recentProducts', 'adverts', 'sideAdverts', 'shopProducts');
    // }



    public function getProductModalData(Product $product)
    {
        // Load the correct relationship for sizes
        $product->load(['productsizes']);
        return view('front_end.front.product_modal_content', compact('product'));
    }



    //route do diplay the index page
    public function viewAll()
    {
        $data = $this->prepareCommonData();

        $topSideAdverts = $data['sideAdverts']->take(2);
        $middleSideAdverts = $data['sideAdverts']->skip(2)->take(2);
        $bottomSideAdverts = $data['sideAdverts']->skip(4);

        return view('front_end.front.index', array_merge($data, compact('topSideAdverts', 'middleSideAdverts', 'bottomSideAdverts')));
    }

    // controller to shop all category page
    public function viewShop()
    {
        $data = $this->prepareCommonData();
        $shopProducts = Product::where('Active', 'yes')->orderBy('created_at', 'desc')->paginate(16);
        return view('front_end.front.shopProduct', array_merge($data, compact('shopProducts')));
    }


    //     public function showDetails(product $product){
    //         $data = $this->prepareCommonData();
    //     $products = product::with('productgalleries')->get();
    // return view('front_end.front.productdetail', array_merge($data, compact('productgalleries')),[
    //             'product' => $product
    //         ]);

    //     }

    // controller to show details
    public function showDetails(Product $product)
    {
        $data = $this->prepareCommonData();
        // Load the related galleries for the product
        $product->load('productgalleries');
        return view('front_end.front.productdetail', array_merge($data, [
            'product' => $product
        ]));
    }


    // controller to  show the products with its related productgallery
    public function showDetail(product $product)
    {
        return view('front_end.front.productdetail', [
            'product' => $product
        ]);
    }


    //  controller to dispay the category page

    public function viewCategory(category $category)
    {
        $data = $this->prepareCommonData();

        $selectedCategory = $category->load('subcategories.products');
        $bottomSideAdverts = $data['sideAdverts']->skip(4);

        return view('front_end.front.categorypage', array_merge($data, compact('selectedCategory', 'bottomSideAdverts')));
    }

    //  controller to dispay the product page

    public function viewProduct(subcategory $subcategory, category $category)
    {
        $data = $this->prepareCommonData();

        $selectedsubcategories = $subcategory->load('products');
        $selectedCategory = $category->load('subcategories.products');
        $bottomSideAdverts = $data['sideAdverts']->skip(4);

        return view('front_end.front.productpage', array_merge($data, compact('selectedsubcategories', 'bottomSideAdverts')));
    }





    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $selectionType = $request->input('selection_type');

        $cart = session()->get('cart', []);
        switch ($selectionType) {
            case 'both':
                // Handle both size and color selection
                // Get the selected sizes and colors from the form
                $selectedSizes = $request->input('selected_sizes');
                $selectedColors = $request->input('selected_colors');

                if (empty($selectedSizes)) {
                    // Handle the case where no sizes are selected, you can return a response or redirect as needed
                    return redirect()->back()->with('modal_message', 'Please select at least one size and one color.');
                }

                // Initialize an array to store cart items

                // Loop through the selected sizes and add them to the cart as separate items
                foreach ($selectedSizes as $sizeId) {
                    $size = Productsize::findOrFail($sizeId);

                    // Create a unique identifier for each cart item based on product ID and size ID
                    $cartItemId = $id . '_' . $sizeId;

                    if (!isset($cart[$cartItemId])) {
                        $cart[$cartItemId] = [
                            "product_name" => $product->name,
                            "photo" => $product->image,
                            "supplierId" => $product->supplier_id,

                            "price" => $size->itemprice,
                            "item_price" => $size->itemprice,
                            "item_sizes" => $size->itemsizes,
                            "item_colors" => isset($selectedColors[$sizeId]) ? $selectedColors[$sizeId] : [], // Assign selected colors or empty array
                            "quantity" => 1,
                            "total_price" => $size->itemprice,
                        ];
                    } else {
                        // If the item already exists, update the colors if selected
                        if (isset($selectedColors[$sizeId])) {
                            $cart[$cartItemId]['item_colors'] = $selectedColors[$sizeId];
                        }
                        $cart[$cartItemId]['quantity']++;
                        $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price'];
                    }
                }

                break;
            case 'size':
                // Handle only size selection
                // Get the selected sizes from the form
                $selectedSizes = $request->input('selected_sizes');

                if (empty($selectedSizes)) {
                    // Handle the case where no sizes are selected, you can return a response or redirect as needed
                    return redirect()->back()->with('modal_message', 'Please select at least one size.');
                }

                // Initialize an array to store cart items

                // Loop through the selected sizes and add them to the cart as separate items
                foreach ($selectedSizes as $sizeId) {
                    $size = Productsize::findOrFail($sizeId);

                    // Create a unique identifier for each cart item based on product ID and size ID
                    $cartItemId = $id . '_' . $sizeId;

                    if (isset($cart[$cartItemId])) {
                        // If the item with the same size already exists, just update the quantity
                        $cart[$cartItemId]['quantity']++;
                        $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price'];
                    } else {
                        // Otherwise, add a new cart item
                        $cart[$cartItemId] = [
                            "product_name" => $product->name,
                            "photo" => $product->image,
                            "supplierId" => $product->supplier_id,

                            "price" => $size->itemprice,
                            "item_price" => $size->itemprice,
                            "item_sizes" => $size->itemsizes,
                            "quantity" => 1,
                            "total_price" => $size->itemprice,
                        ];
                    }
                }
                break;
                // Handle only color selection
                // Handle only color selection
            case 'color':
                // Handle only color selection
                $selectedColors = $request->input('selected_colors');

                if (empty($selectedColors)) {
                    // Handle the case where no colors are selected, you can return a response or redirect as needed
                    return redirect()->back()->with('modal_message', 'Please select at least one Color.');
                }

                // Initialize an array to store cart items

                // Loop through the selected colors and add them to the cart as separate items
                foreach ($selectedColors as $colorName) {
                    // Create a unique identifier for each cart item based on product ID and color name
                    $cartItemId = $id . '_' . Str::slug($colorName); // Use Str::slug to create a valid identifier

                    if (isset($cart[$cartItemId])) {
                        // If the item with the same color already exists, just update the quantity
                        $cart[$cartItemId]['quantity']++;
                        $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price'];
                    } else {
                        // Otherwise, add a new cart item
                        $cart[$cartItemId] = [
                            "product_name" => $product->name,
                            "photo" => $product->image,
                            "supplierId" => $product->supplier_id,

                            "price" => $product->price, // Use the price from the "products" table or your color model if needed
                            "item_price" => $product->price, // You can adjust this based on your needs
                            "item_colors" => [$colorName], // Store the selected color(s)
                            "quantity" => 1,
                            "total_price" => $product->price // Initial total price
                        ];
                    }
                }
                break;


            case 'none':
                // Handle the case where neither size nor color is selected
                $cartItemId = $id;

                if (isset($cart[$cartItemId])) {
                    // If the product is already in the cart, just update the quantity
                    $cart[$cartItemId]['quantity']++;
                    $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price']; // Recalculate total price
                } else {
                    // If the product is not in the cart, add it with an initial quantity of 1
                    $cart[$cartItemId] = [
                        "product_name" => $product->name,
                        "photo" => $product->image,
                        "supplierId" => $product->supplier_id,
                        "price" => $product->price, // Use the price from the "products" table
                        // "item_price" => $product->productsizes->itemprice, // Use the item price from the related "productsizes"
                        "quantity" => 1,
                        "total_price" => $product->price // Initial total price
                    ];

                }

                break;
            default:
                // Handle any other cases or errors
                // ...  nothing is filled here

                break;
        }
// dd($cart);
        // Store the updated cart in the session
        session()->put('cart', $cart);

        return redirect()->back()->with('front_success', 'Product(s) added to cart successfully!');
    }

    //         // add to cart
    //   public function addToCart($id)
    //   {
    //       $product = Product::findOrFail($id);

    //       $cart = session()->get('cart', []);

    //       if(isset($cart[$id])) {
    //           $cart[$id]['quantity']++;
    //       }  else {
    //           $cart[$id] = [
    //               "product_name" => $product->name,
    //               "photo" => $product->image,
    //               "price" => $product->price,
    //               "colors"=>$product->colors,
    //               "colors"=>$product->productsizes->itemprice,
    //               "quantity" => 1
    //           ];
    //       }

    //       session()->put('cart', $cart);
    //       return redirect()->back()->with('front_success', 'Product add to cart successfully!');
    //   }



    // public function addToCart($id)
    // {
    //     $product = Product::findOrFail($id);

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         // If the product is already in the cart, just update the quantity
    //         $cart[$id]['quantity']++;
    //         $cart[$id]['total_price'] = $cart[$id]['quantity'] * $cart[$id]['price']; // Recalculate total price
    //     } else {
    //         // If the product is not in the cart, add it with an initial quantity of 1
    //         $cart[$id] = [
    //             "product_name" => $product->name,
    //             "photo" => $product->image,
    //             "price" => $product->price, // Use the price from the "products" table
    //             "colors" => $product->colors,
    //             "item_price" => $product->productsizes->itemprice, // Use the item price from the related "productsizes"
    //             "item_sizes" => $product->productsizes->itemsizes,// You can remove this line if not needed
    //             "quantity" => 1,
    //             "total_price" => $product->price // Initial total price
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('front_success', 'Product added to cart successfully!');
    // }





    // // THIS  IS THE  BEST FOR THE  COLOR
    // public function addToCart(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     // Get the selected sizes from the form
    //     $selectedSizes = $request->input('selected_sizes');

    //     if (empty($selectedSizes)) {
    //         // Handle the case where no sizes are selected, you can return a response or redirect as needed
    //         return redirect()->back()->with('front_error', 'Please select at least one size.');
    //     }

    //     // Initialize an array to store cart items
    //     $cart = session()->get('cart', []);

    //     // Loop through the selected sizes and add them to the cart as separate items
    //     foreach ($selectedSizes as $sizeId) {
    //         $size = ProductSize::findOrFail($sizeId);

    //         // Create a unique identifier for each cart item based on product ID and size ID
    //         $cartItemId = $id . '_' . $sizeId;

    //         if (isset($cart[$cartItemId])) {
    //             // If the item with the same size already exists, just update the quantity
    //             $cart[$cartItemId]['quantity']++;
    //             $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price'];
    //         } else {
    //             // Otherwise, add a new cart item
    //             $cart[$cartItemId] = [
    //                 "product_name" => $product->name,
    //                 "photo" => $product->image,
    //                 "price" => $size->itemprice,
    //                 "colors" => $product->colors,
    //                 "item_price" => $size->itemprice,
    //                 "item_sizes" => $size->itemsizes,
    //                 "quantity" => 1,
    //                 "total_price" => $size->itemprice
    //             ];
    //         }
    //     }
    // dd($cart);
    //     // Store the updated cart in the session
    //     session()->put('cart', $cart);

    //     return redirect()->back()->with('front_success', 'Product(s) added to cart successfully!');
    // }









    // // THIS IS THE BEST OF THE BEST
    // public function addToCart(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     // Get the selected sizes and colors from the form
    //     $selectedSizes = $request->input('selected_sizes');
    //     $selectedColors = $request->input('selected_colors');

    //     if (empty($selectedSizes)) {
    //         // Handle the case where no sizes are selected, you can return a response or redirect as needed
    //         return redirect()->back()->with('front_error', 'Please select at least one size.');
    //     }

    //     // Initialize an array to store cart items
    //     $cart = session()->get('cart', []);

    //     // Loop through the selected sizes and add them to the cart as separate items
    //     foreach ($selectedSizes as $sizeId) {
    //         $size = ProductSize::findOrFail($sizeId);

    //         // Create a unique identifier for each cart item based on product ID and size ID
    //         $cartItemId = $id . '_' . $sizeId;

    //         if (!isset($cart[$cartItemId])) {
    //             $cart[$cartItemId] = [
    //                 "product_name" => $product->name,
    //                 "photo" => $product->image,
    //                 "price" => $size->itemprice,
    //                 "item_price" => $size->itemprice,
    //                 "item_sizes" => $size->itemsizes,
    //                 "item_colors" => isset($selectedColors[$sizeId]) ? $selectedColors[$sizeId] : [], // Assign selected colors or empty array
    //                 "quantity" => 1,
    //                 "total_price" => $size->itemprice,
    //             ];
    //         } else {
    //             // If the item already exists, update the colors if selected
    //             if (isset($selectedColors[$sizeId])) {
    //                 $cart[$cartItemId]['item_colors'] = $selectedColors[$sizeId];
    //             }
    //             $cart[$cartItemId]['quantity']++;
    //             $cart[$cartItemId]['total_price'] = $cart[$cartItemId]['quantity'] * $cart[$cartItemId]['price'];
    //         }
    //     }
    // // dd($cart);
    //     // Store the updated cart in the session
    //     session()->put('cart', $cart);

    //     return redirect()->back()->with('front_success', 'Product(s) added to cart successfully!');
    // }










    // public function addToCart(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $cart = session()->get('cart', []);

    //     // Get the selected sizes and their corresponding item prices from the form
    //     $selectedSizes = $request->input('selected_sizes');

    //     if (isset($cart[$id])) {
    //         // If the product is already in the cart, just update the quantity
    //         $cart[$id]['quantity']++;
    //         $cart[$id]['total_price'] = $cart[$id]['quantity'] * $cart[$id]['price']; // Recalculate total price
    //     } else {
    //         // If the product is not in the cart, add it with an initial quantity of 1
    //         $cart[$id] = [
    //             "product_name" => $product->name,
    //             "photo" => $product->image,
    //             "price" => $product->price, // Use the price from the "products" table
    //             "colors" => $product->colors,
    //             "item_price" => $product->productsizes->first()->itemprice, // Use the item price from the related "productsizes"
    //             "selected_sizes" => $selectedSizes, // Include selected sizes
    //             "item_sizes" => $product->productsizes->pluck('itemsizes')->toArray(), // Include all item sizes
    //             "quantity" => 1,
    //             "total_price" => $product->price // Initial total price
    //         ];
    //     }
    // dd($cart);
    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('front_success', 'Product added to cart successfully!');
    // }


    // public function addToCart(Request $request)
    // {
    //     $productId = $request->input('product_id');
    //     $product = Product::findOrFail($productId);

    //     $selectedSizes = $request->input('selected_sizes', []);

    //     if (empty($selectedSizes)) {
    //         return redirect()->back()->with('front_error', 'Please select at least one size');
    //     }

    //     $cart = session()->get('cart', []);

    //     // Add the product to the cart (similar to what you did in your previous code)
    //     // You can adjust this logic based on your requirements

    //     // Add the selected sizes to the cart (modify this logic based on your requirements)
    //     foreach ($selectedSizes as $sizeId) {
    //         $size = productsize::find($sizeId);
    //         if ($size) {
    //             $cartItem = [
    //                 "product_name" => $product->name,
    //                 "photo" => $product->image,
    //                 "price" => $product->price, // Use the price from the "products" table
    //                 "colors" => $product->colors,
    //                 "item_price" => $size->itemprice, // Use the item price from the selected size
    //                 "item_sizes" => $size->itemsizes, // Include the selected size
    //                 "quantity" => 1,
    //                 "total_price" => $size->itemprice // Initial total price based on the selected size
    //             ];

    //             // Generate a unique key for the cart item (you can use a combination of product ID and size ID)
    //             $cartItemId = $productId . '-' . $sizeId;

    //             $cart[$cartItemId] = $cartItem;
    //         }
    //     }

    //     // Save the updated cart to the session
    //     session()->put('cart', $cart);

    //     return redirect()->back()->with('front_success', 'Sizes added to cart successfully');
    // }



    //   public function cart(){
    //     $data = $this->prepareCommonData();
    //       return view('front_end.front.cart', array_merge($data));
    //   }

    public function cart()
    {

        $data = $this->prepareCommonData();
        // Retrieve cart data from the session
        $cart = session('cart', []);
        $productId = 'id'; // Replace with the actual product ID you want to retrieve
        $product = Product::find($productId); // Replace with your actual product retrieval logic

        // Pass the data to the view, including the cart data
        return view('front_end.front.cart', array_merge($data, ['product' => $product, 'cart' => $cart]));
    }



    //   public function cart()
    // {
    //     $data = $this->prepareCommonData();
    //     $cart = session()->get('cart', []); // Get the cart data from the session
    //     return view('front_end.front.cart', array_merge($data, ['cart' => $cart]));
    // }



    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('front_success', 'Product successfully removed from the Cart!');
        }
    }



    // public function update(Request $request)
    // {
    //     $cart = session()->get('cart');

    //     if ($request->id && $request->quantity && isset($cart[$request->id])) {
    //         $cart[$request->id]['quantity'] = $request->quantity;
    //         session()->put('cart', $cart);
    //     }
    //     session()->flash('front_success', 'Cart successfully updated!');
    //     return redirect()->back();
    // }


    public function update(Request $request)
{
    $cart = session()->get('cart');

    if ($request->id && $request->quantity && isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
    }
    session()->flash('front_success', 'Cart successfully updated!');
    return redirect()->back();
}


    public function showsearchproductajax()
    {
        $products = product::select('name')->where('Active', 'yes')->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }
    // public function showsearchproduct(Request $request)
    // {
    //     $search_product = $request->product_name;

    //     if ($search_product != "") {
    //         $product = product::where("name", "LIKE", "%$search_product%")->first();

    //         if ($product) {
    //             return redirect('front_end/front/subcategories/'.$product->category->name.'/'.$product->name);
    //             // front_end/front/subcategories/{subcategory}/productpage'
    //         }
    //     } else {
    //         return redirect()->back();
    //     }
    // }

    public function showsearchproduct(Request $request)
{
    $search_product = $request->product_name;

    if ($search_product != "") {
        $product = product::where("name", "LIKE", "%$search_product%")->first();

        if ($product) {
            // Generate the URL using the named route and pass the product ID as a parameter
            return redirect()->route('front.productdetail', ['product' => $product->id]);
        }else{
            return redirect()->back()->with('danger','Product Not Available !!!');

        }
    } else {
        return redirect()->back();
    }
}


// public function showsearchproduct(Request $request)
// {
//     $search_product = $request->product_name;

//     if ($search_product != "") {
//         $product = product::where("name", "LIKE", "%$search_product%")->first();
//         $category = subcategory::where("name", "LIKE", "%$search_product%")->first();

//         switch (true) {
//             case $product != null:
//                 // If a product with the name is found, redirect to the product detail page
//                 return redirect()->route('front.productdetail', ['product' => $product->id]);
//             case $category != null:
//                 // If a category with the name is found, redirect to the product page
//                 return redirect()->route('front.productpage', [
//                     'subcategory' => $category->name,
//                     'product' => $search_product, // Use the search term as the product name
//                 ]);
//             default:
//                 // If neither a product nor a category was found, or if $search_product is empty, redirect back.
//                 return redirect()->back();
//         }
//     }

//     // If $search_product is empty, redirect back.
//     return redirect()->back();
// }

// public function showsearchproduct(Request $request)
// {
//     $search_product = $request->product_name;

//     if ($search_product != "") {
//         $product = product::where("name", "LIKE", "%$search_product%")->first();

//         if ($product) {
//             // Generate the URL using the named route and pass parameters
//             return redirect()->route('front.productpage', [
//                 'subcategory' => $product->category->name,
//                 'product' => $product->name,
//             ]);
//         }
//     } else {
//         return redirect()->back();
//     }
// }



    // // controller to check out
    // public function checkout(){
    //       $data = $this->prepareCommonData();
    //      return view('front_end.front.checkout', array_merge($data));
    // }

    // public function checkout(Request $request)
    // {
    //     $data = $this->prepareCommonData();
    //     // Retrieve the cart items from the request
    //     $cartItems = $request->input('cart_items', []);
    //     $user = auth()->user();

    //     // Pass the cart data to the checkout view
    //     return view('front_end.front.checkout', array_merge($data, ['cartItems' => $cartItems]));
    // }

    public function checkout(Request $request)
    {
        $data = $this->prepareCommonData();

        // Retrieve the cart items from the request
        $cartItems = $request->input('cart_items', []);
        $user = auth('customer')->user();

        foreach ($cartItems as &$cartItem) {
            if (!isset($cartItem['photo'])) {
                $cartItem['photo'] = $request->input('hidden_image', '../assets/img/profile-img.jpg'); // Replace 'default.jpg' with your default image path
            }
        }
        // Pass the manipulated data to the checkout view
        return view('front_end.front.checkout', array_merge($data, ['cartItems' => $cartItems, 'user' => $user,]));
    }

























































































































































































    // public function viewAll()
    // {

    //     $categories = category::with('subcategories.products')->get();

    //     foreach ($categories as $category) {
    //         foreach ($category->subcategories as $subcategory) {
    //             $subcategory->product_count = $subcategory->products->count();
    //             $subcategory->total_units = $subcategory->products->sum('numberunit');
    //         }
    //     }
    //     // Fetch featured products
    //     $featuredProducts = Product::where('featured', 'yes')->take(8)->get();
    //        // Fetch recently added products (example query)
    //        $recentProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
    //        $adverts = advert::get();

    //          // Fetch side advertisements
    //     $sideAdverts = sideadvert::get();

    //     // Separate the side adverts into different sections
    //     $topSideAdverts = $sideAdverts->take(2);
    //     $middleSideAdverts = $sideAdverts->skip(2)->take(2);
    //     $bottomSideAdverts = $sideAdverts->skip(4);


    //     return view('front_end.front.index', compact('categories', 'featuredProducts', 'recentProducts','adverts','topSideAdverts', 'middleSideAdverts', 'bottomSideAdverts'));
    // }





    // // CONTOLLER DISPLAY AT THE CATEGORY PAGE

    // public function viewCategory(category $category )
    // {
    //     $selectedCategory = $category->load('subcategories.products');

    //     $categories = category::with('subcategories.products')->get();


    //     foreach ($categories as $category) {
    //         foreach ($category->subcategories as $subcategory) {
    //             $subcategory->product_count = $subcategory->products->count();
    //             $subcategory->total_units = $subcategory->products->sum('numberunit');
    //         }
    //     }

    //     // Fetch featured products
    //     $featuredProducts = Product::where('featured', 'yes')->take(8)->get();
    //        // Fetch recently added products (example query)
    //        $recentProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
    //        $adverts = advert::get();
    //          // Fetch side advertisements
    //     $sideAdverts = sideadvert::get();
    //     // Separate the side adverts into different sections
    //     $bottomSideAdverts = $sideAdverts->skip(4);
    //     return view('front_end.front.categorypage', compact('categories', 'featuredProducts', 'recentProducts','adverts',
    //     'bottomSideAdverts','selectedCategory'));
    // }




    // public function viewProduct(subcategory $subcategory , category $category )
    // {


    //     $selectedsubcategories=$subcategory->load('products');
    //     $subcategories=subcategory::with('products')->get();

    //     $selectedCategory = $category->load('subcategories.products');

    //     $categories = category::with('subcategories.products')->get();


    //     foreach ($categories as $category) {
    //         foreach ($category->subcategories as $subcategory) {
    //             $subcategory->product_count = $subcategory->products->count();
    //             $subcategory->total_units = $subcategory->products->sum('numberunit');
    //         }
    //     }
    //     // Fetch featured products
    //     $featuredProducts = Product::where('featured', 'yes')->take(8)->get();
    //        // Fetch recently added products (example query)
    //        $recentProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
    //        $adverts = advert::get();
    //          // Fetch side advertisements
    //     $sideAdverts = sideadvert::get();
    //     // Separate the side adverts into different sections
    //     $bottomSideAdverts = $sideAdverts->skip(4);
    //     return view('front_end.front.productpage', compact('categories', 'featuredProducts', 'recentProducts','adverts',
    //     'bottomSideAdverts','selectedsubcategories'));
    // }
}
