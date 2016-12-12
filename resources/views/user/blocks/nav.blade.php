<div id="categorymenu">
      <nav class="subnav">
        <ul class="nav-pills categorymenu">
         <li><a href="{{url('/')}}">Trang chu</a>
          </li>    
          <?php 
            $menu_level_1 = DB::table('cates')->where('parent_id',0)->get();
          ?>
          @foreach($menu_level_1 as $item_level_1)
          <li><a   href="#">{{$item_level_1->name}}</a>
          <?php 
                 $menu_level_2 = DB::table('cates')->where('parent_id',$item_level_1->id)->get();
                 if(count($menu_level_2)>0){
              ?>
            <div>
              <ul>
              @foreach($menu_level_2 as $item_level_2)
                <li><a href="{!! URL('loai-san-pham',[$item_level_2->id,$item_level_2->alias]) !!}">{{ $item_level_2->name }}</a>
                </li>
              @endforeach
              </ul>
            </div>
            <?php }?>
          </li>
          @endforeach
          <li><a href="{{url('/contact')}}">Contact</a>
          </li>         
        </ul>
      </nav>
    </div>