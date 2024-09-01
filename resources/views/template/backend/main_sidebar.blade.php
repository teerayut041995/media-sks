<section class="sidebar">
    <?php
    if (Auth::user()->image != '') {
      $image_user = Auth::user()->image;
      $image_user = url("images/image_user/$image_user");
    } else {
      $image_user = url("images/image_default/no-profile.jpg");
    }
    ?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$image_user}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>จัดการข้อมูลผู้ดูแลระบบ</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/user')}}">ข้อมูลผู้ดูแลระบบ</a></li>
            <li><a href="{{url('administrator/user/create')}}">เพิ่มผู้ดูแลระบบ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>แบนเนอร์สไลด์</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/banner')}}">ข้อมูลแบนเนอร์สไลด์</a></li>
            <li><a href="{{url('administrator/banner/create')}}">เพิ่มแบนเนอร์สไลด์</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>ประเภทบทความ</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/category')}}">ข้อมูลประเภทบทความ</a></li>
            <li><a href="{{url('administrator/category/create')}}">เพิ่มประเภทบทความ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>ประเภทบทความย่อย</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/sub-category')}}">ข้อมูลประเภทบทความย่อย</a></li>
            <li><a href="{{url('administrator/sub-category/create')}}">เพิ่มประเภทบทความย่อย</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>บทความ</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/post')}}">บทความทั้งหมด</a></li>
            <li><a href="{{url('administrator/post/create')}}">เพิ่มบทความ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Video Live</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/media-embed')}}">Video Live ทั้งหมด</a></li>
            <li><a href="{{url('administrator/media-embed/create')}}">เพิ่ม Video Live</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>กิจกรรม</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('administrator/event')}}">กิจกรรมทั้งหมด</a></li>
            <li><a href="{{url('administrator/event/create')}}">เพิ่มกิจกรรม</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>