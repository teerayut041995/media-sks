<div class="row align-items-center justify-content-between d-flex" style="font-family: 'Prompt', sans-serif;">
			      <div id="logo">
			        <a href="{{url('/')}}"><img src="{{asset('template/frontend/img/logo.png')}}" alt="ศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์" title="ศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
			        <?php
			        $categery_menu = App\Category::where('category_status' , '1')->orderBy('category_ranking' , 'asc')->get();
			        ?>
			        @foreach($categery_menu as $maim_menu)
			        <?php
			        	$sub_category_menu = App\SubCategory::where('sub_category_status' , '1')
			        		->where('category_id' , $maim_menu->id)
			        		->orderBy('sub_category_ranking' , 'asc')
			        		->get();
			        ?>
			        	@if(count($sub_category_menu) > 0)
			        	<li class="menu-has-children">
			        		<a href="<?php echo url("หมวดหมู่/$maim_menu->category_slug"); ?>">{{$maim_menu->category_name}}</a>
				            <ul>
				            @foreach($sub_category_menu as $sub_menu)
				            <li><a href="<?php echo url("หมวดหมู่/$maim_menu->category_slug/$sub_menu->sub_category_slug"); ?>">{{$sub_menu->sub_category_name}}</a></li>
				            @endforeach
				              
				            </ul>
				        </li>	
				        @else
				        <li><a href="<?php echo url("หมวดหมู่/$maim_menu->category_slug"); ?>">{{$maim_menu->category_name}}</a></li>
			        	@endif
			        
			        @endforeach
			          <li><a href="{{url('กิจกรรม')}}">รูปภาพกิจกรรม</a></li>
			          <li><a href="{{url('live')}}">วิดีโอการอบรม</a></li>
			          <li><a href="{{url('about')}}">เกี่ยวกับเรา</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>