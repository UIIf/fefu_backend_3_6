<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog</title>
</head>
<body>
    Catalog
    @include('catalog.category_list', ['categories', $categories])

    <div>
        <div>
            <h2>Filters</h2>
            <form method="get">
                <div>
                    <label for="search_query">Search</label>
                    <input type="text" name="search_query" id="search_query" value="{{request('search_query')}}">
                </div>
                <div>
                    <label for="sort_mode">Sort mode</label>
                    <select name="sort_mode" id="sort_mode">
                        <option value="price_asc" {{request('sort_mode') == 'price_asc' ? 'selected': ''}} > Price asc </option>
                        <option value="price_desc" {{request('sort_mode') == 'price_desc' ? 'selected': ''}} > Price desc </option>
                    </select>
                </div>
                @foreach($filters as $filter)
                <div>
                    <h4> {{$filter->name}}</h4>
                    @foreach($filter->options as $option)
                        <div>
                            <label>
                                <input type="checkbox" value="{{$option->value}}"
                                name="filters[{{$filter->key}}][]" {{$option->isSelected ? 'checked' : '' }}>
                                {{$option->value}}({{$option->productCount}})
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
                <button> apply </button>
            </form>
        </div>

        @foreach($products as $product)
        <div>
            <h1>
                <a href="{{ route('product', ['slug' => $product->slug]) }}">
                    {{ $product->name }}
                </a>
            </h1>
            <p>
                {{ $product->price }} rub.
            </p>
        </div>
        @endforeach
    </div>
</body>
</html>