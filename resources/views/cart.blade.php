<x-frontend.master>
    <x-slot name="title">Cart - {{ auth()->user()->name }}</x-slot>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="container mt-4">
            @if(!$bags || $bags->cartItems->isEmpty())
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('welcome') }}" class="btn btn-outline-dark">Back to Home</a>
                </div>
            </div>
            <h2>Cart is empty</h2>
            @else
                <h2 class="py-2">Your Cart</h2>
                <div class="row py-2">
                    <div class="col-md-6">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-dark">Back to Home</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Cart items table -->
                    <table class="table table-bordered">
                        <!-- Table headers -->
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items -->
                            @php $totalPrice = 0; @endphp
                            @foreach ($bags->cartItems as $index => $item)
                                <!-- Cart item row -->
                                <tr>
                                    <!-- Hidden input for cart item id -->
                                    <input type="hidden" name="products[{{ $index }}][cart_item_id]" value="{{ $item->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->product->title }}</td>
                                    <!-- Quantity input -->
                                    <td>
                                        <!-- Quantity adjustment buttons -->
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-danger minus-btn">-</button>
                                            </span>
                                            <input 
                                                type="number" 
                                                class="form-control text-center" 
                                                name="products[{{ $index }}][quantity]" 
                                                value="{{ $item->quantity }}"
                                                data-id="{{ $item->id }}"
                                            >
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-success plus-btn">+</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="unit-price">{{ $item->product->price }}</td>
                                    <input type="hidden" name="products[{{ $index }}][price]" value="{{ $item->product->price }}">
                                    <td class="price">{{ $item->product->price * $item->quantity }}</td>
                                    <!-- Remove button -->
                                    <td class="remove-btn" data-id="{{$item->id}}">
                                        <button type="button" class="btn btn-sm btn-danger">Remove</button>
                                    </td>
                                </tr>
                                <!-- Calculate total price -->
                                @php $totalPrice += ($item->product->price * $item->quantity); @endphp
                            @endforeach
                        </tbody>
                        <!-- Table footer for total -->
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td><b>Grand Total</b></td>
                                <td id="totalprice">{{$totalPrice}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- User details inputs -->
                <div class="row py-4">
                    <div class="form-group col-sm-6">
                        <label for="phone">Phone Number</label>
                        <!-- Phone number input -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+880</span>
                            </div>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="address">Address</label>
                        <!-- Address selection -->
                        <select class="form-control" id="address" name="address">
                            <option value=" ">Select a division</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                    </div>
                </div>
                {{-- Table Ends --}}

                <!-- Checkout Button (Centered) -->
                <div class="row justify-content-end">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-lg btn-outline-success">Place Order</button>
                    </div>
                </div>
            @endif
        </div>
    </form>
    
    <!-- Script section -->
    @push('script')
    <script>
        const removeFromCart = document.querySelectorAll('.remove-btn');
        const decrease = document.querySelectorAll('.minus-btn');

        // removing from cart
        removeFromCart.forEach(function(btn)
        {
            //btn is a callback function
            btn.addEventListener('click', function()
            {
                const id = btn.getAttribute('data-id');

                fetch('/carts/'+id,
                {
                    method : 'DELETE',
                    headers : 
                    {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => 
                {
                    // console.log(data);
                    if(data.success == true)
                    {
                        btn.parentElement.remove()
                        updatingPrice()
                        alert(data.message)
                    }
                    else
                    {
                        alert('Couldn\'t remove item from cart')
                    }
                })
            })
        })

        //Plus Button
        const increase = document.querySelectorAll('.plus-btn');

        increase.forEach(function(btn)
        {
            btn.addEventListener('click', function()
            {
                const quantity = this.parentElement.previousElementSibling;
                //console.log(quantity);

                if(quantity.value == 20)
                {
                    alert('Maximum Order limit reached');
                    return;
                }

                const updatedQuantity = parseInt(quantity.value) + 1;
                quantity.value = updatedQuantity;

                const unitPrice = quantity.parentElement.parentElement.nextElementSibling;
                const updatedPrice = parseFloat(unitPrice.innerText) * updatedQuantity;

                unitPrice.nextElementSibling.innerText = updatedPrice.toFixed(2);

                updatingPrice();

            })
        })

        //Minus Button

        decrease.forEach(function(btn)
        {
            btn.addEventListener('click', function()
            {
                const quantity = this.parentElement.nextElementSibling;
                //console.log(quantity)

                if(quantity.value == 1)
                {
                    alert('Any less than 1 is not acceptable, the remove button is to the right in RED');
                    return;
                }

                const updatedQuantity = parseInt(quantity.value) - 1;
                quantity.value = updatedQuantity;

                const unitPrice = quantity.parentElement.parentElement.nextElementSibling;
                const updatedPrice = parseFloat(unitPrice.innerText) * updatedQuantity;

                unitPrice.nextElementSibling.innerText = updatedPrice.toFixed(2);

                updatingPrice();

            })
        })


        function updatingPrice() {
            let totalprice = 0;

            document.querySelectorAll('.price').forEach(function(seamElement) {
                totalprice += parseFloat(seamElement.innerText);
            });

            document.getElementById('totalprice').innerText =  totalprice.toFixed(2);
        }
    </script>
    @endpush
</x-frontend.master>
