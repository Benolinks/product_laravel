<x-layout>
    <div class="all">
        <h1 class="hh1">This is the edit page </h1>
     
        <form action="{{ route('products.update',['product'=> $product]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('Put')
            <!-- Form fields for creating a product would go here -->

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="form_div">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"  value="{{ $product->username }}" required>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name"  value="{{ $product->product_name }}" required>

        

            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description"   required> {{  $product->product_description}}</textarea>

             <td>
                            @if ($product->image)
                                <img src="{{ asset('/public/images/'.$product->image) }}" alt="" class="image" >
                            @else
                                <p>No image available</p>
                         @endif
                        </td>
                        <br><br>
            
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image">

            <label for="price">Price $:</label>
            <input type="text" id="price" name="price"  value="{{ $product->price }}" required> <br>

            <button type="submit">Update</button>
            </div>
        </form>
    </div>
</x-layout>