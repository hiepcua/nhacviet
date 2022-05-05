<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Menu;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menus;

    public function __construct()
    {
        $this->menus = new Menu();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách menu';
        $menus = $this->menus->getAll();
        return view('admin.menu.list', compact(
            'title',
            'menus'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm menu mới';
        $parent_menu = $this->menus->getParent();
        return view('admin.menu.add', compact(
            'title',
            'parent_menu'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        try {
            $dataInsert = [
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::of($request->input('name'))->slug('-'),
            ];

            $this->menus->create($dataInsert);
            session()->flash('success', 'Tạo danh mục thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Chỉnh sửa menu';
        $parent_menu = $this->menus->getParent();
        $menu = $this->menus->getOne($id);

        return view('admin.menu.edit', compact(
            'title',
            'parent_menu',
            'menu',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        if($id!=""){
            $result = $this->menus->delete($id);
            if($result){
                return response()->json([
                    'error' => false,
                    'message'=> 'Xóa thành công'
                ]);
            }else{
                return response()->json([
                    'error' => true,
                ]);
            }
        }else{
            return back()->width('error', 'Không tìm thấy đối tượng');
        }
    }
}
