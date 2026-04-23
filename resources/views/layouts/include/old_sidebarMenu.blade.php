<h2>{{$sideBarData['title']}}</h2>
<ul>
@foreach ($categories as $category)
        @foreach ($category->getLocalName($locale)->get() as $object)
        
            <li><a href="#">{{ $object->name}}</a></li>
            

        @endforeach
    
@endforeach
</ul>