<?php

namespace App\Http\Controllers;

use App\Slide;

use App\Product;

use App\ProductType;

use App\Cart;

use App\Session;

use App\User;

use Hash;

use Auth;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getIndex()
    {
        $slide = Slide::all();       
        // return view('pages.trangchu',['slide'=>$slide]);
        $new_product = Product::where('new',1)->paginate(8);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
        return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai')); 
    }

    public function getLoaisp($type)
    {
        $sp_theoloai  = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
        return view('pages.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitiet(Request $req)
    {
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
        return view('pages.chitiet_sanpham',compact('sanpham','sp_tuongtu'));
    }

    public function getLienhe()
    {
        return view('pages.lienhe');
    }

    public function getGioithieu()
    { 
        return view('pages.gioithieu');
    }

    public function getAddtoCart(Request $req,$id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDangky()
    {
        return view('pages.dangky');
    }

    public function postDangky(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'
            ],[
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất phải 6 kí tự',
            ]);
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        // $user->phone = $req->phone;
        // $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function getDangnhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangnhap(Request $req)
    {
       $this->validate($req,
       [
           'email'=>'required|email',
           'password'=>'required|min:6|max:20'

       ],[
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất phải 6 kí tự',
            'password.max'=>'Mật khẩu không quá 20 kí tự'
       ]);
       $credentials = array('email'=>$req->email,'password'=>$req->password);
       if(Auth::attempt($credentials)){
           return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
       }
       else{
        return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
       }
    }

    public function getDathang()
    {
        return view('pages.dathang');
    }

    public function getSearch(Request $req)
    {
        $product = Product::where('name','like','%'.$req->key.'%')
                            ->orwhere('unit_price',$req->key)
                            ->get();
        return view('pages.search',compact('product'));
    }

    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('trangchu');
    }
}
