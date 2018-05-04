@foreach($categories as $category)
    <li><a href="/categories/{{  $category->id }}">{{ $category->title }}</a></li>
@endforeach
