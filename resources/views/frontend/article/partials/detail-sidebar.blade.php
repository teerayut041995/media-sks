<aside class="post-detail-aside" aria-label="ข่าวและข้อมูลเพิ่มเติม">
    @if($recent_posts->isNotEmpty())
        <section class="post-sidebar-section" aria-labelledby="post-sidebar-recent-title">
            <div class="post-sidebar-heading"><span class="post-sidebar-kicker">อัปเดตจากศูนย์</span><h2 id="post-sidebar-recent-title">ข่าวล่าสุด</h2></div>
            <div class="post-sidebar-stories">
                @foreach($recent_posts as $recent)
                    @php
                        $recentName = !empty($recent->post_image) ? basename($recent->post_image) : null;
                        $recentPath = $recentName ? 'images/image_post/'.$recentName : null;
                        $recentImage = $recentPath ? (($aboutPreview || !is_file(public_path($recentPath))) ? 'https://sks.go.th/'.$recentPath : asset($recentPath)) : null;
                        $recentUrl = $postDetailBase.'/'.rawurlencode($recent->uid);
                        $recentDate = $recent->created_at ? \Carbon\Carbon::parse($recent->created_at) : null;
                    @endphp
                    <article class="post-sidebar-story">
                        <a class="post-sidebar-story-image" href="{{ $recentUrl }}" aria-label="อ่านข่าว: {{ $recent->post_title }}">@if($recentImage)<img src="{{ $recentImage }}" width="1290" height="726" alt="" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ภาพข่าว</span>@else<span class="image-fallback">ภาพข่าว</span>@endif</a>
                        <div><h3><a href="{{ $recentUrl }}">{{ $recent->post_title }}</a></h3>@if($recentDate)<time datetime="{{ $recentDate->toDateString() }}">{{ formatDateThaiBirthday($recent->created_at) }}</time>@endif</div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="post-sidebar-section" aria-labelledby="post-sidebar-categories-title">
        <div class="post-sidebar-heading"><span class="post-sidebar-kicker">เลือกอ่านตามความสนใจ</span><h2 id="post-sidebar-categories-title">หมวดหมู่</h2></div>
        <nav class="post-sidebar-categories" aria-label="หมวดหมู่บทความ">
            @foreach($category_menu as $menuCategory)
                @php
                    $menuUid = data_get($menuCategory, 'uid');
                    $menuName = data_get($menuCategory, 'category_name');
                @endphp
                <a href="{{ $postList.'?'.http_build_query(['category' => $menuUid]) }}" @if((string) $post->category_uid === (string) $menuUid) aria-current="location" @endif><span>{{ $menuName }}</span><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
            @endforeach
        </nav>
    </section>

    @if($popular_posts->isNotEmpty())
        <section class="post-sidebar-section" aria-labelledby="post-sidebar-popular-title">
            <div class="post-sidebar-heading"><span class="post-sidebar-kicker">ผู้คนอ่านมากที่สุด</span><h2 id="post-sidebar-popular-title">ยอดนิยม</h2></div>
            <ol class="post-sidebar-popular">
                @foreach($popular_posts as $popular)
                    @php
                        $popularUrl = $postDetailBase.'/'.rawurlencode($popular->uid);
                        $popularName = !empty($popular->post_image) ? basename($popular->post_image) : null;
                        $popularPath = $popularName ? 'images/image_post/'.$popularName : null;
                        $popularImage = $popularPath ? (($aboutPreview || !is_file(public_path($popularPath))) ? 'https://sks.go.th/'.$popularPath : asset($popularPath)) : null;
                    @endphp
                    <li><a class="post-sidebar-popular-image" href="{{ $popularUrl }}" aria-label="อ่านบทความยอดนิยม: {{ $popular->post_title }}">@if($popularImage)<img src="{{ $popularImage }}" width="1290" height="726" alt="" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ภาพบทความ</span>@else<span class="image-fallback">ภาพบทความ</span>@endif<span class="post-sidebar-rank" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span></a><div><h3><a href="{{ $popularUrl }}">{{ $popular->post_title }}</a></h3>@if(isset($popular->views_count))<span class="post-sidebar-views">เข้าชม {{ number_format($popular->views_count) }} ครั้ง</span>@endif</div></li>
                @endforeach
            </ol>
        </section>
    @endif

    <section class="post-sidebar-section" aria-labelledby="post-sidebar-topics-title">
        <div class="post-sidebar-heading"><span class="post-sidebar-kicker">ค้นพบเรื่องอื่น ๆ</span><h2 id="post-sidebar-topics-title">สำรวจหัวข้อ</h2></div>
        <div class="post-sidebar-topics">
            @foreach($category_menu as $menuCategory)
                @foreach(data_get($menuCategory, 'sub_categories', []) as $menuSubcategory)
                    @php
                        $topicCategory = data_get($menuCategory, 'uid');
                        $topicUid = data_get($menuSubcategory, 'uid');
                    @endphp
                    <a href="{{ $postList.'?'.http_build_query(['category' => $topicCategory, 'sub_category' => $topicUid]) }}" @if((string) $post->sub_category_uid === (string) $topicUid) aria-current="location" @endif>{{ data_get($menuSubcategory, 'sub_category_name') }}</a>
                @endforeach
            @endforeach
        </div>
    </section>
</aside>
