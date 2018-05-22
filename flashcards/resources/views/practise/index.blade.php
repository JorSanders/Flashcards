@foreach($categories as $category)
<li><a href="/practise/{{  $category->id }}">{{ $category->title }}</a></li>
@endforeach