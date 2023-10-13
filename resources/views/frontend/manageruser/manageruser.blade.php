@extends('frontend/layouts.master')

@section('title')
<title>manageruser page</title>
@endsection

@section('content')
<!--=======Page Content Area=========-->
<main id="pageContentArea">
    <!--========================================
        Page Head
        ===========================================-->
    <div class="page-head text-center">
        <div class="blog-main-slider" style="background-image: radial-gradient(circle, #7ca3dc, #1e71de);">
            <div class="overlay"></div>
            <div class="container">
                <h2>QUẢN LÍ TÀI KHOẢN</h2>
                <p>Hiển thị thông tin tài khoản và các thông tin khác.</p>
            </div>
        </div>
    </div>
    <!--========================================
        grid and list view
        ===========================================-->
    <div class="container">
        <div class="product-overview pt-50 pb-50 fix_pading">
            <div class="row">
                <div class="col-xs-12 col-sm-3 hidden-xs">
                    @include('frontend.manageruser.components.sidebar')
                </div>
                <div class="col-xs-12 col-sm-9">
                    <header class="sec-heading style text-center fix_secheading">
                        <div class="category-wrap">
                            <span class="categorise wrap_text-center" style="font-size: 20px;
    font-weight: 700;">Thông tin cá nhân</span>
                        </div>
                    </header>
                    <div class="wrap_informaiton">
                        <div class="avatar_block">

                        </div>

                        <div class="wrap_text-center">
                            <div class="info-list">
                                <div class="item-info">
                                    <span class="text_item-info">Họ và tên</span>
                                    <span class="text_item-info">{{Auth::user()->name}}</span>
                                </div>
                                <div class="item-info">
                                    <span class="text_item-info">Email</span>
                                    <span class="text_item-info">{{Auth::user()->email}}</span>
                                </div>
                                <div class="item-info">
                                    <span class="text_item-info">Phone</span>
                                    <span class="text_item-info">{{Auth::user()->phone}}</span>
                                </div>
                                <div class="item-info">
                                    <span class="text_item-info">Ngày sinh</span>
                                    <span class="text_item-info"><a style="text-decoration: none" href="#">Thêm thông tin</a></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn_location">Chỉnh sửa thông tin</button>

                    </div>
              {{--      form chỉnh sửa thng tin cá nhân--}}
                    <div class="table-data">
                        <div class="Create-product">
                            <form class="form_create"  method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="ProductId">Họ và tên</label>
                                    <input class="form-control" type="text" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="ProductName">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Phone</label>
                                    <input class="form-control" type="text" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="Description">Mật khẩu</label>
                                    <input class="form-control" type="text" id="password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="Description">Địa chỉ</label>
                                    <input class="form-control" type="text" id="address" name="address" required>
                                </div>

                                <button type="submit" class="Btn_create">Cập nhập thông tin</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div><!--row-->
        </div><!--product overview-->
    </div><!--container-->

</main><!--pageContentArea-->

@endsection
