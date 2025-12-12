<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Module;
use App\Http\Controllers\OrderController;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Display the about us page.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Display the modules page.
     */
    public function modules(Request $request): View
    {
        $search = $request->input('search');
        $query = Module::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $modules = $query->get();

        return view('modules', compact('modules', 'search'));
    }

    /**
     * Display the module detail page.
     */
    public function moduleDetail($id): View
    {
        // $id is the slug
        $module = Module::where('slug', $id)->firstOrFail();

        return view('module-detail', compact('module'));
    }

    /**
     * Add item to cart.
     */
    public function addToCart(Request $request)
    {
        try {
            // Validate required fields
            $request->validate([
                'module_id' => 'required|string',
                'module_name' => 'required|string',
                'module_type' => 'required|string',
                'module_image' => 'required|string',
                'module_fee' => 'required|string',
                'quantity' => 'required|integer|min:1'
            ]);

            // Get cart from session or create new array
            $cart = session('cart', []);

            // Convert fee string to numeric (remove commas)
            $feeNumeric = (float) str_replace(',', '', $request->module_fee);

            // Create cart item
            $cartItem = [
                'id' => $request->module_id,
                'name' => $request->module_name,
                'type' => $request->module_type,
                'image' => $request->module_image,
                'price' => $request->module_fee,
                'quantity' => (int) $request->quantity,
                'total' => $feeNumeric * (int) $request->quantity
            ];

            // Add to cart
            $cart[] = $cartItem;
            session(['cart' => $cart]);

            return redirect()->back()->with('success', 'Module is added to cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding item to cart: ' . $e->getMessage());
        }
    }

    /**
     * Display the cart page.
     */
    public function cart(): View
    {
        // Get cart from session
        $cartItems = session('cart', []);

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total'];
        }
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart($index)
    {
        $cart = session('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Re-index array
            session(['cart' => $cart]);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart successfully!');
    }


    /**
     * Display the checkout page.
     */
    public function checkout(): View
    {
        // Get cart from session
        $cartItems = session('cart', []);

        // Calculate totals
        $subtotal = 0;
        $maxQuantity = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['total'];
            $maxQuantity = max($maxQuantity, $item['quantity']);
        }
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax;

        return view('checkout', compact('cartItems', 'subtotal', 'tax', 'total', 'maxQuantity'));
    }

    /**
     * Process the checkout form submission.
     */
    public function processCheckout(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'participants' => 'required|array',
                'participants.*.name' => 'required|string|max:255',
                'participants.*.email' => 'required|email|max:255',
                'participants.*.mobile' => 'required|string|max:20',
                'participants.*.address' => 'required|string|max:500',
                'payment_method' => 'required|in:cash,card,online',
                'notes' => 'nullable|string|max:500'
            ]);

            // Get cart items
            $cartItems = session('cart', []);

            if (empty($cartItems)) {
                return redirect()->route('cart')->with('error', 'Your cart is empty!');
            }

            // Store participants in session temporarily (can be used later if needed)
            session(['checkout_participants' => $request->participants]);

            // Redirect to OrderController to create the order
            return app(OrderController::class)->store($request);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing checkout: ' . $e->getMessage());
        }
    }

}