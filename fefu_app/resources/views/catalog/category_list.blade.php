@foreach($categories as $category)
    <ul>
        <li>
            <a href="{{ route('catalog', ['slug' => $category->slug]) }}">
                {{ $category->name }}
            </a>
            @if($category->children)
                @include('catalog.category_list', ['categories' => $category->children])
            @endif
        </li>
    </ul>
@endforeach