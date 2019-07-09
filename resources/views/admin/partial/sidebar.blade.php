<style type="text/css">
    #sidebar{
        background-color: #3f9ae5;
    }
</style>
<div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5; width: 20%" id="mySidebar">
    <h3 style="text-align: center; background-color: #6c757d; border: 1px solid" class="w3-bar-item">Menu</h3>
    <a style="text-align: center" href="#" class="w3-bar-item w3-button">Sách</a>
    <a style="text-align: center" href="{{route('author.index')}}" class="w3-bar-item w3-button">Tác giả</a>
    <a style="text-align: center" href="#" class="w3-bar-item w3-button">Tài khoản</a>
    <a style="text-align: center" href="#" class="w3-bar-item w3-button">Thùng rác</a>
</div>
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div>
    <button class="w3-button w3-white w3-xxlarge" onclick="w3_open()">&#9776;</button>
</div>

