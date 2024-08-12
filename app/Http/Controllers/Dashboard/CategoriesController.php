<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cateogry;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CateogryRequest;
use Illuminate\Pagination\Paginator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $query = Cateogry::query();

        //$categories = $query->paginate(3);
        $categories = Cateogry::with('parent')
        // leftjoin('categories as parents', 'parents.id' , '=' , 'categories.parent_id')
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        // ])
        //->select('categories.*')
       // ->selectRaw('(SELECT COUNT(*) FROM products WHERE cateogry_id = categories.id) as products_count')
        ->withCount([
        'products as products_number' => function($query){
            $query->where('status' ,'=','active');
        }
        ])
        ->Filter($request->query())
        ->orderBy('categories.name')
        ->paginate();
        return view('Categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $parents = Cateogry::all();
        $cateogry = new Cateogry();
        return view('Categories.create',compact('parents','cateogry'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CateogryRequest $request)
    {
        $request->validate(Cateogry::rules(),[
            'required' => 'this field (:attribute) is required',
            'unique' => 'this is name  is already exists!',

        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        

        $cateogry = Cateogry::create($data);
        session()->flash('add','success');
        return redirect('dashboard/categories');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cateogry $category)
    {
        return view('Categories.show',[
            'cateogry' => $category
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cateogry = Cateogry::findOrfail($id);
        // if(!$cateogry){
        //     abort(404);
        // }
        $parents = Cateogry::where('id','<>',$id)->where(function($query)use($id){
            $query->whereNull('parent_id')
            ->orwhere('parent_id','<>',$id);
        })->get();
        return view('categories.edit',compact('cateogry','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,archived',
            'image'  => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
            'parent_id' => 'nullable|int|exists:categories,id',
       ] );

        $cateogry = Cateogry::findOrfail($id);
        $old_image = $cateogry->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);
        if($new_image){
        $data['image'] = $new_image;
        }
        $cateogry->update($data);
        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }
        session()->flash('updated','updated ');
        return redirect('dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cateogry $cateogry)
    {
        //$cateogry = Cateogry::findOrfail($id);
        $cateogry->delete();
        
        // if($cateogry->image){
        //     Storage::disk('public')->delete($cateogry->image);
        // }
       // Cateogry::destroy($id);
        session()->flash('delete','deleted');
        return redirect('dashboard/categories');
    }

    protected function uploadImage(Request $request){
        if(!$request->hasFile('image')){
             return;
        }
            $file = $request->file('image');
            $path = $file->store('uploads',[
                'disk' => 'public'
            ]);

            return $path;
    }

    public function trash()
    {
        $categories = Cateogry::onlyTrashed()->paginate();
        return view('Categories.trash',compact('categories'));
    }

    public function restore(Request $request,$id)
    {
        $Cateogry = Cateogry::onlyTrashed()->findOrFail($id);
        $Cateogry->restore();
        session()->flash('success','Cateogry Restore');
        return redirect('/dashboard/categories');  
    }

    public function forceDelete($id)
    {
        $Cateogry = Cateogry::onlyTrashed()->findOrFail($id);
        $Cateogry->forceDelete();
        session()->flash('success','Cateogry delete');
        return redirect('/dashboard/categories');  
    }
}
