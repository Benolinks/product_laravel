<x-layout>
    <div class="all">
        <h1 class="hh1">This is the index page </h1>

        <div>
            <a href="{{ route('products.create') }}" class="create">Create a New Product </a>
        </div>

        

        <div class="tab">
        <table  border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Product_name</th>
                    <th>Product_description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                 @if ($products->count() > 0)
                @foreach ($products as $product)

               
                    
                    <tr>
                        <td>{{ $product->username }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('/public/images/'.$product->image) }}" alt="" class="image" >
                            @else
                                <p>No image available</p>
                         @endif
                        </td>
                        <td>${{ $product->price }}</td>

                        <td>
                           <a href="{{ route ('products.edit',['product'=>$product]) }}" class="anchor">Edit</a>
                        </td>   
                        <td>
                            <form action=" {{ route('products.destroy',['product'=>$product])}} " method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach



@else
                <h1 style="color: white">Nothing to display</h1>
                    
                @endif
                
               
                    
                
            </tbody>
            
          
        </table>
        </div>
        <br><br>
        <div class="pagination">
    {{ $products->links() }}
</div>

    </div>

</x-layout>