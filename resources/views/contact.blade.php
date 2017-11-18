{{--@foreach($contacts as $contact)--}}

       {{--<h4>{{$contact->firstname}}</h4>--}}
  {{--<p>{{$contact->firstname}}</p>--}}


{{--@endforeach--}}


<div class="container">
    <div class="row">
        <form action="store" method="post" enctype="multipart/form-data">
            <input type="text" name='name'>
            <input type="file" name="image">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</div>