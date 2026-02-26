<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benefit;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::orderBy('sort_order')->get();
        return view('admin.benefits', compact('benefits'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer|default:0',
        ]);
        
        Benefit::create($data);
        return redirect()->back()->with('success', 'Benefit added successfully.');
    }

    public function update(Request $request, Benefit $benefit)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $benefit->update($data);
        return redirect()->back()->with('success', 'Benefit updated successfully.');
    }

    public function destroy(Benefit $benefit)
    {
        $benefit->delete();
        return redirect()->back()->with('success', 'Benefit deleted.');
    }
}
