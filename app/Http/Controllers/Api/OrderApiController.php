<?php
namespace App\Http\Controllers\Api;

use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderApiController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $data = $this->orderService->getAllOrders();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = $this->orderService->showOrder($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $response = $this->orderService->createOrder($request);
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $response = $this->orderService->updateOrder($request);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = $this->orderService->deleteOrder($id);
        return response()->json($response);
    }
}
