<script type="text/javascript" src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>

<p>todo explain</p>
<p>https://chrome.google.com/webstore/detail/allow-control-allow-origi/nlfbmbojpeacfghkpbjhddihlkkiljbi?hl=en-US</p>
<h1>Create category</h1>
<form method="post" action="{{route('categories.store')}}">
    {{ csrf_field() }}

    <label>Title</label>
    <input placeholder="Enter title"
           required
           name="title"
    />

    <label>Description</label>
    <textarea placeholder="Enter description"
              name="description"
              rows="5"
    ></textarea>

    <div id="cards"></div>

    <input type="submit" value="submit"/>

</form>

<script type="text/javascript" src="{{ URL::asset('js/addFormElements.js') }}"></script>
