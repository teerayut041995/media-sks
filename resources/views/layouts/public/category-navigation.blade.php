@foreach($navCategories as $navCategory)
    @php
        $navCategoryUid = data_get($navCategory, 'uid');
        $navCategoryName = data_get($navCategory, 'category_name');
        $navSubcategories = data_get($navCategory, 'sub_categories', []);
        $navCategoryUrl = $navPostsBase.'?'.http_build_query(['category' => $navCategoryUid]);
        $navCategoryActive = (string) ($navCurrentCategory ?? '') === (string) $navCategoryUid;
    @endphp
    @if(count($navSubcategories))
        <div class="nav-disclosure nav-post-category">
            <div class="nav-category-topline">
                <a class="nav-category-link" href="{{ $navCategoryUrl }}" @if($navCategoryActive) data-active="true" @endif>{{ $navCategoryName }}</a>
                <button class="nav-category-toggle" type="button" aria-label="แสดงเมนูย่อย{{ $navCategoryName }}" aria-expanded="false" aria-controls="nav-posts-{{ $navCategoryUid }}" data-nav-disclosure><svg class="icon" aria-hidden="true"><use href="#i-chevron"/></svg></button>
            </div>
            <div class="nav-disclosure-panel" id="nav-posts-{{ $navCategoryUid }}" hidden>
                <a class="nav-all-link" href="{{ $navCategoryUrl }}" @if($navCategoryActive && empty($navCurrentSubcategory)) aria-current="page" @endif>ดู{{ $navCategoryName }}ทั้งหมด</a>
                @foreach($navSubcategories as $navSubcategory)
                    <a href="{{ $navPostsBase.'?'.http_build_query(['category' => $navCategoryUid, 'sub_category' => data_get($navSubcategory, 'uid')]) }}" @if($navCategoryActive && (string) ($navCurrentSubcategory ?? '') === (string) data_get($navSubcategory, 'uid')) aria-current="page" @endif>{{ data_get($navSubcategory, 'sub_category_name') }}</a>
                @endforeach
            </div>
        </div>
    @else
        <a href="{{ $navCategoryUrl }}" @if($navCategoryActive) aria-current="page" @endif>{{ $navCategoryName }}</a>
    @endif
@endforeach
