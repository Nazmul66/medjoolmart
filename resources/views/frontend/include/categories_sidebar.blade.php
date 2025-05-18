@php
    $categories = App\Models\Category::where('front_status', 1)->where('status', 1)->get();
@endphp

<div class="offcanvas offcanvas-start canvas-filter canvas-categories" id="shopCategories">
    <div class="canvas-wrapper">
        <div class="canvas-header">
            <i class='bx bx-slider-alt' style="font-size: 24px;"></i>
            <h5>Categories</h5>
            <i class='bx bx-x' style="font-size: 32px;" data-bs-dismiss="offcanvas" aria-label="Close"></i>
        </div>
        <div class="canvas-body">
            @foreach ($categories as $item)
                @php
                    $subCats = App\Models\SubCategory::where('category_id', $item->id)->where('status', 1)->get();
                @endphp
                <div class="wd-facet-categories">
                    <div role="dialog" class="facet-title collapsed" data-bs-target="#{{ $item->slug }}" data-bs-toggle="collapse" aria-expanded="true" aria-controls="{{ $item->slug }}">
                        <img class="avt" src="{{ asset($item->category_img) }}" alt="{{ $item->slug  }}">
                        <span class="title">{{ $item->category_name }}</span>
                        @if ( $subCats->count() > 0 )
                            <i class='bx bx-chevron-down' style="font-size: 24px;"></i>
                        @endif
                    </div>

                    @if ( $subCats->count() > 0 )
                        <div id="{{ $item->slug }}" class="collapse">
                            <ul class="facet-body">
                                @foreach ($subCats as $row)
                                    <li>
                                        <a href="#" class="item link">
                                            <img class="avt" src="{{ asset($row->subcategory_img) }}" alt="{{ $row->slug  }}">
                                            <span class="title-sub text-caption-1 text-secondary">{{ $row->subcategory_name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>