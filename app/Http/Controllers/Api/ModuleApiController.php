<?php
namespace App\Http\Controllers\Api;

use App\Services\ModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleApiController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index()
    {
        $data = $this->moduleService->getAllModules();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $response = $this->moduleService->createModule($request);
        return response()->json($response);
    }

    public function edit(Request $request)
    {
        $response = $this->moduleService->editModule($request->id);
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $response = $this->moduleService->updateModule($request);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = $this->moduleService->deleteModule($id);
        return response()->json($response);
    }
}
